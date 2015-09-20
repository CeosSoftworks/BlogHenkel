CEOS.Slider.Transitions.ZoomOut = new CEOS.Slider.Transition({
	title: "Zoom out",
	
	init: function(el, dur, sender) {
		new CEOS.Slider.Animation(
			'ceos-trans-zoom-out',
			[
				CEOS.Slider.getVendorCSSPrefix() + 'transform: scale(2)',
				'opacity: 0'
			],
			[
				CEOS.Slider.getVendorCSSPrefix() + 'transform: scale(1)',
				'opacity: 1'
			]
		);
		
		new CEOS.Slider.Animation(
			'ceos-trans-zoom-out-hide',
			null,
			['opacity: 0']
		);
	},

	transitionIn: function(el, dur, sender) {
		el.style.zIndex = 1;
		el.style.display = 'block';
		el.style[CEOS.Slider.getVendorStylePrefix() + 'Animation'] =
			'ceos-trans-zoom-out ' + dur / 1000 + 's ease 0s 1 normal both running';
	},
	
	transitionOut: function(el, dur, sender) {
		el.style.zIndex = 0;
		el.style[CEOS.Slider.getVendorStylePrefix() + 'Animation'] =
			'ceos-trans-zoom-out-hide 0s ease ' + dur / 1000 + 's 1 normal both running';
	}
});