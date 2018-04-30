<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_invoices', function (Blueprint $table) {
            $table->increments('custom_invoice_id');
            $table->integer('custom_invoice_number')->unsigned();
            $table->string('custom_customer_name')->nullable(true);
            $table->string('custom_customer_address')->nullable(true);
            $table->double('custom_invoice_amount');
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
        Schema::dropIfExists('custom_invoices');
    }
}
