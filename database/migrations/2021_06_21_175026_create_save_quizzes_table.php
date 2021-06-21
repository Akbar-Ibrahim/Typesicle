<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaveQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('save_quizzes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quiz_id')->unsigned()->index();
            $table->string('question');
            $table->string('option_one');
            $table->string('option_two');
            $table->string('option_three');
            $table->string('option_four');
            $table->string('correct_answer');
            $table->text('image')->nullable();
            $table->timestamps();

            $table->foreign('quiz_id')->references('id')->on('quizzes');
            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('save_quizzes');
    }
}
