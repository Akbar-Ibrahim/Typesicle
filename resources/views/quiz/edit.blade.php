<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>jQuery Bind Click Event to Dynamically added Elements</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
    /* label {
        border: 2px solid black;
    } */
    input {
        border: none;
    }

    .optionRadio {
        margin-right: 8px;
    }

    .option {
        margin-left: 2px;
    }

    .options {
        margin-bottom: 20px;

    }
    </style>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <script src="{{ asset('js/create-quiz.js') }}"></script>

</head>


<body>

    <!-- <span id="createQuiz" url="{{ route('quiz.create') }}" class="d-none"></span> -->
    <span id="buildQuiz" url="{{ route('quiz.store') }}" class="d-none"></span>
    <span id="quizId" quizId="{{ $quiz->id }}" class="d-none"></span>
        <span id="storeQuiz" url="{{ route('quiz.store') }}" class="d-none"></span>
    <span id="profile" profile="{{ Auth::user()->username }}" class="d-none"></span>



    @if($quiz->status == 'done')
    <h1>Nothing to see here</h1>
    @else

    <div class="quizContainer w3-container">
        <div class="w3-row-padding">
            <div class="w3-col l6">
                <form method="POST" action="{{ route('quiz.update', $quiz->id) }}">
                    @csrf
                    <input type="hidden" name="_method"value="PUT">
                    <input class="questionCount" type="hidden" name="questionCount">
                    <input class="status" type="hidden" name="status">
                    <input class="quiz_id" type="hidden" name="quiz_id" value="{{ $quiz->id }}">


                    <div class="w3-container w3-margin">
                        <input style="width: 100%; font-size: 40px; padding: 10px 0px 10px 10px" type="text"
                            class="dynamicQuizTitle w3-border" name="title" value="{{ $quiz->title ?? '' }}">
                    </div>

                    <div class="w3-container w3-margin">
                        <textarea style="border: none; width: 100%" class="w3-border dynamicQuizDescription w3-padding"
                            name="description" id="" value="{{ $quiz->description ?? '' }}"
                            placeholder="Enter a short message or set of instructions for the quiz" cols="50"
                            rows="5"> {{ $quiz->description }} </textarea>
                    </div>

                    <hr style="margin-bottom: 50px;">

                    <div id="quizForm">
                        @includeWhen('$questions', 'quiz.created')
                    </div>

                    <button style="display: none;" id="send">Send</button>
                </form>
                <div class="w3-container">
                    <div class="w3-half">
                    <button class="w3-button" id="createQuiz">Create</button>
                    </div>
                    <div class="w3-half">
                        <button class="w3-button" id="saveQuiz">Save and continue later</button>
                    </div>
                </div>
            </div>







            <div class="w3-col l6">
                <div style="display: none;" class="w3-container">

                    <div class="link"></div>

                    <form method="post" action="/quiz/build">
                        @csrf
                        <div class="w3-container">
                            <input class="quizTitle" type="text" name="quiz_name">
                        </div>

                        <div class="w3-container">
                            <textarea class="quizDescription" name="description" id="" cols="50" rows="5"></textarea>
                        </div>

                        <textarea id="makeQuiz" name="quiz" id="" cols="70" rows="30"></textarea>
                        <button id="build">send</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    @include('includes.errors.optionErrorModal')
    @include('includes.errors.optionErrorModal')
    @include('includes.errors.correctAnswerErrorModal')
    @include('includes.errors.uniqueOptionErrorModal')
    @endif

    <script>
    function leavePage() {
        return "Write something clever here...";
    }
    </script>

</body>
<!-- <script src="{{ asset('js/preview-image.js') }}"></script> -->
<script>
$(".clickFileUpload").click(function() {
    $(this).prev().click();
})

function encodeImagetoBase64(element) {

    var file = element.files[0];

    var reader = new FileReader();

    reader.onloadend = function() {
        $(element).parents(".quizWrap").find(".questionImage").attr("src", reader.result)
        $(element).parents(".quizWrap").find(".questionImage").css("display", "block")

        $(element).parents(".quizWrap").find(".imageString").text(reader.result)

        //   $(".link").text(reader.result);

    }

    reader.readAsDataURL(file);

}

$(".upload_pic").change(function() {


});
</script>
</script>

</html>