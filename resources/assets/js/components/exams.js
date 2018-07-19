$(".exam-modules-slider-item").click(function() {

  /**
  * Get module id.
  *
  */
  var module_id = $(this).attr("data-module-id");

  /**
  * Remove any active classes.
  * Hide all of the containers
  *
  */
  $(".exam-modules-slider-item").removeClass("exam-modules-slider-item-active");
  $(".exam-modules-info-container").hide();

  /**
  * Activate this item.
  *
  */
  $(this).addClass("exam-modules-slider-item-active");
  $("#exam-modules-info-container-"+module_id).show();

});


$(".survey-answer-dropdown-item").click(function() {

  /**
  * Get vars.
  *
  */
  var module_id = $(this).attr("data-module-id");
  var module_name = $(this).attr("data-module-name");
  var category_id = $(this).attr("data-category-id");

  $(".survey-answer-cat").removeClass("survey-answer-active");

  // $(".survey-answer-cat").hide();
  // $(".survey-answer-dropdown").hide();
  // $("#survey-answer-cat-"+category_id).show();
  $("#survey-answer-category-"+category_id).html(module_name);
  $("#survey-answer-category-"+category_id).parent().parent().addClass("survey-answer-active");

  $("#module_id").val(module_id);

});

$(".survey-answer-difficulty").click(function() {

  var difficulty = $(this).attr("data-difficulty");

  $(".survey-answer-difficulty").removeClass("survey-answer-active");

  $(this).addClass("survey-answer-active");

  $("#difficulty").val(difficulty);

});


$(".survey-button-add").click(function(e) {

  e.preventDefault;

  var module_id = $("#module_id").val();
  var difficulty = $("#difficulty").val();

  $.ajax({
    type: "POST",
    url: $("#survey-form").attr('action'),
    data: {
      module_id:module_id,
      difficulty:difficulty
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response){

      if (response == "OK") {
        // location.href = '/exams/survey/results';

        $("#survey-before").hide();
        $("#salary-survey-footer-after-submission").show();

      }

    },
    error: function(response) {
      console.log("ERROR");
      console.log(response);
    }
  });

  return false;


});
