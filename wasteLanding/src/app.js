$(window).on("scroll", function () {
  if ($(window).scrollTop() > 5) {
    $(".menuHoriz").addClass("active");
  } else {
    $(".menuHoriz").removeClass("active");
  }
});

$(document).ready(function () {
  $(".columnMenuEl").hover(
    function () {
      var id = "#" + this.id + "k";
      $(id).fadeIn();
    },
    function () {
      var id = "#" + this.id + "k";
      $(id).hide();
    }
  );
});
