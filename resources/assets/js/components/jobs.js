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
