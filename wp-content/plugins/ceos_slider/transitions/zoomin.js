CEOS.Slider.Transitions.ZoomIn = new CEOS.Slider.Transition({
	title: "Zoom in",
	
	init: function(el, dur, sender) {
		new CEOS.Slider.Animation(
			'ceos-trans-zoom-in',
			[CEOS.Slider.getVendorCSSPrefix() + 'transform: scale(0)'],
			[CEOS.Slider.getVendorCSSPrefix() + 'transform: scale(1)']
		);
		
		new CEOS.Slider.Animation(
			'ceos-trans-zoom-hide',
			null,
			['opacity: 0']
		);
	},

	transitionIn: function(el, dur, sender) {
		el.style.zIndex = 1;
		el.style.display = 'block';
		el.style[CEOS.Slider.getVendorStylePrefix() + 'Animation'] =
			'ceos-trans-zoom-in ' + dur / 1000 + 's ease 0s 1 normal both running';
	},
	
	transitionOut: function(el, dur, sender) {
		el.style.zIndex = 0;
		el.style[CEOS.Slider.getVendorStylePrefix() + 'Animation'] =
			'ceos-trans-zoom-hide 0s ease ' + dur / 1000 + 's 1 normal both running';
	}
});