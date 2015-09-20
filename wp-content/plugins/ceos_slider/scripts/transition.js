var CEOS = CEOS || {};
	CEOS.Slider = CEOS.Slider || {};
	CEOS.Slider.Transitions = CEOS.Slider.Transitions || {};

CEOS.Slider.Transition = function ceosSliderTransition(args) {
	this.title 			= args.title;
	this.init 			= args.init;
	this.transitionIn 	= args.transitionIn;
	this.transitionOut 	= args.transitionOut;
}