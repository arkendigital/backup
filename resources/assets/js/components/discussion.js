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
/*
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
*/

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


$(".discussion-sidebar__mobile-menu").click(function() {

    if ($(".discussion-sidebar__categories").hasClass("active")) {

        hideCategories();

    }

    else {

        showCategories();

    }

});

function showCategories()
{

    $(".discussion-sidebar__categories").addClass("active");
    $(".discussion-sidebar__categories").slideDown();

    $(".discussion-sidebar__mobile-menu span").html("Hide Categories");

    $("html, body").animate({
        scrollTop: $('.discussion-sidebar__mobile-menu').offset().top - 15
    }, 1000);

}

function hideCategories()
{

    $(".discussion-sidebar__categories").removeClass("active");
    $(".discussion-sidebar__categories").slideUp();

    $(".discussion-sidebar__mobile-menu span").html("Show Categories");

}
