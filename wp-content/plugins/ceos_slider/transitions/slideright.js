CEOS.Slider.Transitions.SlideRight = new CEOS.Slider.Transition({
	title: "Slide right",
	
	init: function(el, dur, sender) {
		new CEOS.Slider.Animation(
			'ceos-trans-slideright-in',
			[CEOS.Slider.getVendorCSSPrefix() + 'transform: translateX(-100%)'],
			[CEOS.Slider.getVendorCSSPrefix() + 'transform: translateX(0%)']
		);
		
		new CEOS.Slider.Animation(
			'ceos-trans-slideright-hide',
			null,
			['opacity: 0']
		);
	},

	transitionIn: function(el, dur, sender) {
		el.style.zIndex = 1;
		el.style.display = 'block';
		el.style[CEOS.Slider.getVendorStylePrefix() + 'Animation'] =
			'ceos-trans-slideright-in ' + dur / 1000 + 's ease 0s 1 normal both running';
	},
	
	transitionOut: function(el, dur, sender) {
		el.style.zIndex = 0;
		el.style[CEOS.Slider.getVendorStylePrefix() + 'Animation'] =
			'ceos-trans-slideright-hide 0s ease ' + dur / 1000 + 's 1 normal both running';
	}
});