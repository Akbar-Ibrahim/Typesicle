<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

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

    <script>
    $(document).ready(function() {
        var counter = 0;
        $(".addQuiz").click(function() {
            // $(this).css("display", "none");

            counter = counter + 1;
            questionNumber = counter;


            $("#quizForm").append(
                '<div class="quizWrap" style="margin-bottom: 50px">' +
                '<div class="w3-container  quizBox">' +
                '<div class="w3-row-padding">' +
                '<div class="w3-col s11">' +



                '<div class="quizContainer" style="margin-bottom: 30px;">' +
                '<div class="w3-container" style="margin-bottom: 30px;">' +
                '<div class="questionBox" style="margin-bottom: 30px;">' +

                '<h4 class="questionHeader" style="display: none;"></h4>' +
                '<input class="question requiredQuestionInput" style="width: 80%;" type="text" placeholder="Question" value=""><br><br>' +
                '<img src="" class="w3-border questionImage" alt="" width="100%" height="400px" style="object-fit: cover; display: none;" onclick="showImage(this)">' +
                '</div>' +

                '<div class="options">' +
                '<div class="w3-margin-bottom">' +
                '<input class="optionRadio" type="radio" name="' + questionNumber +
                '" value="optionRadio1">' +
                '<input class="option requiredQuestionInput optionInput" type="text" placeholder="option1" value=""> <label class="optionLabel" style="display:none" for=""></label> ' +
                '</div>' +
                '<div class="w3-margin-bottom">' +
                '<input class="optionRadio" type="radio" name="' + questionNumber +
                '" value="optionRadio2">' +
                '<input class="option requiredQuestionInput optionInput" type="text" placeholder="option2" value=""> <label class="optionLabel" style="display:none" for=""></label> ' +
                '</div>' +
                '<div class="w3-margin-bottom">' +
                '<input class="optionRadio" type="radio" name="' + questionNumber +
                '" value="optionRadio3">' +
                '<input class="option requiredQuestionInput optionInput" type="text" placeholder="option3" value=""> <label class="optionLabel" style="display:none" for=""></label> ' +
                '</div>' +
                '<div class="w3-margin-bottom">' +
                '<input class="optionRadio" type="radio" name="' + questionNumber +
                '" value="optionRadio4">' +
                '<input class="option requiredQuestionInput optionInput" type="text" placeholder="option4" value=""> <label class="optionLabel" style="display:none" for=""></label> ' +
                '</div>' +


                "<input style='display: none;' class='choice' type='text' value='choice'>" +

                "<input style='display: none;' class='correct-answer-hidden requiredQuestionInput option' type='text' value=''><br>" +

                '</div>' +

                '</div>' +
                '</div>' +

                '<div class="correctAnswerBox" style="margin-bottom: 30px;">' +
                "<input class='correct-answer option' type='text' name='correctAnswer" +
                questionNumber +
                "' placeholder='Enter correct answer' value=''><br>" +
                '</div>' +

                '<div class="quizScaffolding">' +
                '<textarea style="display: none;" class="quizSource" cols="50" rows="10" ></textarea>' +
                '</div>' +

                '<div>' +
                '<input style="cursor: pointer;" class="addQuiz w3-right" type="button" value="+">' +
                '<input style="cursor: pointer;" class="done w3-right" type="button" name="done" value="Done">' +
                '</div>' +

                '</div>' +

                '<div class="w3-col s1">' +
                '<div class="w3-margin-bottom w3-margin-top w3-center">' +
                '<input style="cursor: pointer;" type="button" class="remove" value="X">' +
                '</div>' +
                '<div>' +
                '<input style="display: none;" id="upload_pic" class="upload_pic" type="file" onchange="encodeImagetoBase64(this)">' +
                '<button class="w3-button clickFileUpload"><i class="fas fa fa-image"></i></button>' +
                '</div>' +
                '</div>' +

                '</div>' +
                '</div>' +
                '</div>');

        });


        $("#createQuiz").click(function() {
            var i;
            var quizSource = document.getElementsByClassName("quizSource");
            var makeQuiz = document.getElementById("makeQuiz");



            for (i = 0; i < quizSource.length; i++) {
                makeQuiz.value += quizSource[i].value;
            }
        });

        $(document).on("click", ".clickFileUpload", function() {

    $(this).prev().click();
})

// $(document).on("change", ".upload_pic", function() {

//     $(this).parents(".quizWrap").find(".questionImage").attr("src", URL.createObjectURL(event.target.files[0]))
//     $(this).parents(".quizWrap").find(".questionImage").css("display", "block")

// });



        $(document).on("click", ".done", function() {

            var i;
            var question = $(this).parents(".quizBox").find(".questionBox").find(".question");
            var options = $(this).parents(".quizBox").find(".options").find(".optionInput");
            var correctAnswer = $(this).parents(".quizWrap").find(".correctAnswerBox").find(
                ".correct-answer");


            // var op = $(this).parents(".quizWrap").find(".question");
            // alert(op.index(".question"))



            var rightAnswer = correctAnswer.val();
            var option1 = options[0].value;
            var option2 = options[1].value;
            var option3 = options[2].value;
            var option4 = options[3].value;



            if (question.val() == "") {
                // $("#emptyQuestionError").css("display", "block")
                $(this).parents(".quizWrap").find(".emptyQuestionError").css("display", "block")
                $(this).parents(".quizWrap").find(".emptyQuestionError").text("Please fill out the question field")
            } else if (options[0].value == "" || options[1].value == "" || options[2].value == "" ||
                options[3].value == "") {

                // $("#emptyOptionError").css("display", "block")
                $(this).parents(".quizWrap").find(".missingOptionError").css("display", "block")
                $(this).parents(".quizWrap").find(".missingOptionError").text("You have to fill out all the options")
            } else if (correctAnswer.val() == "") {
                // alert("You have to enter the correct answer")
                $("#correctAnswerError").css("display", "block")
                $(this).parents(".quizWrap").find(".emptyCorrectAnswerError").css("display", "block")
                $(this).parents(".quizWrap").find(".emptyCorrectAnswerError").text("You must fill in the correct answer")
            } else if (option1.toUpperCase() == option2.toUpperCase() || option1.toUpperCase() ==
                option3
                .toUpperCase() || option1.toUpperCase() == option4.toUpperCase() || option2
                .toUpperCase() == option3.toUpperCase() || option2.toUpperCase() == option4
                .toUpperCase() || option3.toUpperCase() == option4.toUpperCase()) {
                // alert("Each option must be unique, dumbo.")
                // $("#uniqueOptionError").css("display", "block")
                $(this).parents(".quizWrap").find(".uniqueOptionError").css("display", "block")
                $(this).parents(".quizWrap").find(".uniqueOptionError").text("The four options must be unique")
            } else if (rightAnswer.toUpperCase() == option1.toUpperCase() || rightAnswer
                .toUpperCase() == option2.toUpperCase() || rightAnswer.toUpperCase() == option3
                .toUpperCase() ||
                rightAnswer.toUpperCase() == option4.toUpperCase()) {

                // $(this).parents(".quizBox").find(".options").find(".option").attr("type", "radio");
                $(this).parents(".quizBox").find(".options").find(".option").css("display", "none");
                $(this).parents(".quizBox").find(".options").find("label").css("display",
                    "inline-block");
                $(this).parents(".quizBox").find(".questionBox").find(".questionHeader").css("display",
                    "block");
                $(this).parents(".quizBox").find(".questionBox").find(".question").css("display",
                    "none");
                $(this).parents(".quizBox").find(".questionHeader").text($(this)
                    .parents(".quizBox").find(".question").find("input").val());


                $(this).parents(".quizBox").find(".quizScaffolding").find("textarea").val($(this)
                    .parents(
                        ".quizWrap").find(".quizContainer").html());
            } else {
                alert("None of the options match the correct answer you entered")
            }

        });

        $(document).on("click", ".remove", function() {

            $(this).parents(".quizWrap").remove();

        });

        $(document).on("keyup", ".dynamicQuizTitle", function() {
            $(".quizTitle").val($(this).val())
        });

        $(document).on("keyup", ".dynamicQuizDescription", function() {
            $(".quizDescription").val($(this).val())
        });

        $(document).on("keyup", ".option", function() {

            // $(this).attr("value", $(this).val())
            $(this).prev().attr("value", $(this).val())
            $(this).next().text($(this).val())

        });

        $(document).on("keyup", ".correct-answer", function() {

            $(this).attr("value", $(this).val())
            $(this).parents(".quizWrap").find(".options").find(".correct-answer-hidden").val($(this)
                .val());
            $(this).parents(".quizWrap").find(".options").find(".correct-answer-hidden").attr("value",
                $(this).val());

        });

        $(document).on("keyup", ".question", function() {

            $(this).attr("value", $(this).val())
            $(this).prev().text($(this).val())

        });

        $(document).on("click", ".questionHeader", function() {

            $(this).css("display", "none");
            $(this).next().css("display", "block")
            // $(".done").attr("disabled", false);
            // $(this).parents(".quizWrap").find(".done").attr("disabled", true)


        });

        $(document).on("click", ".optionRadio", function() {

            var correct = $(this).parents(".quizWrap").find(".correct-answer").val();
            var choice = $(this).val();
            if (choice == correct) {
                // $(this).attr("value", "correct");
                alert("correct");
            } else {
                alert("wrong")
            }

        });

        $(document).on("click", ".optionLabel", function() {

            $(this).css("display", "none");
            // $(this).prev().attr("type", "text")
            $(this).prev().css("display", "inline-block")

        });


    });
    </script>

</head>

<body>






    <div class="quizContainer w3-container">
        <div class="w3-row-padding">
            <div class="w3-col l6">
                <!-- <form method="post" action="/quiz/store"> -->
                <!-- @csrf -->

                <div class="w3-container w3-margin">
                    <input style="width: 100%; font-size: 40px; padding: 10px 0px 10px 10px" type="text"
                        class="dynamicQuizTitle" value="Quiz Title">
                </div>

                <div class="w3-container w3-margin">
                    <textarea style="border: none;" class="dynamicQuizDescription" name="description" id=""
                        placeholder="Enter a short message or set of instructions for the quiz" cols="50"
                        rows="5"></textarea>
                </div>

                <hr style="margin-bottom: 50px;">

                <div id="quizForm">

                    <div class="quizWrap" style="margin-bottom: 50px">
                        <div class="w3-container  quizBox">
                            <div class="w3-row-padding">
                                <div class="w3-col s11">



                                    <div class="quizContainer" style="margin-bottom: 30px;">
                                        <div class="w3-container" style="margin-bottom: 30px;">
                                            <div class="questionBox" style="margin-bottom: 30px;">

                                                <h4 class="questionHeader" style="display: none;"></h4>
                                                <input class="question requiredQuestionInput" style="width: 80%;"
                                                    type="text" placeholder="Question" value="">
                                                    <p class="emptyQuestionError" style="display: none;"></p>

                                                <img src="" class="w3-border questionImage" alt=""
                                                    width="100%" height="400px" onclick="showImage(this)"
                                                    style="object-fit: cover; display: none;">
                                            </div>

                                            <div class="options">
                                                <div class="w3-margin-bottom">
                                                    <input class="optionRadio" type="radio" name=""
                                                        value="optionRadio1">
                                                    <input class="option requiredQuestionInput optionInput" type="text"
                                                        placeholder="option1" value=""> <label class="optionLabel"
                                                        style="display:none" for=""></label>
                                                </div>
                                                <div class="w3-margin-bottom">
                                                    <input class="optionRadio" type="radio" name=""
                                                        value="optionRadio2">
                                                    <input class="option requiredQuestionInput optionInput" type="text"
                                                        placeholder="option2" value=""> <label class="optionLabel"
                                                        style="display:none" for=""></label>
                                                </div>
                                                <div class="w3-margin-bottom">
                                                    <input class="optionRadio" type="radio" name=""
                                                        value="optionRadio3">
                                                    <input class="option requiredQuestionInput optionInput" type="text"
                                                        placeholder="option3" value=""> <label class="optionLabel"
                                                        style="display:none" for=""></label>
                                                </div>
                                                <div class="w3-margin-bottom">
                                                    <input class="optionRadio" type="radio" name=""
                                                        value="optionRadio4">
                                                    <input class="option requiredQuestionInput optionInput" type="text"
                                                        placeholder="option4" value=""> <label class="optionLabel"
                                                        style="display:none" for=""></label>
                                                </div>
                                                <p class="missingOptionError" style="display: none;"></p>
                                                <p class="uniqueOptionError" style="display: none;"></p>

                                                <input style='display: none;' class='choice' type='text' value='choice'>

                                                <input style='display: none;'
                                                    class='correct-answer-hidden requiredQuestionInput option'
                                                    type='text' value=''><br>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="correctAnswerBox" style="margin-bottom: 30px;">
                                        <input class='correct-answer option' type='text' name='correctAnswer'
                                            placeholder=' Enter correct answer' value=''><br>
                                            <p class="emptyCorrectAnswerError" style="display: none;"></p>
                                    </div>

                                    <div class="quizScaffolding">
                                        <textarea style="display: none;" class="quizSource" cols="50"
                                            rows="10"></textarea>
                                    </div>

                                    <div>
                                        <input style="cursor: pointer;" class="addQuiz w3-right" type="button"
                                            value="+">
                                        <input style="cursor: pointer;" class="done w3-right" type="button" name="done"
                                            value="Done">
                                    </div>

                                </div>

                                <div class="w3-col s1">
                                    <div class="w3-margin-bottom w3-margin-top w3-center" style="">
                                        <!-- <input style="cursor: pointer;" type="button" class="remove" value="X"> -->
                                        <button class="w3-button"> <i class="far fa fa-times"></i> </button>
                                    </div>

                                    <div>
                                        <input style="display: none;" id="upload_pic" class="upload_pic" type="file" onchange="encodeImagetoBase64(this)"
                                            >
                                        <button class="w3-button clickFileUpload"><i
                                                class="fas fa fa-image"></i></button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="w3-center w3-padding " style="margin-top: 40px; ">
                    <input class="addQuiz w3-button" type="button" value="Add question">
                </div>
                <div style="margin-top: 40px;"><button id="createQuiz">Create Quiz</button></div>

                <!-- </form> -->
            </div>

            <div class="w3-col l6">
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
    @include('includes.errors.questionErrorModal')
    @include('includes.errors.optionErrorModal')
    @include('includes.errors.correctAnswerErrorModal')
    @include('includes.errors.uniqueOptionErrorModal')

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

//   $(".link").text(reader.result);

}

reader.readAsDataURL(file);

}

$(".upload_pic").change(function() {


    
    // $(this).parents(".quizWrap").find(".questionImage").attr("src", URL.createObjectURL(event.target.files[0]))
    // $(this).parents(".quizWrap").find(".questionImage").css("display", "block")

});
</script>

</html>