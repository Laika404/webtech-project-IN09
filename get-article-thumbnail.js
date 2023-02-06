// AJAX fetches country data and html
var thumbnail;
/* This gets the html of the thumbnail of a specific article and puts it into a
container specified by divID */
function getArticleThumbnail (articleId, divID) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        document.getElementById(divID).innerHTML += this.response;
    }
    xmlhttp.open("GET","article-thumbnail.php?a-id=" + articleId, true);
    xmlhttp.send();
}