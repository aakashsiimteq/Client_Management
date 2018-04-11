<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('invoice_id');
            $table->string('invoice_number')->unique();
            $table->integer('customer_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->float('invoice_gst_rate')->nullable(true)->unsigned();
            $table->double('invoice_final_cost')->unsigned();
            $table->date('invoice_date');
            $table->enum('invoice_status', ['Open', 'Close']);
            $table->enum('invoice_copy_type', ['By hand', 'By Email'])->nullable(true);
            $table->enum('invoice_payment_terms', ['Credit card', 'Cash', 'Cheque', 'Other']);
            $table->string('invoice_billing_address');
            $table->text('invoice_comments')->nullable(true);
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
        Schema::dropIfExists('invoices');
    }
}
