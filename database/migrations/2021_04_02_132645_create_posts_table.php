<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('category_id')->index()->nullable();
            $table->unsignedBigInteger('photo_id')->index()->nullable();
            $table->string('title');
            $table->string('url');
            $table->text('body');
            $table->integer('likes')->unsigned()->index()->default(0);
            $table->integer('shares')->unsigned()->index()->default(0);
            // $table->string('is_liked')->nullable();
            // $table->string('is_shared')->nullable();
            $table->string('is_published')->default("yes");
            $table->integer('responding_to')->nullable()->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('photo_id')->references('id')->on('photos');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
