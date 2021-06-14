<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizAnalyticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_analytics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quiz_id')->unsigned()->index();
            $table->integer('creator')->unsigned()->index();
            $table->integer('player')->unsigned()->index();
            $table->integer('correct')->unsigned()->index()->default(0);
            $table->integer('wrong')->unsigned()->index()->default(0);
            $table->integer('unanswered')->unsigned()->index()->default(0);
            $table->string('questions_correct')->nullable();
            $table->string('questions_wrong')->nullable();
            $table->string('questions_unanswered')->nullable();
            $table->integer('total')->unsigned()->index()->default(0);
            $table->timestamps();

            $table->foreign('creator')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('player')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_analytics');
    }
}
