CEOS.Slider.Transitions.SlideBothDownDelay = new CEOS.Slider.Transition({
	title: "Slide both down with delay",
	
	init: function(el, dur, sender) {
		new CEOS.Slider.Animation(
			'ceos-trans-slide-both-down-delay-in',
			[CEOS.Slider.getVendorCSSPrefix() + 'transform: translateY(-100%)'],
			[CEOS.Slider.getVendorCSSPrefix() + 'transform: translateY(0%)']
		);
		
		new CEOS.Slider.Animation(
			'ceos-trans-slide-both-down-delay-out',
			[CEOS.Slider.getVendorCSSPrefix() + 'transform: translateY(0%)'],
			[CEOS.Slider.getVendorCSSPrefix() + 'transform: translateY(100%)']
		);
	},

	transitionIn: function(el, dur, sender) {
		el.style.zIndex = 1;
		el.style.display = 'block';
		el.style[CEOS.Slider.getVendorStylePrefix() + 'Animation'] =
			'ceos-trans-slide-both-down-delay-in ' + dur / 1000 + 's ease 0s 1 normal both running';
	},
	
	transitionOut: function(el, dur, sender) {	
		el.style.zIndex = 0;
		el.style[CEOS.Slider.getVendorStylePrefix() + 'Animation'] =
			'ceos-trans-slide-both-down-delay-out ' + dur / 1000 + 's ease-in 0s 1 normal both running';
	}
});