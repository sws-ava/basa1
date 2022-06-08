<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('entity')->nullable();
            $table->string('foundation')->nullable();
            $table->string('legal_form')->nullable();
            $table->string('ownership')->nullable();
            $table->string('inn')->nullable();
            $table->string('ogrn')->nullable();
            $table->string('soc')->nullable();
            $table->string('employees')->nullable();
            $table->string('filials')->nullable();
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
