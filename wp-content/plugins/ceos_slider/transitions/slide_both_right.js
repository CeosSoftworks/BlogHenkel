CEOS.Slider.Transitions.SlideBothRight = new CEOS.Slider.Transition({
	title: "Slide both right",
	
	init: function(el, dur, sender) {
		new CEOS.Slider.Animation(
			'ceos-trans-slide-both-right-in',
			[CEOS.Slider.getVendorCSSPrefix() + 'transform: translateX(-100%)'],
			[CEOS.Slider.getVendorCSSPrefix() + 'transform: translateX(0%)']
		);
		
		new CEOS.Slider.Animation(
			'ceos-trans-slide-both-right-out',
			[CEOS.Slider.getVendorCSSPrefix() + 'transform: translateX(0%)'],
			[CEOS.Slider.getVendorCSSPrefix() + 'transform: translateX(100%)']
		);
	},

	transitionIn: function(el, dur, sender) {
		el.style.zIndex = 1;
		el.style.display = 'block';
		el.style[CEOS.Slider.getVendorStylePrefix() + 'Animation'] =
			'ceos-trans-slide-both-right-in ' + dur / 1000 + 's ease 0s 1 normal both running';
	},
	
	transitionOut: function(el, dur, sender) {	
		el.style.zIndex = 0;
		el.style[CEOS.Slider.getVendorStylePrefix() + 'Animation'] =
			'ceos-trans-slide-both-right-out ' + dur / 1000 + 's ease 0s 1 normal both running';
	}
});