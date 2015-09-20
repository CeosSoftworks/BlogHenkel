var CEOS = CEOS || {};
	CEOS.Slider = CEOS.Slider || {};

CEOS.Slider.Animation = function ceosSliderAnimation(name, from, to) {
	function arrayToStr(arr) {
		var s = '';
		if(arr) {
			arr.forEach(function(el, i, arr){ s += el + '; ' });
		}
		return s;
	}

	var keyframesPrefix = 
		CEOS.Slider.getVendorStylePrefix() == 'WebKit' ? '-webkit-' : '';

	var str =
		'@' + keyframesPrefix + 'keyframes ' + name + ' {' +
			'from {' + arrayToStr(from) + '} ' +
			'to {' + arrayToStr(to) + '}' +
		'}';

	var node = document.createTextNode(str);

	CEOS.Slider.Animation.prototype.appendToStyle(node);
}

CEOS.Slider.Animation.prototype.appendToStyle = function(animation) {
	var style = document.getElementById("ceos-slider-anim-style");

	if(!style) {
		style = document.createElement('style');
		style.id = "ceos-slider-anim-style";

		document.getElementsByTagName('head')[0].appendChild(style);
	}

	style.appendChild(animation);
}
