$("#salary-survey-form").submit(function(e) {

  e.preventDefault;

  $.ajax({
    type: "POST",
    url: $(this).attr('action'),
    data: new FormData( this ),
    processData: false,
    contentType: false,
    success: function(response){

      console.log("SUCCESS");
      console.log(response);

      if (response == "OK") {
        $("#salary-survey-footer-before-submission").hide();
        $("#salary-survey-footer-after-submission").show();
      }

    },
    error: function(response) {

      console.log("ERROR");
      console.log(response);

      alert("Please enter some content...");

    }
  });

  return false;

});

$(".salary-survey-question-answer-clickable").click(function() {

  /**
  * Define variables.
  *
  */
  var key = $(this).attr("data-key");
  var value = $(this).attr("data-value");

  if (key == "type") {
      $(".salary-survey-question-answer-input").hide();

      $("#input-"+value).show();

  }

  /**
  * Update hidden field with value.
  *
  */
  $("#"+key).val(value);

  /**
  * Remove active from other answers on this question.
  *
  */
  $(".salary-survey-question-answer-clickable-"+key).removeClass("salary-survey-question-answer-clickable-active");

  /**
  * Activate clicked answer.
  *
  */
  $(this).addClass("salary-survey-question-answer-clickable-active");

});
