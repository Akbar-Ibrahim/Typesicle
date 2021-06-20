$(document).ready(function () {
    $(".shortieImages").each(function(i) {
        if ($(this).children().length == 1) {
            $(this).children().addClass("w3-container")
            $(this).children().children().css("width", "100%")
            $(this).children().children().css("height", "250px")

        } else if ($(this).children().length == 2) {
            $(this).children().addClass("w3-half")
            $(this).children().children().css("width", "100%")
            $(this).children().children().css("height", "250px")


        } else if ($(this).children().length == 3) {
            $(this).children().addClass("w3-third")
            $(this).children().children().css("width", "100%")
            $(this).children().children().css("height", "200px")

        } else if ($(this).children().length == 4) {
            $(this).children().addClass("w3-quarter")
            $(this).children().children().css("width", "100%")
            $(this).children().children().css("height", "200px")
        }
    });
    
});

