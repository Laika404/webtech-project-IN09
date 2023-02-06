// Alert that is shown when you can't submit and submit button is clicked
function showAlert() {
  alertString = canSubmit();
  alert(alertString);
}



// Resizes the text field so that the whole content can be shown.
function resizeTextField (elem) {
  $(elem).height('max-content').height(elem.scrollHeight);
}

// Resizes all text fields, this is needed when the user resizes the whole screen.
function allTextFieldsResizing() {
  let article_array = $(".article-text-field").toArray();
  article_array.forEach(elem => {
    resizeTextField(elem);
})}


//Rename textareas for handling php post method
function renameTextAreas () {
  var currentTextField = 0;
  var currentSubTitleField = 0;
  var text_array = $('#super-article-editor-content-container').children().toArray();
  for (element of text_array) {
    if ($(element).children().eq(1).attr('class').split(' ')[1] == 'article-subtitle-field') {
      $(element).children().eq(1).attr('name', 'asubtitle' + currentSubTitleField);
      currentSubTitleField += 1;
    } else {
      $(element).children().eq(1).attr('name', 'atext' + currentTextField);
      currentTextField += 1;
    }
  }
}

// Get total character count of content area
function calculateCharacterCount () {
  var totalCharacterCount = 0;
  var text_array = $('#super-article-editor-content-container').children().toArray();
  for (element of text_array) {
    console.log($(element).children().eq(1).attr('class').split(' ')[1]);
    if ($(element).children().eq(1).attr('class').split(' ')[1] == 'article-subtitle-field') {
      totalCharacterCount += $(element).children().eq(1).val().length;
      //'<h2></h2>'.length
      totalCharacterCount += 9;
    } else {
      totalCharacterCount += $(element).children().eq(1).val().length;
    // '<p></p>'.length
      totalCharacterCount += 7;
    }
  }
  return totalCharacterCount;
}

// check if character count is within limits and update the page respectively
function checkCharacterCount () {
  var totalCharacterCount = calculateCharacterCount();
  if (totalCharacterCount < 14000) {
    $('#character-count').html(' Content: <span class="gray"> (' + totalCharacterCount + '/14000 karakters)');
  } else {
    $('#character-count').html(' Content: <span class="red"> (' + totalCharacterCount + '/14000 karakters)');
  }
}

/* Changes the submit button depending on if the article is submittable */
function canSubmit() {
  var alertString = "Kan het artikel niet maken:\n\n\n";
  var canSubmitValue = true;
  if ($(".article-title-field").val().length == 0) {
    alertString += "- \t Geen titel\n";
    canSubmitValue = false;
  }
  if (calculateCharacterCount() <= 7) {
    alertString += "- \t Geen content\n"
    canSubmitValue = false;
  } if (calculateCharacterCount() > 14000){
    alertString += "- \t Karakterlimiet overschreden\n"
    canSubmitValue = false;
  }
  if ($('#land-tag-options').val() == 'none') {
    alertString += "- \t Geen land-tag\n"
    canSubmitValue = false;   
  }
  if ($('#subject-tag-options').val() == 'none') {
    alertString += "- \t Geen onderwerp-tag\n"
    canSubmitValue = false;   
  } 


  if (canSubmitValue == false) {
    $('#make-button-wrong').css('display', 'block');
    $('#make-button').css('display', 'none');
  } else {
    $('#make-button-wrong').css('display', 'none');
    $('#make-button').css('display', 'block');
  }

  return alertString;
}

/* Delete text fields. (if a .delete-button is added it needs to be activated to
   update new elements)
*/
function initializeDeleteButton () {
  $(".delete-button").on( 'click', function () {
      $(this).parent().remove();
      renameTextAreas();
      checkCharacterCount();
      canSubmit();
  })
}
/* resize text fields. (if a text field is added it needs to be activated to 
  update new elements)
*/
function initializeResizingText (){
  $('.article-text-field').on('input', function() {
      resizeTextField(this);
      renameTextAreas();
      checkCharacterCount();
      canSubmit();
  })
};

/* Functions that often need to be called together. */
function updateFunctions () {
  initializeDeleteButton();
  initializeResizingText();
  renameTextAreas();
  checkCharacterCount();
  allTextFieldsResizing();
  canSubmit();
}


/* Adds a subtitle to the article maker */
function addSubTitle() {
  $('#super-article-editor-content-container').append($('#hidden-text-elements-container').children().eq(0).clone());
  updateFunctions();
}

/* Adds a text field to the article maker */
function addTextField() {
  $('#super-article-editor-content-container').append($('#hidden-text-elements-container').children().eq(1).clone());
  updateFunctions();    
}

/* Run this when the html document is loaded */
$(document).ready(function () {
  updateFunctions();
  $(window).resize(function(){
    allTextFieldsResizing();
  });
})