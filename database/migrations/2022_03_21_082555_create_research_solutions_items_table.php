<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResearchSolutionsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_solutions_items', function (Blueprint $table) {
            $table->id('research_solutions_items_id');
            $table->string('research_solutions_items_cat')->nullable();
            $table->string('research_solutions_items_name');
            $table->bigInteger('research_solutions_items_order')->nullable();
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
        Schema::dropIfExists('research_solutions_items');
    }
}
