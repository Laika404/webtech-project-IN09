// Changes the icon of the night mode button to the light icon.
function buttonLight() {
    document.getElementById('night-mode-but').innerHTML = "<ion-icon name='sunny'></ion-icon>";
}

// Changes the icon of the night mode button to the night icon.
function buttonDark() {
    document.getElementById('night-mode-but').innerHTML = "<i class='fa-solid fa-moon'></i>";
}

// Switches night mode.
var lightmode = true;
function changeNightMode() {
    console.log(lightmode);

    if (lightmode == true) {
        document.getElementById('night-mode-but').setAttribute( "onmouseenter", "buttonLight()" );
        document.getElementById('night-mode-but').setAttribute( "onmouseleave", "buttonDark()" );
        lightmode = false;
    } else {
        document.getElementById('night-mode-but').setAttribute( "onmouseenter", "buttonDark()" );
        document.getElementById('night-mode-but').setAttribute( "onmouseleave", "buttonLight()" );
        lightmode = true;
    }

}


$(document).ready(function() {
    
    const homeButtonSize = 500;
    const pixelScrollHorizontal = (homeButtonSize-100)/400;
    const pixelScrollVertical = 50/400;
    
    // Changes the navigation bar, when resizing.
    function when_resizing() {
    when_scrolling();
    let windowWidth = $(window).width();
    if (windowWidth < 1000) {
        document.getElementById('middle-nav').style.width = '100px';
        document.getElementById('right-nav').style.width = windowWidth/2-50 + 'px';
        document.getElementById('left-nav').style.width = windowWidth/2-50 + 'px';
    } else {
        document.getElementById('middle-nav').style.width = 'calc(100% - 2*var(--nav-sides-width))';
        document.getElementById('right-nav').style.width = 'var(--nav-sides-width)';
        document.getElementById('left-nav').style.width = 'var(--nav-sides-width)';
    }
    }
    
    function when_scrolling() {
    let scroll = $(window).scrollTop();
    if (scroll <= 400) {
        let imageSize = homeButtonSize - scroll*pixelScrollHorizontal;
        document.getElementById('home-button').style.height = imageSize+'px';
        document.getElementById('home-button').style.width = imageSize+'px';
        document.getElementById('home-button').style.left = -0.5*(imageSize - document.getElementById('middle-nav').offsetWidth)+'px';
        document.getElementById('home-button').style.top = -60 + scroll*pixelScrollVertical+'px';
    }
    else {
        document.getElementById('home-button').style.height = '100px';
        document.getElementById('home-button').style.width = '100px';
        document.getElementById('home-button').style.left = -50 + 0.5*document.getElementById('middle-nav').offsetWidth + 'px';
        document.getElementById('home-button').style.top = '-10px';
    
    }
    };
    
    

when_resizing();
window.onresize = when_resizing;

$(window).scroll(function (event){
    when_scrolling();
});

});