CEOS.Slider.Transitions.SlideBothUp = new CEOS.Slider.Transition({
	title: "Slide both up",
	
	init: function(el, dur, sender) {
		new CEOS.Slider.Animation(
			'ceos-trans-slide-both-up-in',
			[CEOS.Slider.getVendorCSSPrefix() + 'transform: translateY(100%)'],
			[CEOS.Slider.getVendorCSSPrefix() + 'transform: translateY(0%)']
		);
		
		new CEOS.Slider.Animation(
			'ceos-trans-slide-both-up-out',
			[CEOS.Slider.getVendorCSSPrefix() + 'transform: translateY(0%)'],
			[CEOS.Slider.getVendorCSSPrefix() + 'transform: translateY(-100%)']
		);
	},

	transitionIn: function(el, dur, sender) {
		el.style.zIndex = 1;
		el.style.display = 'block';
		el.style[CEOS.Slider.getVendorStylePrefix() + 'Animation'] =
			'ceos-trans-slide-both-up-in ' + dur / 1000 + 's ease 0s 1 normal both running';
	},
	
	transitionOut: function(el, dur, sender) {	
		el.style.zIndex = 0;
		el.style[CEOS.Slider.getVendorStylePrefix() + 'Animation'] =
			'ceos-trans-slide-both-up-out ' + dur / 1000 + 's ease 0s 1 normal both running';
	}
});