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
        Schema::create('c_v__additional__schools', function (Blueprint $table) {
            $table->id();
            $table->text('institution');
            $table->integer('yearStart')->nullable();
            $table->integer('monthStart')->nullable();
            $table->integer('yearEnd')->nullable();
            $table->integer('monthEnd')->nullable();
            $table->string('degree');
            $table->string('title');
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
        Schema::dropIfExists('c_v__additional__schools');
    }
};
