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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('othername')->nullable();
            $table->bigInteger('profession_id')->unsigned(); 
            $table->string('username')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->timestamp('email_verified_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('avatar')->nullable();
            $table->enum('gender', ['M', 'F'])->nullable();
            $table->enum('plan', ['F', 'P'])->default('F');
            $table->enum('role', ['Client', 'Admin', 'SuperAdmin'])->default('Client');
            $table->date('DOB')->nullable();
            $table->string('password');
            $table->text('accessToken')->nullable()->default(null);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('profession_id')->references('id')->on('professions')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
