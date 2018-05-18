require("./components/alert")
require("./components/uploadphoto")
require("./components/discussion")
require("./components/jobs")
require("./components/navigation")
require("./components/search")
require("./components/exams")
require("./components/map")
require("./components/fileupload")
require("./components/salary-survey")


$(function() {

    $(".account_page_delete").click(function() {
        swal({
          title: "Are you sure?",
          text: "Once deleted you cannot retrieve this again in the future!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {

              $("#delete_account_form").submit();

          } else {

            return false;
            
          }
        });
    });

});
