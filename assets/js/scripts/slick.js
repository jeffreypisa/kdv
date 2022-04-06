import $ from "jquery";
import 'slick-carousel';

export function slick_init() {	
	
	$('.js-slick-bannerslider').slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		dots: true,
		centerMode: true,
		swipeToSlide: true,
		speed: 2000,
		fade: true,
		cssEase: 'cubic-bezier(.19,1,.22,1)'
	});
	
	$('.js-slick-quote').slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		dots: false,
		centerMode: true,
		fade: true,
		autoplay: true,
		swipeToSlide: true,
		speed: 2000,
		cssEase: 'cubic-bezier(.19,1,.22,1)'
	});
	
	$('.js-slick-cta').slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		dots: true,
		centerMode: true,
		swipeToSlide: true,
		speed: 2000,
		cssEase: 'cubic-bezier(.19,1,.22,1)',
		adaptiveHeight: true
	});
	
}