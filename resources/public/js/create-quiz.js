


$(document).ready(function () {


    var counter = 1;

    $(document).on("click", ".addQuiz", function () {
        counter = counter + 1;
        questionNumber = counter;

        // $(this).css("display", "none");

        // $("#quizForm").append(
            $(this).parents(".quizWrap").after(
            '<div class="quizWrap w3-border w3-margin-bottom" style="border-radius: 20px;">' +
            '<div class="w3-container  quizBox">' +
            '<div class="w3-row-padding">' +
            '<div class="w3-col s11">' +



            '<div class="quizContainer" style="margin-bottom: 30px;">' +
            '<div class="w3-container" style="margin-bottom: 30px;">' +
            '<div class="questionBox" style="margin-bottom: 30px;">' +

            '<input style="display: none;" class="unique" type="text" value="' + counter + '">' +

            '<h4 class="questionHeader" style="display: none;"></h4>' +
            '<input class="w3-padding question requiredQuestionInput" style="width: 80%;" type="text" placeholder="Question" value=""><br><br>' +
            '<p class="emptyQuestionError" style="display: none;"></p>' +
            '<img src="" class="w3-border questionImage" alt="" width="100%" height="400px" style="object-fit: cover; display: none;" onclick="showImage(this)">' +
            '</div>' +
            '<textarea style="display: none;" class="imageString">  </textarea>' +

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

            '<p class="missingOptionError" style="display: none;"></p>' +
            '<p class="uniqueOptionError" style="display: none;"></p>' +
            '<p class="uncheckedOptionError" style="display: none;"></p>' +


            "<input style='display: none;' class='choice' type='text' value='choice'>" +

            "<input style='display: none;' class='correct-answer-hidden requiredQuestionInput option' type='text' value=''><br>" +

            '</div>' +

            '</div>' +
            '</div>' +


            '<div class="quizScaffolding">' +
            '<textarea style="display: none;" class="quizSource" cols="50" rows="10" ></textarea>' +
            '</div>' +

            '<div class="w3-container">' +
            '<div class="w3-right">' +
            '<input style="cursor: pointer; float: left" class="done w3-padding" type="button" name="update" value="Done">' +
            '<input style="cursor: pointer; display: none; float: left;" class="addQuiz w3-padding" type="button" value="+">' +
            '</div>' +
            '</div>' +

            '</div>' +

            '<div class="w3-col s1">' +
            '<div class="w3-margin-bottom w3-margin-top w3-center">' +
            '<input style="cursor: pointer; " type="button" class="remove" value="X">' +
            '</div>' +
            '<div>' +
            '<input style="display: none;" id="upload_pic" class="upload_pic" type="file" onchange="encodeImagetoBase64(this)">' +
            '<span class="w3-button clickFileUpload"><i class="fas fa fa-image"></i></span>' +
            '</div>' +
            '</div>' +

            '</div>' +
            '</div>' +
            '</div>');


    });

    $(document).on("click", ".done", function () {

        var i;

        var question = $(this).parents(".quizBox").find(".questionBox").find(".question");
        var options = $(this).parents(".quizBox").find(".options").find(".optionInput");
        // var correctAnswer = $(this).parents(".quizWrap").find(".correctAnswerBox").find(
        // ".correct-answer");

        var optionRadio = $(this).parents(".quizBox").find(".options").find(".optionRadio");


        var option1 = options[0].value;
        var option2 = options[1].value;
        var option3 = options[2].value;
        var option4 = options[3].value;


        if (question.val().trim() == "") {
            // $("#emptyQuestionError").css("display", "block")
            $(this).parents(".quizWrap").find(".emptyQuestionError").css("display", "block")
            $(this).parents(".quizWrap").find(".emptyQuestionError").text(
                "Please fill out the question field")
            $("#makeQuiz").val("");
        } else if (options[0].value.trim() == "" || options[1].value.trim() == "" || options[2].value.trim() == "" ||
            options[3].value.trim() == "") {

            $(this).parents(".quizWrap").find(".missingOptionError").css("display", "block")
            $(this).parents(".quizWrap").find(".missingOptionError").text(
                "You have to fill out all the options")


        } else if (option1.toUpperCase() == option2.toUpperCase() || option1.toUpperCase() ==
            option3
                .toUpperCase() || option1.toUpperCase() == option4.toUpperCase() || option2
                    .toUpperCase() == option3.toUpperCase() || option2.toUpperCase() == option4
                        .toUpperCase() || option3.toUpperCase() == option4.toUpperCase()) {

            $(this).parents(".quizWrap").find(".uniqueOptionError").css("display", "block")
            $(this).parents(".quizWrap").find(".uniqueOptionError").text(
                "The four options must be unique")
        } else if ($(this).parents(".quizWrap").find(".correct-answer-hidden").attr("value") == "") {
            $(this).parents(".quizWrap").find(".uncheckedOptionError").css("display", "block")
            $(this).parents(".quizWrap").find(".uncheckedOptionError").text(
                "You have not checked a correct answer")
        } else {

            $(this).parents(".quizWrap").find(".remove").css("display", "block");

            // $(this).removeClass("done");
            // $(this).addClass("update");
            // $(this).attr("value", "Update");

            
        // $(".addQuiz").css("display", "block");
        $(this).parents(".quizWrap").find(".addQuiz").css("display", "block");
        }
    });

    $(document).on("click", ".update", function () {

        var options = $(this).parents(".quizBox").find(".options").find(".optionInput");
        var myQuestion = $(this).parents(".quizBox").find(".questionBox").find(".question").attr("value");

        var option_one = options[0].value;
        var option_two = options[1].value;
        var option_three = options[2].value;
        var option_four = options[3].value;
        var correct_answer = $(this).parents(".quizWrap").find(".correct-answer-hidden").attr("value");
        var name = $(".dynamicQuizTitle").val();
        var description = $(".dynamicQuizDescription").val();
        // var unique_id = $(this).parents(".quizWrap").find(".unique").attr("value");
        var unique_id = $(this).parents(".quizWrap").find(".quizBox");
        var unique = unique_id.attr("unique_id");
        var image = $(this).parents(".quizWrap").find(".imageString").val();

        var is_editable = $(this).parents(".quizWrap").find(".quizBox").attr("editable");
        // var editable = is_editable.attr("editable");
        var editable = "Yes";
        alert(unique)
        let quiz_id = $('#quizId').attr('quizId');

        let url = $('#buildQuiz').attr('url');
        let token = $('[name = csrf-token]').attr('content');

        // if(editable === "Yes") {

        $.post(url, {
            quiz_id: quiz_id,
            is_editable: editable,
            unique: unique,
            name: name,
            description: description,
            question: myQuestion,
            option_one: option_one,
            option_two: option_two,
            option_three: option_three,
            option_four: option_four,
            correct_answer: correct_answer,
            image: image,
            _token: token
        }, function () {

            // $(this).css("display", "none");
            alert("Successfully updated");

        });
        // } else {
        //     alert("A problem occurred")
        // }
    });


    $("#createQuiz").click(function () {
        

        $(".quizWrap").each(function (i) {

            $(this).find(".questionBox").find(".question").attr("name", i + "question")
            $(this).find(".imageString").attr("name", i + "image");
            
            $(this).find(".optionInput").eq(0).attr("name", i + "optionInput1")
            $(this).find(".optionInput").eq(1).attr("name", i + "optionInput2")
            $(this).find(".optionInput").eq(2).attr("name", i + "optionInput3")
            $(this).find(".optionInput").eq(3).attr("name", i + "optionInput4")

            $(this).find(".correct-answer-hidden").attr("name", i + "correctAnswer");


        });

        var questionEmpty;
        var optionEmpty;
        var caEmpty;

        $(".question").each(function(){
            if ($(this).val() === "") {
                questionEmpty = "flag";
            } 
        });

        $(".optionInput").each(function(){
            if ($(this).val() === "") {
                optionEmpty = "flag";
            } 
        });


        
        $(".correct-answer-hidden").each(function(){
            if ($(this).val() === "") {
                caEmpty = "flag";
            } 
        });

        $(".questionCount").attr("value", $(".question").length);
        $(".status").attr("value", "done");

        if (questionEmpty === "flag") {
            alert("A question field is empty")
        } else if (optionEmpty === "flag") {
            alert("An option field is empty")
        } else if (caEmpty === "flag") {
            alert("Please,, make sure you have checked the correct answer for each question.")
        } else {
            // alert("all done")
            $("#send").click()
        }
        
    });

    $("#saveQuiz").click(function () {
        var unique_id = $(this).parents(".quizWrap").find(".quizBox").attr("unique_id", 0);
        var unique = unique_id.attr("unique_id");
        var image = $(this).parents(".quizWrap").find(".imageString").val();

        $(".quizWrap").each(function (i) {

            $(this).find(".questionBox").find(".question").attr("name", i + "question")
            $(this).find(".imageString").attr("name", i + "image");
            
            $(this).find(".optionInput").eq(0).attr("name", i + "optionInput1")
            $(this).find(".optionInput").eq(1).attr("name", i + "optionInput2")
            $(this).find(".optionInput").eq(2).attr("name", i + "optionInput3")
            $(this).find(".optionInput").eq(3).attr("name", i + "optionInput4")

            $(this).find(".correct-answer-hidden").attr("name", i + "correctAnswer");

        });

        var questionEmpty;
        var optionEmpty;
        var caEmpty;

        $(".question").each(function(){
            if ($(this).val() === "") {
                questionEmpty = "flag";
            } 
        });

        $(".optionInput").each(function(){
            if ($(this).val() === "") {
                optionEmpty = "flag";
            } 
        });


        
        $(".correct-answer-hidden").each(function(){
            if ($(this).val() === "") {
                caEmpty = "flag";
            } 
        });


        $(".questionCount").attr("value", $(".question").length);
        $(".status").attr("value", "saved");

        if (questionEmpty === "flag") {
            alert("A question field is empty")
        } else if (optionEmpty === "flag") {
            alert("An option field is empty")
        } else if (caEmpty === "flag") {
            alert("Please,, make sure you have checked the correct answer for each question.")
        } else {
            
            $("#send").click()
        }
    });
    

    $(document).on("click", ".clickFileUpload", function () {

        $(this).prev().click();
    })

    // $(document).on("change", ".upload_pic", function() {

    //     $(this).parents(".quizWrap").find(".questionImage").attr("src", URL.createObjectURL(event.target.files[0]))
    //     $(this).parents(".quizWrap").find(".questionImage").css("display", "block")

    // });

    $(document).on("keyup", ".question", function () {
        $(this).parents(".quizWrap").find(".emptyQuestionError").css("display", "none")
    });

    // $(".optionRadio").hide();

    $(document).on("click", ".optionRadio", function () {
        if ($(this).next().val().trim() === "") {
            $(this).parents(".quizWrap").find(".emptyOptionError").css("display", "block")
            $(this).parents(".quizWrap").find(".emptyOptionError").text(
                "You have to write an option before checking it")
            $(this).prop("checked", false)
        }
    });

    

    $(document).on("keyup", ".optionInput", function () {
        

        $(this).parents(".quizWrap").find(".emptyOptionError").css("display", "none")
        $(this).parents(".quizWrap").find(".uniqueOptionError").css("display", "none")
        // $(".optionInput").each(function(){
            if ($(this).val() === "" && $(this).prev().prop("checked")) {
                $(this).prev().prop("checked", false);
                $(this).parents(".quizWrap").find(".correct-answer-hidden").attr("value", "");
            }
        // });

    });


    // $(document).on("click", ".done", function() {

    //     $(this).css("display", "none");


    //     // $(this).parents(".quizBox").find(".options").find(".option").css("display", "none");
    //     $(this).parents(".quizBox").find(".options").find("label").css("display",
    //         "inline-block");
    //     $(this).parents(".quizBox").find(".questionBox").find(".questionHeader").css("display",
    //         "block");
    //     // $(this).parents(".quizBox").find(".questionBox").find(".question").css("display",
    //     //     "none");

    //     $(this).parents(".quizBox").find(".questionBox").find(".question").remove();
    //     $(this).parents(".quizBox").find(".options").find(".optionInput").remove();
    //     $(this).parents(".quizBox").find(".errorInput").remove();




    //     $(this).parents(".quizBox").find(".questionHeader").text($(this)
    //         .parents(".quizBox").find(".question").find("input").val());


    //     $(this).parents(".quizBox").find(".quizScaffolding").find("textarea").val($(this)
    //         .parents(
    //             ".quizWrap").find(".quizContainer").html());


    // });

    $(document).on("click", ".remove", function () {

        $(this).parents(".quizWrap").remove();


        var unique = $(this).parents(".quizWrap").find(".unique").attr("value");
        let quiz_id = $('#quizId').attr('quizId');
        let url = $('#removeQuestion').attr('url');
        let token = $('[name = csrf-token]').attr('content');

        $.post(url, {
            quiz_id: quiz_id,
            unique: unique,
            _token: token
        }, function () {

            alert("Successfully inserted");

        });

        alert("hello")


    });

    $(document).on("keyup", ".dynamicQuizTitle", function () {
        $(".quizTitle").val($(this).val())
    });

    $(document).on("keyup", ".dynamicQuizDescription", function () {
        $(".quizDescription").val($(this).val())
    });

    $(document).on("keyup", ".option", function () {

        // $(this).attr("value", $(this).val())
        $(this).prev().attr("value", $(this).val())
        $(this).next().text($(this).val())
        $(this).parents(".quizWrap").find(".missingOptionError").css("display", "none")

    });

    $(document).on("keyup", ".correct-answer", function () {

        $(this).attr("value", $(this).val())
        $(this).parents(".quizWrap").find(".options").find(".correct-answer-hidden").val($(this)
            .val());
        $(this).parents(".quizWrap").find(".options").find(".correct-answer-hidden").attr("value",
            $(this).val());

        if ($(this).val() !== "") {
            $(this).parents(".quizWrap").find(".emptyCorrectAnswerError").css("display", "none")
        }

    });

    $(document).on("keyup", ".question", function () {

        $(this).attr("value", $(this).val())
        $(this).prev().text($(this).val())

    });

    $(document).on("click", ".questionHeader", function () {

        $(this).css("display", "none");
        $(this).next().css("display", "block")
        // $(".done").attr("disabled", false);
        // $(this).parents(".quizWrap").find(".done").attr("disabled", true)


    });

    $(document).on("click", ".optionRadio", function () {

        var correct = $(this).parents(".quizWrap").find(".correct-answer").val();
        var choice = $(this).val();

        // $(this).attr("status", "correct");
        // $(this).parent().siblings().children().attr("status", "wrong");
        $(this).parents(".quizWrap").find(".correct-answer-hidden").attr("value", $(this).next()
            .val());
        $(this).parents(".quizWrap").find(".uncheckedOptionError").css("display", "none")



    });

    $(document).on("click", ".optionLabel", function () {

        $(this).css("display", "none");
        // $(this).prev().attr("type", "text")
        $(this).prev().css("display", "inline-block")

    });


});
