<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('heads', function (Blueprint $table) {
            $table->id('heads_id');
            $table->bigInteger('heads_company_id');
            $table->bigInteger('heads_cat')->nullable();
            $table->string('heads_first_name')->nullable();
            $table->string('heads_second_name')->nullable();
            $table->string('heads_last_name')->nullable();
            $table->string('heads_phone')->nullable();
            $table->string('heads_mail')->nullable();
            $table->string('heads_fb')->nullable();
            $table->string('heads_insta')->nullable();
            $table->string('heads_vk')->nullable();
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
        Schema::dropIfExists('heads');
    }
}
