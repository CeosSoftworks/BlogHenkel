var CEOS = CEOS || {};
	CEOS.Slider = CEOS.Slider || {};

CEOS.Slider.SliderItem = function ceosSliderItem(args) {
	this.element		= args.element;
	this.transition 	= CEOS.Slider.getTransition(args.transition);
	this.transDuration 	= args.transition_duration;
	this.interval 		= args.interval;
	this.parent			= args.parent;
}

CEOS.Slider.SliderItem.prototype.init = function () {
	var transition = this.transition
		? this.transition
		: this.parent.defTransition;

	var transDuration = this.transDuration
		? this.transDuration
		: this.parent.defTransDuration;

	if(transition) {
		transition.init(this.element, transDuration, this);
	}
}

CEOS.Slider.SliderItem.prototype.transitionIn = function () {
	var transition = this.transition
		? this.transition 
		: this.parent.defTransition;

	var transDuration = this.transDuration
		? this.transDuration
		: this.parent.defTransDuration;

	if(transition == 'none' || !transition) {
		this.element.style.display = 'block';
	} else {
		transition.transitionIn(this.element, transDuration, this);
	}
}

CEOS.Slider.SliderItem.prototype.transitionOut = function () {
	var transition = this.parent.items[this.parent.to].transition
		? this.parent.items[this.parent.to].transition 
		: this.parent.defTransition;

	var transDuration = this.parent.items[this.parent.to].transDuration
		? this.parent.items[this.parent.to].transDuration
		: this.parent.defTransDuration;

	if(transition == 'none' || !transition) {
		this.element.style.display = 'none';
	} else {
		transition.transitionOut(this.element, transDuration, this);
	}
}

CEOS.Slider.SliderItem.prototype.bindNavigationItem = function() {
	if(this.parent.optShowNavigation) {
		var self = this;
		var elList = this.parent.element.getElementsByClassName('nav-list')[0];
			
		elList = Array.prototype.slice.call(
				elList.getElementsByClassName('nav-item')
			);

		elList.forEach(function(item, i, arr) {
			if(item instanceof HTMLLIElement) {
				var elAnchor = item.getElementsByTagName('a')[0];

				if(elAnchor.getAttribute('data-goto') == i) {
					elAnchor.addEventListener('click', function() {
						self.parent.goTo(i);
						self.parent.pause();
					});
				}
			}
		})
	}
}