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
        Schema::create('bios', function (Blueprint $table) {
            $table->id();
            $table->text('about')->nullable();
            $table->string('photo')->nullable();
            $table->string('firstname')->nullable();
            $table->unsignedBigInteger('title_id')->nullable();
            $table->string('lastname')->nullable();
            $table->string('othername')->nullable();
            $table->enum('gender', ['M', 'F', 'O']);
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
        Schema::dropIfExists('bios');
    }
};
