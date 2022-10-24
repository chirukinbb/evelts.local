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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('parent_comment_id')->default(0);
            $table->text('content');

            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->foreign('event_id')->references('id')
                ->on('events')->onDelete('cascade');
            $table->foreign('parent_comment_id')->references('id')
                ->on('comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
