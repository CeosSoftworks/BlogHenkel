var CEOS = CEOS || {};
	CEOS.Slider = CEOS.Slider || {};

/**
 * Page load event
 */

CEOS.Slider.onLoad = function () {
	document.getElementById('slide-add')
		.addEventListener('click', CEOS.Slider.addSliderForm);

	document.addEventListener('mousemove', CEOS.Slider.monitorMouseMovement);

	document.getElementById('opt-max-width').addEventListener('change',
		CEOS.Slider.calculateProportions.bind(this, 'width'));
	
	document.getElementById('opt-max-height').addEventListener('change', 
		CEOS.Slider.calculateProportions.bind(this, 'height'));

	document.getElementById('opt-aspect-ratio').addEventListener('change', 
		CEOS.Slider.calculateProportions.bind(this, 'ratio'));

	window.addEventListener('resize',
		CEOS.Slider.calculateProportions.bind(this, 'ratio'));

	CEOS.Slider.calculateProportions.bind(this, 'ratio')
}

document.addEventListener('DOMContentLoaded', CEOS.Slider.onLoad);

/**
 * Form submit click event
 */

document.getElementById('send-form').addEventListener('click', function (e) {
	var form = document.getElementById('create-slider-form');
	var sliderItems = document.getElementById('slider-content');
	var title = document.getElementById('title');
	var optTransition = document.getElementById('opt-transition');
	var error = false;
	
	if(title.length == 0) {
		error = true;
		e.preventDefault();
		title.style.backgroundColor = '#FFD3D3';
	} else {
		title.style.backgroundColor = 'white';
	}

	if(!optTransition.options[optTransition.selectedIndex]
		|| optTransition.options[optTransition.selectedIndex].value.length == 0)
	{	
		error = true;
		e.preventDefault();
		optTransition.style.backgroundColor = '#FFD3D3';
	} else {
		title.style.backgroundColor = 'white';
	}

	if(sliderItems.childNodes.length == 0) {
		error = true;
		e.preventDefault();
	} else {
		for(var i = 0; i < sliderItems.childNodes.length; i++) {

			var sldItem = document.getElementsByClassName('slider-item')[i];
			var sldItemImg = sldItem.getElementsByClassName('slider-item-img')[0];
			var sldItemSrc = sldItem.getElementsByClassName('slider-file-input')[0];

			if(sldItemSrc.value.length == 0
				&& !sldItemSrc.getAttribute('nocheck')) {
				error = true;
				e.preventDefault();
				sldItemImg.style.borderColor = '#FFD3D3';
				sldItemImg.style.boxShadow = '0 0 10px #FFD3D3';
			} else {
				sldItemImg.style.borderColor = '#CCC';
				sldItemImg.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.2)';
			}
		}
	}

	if(error) {
		alert(translations.invalid_form_data);
	}
})

/**
 * Calculate the slider items proportion and preview them on the slider
 * thumbnails
 */

CEOS.Slider.calculateProportions = function (propChanged) {
	var elHeight = document.getElementById('opt-max-height');
	var elWidth = document.getElementById('opt-max-width');
	var elRatio = document.getElementById('opt-aspect-ratio');

	switch(propChanged) {
		case 'width':
		case 'height':
			elRatio.value = (elHeight.value / elWidth.value).toFixed(4);
			break;
		case 'ratio':
			elHeight.value = Math.round(elWidth.value * elRatio.value);
			break;
	}

	var imgs = document.getElementsByClassName('slider-item-img');

	Array.prototype.slice.call(imgs).forEach(function (el, i, arr){
		var rect = el.getBoundingClientRect();
		var height = rect.width * elRatio.value;

		el.style.paddingTop = height + 'px';
	})
}