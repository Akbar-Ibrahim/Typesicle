function readImg(input, img) {
    if (input.files && input.files[0]) {

        if (checkImage(input)) {
            var reader = new FileReader();
            reader.onload = function (ev) {
                // img.src = ev.target.result;
                img.attr("src", ev.target.result);

                img.classList.remove('d-none');
            };

            reader.readAsDataURL(input.files[0]);


        }
    }

}

function checkImage(input) {

    var file = input.files;

    //checkfileType
    for (var i = 0; i < file.length; i++) {
    if (!((file[i].type === "image/jpeg") || (file[i].type === "image/gif") || (file[i].type === "image/png"))) {

        // openNotify({color:'red', message:'File type not supported', type:'closed'});
        $(".w3-modal").css("display", "block");

        input.value = "";


        return false;

    }
    }
    return true;

}


$(document).ready(function () {

    $(document).on("click", ".uploadButton", function () {

        var inputs = $(this).next().find(".fileUpload")
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].value == "") {
                inputs[i].click();
                break;
            }
        }


    });


    $("#clickPostButton").click(function () {
        $("#postButton").click();
    });

});


$(document).ready(function () {
    
    
    $(document).on("change", ".fileUpload", function () {

        $(this).parents(".shortie-container").find(".imageLimitError").hide()
        var total_file = this.files.length;
        var input = this;
        

        var fileUpload = document.getElementsByClassName("fileUpload");

        if (checkImage(input)) {

        var total = 0;
        for (var i = 0; i < fileUpload.length; i++) {
            total = total + fileUpload[i].files.length
        }

        // if (total > 100) {
        //     alert("Maximum is four")
        //     $(this).val("");
        // } else {
    

            for (var i = 0; i < total_file; i++) {

                $(this).attr("delete", i+1);
                $(this).attr("deletecount", 0);
                $(this).parents(".shortie-option").prev().append(
                    '<div class="imgDiv' + i + ' img_preview image' + $(this).attr("identify") + '" identify="' + $(this).attr("identify") + '" imageIndex="' + i + '">' +
                    '<img id="img_preview1" class="img_preview1" src="' +
                    URL.createObjectURL(event.target.files[i])
                    + '" style="height: 150px; width: 150px;  object-fit: cover;">' +
                    '<input index="' + i + '" type="button" class="remove1 removeImg" id="" style="font-size: 30px;" value="x">' +
                    '</div>'
                );



            }
        }

        // var images = document.getElementsByClassName("img_preview"+mediaIndex);
        var images = $(this).parents(".shortie-option").prev().find(".img_preview")
        

        if(images.length > 4){
            // alert("You have reached the limit");
            $(this).val("");
            // $(".image" + $(this).attr("identify") + mediaIndex).remove();
            $(this).parents(".shortie-option").prev().find(".image" + $(this).attr("identify")).remove();
            $(this).parents(".shortie-container").find(".imageLimitError").show()
            

        }
    

    });

    var skipFileOneCount = 0;
    var skipFileTwoCount = 0;
    var skipFileThreeCount = 0;
    var skipFileFourCount = 0;


    var skip = 1;

    $(document).on("click", ".removeImg", function () {
        var container = $(this).parents(".shortie-container");
        var image = $(this).parent();
        var identity = $(this).parent().attr("identify");
        var uf = $(this).parents(".shortie-container").find(".inputButton").find("."+identity);
        uf.attr("delete", uf.attr("delete") - 1);
        var deletecount = parseInt(uf.attr("deletecount"))
        uf.attr("deletecount", deletecount + 1);
        var d_c = uf.attr("deletecount");
        var dc = parseInt(d_c);



        $(this).parents(".shortie-container").find(".toBeRemoved").append("<div style='display:none;' class='" + image.attr("identify") + "'>" + 
            "<input style='' type='text' name='" + container.index() + "skip" + dc + "' value='" + $(this).attr("index") + "' />" +
            "</div>")
            // $(this).parents(".media").next().find(".counts").find("." + identity).attr("value", uf.attr("deletecount"));
            $(this).parents(".shortie-container").find(".counts").find("." + identity).attr("value", dc);

        // alert(uf[0].files.length)

        dc = dc + 1;
        var media = $(this).parents(".media").children().length;
        
        if (uf.attr("delete") == 0) {
            uf.remove()
            $(this).parents(".shortie-container").find(".toBeRemoved").find("." + identity).remove();
            $(this).parents(".shortie-container").find(".counts").find("." + identity).remove();
            $(this).parents(".shortie-container").find(".inputButton").append("<input style='display: none' identify='" + identity + "' type='file' class='" + identity + " fileUpload' multiple />")
            $(this).parents(".shortie-container").find(".counts").append("<input style='display:none;' class='" + identity + " skipCount' type='number' value='0' />")

            $(this).parent().remove();

        } else {
            $(this).parent().remove();
        }
        
        
    });







    // $('form').ajaxForm(function () {

    //     alert("Uploaded SuccessFully");


    // });
});