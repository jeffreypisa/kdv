import $ from "jquery";

export function scrollto() {
  
  $(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();
    
    $("body").removeClass("menuopen");
    $("body").removeClass("opensidemenu");
    $(".js-mobilemenu").removeClass("open");
    
    $('html, body').animate({
      scrollTop: $($.attr(this, 'href')).offset().top
    }, 800);
  });
  
  /*
  $(".js-bannerbutton").on({
    mouseenter: function () {      
      $(".mod-banner").addClass('grow');
      $("body").removeClass('text-white').removeClass('text-dark').css('background-color', bgcolor).addClass(textcolor).addClass('logo-dark');
    },
    mouseleave: function () {
      $(".mod-banner").removeClass('grow');
      $("body").css('background-color', '#E5E7ED').removeClass('text-white').removeClass('text-dark').removeClass('logo-dark');
    } 
  });
  */
}