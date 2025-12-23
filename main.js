var $ = jQuery.noConflict();

$(document).on("click", ".posts-layout .post", function() {
    window.location = $(this).find("a").attr("href");
    return false;
});

$(document).on("mouseenter", ".posts-layout .post", function() {
    $(".posts-layout .post").css("background-color", "#fff");
    var cols = "rgba("+parseInt(Math.random()*100+155,10)+","+parseInt(Math.random()*100+155,10)+","+parseInt(Math.random()*100+155,10)+",1)";
    $(this).css("background-color", cols);
});

