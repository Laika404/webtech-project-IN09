/* This file changes CSS variables into a 'dark mode' variant */
/* Changes text color. */

function cssDark(){
    $(":root").css("--article-thumbnail-text-color", "#f5f5f5");
    $(":root").css("--article-tag-text-color", "#f5f5f5");
    $(":root").css("--home-text-color", "#f5f5f5");
    $(":root").css("--drop-text-color", "#f5f5f5");

    /* Changes article preview boxes. */
    $(":root").css("--article-thumbnail-color", "#273e63");
    $(":root").css("--article-thumbnail-color-hover", "#4e6a96");
    $(":root").css("--article-tag-container-background-color", "#4e6a96");

    /* Changes drop down menu in nav-bar. */
    $(":root").css("--drop-background-color", "#7285ee");
    $(":root").css("--drop-background-color-hover", "#4e6a96");
    $(":root").css("--drop-border-color", "#f5f5f5");

    /* Changes country selection bars. */
    $(":root").css("--country-bar-background-color", "#4e6a96");
    $(":root").css("--country-bar-background-hover", "#3f37c9");
    $(":root").css("--table-background-color", "#3f37c9");
    /* $(":root").css("--country-container-background-color", "#273e63"); 
    $(":root").css("--country-bar-text-color", "#f5f5f5");
    */
    /* Changes country info screen. */
    $(":root").css("--country-information-background-color", "#273e63");
    $(":root").css("--article-container-color", "#273e63");
    /* $(":root").css("--background-color", "#4e6a96"); */
    
    //home-body.css
    $(":root").css("--country-container-background-color", "#005a96");
    
    /* Changes top half of the home page. */
    $(":root").css("--home-background-color", "#273e63");
    
    //nav-bar-style.css
    $(":root").css("--search-background-color", "#303030");

    //basic.css
    $(":root").css("--body-background-color", "#005a96");
    $(":root").css("--basic-text-style", "white");

    /*article-style */
    $(":root").css("--title-color", "#f3defa");
    $(":root").css("--screening-color", "#e68e22");
    $(":root").css("--article-background-color", "#273e63");
    $(":root").css("--date-color", "lightgray");
    $(":root").css("--date-text-color", "lightgray");
    $(":root").css("--buttons-container-background-color", "lightgray");
    $(":root").css("--a-background-color", "#7209B7");
    $(":root").css("--button-text-color", "white");
    $(":root").css("--a-text-color", "#e68e22");
    
    //search-style.css
    $(":root").css("--search-content-background-color", "#111f5c");

    /*footer-style */
    $(":root").css("--footer-background-color", "#262626"); 

    //article-editor.css
    $(":root").css("--text-editor-outer-background-color", "#404040");
    $(":root").css("--text-editor-inner-background-color", "#0e3275");
    $(":root").css("--text-area-border-color", "lightgray");
    $(":root").css("--comments-text-color", "lightgray");
    $(":root").css("--comments-text-color-wrong", "red");
    $(":root").css("--button-container-background-color", "rgb(77, 77, 77)");
    $(":root").css("--submit-button-wrong-background-color", "rgb(126, 125, 125)");
    $(":root").css("--submit-button-wrong-text-color", "rgb(156, 156, 156)");
    $(":root").css("--text-area-background-color", "#264887");

    //table style
    $(":root").css("--country-button-background-color", "darkblue");
    $(":root").css("--table-background-color-2",  "#3e4040");
    $(":root").css("--table-background-color-1",  "#303030");
    $(":root").css("--table-hover-color", "#2c5734");
}


/* Changes footer color 
$(":root").css("--footer-background-color", "#3f37c9"); */

/* proposed changes 
    -> home-body.css
        - 38: change #f1d8ff into var(--background-color)
            + add var into :root
        - 43: change white into var(--country-container-background-color)
            + add var into :root
        - 67: change black into var(--country-text-bar-color)
            + add var into :root
        - country-container: give h1 a var color so it can be changed
    -> footer-style.css
        - 06: change #ddd into var (--footer-background-color)
            + add var into :root / change footer for both light and dark
    -> header
        - make id + var so text can be changed color
*/


