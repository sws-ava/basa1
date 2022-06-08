<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyBadgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_badges', function (Blueprint $table) {
            // $table->id();
            $table->string('company_badges_company_id')->nullable();
            $table->string('company_badges_array')->nullable();
            $table->string('company_badges_blacklist')->nullable();
            $table->string('company_badges_rik_now')->nullable();
            $table->string('company_badges_rik_middle')->nullable();
            $table->string('company_badges_rik_member')->nullable();
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
        Schema::dropIfExists('company_badges');
    }
}
