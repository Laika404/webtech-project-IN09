// Used for the delete article button, deletes article
function deleteClick(articleId) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        window.location.href = "index.php";
    }
    xmlhttp.open("POST", "delete-article.php");
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("article-id=" + articleId);

}

// used for the approve article button, approves the article
function approveClick(articleId) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        window.location.replace("article.php?a-id=" + articleId);
    }
    xmlhttp.open("POST", "approve-article.php");
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("article-id=" + articleId);
}