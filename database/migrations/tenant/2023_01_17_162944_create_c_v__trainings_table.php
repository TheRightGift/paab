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
        Schema::create('c_v__trainings', function (Blueprint $table) {
            $table->id();
            $table->text('institution');
            $table->text('location');
            $table->integer('yearStart');
            $table->integer('monthStart');
            $table->integer('yearEnd')->nullable();
            $table->integer('monthEnd')->nullable();
            $table->string('specialty')->nullable();
            $table->string('title')->nullable();
            $table->string('sub_specialty')->nullable();
            $table->enum('type', ['fellowship', 'residency', 'internship'])->nullable();
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
        Schema::dropIfExists('c_v__trainings');
    }
};
