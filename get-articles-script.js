// This function gets an amount of article thumbnails based on the search parameters and puts them inside a container specified by the parameter element
// ORDER BY (unix, likes, views) (ASC|DESC)
// returnString = true, returns the string of the url with all the get values.
// you can use callBackFunction to do something with the response text in javascript
function getArticles(element, options = {}, returnString = false, callBackFunction = function (){}) {
    var searchString = options.searchString || "";
    var orderType = options.orderType ||'unix';
    var descending = options.descending || "DESC";
    var startPoint = options.startPoint || 0;
    var subjectTag = options.subjectTag || "none";
    var countryTag = options.countryTag || "none";
    var authorName = options.authorName || "none";
    var thumbnailsDIVID = options.thumbnailsDIVID || "articles-give-0";
    var getArticleCount = options.getArticleCount|| 0;
    var useFunction = options.useFunction || 0;
    // needed because screenedTag can be zero
    if (options.hasOwnProperty('screenedTag')) {
        screenedTag = options.screenedTag;
    } else {
        var screenedTag =  1;
    }
    // needed because amount can be zero
    if (options.hasOwnProperty('amount')) {
        amount = options.amount;
    } else {
        var amount =  10;
    }
    
    // In this case there isn't send a request but the search string get parameters are returned
    if (returnString == true) {
        return "search=" + searchString + 
        "&order-type=" + orderType +
        "&descending=" + descending +
        "&amount=" + amount +
        "&start-point=" + startPoint +
        "&subject-tag=" + subjectTag +
        "&land-tag=" + countryTag +
        "&author-name=" + authorName +
        "&screened-tag=" + screenedTag +
        "&div-id=" + thumbnailsDIVID +
        "&get-count=" + getArticleCount;
    } else {
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        $("#"+ element).html(this.responseText);
        // used for the search page count
        if (this.responseText == "1") {
            $("#search-page-zoek").html("zoekresultaat");
        }
        if (useFunction == 1) {
            callBackFunction(parseInt(this.responseText));
        }
    }
    xmlhttp.open("GET","give-article-list.php?" +
     "search=" + searchString + 
     "&order-type=" + orderType +
     "&descending=" + descending +
     "&amount=" + amount +
     "&start-point=" + startPoint +
     "&subject-tag=" + subjectTag +
     "&land-tag=" + countryTag +
     "&author-name=" + authorName +
     "&screened-tag=" + screenedTag +
     "&div-id=" + thumbnailsDIVID +
     "&get-count=" + getArticleCount, true);
    xmlhttp.send();
}
}