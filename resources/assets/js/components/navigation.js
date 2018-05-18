$(".header-burger").click(function() {
  showNav();
});

$(".navigation-overlay").click(function() {
  hideNav();
});


function hideNav() {
  $("html, body").removeClass("navigation-active");
  $(".navigation-overlay").fadeOut();
  $("nav").animate({
    width: "0"
  });
}

function showNav() {
  $("html, body").addClass("navigation-active");
  $(".navigation-overlay").fadeIn();
  $("nav").show();
  $("nav").animate({
    width: "85%"
  });
}
