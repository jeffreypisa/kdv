import $ from "jquery";
import 'slick-carousel';

export function slick_init() {	
	$('.slick-slider').slick({
		slidesToShow: 3,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 2
				}
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 1
				}
			}
		]
	});
	
	$('.js-slick-sliderblok').slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		dots: false,
		centerMode: true,
		fade: true,
		autoplay: true,
		swipeToSlide: true,
		speed: 2000,
		cssEase: 'cubic-bezier(.19,1,.22,1)'
	});
	

	
	$('.slick-slider-coaches').slick({
		slidesToShow: 1
	});
	
	// FAQ interaction
	$('.faq-question').click(function() {
		$(this).siblings('.faq-answer').slideToggle();
		$(this).find('i').toggleClass('fa-plus fa-minus');
	});
}