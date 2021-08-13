<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('post_id')->index()->nullable();
            $table->unsignedBigInteger('category_id')->index()->nullable();
            $table->unsignedBigInteger('quiz_id')->index()->nullable();
            $table->unsignedBigInteger('shortie_id')->index()->nullable();
            $table->unsignedBigInteger('thread_id')->index()->nullable();
            $table->unsignedBigInteger('poll_id')->index()->nullable();
            $table->string('reposted')->nullable()->default('no');
            $table->text('repost_message')->nullable();
            $table->string('status')->nullable();
            $table->integer('views')->unsigned()->index()->default(0);
            $table->integer('quotes')->unsigned()->index()->default(0);
            // $table->integer('likes')->unsigned()->index()->default(0);
            // $table->integer('shares')->unsigned()->index()->default(0);
            // $table->string('is_liked')->nullable();
            // $table->string('is_shared')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('quiz_id')->references('id')->on('quizzes');
            $table->foreign('shortie_id')->references('id')->on('shorties');
            $table->foreign('thread_id')->references('id')->on('threads');
            $table->foreign('poll_id')->references('id')->on('polls');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feeds');
    }
}
