<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_resources', function (Blueprint $table) {
            $table->bigInteger('company_resources_id');
            $table->string('company_resources_checkbox_array')->nullable();
            $table->string('company_resources_focus_rooms')->nullable();
            $table->string('company_resources_placements')->nullable();
            $table->string('company_resources_placements_area')->nullable();
            $table->string('company_resources_tablets')->nullable();
            $table->string('company_resources_tablets_more')->nullable();
            $table->string('company_resources_interviewers')->nullable();
            $table->string('company_resources_regions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_resources');
    }
}
