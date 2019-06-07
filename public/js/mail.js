$(document).on("click", ".show-self_context > span", function() {
    if ($(this).next().css("display") == "none") {
      $(this).next().show();
    } else {
      $(this).next().hide();
    }
  });