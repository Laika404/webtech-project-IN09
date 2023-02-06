// File used for ajax to like

var like_active = false;
/* requests a like or delike from the server (there is a request option, because
 the first time the page is loaded the like button html needs to be changed 
accordingly)*/
function likeClick(userId, articleId, request=true) {
    if (like_active == false) {
        like_active = true;
        var like = 1;
        $("#like-button").addClass("liked");
        $("#like-text").html("Geliked!");

    } else {
        like_active = false;
        var like = 0;
        $("#like-button").removeClass("liked");
        $("#like-text").html("Like!");
    }
    if (request == true) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function () {
            document.getElementById("like-value").innerHTML = this.response;
        }
        xmlhttp.open("POST", "like.php");
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("user-id=" + userId + "&article-id=" + articleId + "&like=" + like);
    } 
}