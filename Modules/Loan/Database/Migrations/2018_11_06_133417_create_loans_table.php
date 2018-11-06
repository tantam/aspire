<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index();
            $table->bigInteger('amount')->comment('in cents');
            $table->integer('duration')->comment('months');
            $table->integer('repayment_frequency')->comment('every x month');
            $table->float('interest_rate');
            $table->bigInteger('arrangement_fee');
            $table->boolean('status')->default(1)->comment('1: open, 0: closed, 2:finished');
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
        Schema::dropIfExists('loans');
    }
}
