<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->increments('payment_details_id');
            $table->integer('customer_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->double('project_final_amount')->unsigned();
            $table->double('project_paid_amount')->unsigned()->nullable(true);
            $table->double('project_due_amount')->unsigned()->nullable(true);
            $table->date('last_amount_paid_on')->nullable(true);
            $table->enum('payment_status', ['Pending', 'Complete']);
            $table->enum('payment_method', ['Manual', 'Card', 'Check']);
            $table->mediumText('payment_comment');
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
        Schema::dropIfExists('payment_details');
    }
}
