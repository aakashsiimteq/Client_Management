<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomInvoiceItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_invoice_items', function (Blueprint $table) {
            $table->increments('custom_invoice_item_id');
            $table->integer('custom_invoice_number')->unsigned();
            $table->string('custom_invoice_product_name');
            $table->integer('custom_invoice_product_quantity');
            $table->double('custom_invoice_product_cost');
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
        //
    }
}
