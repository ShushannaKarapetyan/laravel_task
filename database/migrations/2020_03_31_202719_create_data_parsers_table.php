<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataParsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_parsers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('coverImage')->nullable();
            $table->timestamp('releaseDate')->nullable();
            $table->double('rating');
            $table->json('category')->nullable();
            $table->string('director');
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
        Schema::dropIfExists('data_parsers');
    }
}
