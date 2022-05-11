import $ from "jquery";
import MatchHeight from 'matchheight';

export function themas() {
	$('.mod-themas .tabs button').click(function() {
		$('.card-term').removeClass('show');
		$('.dot').removeClass('active');
		$('.card-term[data-index=1]').addClass('show');
		$('.dot[data-index=1]').addClass('active');
	});

	$('.js-showproject').click(function() {
		var thanumba = $(this).attr('data-index');
		$('.card-term').removeClass('show');
		$('.dot').removeClass('active');
		$('.card-term[data-index=' + thanumba + ']').addClass('show');
		$('.dot[data-index=' + thanumba + ']').addClass('active');
	});
	
	$('.js-laadmeer').click(function() {
		var currentItems = $('.hider').length;
		var newItems = currentItems + 6;
		
		$('.hider').removeClass('show');
		$(".hider").slice(0,newItems).addClass('show');
		
		MatchHeight.init();
		
		var allItems = $('.tease').length;
		if (currentItems === allItems) {
			$('.js-laadmeer').remove();
		}
	});
}