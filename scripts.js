// Changes the icon of the night mode button to the light icon.
function buttonLight() {
    document.getElementById('night-mode-but').innerHTML = "<ion-icon name='sunny'></ion-icon>";
}

// Changes the icon of the night mode button to the night icon.
function buttonDark() {
    document.getElementById('night-mode-but').innerHTML = "<i class='fa-solid fa-moon'></i>";
}

// Switches night mode.
var lightMode = true;
function changeNightMode() {
    console.log(lightMode);

    if (lightMode == true) {
        document.getElementById('night-mode-but').setAttribute( "onmouseenter", "buttonLight()" );
        document.getElementById('night-mode-but').setAttribute( "onmouseleave", "buttonDark()" );
        lightMode = false;
    } else {
        document.getElementById('night-mode-but').setAttribute( "onmouseenter", "buttonDark()" );
        document.getElementById('night-mode-but').setAttribute( "onmouseleave", "buttonLight()" );
        lightMode = true;
    }
}

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



// Button which will show search bar.
var searchButActive = false;
/* resize = If the user is resizing, certain things need to happen depending on
if the search bar is active*/
function clickSearchButton () {
    if (searchButActive == true) {
        document.getElementById('search-input').style.visibility = "hidden";
        document.getElementById('search-input').style.width = "0px";
        document.getElementById('search-bar').style.marginRight = "0%";
        $(".search-resize").removeClass('search-resize');
        
        searchButActive = false;
    } else {
        document.getElementById('search-input').style.visibility = "visible";
        document.getElementById('search-input').style.width = "200px";
        document.getElementById('search-bar').style.marginRight = "0.5%";

        document.getElementById('drop-down').classList.add('search-resize');
        document.getElementById('nav-but-1').classList.add('search-resize');
        document.getElementById('nav-but-2').classList.add('search-resize');
        $(".logo-text").addClass('search-resize');
        $("#middle-nav").addClass('search-resize');
        $("#hidden-middle-nav").addClass('search-resize');
        $("#left-nav").addClass('search-resize');
        $("#right-nav").addClass('search-resize');

        searchButActive= true;
    }
}


$(document).ready(function() {
    
    const homeButtonSize = 500;
    const pixelScrollHorizontal = (homeButtonSize-100)/400;
    const pixelScrollVertical = 50/400;
    
    // Changes the navigation bar, when resizing.
    function when_resizing() {
        when_scrolling();
        let windowSize = $(window).width();
        document.getElementById('home-info').innerHTML = windowSize;
        // If drop down button is not visible anymore hide drop down content.
        if ($('#drop-down').css('display') == 'none') {
            document.getElementById('left-drop').style.display = 'none';
            dropButActive = false;
        }
    }
    

    function when_scrolling() {
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
    
    

when_resizing();
window.onresize = when_resizing;

$(window).scroll(function (event){
    when_scrolling();
});

});