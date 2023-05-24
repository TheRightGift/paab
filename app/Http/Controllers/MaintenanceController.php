<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminClientOrder;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class MaintenanceController extends Controller
{
    public function checkTenantNRemoveIfBioIsEmpty () {
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
                return response()->json(['msg' => $status, 'lastTenant' => $lastRemoved]);
            } else {
                return response()->json(['msg' => 'No clients created by admins yet', 'lastTenant' => $lastRemoved]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    } 

    // public function loopThruTenants
}
