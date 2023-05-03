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
        Schema::create('webcreations', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('domainName');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('tenant_id');
            $table->enum('web_creation', ['pending', 'success'])->default('pending');
            $table->enum('site_active', ['true', 'false'])->default('true');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webcreations');
    }
};
