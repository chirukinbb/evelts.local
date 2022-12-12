<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->string('thumbnail_url');
            $table->string('address');
            $table->text('description');
            $table->string('coordinate_lat');
            $table->string('coordinate_lng');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('point_id');
            $table->string('planing_time');
            $table->integer('slots');
            $table->integer('is_happened')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')
                ->on('categories')->onDelete('cascade');
            $table->foreign('country_id')->references('id')
                ->on('countries')->onDelete('cascade');
            $table->foreign('point_id')->references('id')
                ->on('points')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
