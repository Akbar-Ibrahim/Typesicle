@extends('layouts.home')

@section('styles')

<link href="{{ asset('css/search-dropdown.css') }}" rel="stylesheet">

<style>
/* label {
     border: 2px solid black; 
    font-size: 12px;
} */

input {
    border: none;
}

.options {
    margin-bottom: 20px;
}
</style>
@endsection


@section('content')
@include('includes.urls')
<h1 id="time">5</h1>
<div class="w3-container">
    <div class="w3-row">

        <div class="w3-threequarter">
            <!-- Start of post div -->

            @guest

            @else
            <div>
                <a href="{{ route('profile.show', Auth::user()->username) }}"> Back to profile </a>
            </div>
            @endauth




            <div class="w3-container my-4">
                <postsearch-component></postsearch-component>
            </div>

            <!-- Main Post/Article -->
            </h1>
            <div class="w3-container w3-margin-bottom">
                <div class="d-flex">
                    <div class="px-2">
                        <a href="{{ route('profile.show', $creator->username) }}">
                            <img src="/images/{{ $creator->id }}/profile_pic/{{ $creator->profile->picture }}"
                                alt="Avatar" class="w3-center w3-circle w3-border " style="width:35px">
                        </a>
                    </div>


                    <div class="flex-grow-1">
                        <div><a href="{{ route('profile.show', $creator->username) }}">
                                {{ $creator->name }}
                            </a>
                        </div>

                        <div style="font-size: 12px;" class="w3-opacity pr-2 pr-1">
                            {{ $quiz->created_at->toFormattedDateString() }}
                        </div>
                    </div>

                </div>
            </div>

            <hr class="w3-clear">


            <div class="w3-container" style="margin-top: 100px;">
                <div class="w3-container w3-margin-bottom">
                    <h1> {{ $quiz->name ?? '' }} </h1>
                </div>
                <div class="w3-container w3-margin-bottom">
                    <h3> {{ $quiz->description }} </h3>
                </div>
            </div>



            <h1 id="playStatus" playStatus="{{ $player ? 'Played' : 'Play' }}"> {{ $player ? "Played" : "Play" }} </h1>
            <div>
                <form method="post" action="/quiz/process">
                    @csrf

                    <input type="hidden" name="creator" value="{{ $quiz->user_id }}">
                    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">


                    <div class="quizzes">
                        @foreach($questions as $question)

                        <div class="w3-border w3-margin-bottom" style="border-radius: 20px;">
                            <div class="questionBox w3-margin">
                                <h5 class="questionHeader"> {{ $question->question }} </h5>
                            </div>

                            @if($question->image)
                            <div class="w3-margin">
                                <img src="{{ $question->image }}" alt=""
                                    style="width: 60%; height: 280px; object-fit: cover;" onclick="showImage(this)"
                                    class="w3-hide-small">
                                <img src="{{ $question->image }}" alt=""
                                    style="width: 100%; height: 280px; object-fit: cover;" onclick="showImage(this)"
                                    class="w3-hide-large">
                            </div>
                            @endif

                            <div class="options w3-margin" ca="{{ $question->correct_answer }}"
                                chosen="{{ $question->quizAnswer ? $question->playerAnswer(Auth::user()->id)->answer : '' }}">


                                <div class="w3-margin-bottom">
                                    <input questionId="{{ $question->id }}" class="optionRadio optionInput" type="radio"
                                        name="myChoice1" value="{{ $question->option_one }}">
                                    <label class="optionLabel w3-padding" value="{{ $question->option_one }}" for="">
                                        {{ $question->option_one }}

                                    </label>
                                </div>

                                <div class="w3-margin-bottom">
                                    <input questionId="{{ $question->id }}" class="optionRadio optionInput" type="radio"
                                        name="myChoice1" value="{{ $question->option_two }}">
                                    <label class="optionLabel w3-padding" value="{{ $question->option_two }}" for="">
                                        {{ $question->option_two }} </label>
                                </div>

                                <div class="w3-margin-bottom">
                                    <input questionId="{{ $question->id }}" class="optionRadio optionInput" type="radio"
                                        name="myChoice1" value="{{ $question->option_three }}">
                                    <label class="optionLabel w3-padding" value="{{ $question->option_three }}" for="">
                                        {{ $question->option_three }} </label>
                                </div>

                                <div class="w3-margin-bottom">
                                    <input questionId="{{ $question->id }}" class="optionRadio optionInput" type="radio"
                                        name="myChoice1" value="{{ $question->option_four }}">
                                    <label class="optionLabel w3-padding" value="{{ $question->option_four }}" for="">
                                        {{ $question->option_four }} </label>
                                </div>

                                <input style='display: none;' class='choice' type='text' value='choice'>

                                <input style='display: none;' class='correct-answer-hidden requiredQuestionInput option'
                                    type='text' value='{{ $question->correct_answer }}'>
                            </div>
                        </div>
                        @endforeach

                    </div>



                    <!-- <input id="submit" type="button" value="Submit"> -->
                    @can('canPlayQuiz', $quiz)
                    <div id="submitQuiz" class="w3-container">
                        <button id="submit">Submit</button>
                    </div>
                    @endcan
                    @foreach($questions as $question)
                    <input class="questionId" type="hidden" value="{{ $question->id }}">
                    @endforeach
                    @foreach($questions as $question)
                    <input id="{{ $question->id }}" class="selected" type="hidden" value="">
                    @endforeach
                </form>

            </div>



            @include('includes.imageModal')



            <!-- End of post div -->
        </div>


        <!--  -->
        <!--  -->
        <!--  -->
        <!--  -->
        <!--  -->


        <div class="w3-quarter">
            <h2>Posts by those who follow this author</h2>
        </div>

    </div>
</div>






@endsection

@section('scripts')

<script src="{{ asset('js/profiles.js') }}" defer></script>
<script>
var time = parseInt(document.getElementById("time").innerHTML);

// if(time > 0) {
//     setInterval(function () {
// time = time - 1;
// document.getElementById("time").innerHTML = time;

// }, 1000);

// } else {

// }




$(document).ready(function() {
    $("img").mouseover(function() {
        $(this).css("cursor", "pointer")
    })

    var total = 0;
    var header = $(".questionHeader");

    var num = document.getElementsByClassName("questionHeader");
    var myChoice = document.getElementsByClassName("choice");
    var selected = document.getElementsByClassName("selected");
    var questionId = document.getElementsByClassName("questionId");
    var options = document.getElementsByClassName("options");
    var ca = "";



    if ($("#playStatus").attr("playStatus") === "Played") {

        $("#submitQuiz").hide();

        $(".options").each(function(i) {
            $(this).addClass("options" + i);
            $(this).find(".optionInput").addClass("optionInput" + i)
            $(this).find(".optionInput").attr("name", "choices" + i)
            $(this).find(".optionInput").attr("disabled", true)
        });


        $(".options").each(function(i) {
            ca = $(this).attr("ca");
            chosen = $(this).attr("chosen")
            $(this).find(".optionInput" + i).each(function() {
                if ($(this).val() === $(this).parents(".options").attr("chosen")) {
                    $(this).prop("checked", true);
                    if ($(this).val() === ca) {
                        $(this).next().text("Correct answer")
                    } else if ($(this).val() !== ca) {
                        $(this).next().text("Wrong answer")
                    }

                }
            });
        });

    }

    var i;

    for (i = 0; i < myChoice.length; i++) {
        myChoice[i].setAttribute("name", "myChoice" + i)
    }

    for (i = 0; i < questionId.length; i++) {
        questionId[i].setAttribute("name", "questionId" + i)
    }

    for (i = 0; i < selected.length; i++) {
        selected[i].setAttribute("name", "selected" + i)
    }

    for (i = 0; i < num.length; i++) {
        var question = num[i].innerHTML;
        num[i].innerHTML = i + 1 + ". " + question;
        num[i].setAttribute("id", i + 1);
    }




    $(".optionRadio").click(function() {


        var selected = document.getElementsByClassName("selected");

        var i;

        for (i = 0; i < selected.length; i++) {

            if ($(this).attr("questionId") == selected[i].getAttribute("id")) {
                selected[i].value = $(this).attr("value");
            }
        }

        // var unique = $(this).parents(".options").prev().find(".questionHeader").attr("id");
        var unique = $(this).parents(".options").find(".choice").attr("name");
        $(this).attr("name", unique)

        $(this).parent().siblings().children().attr("name", unique)

        var chosenAnswer = $(this).parents(".options").find(".choice").attr("value");
        var correctAnswerHidden = $(this).parents(".options").find(".correct-answer-hidden").attr(
            "value");

        chosenAnswer = $(this).next().attr("value");
        // alert(chosenAnswer)

        if (chosenAnswer == correctAnswerHidden) {

            $(this).parents(".options").find(".choice").attr("value", "correct");
        } else {

            $(this).parents(".options").find(".choice").attr("value", "wrong");

        }


    });

    $("submit").click(function() {
        $(this).innerHTML = total + "/" + quiz.length;
    });

})

var quiz = document.getElementsByClassName("questionHeader");
document.getElementById("numOfQuestions").innerHTML = quiz.length + " questions for you today!";



</script>


@endsection