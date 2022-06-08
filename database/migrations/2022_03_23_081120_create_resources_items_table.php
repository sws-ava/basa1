<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcesItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources_items', function (Blueprint $table) {
            $table->id('resources_items_id');
            $table->string('resources_items_cat')->nullable();
            $table->string('resources_items_name');
            $table->string('resources_items_type');
            $table->bigInteger('resources_items_order')->nullable();
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
        Schema::dropIfExists('resources_items');
    }
}
