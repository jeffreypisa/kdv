import $ from "jquery";
import bootstrap from 'bootstrap/dist/js/bootstrap.bundle';

// Init plugins
import { slick_init } from './scripts/slick.js';
import { matchheight_init } from './scripts/matchheight_init.js';
import { animejs } from './scripts/anime.js';
import { lity_init } from './scripts/lity_init.js';
import { rellax_init } from './scripts/rellax_init.js';
import { lottie_init } from './scripts/lottie_init.js';

// Scripts
import { site_is_loaded } from './scripts/site_is_loaded.js';
import { footer_down } from './scripts/footer_down.js';
import { mobilemenu } from './scripts/mobilemenu.js';
import { sticky_header } from './scripts/sticky_header.js';
import { scrollto } from './scripts/scrollto.js';
import { themas } from './scripts/themas.js';
import { ubncheck } from './scripts/ubncheck.js';


lity_init();
rellax_init();
lottie_init();

$( document ).ready(function() {
	footer_down();
	mobilemenu();
	slick_init();
	scrollto();
	sticky_header();
	themas();
	ubncheck();
	
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	  return new bootstrap.Tooltip(tooltipTriggerEl)
	});
	
	var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
	var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
	  return new bootstrap.Popover(popoverTriggerEl)
	});
	
	var triggerTabList = [].slice.call(document.querySelectorAll('#pills button'))
	triggerTabList.forEach(function (triggerEl) {
	  var tabTrigger = new bootstrap.Tab(triggerEl)
	
	  triggerEl.addEventListener('click', function (event) {
		event.preventDefault()
		tabTrigger.show()
	  })
	})
	
	// bootnavslec
	$('.js-selecttabtoggle').on('change', function () {
		
	 var triggerEl = document.querySelector('#pills button[data-bs-target="' + this.value + '"]')
	 bootstrap.Tab.getInstance(triggerEl).show() // Select tab by name
	});
	
	
		
});

$(window).on('load', function() {
	matchheight_init();
	animejs();
	site_is_loaded();
});