/* This file changes CSS variables into a 'light' variant */
/* Changes text color. */

function cssLight() {
    $(":root").css("--article-thumbnail-text-color", "black");
    $(":root").css("--article-tag-text-color", "white");
    $(":root").css("--home-text-color", "black");
    $(":root").css("--drop-text-color", "#3A0CA3");

    /* Changes article preview boxes. */
    $(":root").css("--article-thumbnail-color", "#f5f5f5");
    $(":root").css("--article-thumbnail-color-hover", "#e3d9f7");
    $(":root").css("--article-tag-container-background-color", "lightgray");

    /* Changes top half of the home page. */
    $(":root").css("--home-background-color", "#7285ee");

    /* Changes drop down menu in nav-bar. */
    $(":root").css("--drop-background-color", "#f5e6f2");
    $(":root").css("--drop-background-color-hover", "#b555a5");
    $(":root").css("--drop-border-color", "#c295ba");

    /* Changes country selection bars. */
    $(":root").css("--country-bar-background-color", "white");
    $(":root").css("--country-bar-background-hover", "lightblue");
    $(":root").css("--table-background-color", "white");

    /* Changes country info screen. */
    $(":root").css("--country-information-background-color", "#f1d8ff");
    $(":root").css("--article-container-color", "rgb(105, 103, 103)")
    $(":root").css("--table-background-color-1", "#d8d8d8");

    /* Changes footer color */
    $(":root").css("--footer-background-color", "#ddd");
    
    
    //home-body.css
    $(":root").css("--country-container-background-color", "white");

    //nav-bar-style.css
    $(":root").css("--search-background-color", "white");
    
    //basic.css
    $(":root").css("--body-background-color", "#f1e1f3");
    $(":root").css("--basic-text-style", "black");

    // article-style.css
    $(":root").css("--title-color", "#451754");
    $(":root").css("--screening-color", "red");
    $(":root").css("--article-background-color", "white");
    $(":root").css("--date-color", "gray");
    $(":root").css("--date-text-color", "rgb(78, 78, 78)");
    $(":root").css("--buttons-container-background-color", "lightgray");
    $(":root").css("--a-background-color", "#7209B7");
    $(":root").css("--button-text-color", "white");
    $(":root").css("--a-text-color", "#7209B7");

    /* Changes top half of the home page. */
    $(":root").css("--home-background-color", "#7285ee");

    //search-style.css
    $(":root").css("--search-content-background-color", "rgb(233, 233, 233)");

    //article-editor.css
    $(":root").css("--text-editor-outer-background-color", "gray");
    $(":root").css("--text-editor-inner-background-color", "white");
    $(":root").css("--text-area-border-color", "#7209B7");
    $(":root").css("--comments-text-color", "gray");
    $(":root").css("--comments-text-color-wrong", "red");
    $(":root").css("--button-container-background-color", "rgb(77, 77, 77)");
    $(":root").css("--submit-button-wrong-background-color", "rgb(126, 125, 125)");
    $(":root").css("--submit-button-wrong-text-color", "rgb(156, 156, 156)");
    $(":root").css("--text-area-background-color", "white");

    //table style
    $(":root").css("--country-button-background-color", "green");
    $(":root").css("--table-background-color-2",  "#d8f5ff");
    $(":root").css("--table-background-color-1",  "#d8d8d8");
    $(":root").css("--table-hover-color", "rgb(228, 165, 107)");
}