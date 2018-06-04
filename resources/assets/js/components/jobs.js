$(".advertising-toggle").click(function() {

  console.log( $(this).attr("data-id") );

  /**
  * Hide any current showing toggle items.
  *
  */
  $(".advertising-toggle-item").slideUp();

  /**
  * Show the correct one.
  *
  */
  $("#"+$(this).attr("data-id")).slideDown();

});





$(".job-list-filter-toggle").click(function() {

    if ($(".job-list-sidebar").hasClass("active")) {

        hideCategories();

    }

    else {

        showCategories();

    }

});

function showCategories()
{

    $(".job-list-sidebar").addClass("active");
    $(".job-list-sidebar").slideDown();
    $(".job-list-banner").slideDown();

    $(".job-list-filter-toggle").html("Hide Filtering");

    $("html, body").animate({
        scrollTop: $('.job-list-banner').offset().top - 15
    }, 1000);

}

function hideCategories()
{

    $(".job-list-sidebar").removeClass("active");
    $(".job-list-sidebar").slideUp();
    $(".job-list-banner").slideUp();

    $(".job-list-filter-toggle").html("Show Filtering");

}
