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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->integer('created');
            $table->string('collection_method');
            $table->string('currency');
            $table->string('billing_reason');
            $table->integer('amount_paid');
            $table->integer('amount_remaining');
            $table->enum('web_creation', ['pending', 'success'])->default('pending');
            $table->json('discount')->nullable();
            $table->string('account_country')->nullable();
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
        Schema::dropIfExists('payments');
    }
};
