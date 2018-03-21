/**
* Open add discussion popover.
*
*/
$(".discussion-add-button").click(function() {
  $(".discussion-popover").addClass("discussion-popover-active");
});

/**
* Close popover.
*
*/
$(".discussion-popover-close").click(function() {
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
