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
            $table->string('custom_invoice_number');
            $table->string('custom_customer_name')->nullable(true);
            $table->enum('project_type', ['Website', 'Software', 'Web service', 'Cloud', 'Network Installation', 'Computer Maintenance','Other']);
            $table->string('project_title');
            $table->double('project_per_hour_cost');
            $table->double('project_estimate_cost');
            $table->double('project_final_cost');
            $table->string('invoice_reference');
            $table->double('invoice_total_amount');
            $table->double('invoice_gst_rate')->nullable(true);
            $table->double('invoice_grand_total');
            $table->double('invoice_paid_amount');
            $table->double('invoice_unpaid_amount');
            $table->enum('invoice_status', ['Open', 'Close']);
            $table->date('invoice_date');
            $table->enum('invoice_copy_type', ['By hand', 'By Email'])->nullable(true);
            $table->mediumText('invoice_billing_address');
            $table->text('project_desc')->nullable(true);
            $table->mediumText('invoice_comments')->nullable(true);
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
