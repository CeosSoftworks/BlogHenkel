var CEOS = CEOS || {};
	CEOS.Slider = CEOS.Slider || {};

CEOS.Slider.getTransition = function (transitionName) {
	for(var name in CEOS.Slider.Transitions) {
		if(name == transitionName) {
			return CEOS.Slider.Transitions[name];
		}
	}
}

CEOS.Slider.getVendorCSSPrefix = function() {
	return '-' + CEOS.Slider.getVendorStylePrefix().toLowerCase() + '-';
}
CEOS.Slider.getVendorStylePrefix = function () {
	var engines = {
		webkit	: 'WebKit',
		gecko	: 'Moz',
		opera	: 'O',
		trident	: 'ms'
	};

	var userAgent 		= navigator.userAgent;
	var currentEngine 	= null;

	for(var engine in engines) {
		if((new RegExp(engine, 'i')).test(userAgent)) {
			currentEngine = engines[engine];
			break;
		}
	};

	return currentEngine || '';
}

CEOS.Slider.getVendorAnimationPrefix = function() {
	var prefix = CEOS.Slider.getVendorStylePrefix();

	switch(prefix) {
		case 'Moz':
		case 'O': return prefix.toLowerCase(); break;
		default: return prefix;
	}
}

CEOS.Slider.getVendorTransitionPrefix = function() {
	var prefix = CEOS.Slider.getVendorStylePrefix();

	switch(prefix) {
		case 'Moz': return ''; break;
		case 'O' : return prefix.toLowerCase(); break;
		default: return prefix;
	}
}