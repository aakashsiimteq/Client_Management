<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogPaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_payment_details', function (Blueprint $table) {
            $table->increments('log_payment_id');
            $table->integer('payment_details_id')->unsigned();
            $table->double('project_paid_amount')->unsigned();
            $table->double('project_due_amount')->unsigned();
            $table->enum('payment_status', ['Pending', 'Complete']);
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_payment_details');
    }
}
