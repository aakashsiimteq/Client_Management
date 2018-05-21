<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('project_id');
            $table->string('project_number')->unique();
            $table->integer('customer_id')->unsigned();
            $table->string('project_name');
            $table->enum('project_type', ['Website', 'Software', 'Web service', 'Cloud', 'Network Installation', 'Computer Maintenance','Other']);
            $table->text('project_details')->nullable(true);
            $table->enum('project_status', ['In Progress', 'Complete'])->nullable(true);
            $table->date('project_start_date')->nullable(true);
            $table->date('project_end_date')->nullable(true);
            $table->integer('project_estimate_hour')->unsigned();
            $table->double('project_per_hour_cost')->unsigned();
            $table->double('project_estimate_cost')->unsigned();
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
        Schema::dropIfExists('projects');
    }
}
