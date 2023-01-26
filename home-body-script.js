// width when #country-container resizes to 100%
var countryContainerResize = 850;
// The country information box that is currently visible
var currentVisibleCountry = null;

// Moves the country information container (mobile case = under it's respective button)
function moveCountryBox (event_id) {
    if ($(window).width() >= countryContainerResize) {
        $(".country-information").addClass('sided');
        $(".country-information").removeClass('unsided');
        $("#ajax-country-container").detach().appendTo('body');

    } else {
        if (currentVisibleCountry != null) {
            $(".country-information").addClass('unsided');
            $(".country-information").removeClass('sided');
            console.log("#"+ currentVisibleCountry);
            $("#ajax-country-container").detach().appendTo('body');
            $("#ajax-country-container").insertAfter($("#"+ currentVisibleCountry));
        }
    }
}

// Happens when scrolling (webpage needs to know when to switch to mobile version).
function scrollFunction() {
    if ($(window).width() >= countryContainerResize) {
        if (150 <= $(window).scrollTop() && $(window).scrollTop() <= ($(document).height() - 1100)) {
            $('#country-article-container').css('display', 'flex');
        } else {
            $('#country-article-container').css('display', 'none');
        }
    }
}

// AJAX fetches country data and html
function getCountryHTML (country) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        document.getElementById("ajax-country-container").innerHTML = this.responseText;
        moveCountryBox(currentVisibleCountry);
        scrollFunction();
    }
    xmlhttp.open("GET","country-information-side.php?c_name=" + country.replace("-", " "), true);
    xmlhttp.send();
}



/*event_id is in html this.id */
// Happens when entering a country bar
function countryEnter (event_id) {
    if ($(window).width() >= countryContainerResize) {
        getCountryHTML (event_id);
    }
}

// Happens when leaving a country bar
function countryLeave () {
    if (currentVisibleCountry == null) {
        document.getElementById("ajax-country-container").innerHTML = "";
    } else {
        countryEnter(currentVisibleCountry);
    }
}

// Happens when clicking on a country bar.
function countryClick (event_id) {
    if (currentVisibleCountry != null) {
        $('#' + currentVisibleCountry + '> .country-drop').html('<i class="fa-solid fa-caret-down"></i>');
    }
    if (currentVisibleCountry == event_id && $(window).width() <= countryContainerResize) {
        currentVisibleCountry = null;
        $('#' + event_id + '> .country-drop').html('<i class="fa-solid fa-caret-down"></i>');
        document.getElementById("ajax-country-container").innerHTML = "";
    } else {
        currentVisibleCountry = event_id;
        $('#' + currentVisibleCountry + ' > .country-drop').html('<i class="fa-solid fa-caret-up"></i>');
        getCountryHTML(currentVisibleCountry);
        }
}

// When document ready, add to events resize function and scroll function.
$(document).ready(function() {
    $(window).resize(function(){
        moveCountryBox(currentVisibleCountry);
    });

    $(window).scroll(function () {
        scrollFunction();
    });
})
