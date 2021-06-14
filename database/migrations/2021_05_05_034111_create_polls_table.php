<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('question')->nullable();
            $table->string('first_choice');
            $table->string('second_choice');
            $table->string('third_choice')->nullable();
            $table->string('fourth_choice')->nullable();
            $table->integer('first_choice_total')->unsigned()->index()->default(0);
            $table->integer('second_choice_total')->unsigned()->index()->default(0);
            $table->integer('third_choice_total')->unsigned()->index()->default(0);
            $table->integer('fourth_choice_total')->unsigned()->index()->default(0);
            $table->integer('total')->unsigned()->index()->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polls');
    }
}
