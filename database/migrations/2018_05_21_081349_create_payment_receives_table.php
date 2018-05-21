<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_receives', function (Blueprint $table) {
            $table->increments('payment_id');
            $table->integer('customer_id')->unsigned(true);
            $table->integer('project_id')->unsigned(true);
            $table->string('invoice_id');
            $table->double('invoice_final_amount');
            $table->double('invoice_paid_amount');
            $table->double('invoice_due_amount');
            $table->timestamp('last_amount_paid_on')->nullable(true);
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
        Schema::dropIfExists('payment_receives');
    }
}
