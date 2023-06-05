<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\AdminClientOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

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
            
            if(!empty($orders)) {
                
                foreach ($orders as $key => $tenant) {
                    $tenantID = $tenant->tenant_id;
                    $tenantDBName = "tenant$tenantID"; // Tenant ID is also used as the database name, prefixed with tenant
                    Config::set('database.connections.mysql.database', $tenantDBName);
                    DB::connection('mysql')->reconnect();
                    DB::setDatabaseName($tenantDBName);
                    $tenantBio = DB::table('bios')->get();
                    
                    if (count($tenantBio) < 1) {
                        // return response()->json(['msg' => $tenantDBName], 200);
                        DB::connection()->statement("DROP DATABASE IF EXISTS $tenantDBName");
                        Config::set('database.connections.mysql.database', env('DB_DATABASE'));
                        DB::connection('mysql')->reconnect();
                        DB::setDatabaseName(env('DB_DATABASE'));
                        $adminOrders->where('tenant_id', $tenantID)->delete();
                        $tenants->where('id', $tenantID)->delete();
                        
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
}
