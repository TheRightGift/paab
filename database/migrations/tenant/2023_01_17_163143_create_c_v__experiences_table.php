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
        Schema::create('c_v__experiences', function (Blueprint $table) {
            $table->id();
            $table->text('position')->nullable();
            $table->text('institution')->nullable();
            $table->text('location')->nullable();
            $table->integer('yearStart')->nullable();
            $table->integer('monthStart')->nullable();
            $table->integer('yearEnd')->nullable();
            $table->integer('monthEnd')->nullable();
            $table->json('activities')->nullable();
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
        Schema::dropIfExists('c_v__experiences');
    }
};
