import $ from "jquery";
import 'slick-carousel';

export function slick_init() {	
	
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
	
}