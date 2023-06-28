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
        Schema::create('developer_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('developer_id');
            $table->string('zip_url');
            $table->string('name');
            $table->enum('approved', [0, 1])->default(0);
            $table->enum('paid', [0, 1])->default(0);
            $table->timestamps();

            $table->foreign('developer_id')->references('id')->on('developers')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('developer_projects');
    }
};
