<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCompaniesMoreColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('fb')->nullable();
            $table->string('tw')->nullable();
            $table->string('tg')->nullable();
            $table->string('insta')->nullable();
            $table->string('whatsup')->nullable();
            $table->string('vk')->nullable();
            $table->string('shtat')->nullable();
            $table->string('analit')->nullable();
            $table->string('managers')->nullable();
            $table->string('noshtat')->nullable();
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
