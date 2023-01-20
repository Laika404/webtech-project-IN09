// Changes the night mode buttons to their day versions.
function buttonLight() {
    document.getElementById('night-mode-but').innerHTML = "<ion-icon name='sunny'></ion-icon>";
    document.getElementById('drop-but-4').innerHTML = "Dag-modus";
}

// Changes the light mode buttons to their night versions.
function buttonDark() {
    document.getElementById('night-mode-but').innerHTML = "<i class='fa-solid fa-moon'></i>";
    document.getElementById('drop-but-4').innerHTML = "Nacht-modus";
}

// Toggles night mode.
var lightMode = true;
function changeNightMode() {
    console.log(lightMode);

    if (lightMode == true) {
        buttonDark();
        document.getElementById('night-mode-but').setAttribute( "onmouseenter", "buttonLight()" );
        document.getElementById('night-mode-but').setAttribute( "onmouseleave", "buttonDark()" );
        lightMode = false;
    } else {
        buttonLight();
        document.getElementById('night-mode-but').setAttribute( "onmouseenter", "buttonDark()" );
        document.getElementById('night-mode-but').setAttribute( "onmouseleave", "buttonLight()" );
        lightMode = true;
    }
}

// Toggles drop down menu.
var dropButActive = false;
function clickDropButton () {
    if (dropButActive == true) {
        document.getElementById('left-drop').style.display = 'none';
        dropButActive = false;
    } else {
        document.getElementById('left-drop').style.display = 'block';
        dropButActive = true;
    }
}

// Toggles user drop down menu.
var userButActive = false;
function clickUserButton() {
    if (userButActive == true) {
        document.getElementById('user-drop').style.display = 'none';
        document.getElementById('user-button').innerHTML = '<i class="fa-solid fa-user"></i> <i class="fa-solid fa-caret-down"></i>';
        userButActive = false;
    } else {
        document.getElementById('user-drop').style.display = 'block';
        document.getElementById('user-button').innerHTML = '<i class="fa-solid fa-user"></i> <i class="fa-solid fa-caret-up"></i>';
        userButActive = true;
    }
}



// Toggles if search bar is active.
var searchButActive = false;
function clickSearchButton () {
    if (searchButActive == true) {
        document.getElementById('search-input').style.visibility = "hidden";
        document.getElementById('search-input').style.width = "0px";
        document.getElementById('search-bar').style.marginRight = "0%";
        $(".search-resize").removeClass('search-resize');
        
        searchButActive = false;
    } else {
        document.getElementById('search-input').style.visibility = "visible";
        scalingSearchBar();
        document.getElementById('search-bar').style.marginRight = "0.5%";

        /*  A special search-resize class makes sure (through css) that these 
        elements are properly displayed when search active. */
        document.getElementById('drop-down').classList.add('search-resize');
        document.getElementById('nav-but-1').classList.add('search-resize');
        document.getElementById('nav-but-2').classList.add('search-resize');
        $(".logo-text").addClass('search-resize');
        $("#middle-nav").addClass('search-resize');
        $("#hidden-middle-nav").addClass('search-resize');
        $("#left-nav").addClass('search-resize');
        $("#right-nav").addClass('search-resize');
        $("#left-drop").addClass('search-resize');
        $("#user-drop").addClass('search-resize');
        $(".drop-but").addClass('search-resize');
        searchButActive= true;
    }
}

/* Used by clickSearchButton() to resize search bar depending on width display*/
function scalingSearchBar () {
    if ($(window).width() <= 910) {
        var searchWidth = '100%';
    } else {
        var searchWidth = '200px';
    }
    document.getElementById('search-input').style.width = searchWidth;
}

/* This function will only run when the html is already loaded */
$(document).ready(function() {

    /* Changes the navigation bar, when resizing. */
    function when_resizing() {
        let windowSize = $(window).width();
        // If drop down button is not visible anymore hide drop down content.
        if ($('#drop-down').css('display') == 'none') {
            document.getElementById('left-drop').style.display = 'none';
            dropButActive = false;
        }
        //The scaling of the search input bar.
        if (searchButActive == true) {
            scalingSearchBar();
        }
        


        // If user button is not visible anymore hide drop down content.
        if ($('#right-nav').css('display') == 'none') {
            document.getElementById('user-drop').style.display = 'none';
            document.getElementById('user-button').innerHTML = '<i class="fa-solid fa-user"></i> <i class="fa-solid fa-caret-down"></i>';
            userButActive = false;           
        }
    }
    
/* when_resizing() and when_scrolling() run when html loaded to display 
everything correctly. */
when_resizing();

/* The event loops for resizing. */
window.onresize = when_resizing;
});