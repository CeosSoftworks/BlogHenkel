CEOS.Slider.Transitions.Crossfade = new CEOS.Slider.Transition({
	title: "Crossfade",
	
	init: function(el, dur, sender) {
		new CEOS.Slider.Animation(
			'ceos-trans-fade-in',
			['opacity: 0'],
			['opacity: 1']
		);
		
		new CEOS.Slider.Animation(
			'ceos-trans-fade-hide',
			['opacity: 1'],
			['opacity: 0']
		);
	},

	transitionIn: function(el, dur, sender) {
		el.style.zIndex = 1;
		el.style.display = 'block';
		el.style[CEOS.Slider.getVendorStylePrefix() + 'Animation'] =
			'ceos-trans-fade-in ' + dur / 1000 + 's ease 0s 1 normal both running';
	},
	
	transitionOut: function(el, dur, sender) {
		el.style.zIndex = 0;
		el.style[CEOS.Slider.getVendorStylePrefix() + 'Animation'] =
			'ceos-trans-fade-hide 0s ease ' + dur / 1000 + 's 1 normal both running';
	}
});