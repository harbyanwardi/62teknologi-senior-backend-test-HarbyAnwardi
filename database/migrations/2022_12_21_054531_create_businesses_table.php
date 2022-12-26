<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias');
            $table->string('phone');
            $table->decimal('distance',18,12);
            $table->string('image_url');
            $table->string('is_closed');
            $table->integer('price');
            $table->integer('rating')->default('0');
            $table->integer('review_count')->default('0');
            $table->string('transaction_url')>nullable();
            $table->string('url')>nullable();
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
        Schema::dropIfExists('businesses');
    }
}
