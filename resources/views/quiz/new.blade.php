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

<!-- <body onbeforeunload="return leavePage()"> -->

<body>


    <div class="quizContainer w3-container">
        <div class="w3-row-padding">
            <div class="w3-col l6">
                <form method="POST" action="/quiz/build">
                    @csrf
                    <input class="questionCount" type="hidden" name="questionCount">
                    <input class="status" type="hidden" name="status">
                    <div class="w3-container w3-margin">
                        <input style="width: 100%; font-size: 40px; padding: 10px 0px 10px 10px" type="text"
                            class="dynamicQuizTitle" name="title" value="Quiz Title">
                    </div>

                    <div class="w3-container w3-margin">
                        <textarea style="border: none;" class="dynamicQuizDescription" name="description" id=""
                            placeholder="Enter a short message or set of instructions for the quiz" cols="50"
                            rows="5"></textarea>
                    </div>

                    <hr style="margin-bottom: 50px;">

                    <div id="quizForm">

                        <div class="quizWrap w3-border w3-margin-bottom" style="border-radius: 20px;">

                            <div class="w3-container quizBox" unique_id="">
                                <div class="w3-row-padding">
                                    <div class="w3-col s11">



                                        <div class="quizContainer w3-margin">
                                            <div class="w3-container" style="margin-bottom: 30px;">
                                                <div class="questionBox" style="margin-bottom: 30px;">
                                                    <input style="display: none;" class="unique" type="text" value="">
                                                    <h4 class="questionHeader" style="display: none;"></h4>
                                                    <input class="w3-padding question requiredQuestionInput"
                                                        style="width: 80%;" type="text" placeholder="Question" value="">
                                                    <p class="inputError emptyQuestionError" style="display: none;"></p>


                                                    <img src="" class="w3-border questionImage" alt="" width="100%"
                                                        height="400px" onclick="showImage(this)"
                                                        style="object-fit: cover; display: none;">

                                                </div>
                                                <textarea style="display: none;" class="imageString">  </textarea>

                                                <div class="options">
                                                    <div class="w3-margin-bottom">
                                                        <input class="optionRadio" type="radio" name="myChoice1"
                                                            value="optionRadio1">
                                                        <input class="option requiredQuestionInput optionInput"
                                                            type="text" placeholder="option1" value=""> <label
                                                            class="optionLabel" style="display:none" for=""></label>
                                                    </div>
                                                    <div class="w3-margin-bottom">
                                                        <input class="optionRadio" type="radio" name="myChoice1"
                                                            value="optionRadio2">
                                                        <input class="option requiredQuestionInput optionInput"
                                                            type="text" placeholder="option2" value=""> <label
                                                            class="optionLabel" style="display:none" for=""></label>
                                                    </div>
                                                    <div class="w3-margin-bottom">
                                                        <input class="optionRadio" type="radio" name="myChoice1"
                                                            value="optionRadio3">
                                                        <input class="option requiredQuestionInput optionInput"
                                                            type="text" placeholder="option3" value=""> <label
                                                            class="optionLabel" style="display:none" for=""></label>
                                                    </div>
                                                    <div class="w3-margin-bottom">
                                                        <input class="optionRadio" type="radio" name="myChoice1"
                                                            value="optionRadio4">
                                                        <input class="option requiredQuestionInput optionInput"
                                                            type="text" placeholder="option4" value=""> <label
                                                            class="optionLabel" style="display:none" for=""></label>
                                                    </div>
                                                    <p class="inputError missingOptionError" style="display: none;"></p>
                                                    <p class="inputError uniqueOptionError" style="display: none;"></p>
                                                    <p class="uncheckedOptionError" style="display: none;"></p>
                                                    <p class="emptyOptionError" style="display: none;"></p>

                                                    <input style='display: none;' class='choice' type='text'
                                                        value='choice'>

                                                    <input style='display: none;'
                                                        class='correct-answer-hidden requiredQuestionInput option'
                                                        type='text' value=''><br>

                                                </div>

                                            </div>
                                        </div>


                                        <div class="quizScaffolding">
                                            <textarea style="display: none;" class="quizSource" cols="50"
                                                rows="10"></textarea>
                                        </div>

                                        <div class="w3-container">
                                            <div class="w3-right">
                                                <!-- <input style="cursor: pointer;" class="addQuiz w3-right" type="button"
                                            value="+"> -->

                                                <input style="cursor: pointer; float: left;"
                                                    class="done w3-padding w3-border" type="button" value="Done">
                                                <input style="cursor: pointer; display: none; float: left;"
                                                    class="addQuiz w3-padding w3-border" type="button" value="+">
                                            </div>

                                        </div>

                                    </div>


                                    <div class="w3-col s1">
                                        <div class="w3-margin-bottom w3-margin-top w3-center" style="">
                                            <!-- <input style="cursor: pointer;" type="button" class="remove" value="X"> -->
                                            <button style="display: none;" class="w3-button remove"> <i
                                                    class="far fa fa-times"></i> </button>
                                        </div>

                                        <div>
                                            <input style="display: none;" id="upload_pic" class="upload_pic" type="file"
                                                onchange="encodeImagetoBase64(this)">
                                            <span class="w3-button clickFileUpload"><i
                                                    class="fas fa fa-image"></i></span>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>

                    </div>



                    <!-- <input style="cursor: pointer; font-size: 40px; display: none;" class="addQuiz" type="button"
                        value="+"> -->

                    <!-- <div style="margin-top: 40px;"><button id="create">Create Quiz</button></div> -->
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

            <div class="w3-col l6 w3-hide">
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