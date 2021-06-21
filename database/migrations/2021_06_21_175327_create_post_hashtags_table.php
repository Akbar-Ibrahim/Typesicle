<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostHashtagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_hashtags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('feed_id')->index()->unsigned();
            $table->integer('hashtag_id')->index()->unsigned();
            $table->timestamps();

            $table->foreign('hashtag_id')->references('id')->on('hashtags');
            $table->foreign('feed_id')->references('id')->on('feeds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_hashtags');
    }
}
