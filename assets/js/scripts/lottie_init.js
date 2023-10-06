import lottie from 'lottie-web';

export function lottie_init() {
	const lottieContainer = document.getElementById('lottieanimation'); // haal het DOM-element op

	lottie.loadAnimation({
		container: lottieContainer, // het DOM-element dat de animatie zal bevatten
		renderer: 'svg',
		loop: true,
		autoplay: true,
		path: '/wp-content/themes/kdv/assets/lottie/composition.json' // het pad naar de animatie json
	});
}