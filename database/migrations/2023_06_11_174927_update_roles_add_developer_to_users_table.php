<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            DB::transaction(function () {
                // DB::statement("ALTER TABLE users CHANGE COLUMN permissions permissions ENUM('admin', 'user', 'candidate') NOT NULL DEFAULT 'user'");

                DB::statement("ALTER TABLE users CHANGE COLUMN role role ENUM('Client', 'Admin', 'SuperAdmin', 'Developer') NOT NULL DEFAULT 'Client'");
            });
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
};
