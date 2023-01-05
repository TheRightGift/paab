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
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('imageUrl');
            $table->bigInteger('profession_id')->unsigned();
            $table->string('styleFile');
            $table->enum('approved', ['F', 'T'])->default('F');
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
        Schema::dropIfExists('templates');
    }
};
