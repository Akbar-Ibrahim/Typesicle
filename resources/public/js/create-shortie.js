

$(document).ready(function () {

    
    $(".send").click(function () {

        $(".shortie").each(function (i) {

            $(this).attr("name", "shortie" + i)

            $(this).parent().next().next().find(".inputButton").find(".fileUpload").eq(0).attr("name",
                i + "uploadFile1[]")
            $(this).parent().next().next().find(".inputButton").find(".fileUpload").eq(1).attr("name",
                i + "uploadFile2[]")
            $(this).parent().next().next().find(".inputButton").find(".fileUpload").eq(2).attr("name",
                i + "uploadFile3[]")
            $(this).parent().next().next().find(".inputButton").find(".fileUpload").eq(3).attr("name",
                i + "uploadFile4[]")


            $(this).parent().next().next().find(".counts").find(".skipCount").eq(0).attr("name",
                i + "count1")
            $(this).parent().next().next().find(".counts").find(".skipCount").eq(1).attr("name",
                i + "count2")
            $(this).parent().next().next().find(".counts").find(".skipCount").eq(2).attr("name",
                i + "count3")
            $(this).parent().next().next().find(".counts").find(".skipCount").eq(3).attr("name",
                i + "count4")



        });

        var shortie = document.getElementsByClassName("shortie");
        var i;
        document.getElementById("count").value = shortie.length;
        var isEmpty = document.getElementById("isEmpty");
        for (i = 0; i < shortie.length; i++) {
            if (shortie[i].value === "") {
                isEmpty.value = "Yes";
            }
        }


        $("#postButton").click();


    });




    if ($(".shortie").val() == "") {
        $("#clickPostButton").attr("disabled", true);
    }

    $(document).on("keyup", ".shortie", function () {
        if ($(this).val().trim() !== "") {
            $("#clickPostButton").attr("disabled", false);
        } else {
            $("#clickPostButton").attr("disabled", true);
        }
    });



});




$(document).ready(function () {


    var counter = 1;

    $(document).on("click", ".add-shortie", function () {
        counter = counter + 1;
        questionNumber = counter;

        $(this).parents(".shortie-option").css("display", "none");
        // $(this).addClass("d-none");

        $(this).parents(".shortie-container").after(
            '<div class="w3-container shortie-container w3-border mb-4 shortieWrapper">' +

            '<div class="w3-margin">' +
            '<input class="removeShortie w3-circle " style="font-size: 20px;" type="button" value="x">' +
            '</div>' +

            '<div class="w3-container ">' +
            '<textarea style="font-size: 21px; width: 100%; resize: none;" class=" py-2 px-2 shortie summernote" rows="2"' +
            'placeholder="Wata Guan?"></textarea>' +
            '<div style="display: none;" class="w3-container py-4 imageLimitError">You cannot upload more than four images</div>' +

            '</div>' +

            '<div class="w3-container my-4 media"></div>' +

            '<div class="w3-container my-4 shortie-option">' +

            '<div class="w3-twothird">' +
            '<input type="button" id="uploadButton" class="uploadButton w3-button" value="Upload Image"></input>' +
            '<div class="inputButton">' +
            '<input identify="uploadFile1" type="file" class="uploadFile1 fileUpload" style="display: none;" multiple />' +
            '<input identify="uploadFile2" type="file" class="uploadFile2 fileUpload" style="display: none;" multiple />' +
            '<input identify="uploadFile3" type="file" class="uploadFile3 fileUpload" style="display: none;" multiple />' +
            '<input identify="uploadFile4" type="file" class="uploadFile4 fileUpload" style="display: none;" multiple />' +
            '</div>' +

            '<div class="toBeRemoved"></div>' +
            '<div class="counts">' +
            '<input class="uploadFile1 count1 skipCount" type="hidden" value="0" />' +
            '<input class="uploadFile2 count2 skipCount" type="hidden" value="0" />' +
            '<input class="uploadFile3 count3 skipCount" type="hidden" value="0" />' +
            '<input class="uploadFile4 count4 skipCount" type="hidden" value="0" />' +
            '</div>' +

            '</div>' +

            '<div class="w3-third">' +
            // '<button style="font-size: 22px;" class="py-2 px-3 w3-right w3-circle add-shortie">+</button>' +
            ' <span class="chars">240</span> ' +
            '<input type="button" style="font-size: 22px;" class="py-2 px-3 w3-right w3-circle add-shortie" value="+">' +
            '</div>' +

            '</div>' +
            '</div>'
        );
        // autosize(document.querySelectorAll('textarea'));

        var maxLength = 240;
        $(".send").attr("disabled", true);

        $('.summernote').summernote({
            toolbar: [],
            placeholder: "What's on your mind?",

            callbacks: {
                onInit: function() {
                    $(".note-editable").on('click', function (e) {
                        // alert('clicked');
                        $(this).parents(".shortie-container").find(".shortie-option").css("display", "block")
                        $(this).parents(".shortie-container").siblings().find(".shortie-option").css("display", "none") 
                    });
                },
                onKeyup: function (e) {
                    // alert('Key is released: ' + e.keyCode);

                    var length = $(this)
                        .summernote("code")
                        .replace(/<\/p>/gi, "\n")
                        .replace(/<br\/?>/gi, "\n")
                        .replace(/<\/?[^>]+(>|$)/g, "")
                        .trim().length;

                    var length = maxLength - length;
                    $(this).parents(".shortie-container").find(".chars").text(length)

                    if (length < 240 && length > 0) {
                        $(".send").attr("disabled", false);
                    } else {
                        $(".send").attr("disabled", true);
                        
                    }

                },
            },
        });


        $(".shortie").each(function (i) {

            if ($(this).val() == "") {
                $("#clickPostButton").attr("disabled", true);
            }


        });


    });

    

    $(document).on("click", ".removeShortie", function () {

        $(this).parents(".shortie-container").siblings().find(".shortie-option").css("display", "none")
        $(this).parents(".shortie-container").prev().find(".shortie-option").css("display", "block")
        $(this).parents(".shortie-container").remove();
    });

    $(".shortie").each(function (i) {
        if ($(this).val().trim() == "") {
            $(".getName").css("display", "none")
        } else if ($(this).val().trim() !== "") {
            $(".getName").css("display", "block")
        }
    });


    $(document).on("click", ".shortie", function () {


        $(this).parents(".shortie-container").find(".shortie-option").css("display", "block")
        $(this).parents(".shortie-container").siblings().find(".shortie-option").css("display", "none")

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


        if (question.val() == "") {
            // $("#emptyQuestionError").css("display", "block")
            $(this).parents(".quizWrap").find(".emptyQuestionError").css("display", "block")
            $(this).parents(".quizWrap").find(".emptyQuestionError").text(
                "Please fill out the question field")
            $("#makeQuiz").val("");
        } else if (options[0].value == "" || options[1].value == "" || options[2].value == "" ||
            options[3].value == "") {

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

            $(this).removeClass("done");
            $(this).addClass("update");
            $(this).attr("value", "Update");


            // $(this).css("display", "none");

            var myQuestion = $(this).parents(".quizBox").find(".questionBox").find(".question").attr("value");

            var option_one = options[0].value;
            var option_two = options[1].value;
            var option_three = options[2].value;
            var option_four = options[3].value;
            var correct_answer = $(this).parents(".quizWrap").find(".correct-answer-hidden").attr("value");
            var name = $(".dynamicQuizTitle").val();
            var description = $(".dynamicQuizDescription").val();
            var unique = $(this).parents(".quizWrap").find(".unique").attr("value");
            var image = $(this).parents(".quizWrap").find(".imageString").val();

            // alert(image)

            let quiz_id = $('#quizId').attr('quizId');

            let url = $('#buildQuiz').attr('url');

            let token = $('[name = csrf-token]').attr('content');

            $.post(url, {
                quiz_id: quiz_id,
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


                alert("Successfully inserted");

            });

            $(".addQuiz").css("display", "block");

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
        var unique = $(this).parents(".quizWrap").find(".unique").attr("value");
        var image = $(this).parents(".quizWrap").find(".imageString").val();



        let quiz_id = $('#quizId').attr('quizId');

        let url = $('#buildQuiz').attr('url');
        let token = $('[name = csrf-token]').attr('content');

        $.post(url, {
            quiz_id: quiz_id,
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
            alert("Successfully inserted");

        });

    });




    $("#create").click(function () {


        // var i;

        // var done = document.getElementsByClassName("done");
        // for (i = 0; i < done.length; i++) {
        //     done[i].click();
        // }

        // var quizSource = document.getElementsByClassName("quizSource");
        // var makeQuiz = document.getElementById("makeQuiz");

        // for (i = 0; i < quizSource.length; i++) {
        //     makeQuiz.value += quizSource[i].value;
        // }

        // $("#build").click();

        var name = $(".dynamicQuizTitle").val();
        var description = $(".dynamicQuizDescription").val();
        let quiz_id = $('#quizId').attr('quizId');

        let profile = $('#profile').attr('profile');
        let url = $('#storeQuiz').attr('url');
        let token = $('[name = csrf-token]').attr('content');

        $.post(url, {
            quiz_id: quiz_id,
            name: name,
            description: description,
            _token: token
        }, function () {

            // alert("Your Quiz has been stored");
            location.href = "/" + profile;

        });



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
