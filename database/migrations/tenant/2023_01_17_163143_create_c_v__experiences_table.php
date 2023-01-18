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
            $table->text('position');
            $table->text('institution');
            $table->text('location');
            $table->integer('yearStart');
            $table->integer('monthStart');
            $table->integer('yearEnd')->nullable();
            $table->integer('monthEnd')->nullable();
            $table->json('activities');
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
