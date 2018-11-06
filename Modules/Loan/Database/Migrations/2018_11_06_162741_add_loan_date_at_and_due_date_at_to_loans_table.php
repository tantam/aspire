<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLoanDateAtAndDueDateAtToLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dateTime('loan_date_at')->nullable();
            $table->dateTime('due_date_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn(['loan_date_at','due_date_at']);
        });
    }
}
