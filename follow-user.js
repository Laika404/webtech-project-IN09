// if user wants to follow this person, makes a request to the server

var followed = false;

// Makes a request to the server to assign a follow
function followUser(userId, authorName, request=true) {
    if (followed == false) {
        followed = true;
        $("#follow-text").html("Gevolgd");
        var follow = 1;
    } else {
        followed = false;
        $("#follow-text").html("Volg");
        var follow = 0;
    }


    if (request == true) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "follow.php");
        xmlhttp.onload = function () {
            $("#follow-number").html(this.responseText);
        }
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("user-id=" + userId + "&author-name=" + authorName + "&follow=" + follow);
    } 
}