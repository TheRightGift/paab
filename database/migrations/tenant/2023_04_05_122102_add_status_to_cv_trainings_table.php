<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('c_v__trainings', function (Blueprint $table) {
            $table->enum('status', ['Yes', 'Ongoing']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('c_v__trainings', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
