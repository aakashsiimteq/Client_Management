<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('customer_id');
            $table->string('customer_number')->unique();
            $table->string('customer_name');
            $table->enum('customer_type', ['Company', 'Individual'])->nullable(true);
            $table->string('customer_abn_no')->nullable(true);
            $table->string('customer_email')->unique()->nullable(true);
            $table->string('customer_contact_no')->unique()->nullable(true);
            $table->string('customer_physical_address')->nullable(true);
            $table->string('customer_billing_address')->nullable(true);
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
        Schema::dropIfExists('customers');
    }
}
