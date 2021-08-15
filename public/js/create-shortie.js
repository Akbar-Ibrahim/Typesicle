

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

        var maxLength = 750;
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

                    if (length < 750 && length > 0) {
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




    
    $(document).on("click", ".clickFileUpload", function () {

        $(this).prev().click();
    })




});
