import Rellax from 'rellax';

export function rellax_init() {
	var rellax = new Rellax('.rellax', {
		speed: -2,
		center: false,
		wrapper: null,
		round: true,
		vertical: true,
		horizontal: false
	});
}