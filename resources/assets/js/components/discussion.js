/**
* Open add discussion popover.
*
*/
$(".discussion-add-button").click(function() {
  $("html, body").css("overflow", "hidden");
  $(".discussion-popover").addClass("discussion-popover-active");
});

/**
* Close popover.
*
*/
$(".discussion-popover-close").click(function() {
  $("html, body").css("overflow", "scroll");
  $(this).closest(".discussion-popover").removeClass("discussion-popover-active");
});


/**
* Discussion reply form submission.
*
*/
$("#discussion-reply-form").submit(function(e) {

  e.preventDefault;

  $.ajax({
    type: "POST",
    url: $(this).attr('action'),
    data: new FormData( this ),
    processData: false,
    contentType: false,
    success: function(response){

      $("#newDiscussionReply").append(response);
      $(".discussion-view-reply-editor").trumbowyg("empty");

    },
    error: function(response) {

      alert("Please enter some content...");

    }
  });

  return false;

});


$('.discussion-view-reply-editor, .discussion-edit-content-editor').trumbowyg({
  svgPath: '/images/icons.svg',
  btns: [
    'strong', 'link', 'unorderedList', 'orderedList', 'undo', 'redo'
  ]
});

/**
 * User clicks the reply button
 *
 */
$(".discussion-button--reply").click(function() {
    $('html, body').animate({
        scrollTop: $(".discussion-view-reply").offset().top - 15
    }, 1000);
});
