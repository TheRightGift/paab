<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\AdminClientOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

class MaintenanceController extends Controller
{
    public function checkTenantNRemoveIfBioIsEmpty()
    {
        try {
            $adminOrders = new AdminClientOrder();
            $tenants = new Tenant();
            $orders = $adminOrders->get();
            $status = 'Success';
            $lastRemoved = null;
            if (!empty($orders)) {
                foreach ($orders as $key => $tenant) {
                    $tenantID = $tenant->tenant_id;
                    $tenantDBName = "tenant$tenantID"; // Tenant ID is also used as the database name, prefixed with tenant
                    Config::set('database.connections.mysql.database', $tenantDBName);
                    DB::connection('mysql')->reconnect();
                    DB::setDatabaseName($tenantDBName);
                    $tenantBio = DB::table('bios')->get();
                    if (count($tenantBio) === 0) {
                        DB::connection()->statement("DROP DATABASE IF EXISTS $tenantDBName");
                        Config::set('database.connections.mysql.database', env('DB_DATABASE'));
                        DB::connection('mysql')->reconnect();
                        DB::setDatabaseName(env('DB_DATABASE'));
                        $adminOrders->where('tenant_id', $tenantID)->delete();
                        $tenants->where('id', $tenantID)->delete();

                        // Delete the user file
                        // $imageToDelete = public_path()."/media/tenants/$tenantID/img";
                        // if ( file_exists($imageToDelete))
                        // {
                        //     unlink($imageToDelete);
                        // }
                        $status = 'Tenant Removed';
                        $lastRemoved = $tenant;
                    } else {
                        $status = 'No action to reproduce';
                    }
                }
                return response()->json(['msg' => $status, 'lastTenant' => $lastRemoved], 204);
            } else {
                return response()->json(['msg' => 'No clients created by admins yet', 'lastTenant' => $lastRemoved]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function loopThruTenantsWithFaultyCr8()
    {
        $adminOrders = new AdminClientOrder();
        $tenants = new Tenant();
        $orders = $adminOrders->get();
        $data = array();
        if (!empty($orders)) {
            foreach ($orders as $key => $tenant) {
                $tenantID = $tenant->tenant_id;
                $tenantDBName = "tenant$tenantID"; // Tenant ID is also used as the database name, prefixed with tenant
                Config::set('database.connections.mysql.database', $tenantDBName);
                DB::connection('mysql')->reconnect();
                DB::setDatabaseName($tenantDBName);
                $tenantBio = DB::table('bios')->get();
                if (count($tenantBio) === 0) {
                    array_push($data, $tenant);
                }
            }
            return response()->json(['msg' => 'Fetched', 'data' => $data]);
        } else {
            return response()->json(['msg' => 'No data to fetch']);
        }
    }

    public function removeUser ($tenantID) {
        $adminOrders = new AdminClientOrder();
        $tenants = new Tenant();
        $tenantDBName = "tenant$tenantID"; // Tenant ID is also used as the database name, prefixed with tenant
        Config::set('database.connections.mysql.database', $tenantDBName);
        DB::connection('mysql')->reconnect();
        DB::setDatabaseName($tenantDBName);
        $tenantBio = DB::table('bios')->get();
        if (count($tenantBio) === 0) {
            DB::connection()->statement("DROP DATABASE IF EXISTS $tenantDBName");
            Config::set('database.connections.mysql.database', env('DB_DATABASE'));
            DB::connection('mysql')->reconnect();
            DB::setDatabaseName(env('DB_DATABASE'));
            $adminOrders->where('tenant_id', $tenantID)->delete();
            $tenants->where('id', $tenantID)->delete();
        }
        return response()->json(['msg' => 'Removed On succes'], 204);
    }

    public function removeTenant ($tenantID) {
        $adminOrders = new AdminClientOrder();
        $tenants = new Tenant();
        $tenantDBName = "tenant$tenantID"; // Tenant ID is also used as the database name, prefixed with tenant
        
        DB::connection()->statement("DROP DATABASE IF EXISTS $tenantDBName");
        Config::set('database.connections.mysql.database', env('DB_DATABASE'));
        DB::connection('mysql')->reconnect();
        DB::setDatabaseName(env('DB_DATABASE'));
        $adminOrders->where('tenant_id', $tenantID)->delete();
        $tenants->where('id', $tenantID)->delete();
    
        return response()->json(['msg' => 'Removed On succes'], 204);
    }

    public function checkUsersThatMadeChanges() {
        $users = new User();
        $userMadeChanges = $users->where([['role', 'Client'], ['title_id', '!=', null]])->get();
        return response()->json(['msg' => 'Users Fetched', 'user' => $userMadeChanges], 200);
    }

    public function getTenants() {
        $tenants = Tenant::with('order')->get();
        $data = [];
        foreach ($tenants as $key => $value) {
            // If client add siteclaimed to true
            if ($this->checkIfStillAdminCreated($value->user_id)) {
                // Check if user is subcsribed
                if (!$this->checkIfUserHasSubscribed($value->user_id)[0]) {
                    $userId = $value->id;
                    $created_at = Carbon::parse($value->updated_at)->toIso8601String();
                    $subscribed = 0;
                    $claimed = 1;
                    $email = $value->order == null ? $this->checkIfUserHasSubscribed($value->user_id)[1] : $value->order->email;
                }
            } else {
                $userId = $value->id;
                $created_at = Carbon::parse($value->updated_at)->toIso8601String();
                $subscribed = 0;
                $claimed = 0;
                $email = $value->order == null ? $this->checkIfUserHasSubscribed($value->user_id)[1] : $value->order->email;
            }
            $this->addToArray($data, $userId, $created_at, $subscribed, $claimed, $email);
        }

        return response()->json($data);
    }

    private function checkIfStillAdminCreated($id) {
        $user = new User();
        $check = $user->find($id)->role;
        if ($check == 'Client') {
            return true;
        } else {
            return false;
        }
    }

    private function checkIfUserHasSubscribed ($userId) {
        $user = User::find($userId);
        if ($user->subscribed()) {
            return [true, $user->email];
        } else {
            return [false, $user->email];
        }
    }

    private function addToArray(&$array, $id, $created_at, $subscribed, $claimed, $email) {
        $data = [
            'id' => $id,
            'created' => $created_at,
            'subscribed' => $subscribed,
            'claimed' => $claimed,
            'email' => $email,
        ];
        array_push($array, $data);
    }
}
