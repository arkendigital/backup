$(".header-burger").click(function() {
  showNav();
});

$(".navigation-overlay").click(function() {
  hideNav();
});


function hideNav() {
  $("body").css("overflow", "visible");
  $(".navigation-overlay").fadeOut();
  $("nav").animate({
    width: "0"
  });
}

function showNav() {
  $("body").css("overflow", "hidden");
  $(".navigation-overlay").fadeIn();
  $("nav").show();
  $("nav").animate({
    width: "400px"
  });
}
