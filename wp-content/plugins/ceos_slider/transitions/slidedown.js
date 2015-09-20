CEOS.Slider.Transitions.SlideDown = new CEOS.Slider.Transition({
	title: "Slide Down",
	
	init: function(el, dur, sender) {
		new CEOS.Slider.Animation(
			'ceos-trans-slidedown-in',
			[CEOS.Slider.getVendorCSSPrefix() + 'transform: translateY(-100%)'],
			[CEOS.Slider.getVendorCSSPrefix() + 'transform: translateY(0%)']
		);
		
		new CEOS.Slider.Animation(
			'ceos-trans-slidedown-hide',
			null,
			['opacity: 0']
		);
	},

	transitionIn: function(el, dur, sender) {
		el.style.zIndex = 1;
		el.style.display = 'block';
		el.style[CEOS.Slider.getVendorStylePrefix() + 'Animation'] =
			'ceos-trans-slidedown-in ' + dur / 1000 + 's ease 0s 1 normal both running';
	},
	
	transitionOut: function(el, dur, sender) {	
		el.style.zIndex = 0;
		el.style[CEOS.Slider.getVendorStylePrefix() + 'Animation'] =
			'ceos-trans-slidedown-hide 0s ease ' + dur / 1000 + 's 1 normal both running';
	}
});