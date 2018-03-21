function readName(input,element) {

  if (input.files && input.files[0]) {

    var file_name = input.files[0].name;

    $(element + " span").html(file_name);

  }

}

$(function() {
  $(".file-upload").click(function() {

    var file_input = $(this).attr("data-id");

    $("#"+file_input).click();

  });
  $(".file-upload-input").change(function() {

    var file_upload_container = $(this).attr("data-id");

    readName(this, "#"+file_upload_container);

  });

});
