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
    /* Used for calculating size and position of logo when scrolling. */
    const homeButtonSize = 500;
    const pixelScrollHorizontal = (homeButtonSize-100)/400;
    const pixelScrollVertical = 50/400;
    
    /* Changes the navigation bar, when resizing. (Contains when scrolling 
    because it essential for the display of the logo) */
    function WhenResizingNav() {
        whenScrollingNav();
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
    
    /* function that will run when scrolled, only contains code for resizing the logo */
    function whenScrollingNav() {
    let scroll = $(window).scrollTop();
    let windowSize = $(window).width();
    if (windowSize < 1100 || scroll > 400) {
        document.getElementById('home-button').style.height = '100px';
        document.getElementById('home-button').style.width = '100px';
        document.getElementById('home-button').style.left = -50 + 0.5*document.getElementById('middle-nav').offsetWidth + 'px';
        document.getElementById('home-button').style.top = '-10px';
    }
    else {
        let imageSize = homeButtonSize - scroll*pixelScrollHorizontal;
        document.getElementById('home-button').style.height = imageSize+'px';
        document.getElementById('home-button').style.width = imageSize+'px';
        document.getElementById('home-button').style.left = -0.5*(imageSize - document.getElementById('middle-nav').offsetWidth)+'px';
        document.getElementById('home-button').style.top = -60 + scroll*pixelScrollVertical+'px';
    }
    };
    
    
/* when_resizing() and when_scrolling() run when html loaded to display 
everything correctly. */
WhenResizingNav();

/* The event loops for resizing and scrolling */
window.onresize = WhenResizingNav;
$(window).scroll(function (event){
    whenScrollingNav();
});
});
