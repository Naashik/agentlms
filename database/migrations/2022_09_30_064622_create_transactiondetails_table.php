<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactiondetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactiondetails', function (Blueprint $table) {
            $table->id();
            $table->string('transaction')->nullable();
            $table->date('reminder')->nullable();
            $table->time('time')->nullable();
            $table->date('current_date')->nullable();
            $table->decimal('amount', $precision = 8, $scale = 2)->nullable();
            $table->string('currency')->nullable();
            $table->unsignedBigInteger('leadid')->nullable();
            $table->foreign('leadid')->references('id')->on('leads')->onDelete('cascade');
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
        Schema::dropIfExists('transactiondetails');
    }
}