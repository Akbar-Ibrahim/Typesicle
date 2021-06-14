<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shorties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->integer('quoted')->index()->nullable()->default(0);
            $table->integer('replies')->index()->nullable()->default(0);
            $table->text('shortie')->nullable();
            $table->string('status')->nullable();
            $table->integer('likes')->index()->nullable()->default(0);
            $table->integer('shares')->index()->nullable()->default(0);
            $table->integer('commenting_on')->index()->nullable()->default(0);
            $table->integer('thread_id')->index()->nullable()->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('thread_id')->references('id')->on('threads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shorties');
    }
}
