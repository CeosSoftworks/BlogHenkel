/**
 * CEOS Select: Replaces the common selection element provided by the browser
 * with a fully customizable alternative. 
 *
 * Make sure to include the companion stylesheet, "ceos_select.css", in your
 * document.
 *
 * @author Jeferson Oliveira @ CEOS Softworks
 * @version 1.0
 * 
 * Copyright© 2015, CEOS Sofworks.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

function ceosSelect(target) {
	// For occasions when this is not actualy this :D
	var self = this;

	/**
	 * Holds the last element selected by the user.
	 */
	this.selectLast;

	/**
	 * Holds the selected HTML to be displayed to the user.
	 */
	var selectHTML; 

	/**
	 * Used to point which option is being highlighted. This is necessary to
	 * make navigation with the keyboard possible.
	 */
	var navItem = -1;

	/**
	 * If a string is provided as an argument, then use the string as a
	 * selector for the purpose of ending up with a HTMLSelectElement.
	 */
	if(typeof target == 'string') {
		target = document.querySelector(target);
	}

	/**
	 * We ought to have a HTMLSelectElement.
	 */
	if(!(target instanceof HTMLSelectElement)) {
		throw "Invalid target supplied.";
	}

	/**
	 * Keeps track if the select dropdown list is visible or not.
	 */
	this.open = false;

	/**
	 * This is the target HTMLSelectElement supplied to the procedure and its
	 * options.
	 */
	var target = target,
		targetChilds = Array.prototype.slice.call(target.childNodes);

	/**
	 * Here we create the elements that constitute the CEOS Select.
	 * The first element created is the main div, "select".
	 */
	this.select = document.createElement('div');

	/**
	 * This is element that will show the selected element on the list.
	 */
	this.selectDisplay = document.createElement('div');

	/**
	 * This will be the dropdown list that will hold the options.
	 */
	this.selectDropList = document.createElement('ul');

	/**
	 * The dropdown button that will be shown alongside with the display.
	 * It doesn't have much of a purpose other than looking good and showing to
	 * the user that the element he's seeing is a dropdown list.
	 */
	this.selectDropButton = document.createElement('button');

	/**
	 * This input will be used to emulate the behavior of and actual select,
	 * with its value being sent to the server on submission.
	 */
	this.selectInput = document.createElement('input');

	/**
	 * Will hold the select options.
	 */
	this.selectOptions = [];

	/**
	 * Setup the new select element with the former select ID, class name and
	 * tab index. If no tab index is given, we define the select element to be
	 * 0, so we can focus it like an actual select.
	 */
	this.select.id = target.id;
	this.select.className = target.className + ' ceos-select';
	this.select.title = target.title;
	this.select.tabIndex = target.tabIndex || 0;

	/**
	 * Setup the input as a hidden element, so the user doesn't see it, with the
	 * name of the former select element, so its value is sent to the server as
	 * if it was the actual select.
	 */
	this.selectInput.type = "hidden";
	this.selectInput.name = target.name;

	/**
	 * Setup the display element.
	 */
	this.selectDisplay.className = 'display';

	/**
	 * Setup the dropdown button
	 */
	this.selectDropButton.type = 'button';
	this.selectDropButton.className = 'dropbtn';
	this.selectDropButton.innerHTML = ceosSelect.prototype.ARROW_DOWN;

	/**
	 * Setup the dropdown list.
	 */
	this.selectDropList.className = 'droplist';

	/**
	 * Inserts the elements that constitute the CEOS select into the main select
	 * element.
	 */
	this.select.appendChild(this.selectInput);
	this.select.appendChild(this.selectDropButton);
	this.select.appendChild(this.selectDisplay);
	this.select.appendChild(this.selectDropList);

	/**
	 * Will be used to keep track of the actual index of the selected option.
	 */
	var optID = 0;

	/**
	 * Iterates through all the options from the old select element and creates
	 * a representation of each of them for the dropdown list of the new select.
	 */
	targetChilds.forEach(function(el, i, arr){
		if(el instanceof HTMLOptionElement) {
			var opt = document.createElement('li');

			opt.id = target.id + '-opt-' + optID++;
			opt.tabIndex = optID - 1;
			opt.className = 'droplist-opt';
			opt.setAttribute('data-value', el.value);
			opt.innerHTML = el.innerHTML;

			self.selectDropList.appendChild(opt);

			self.selectOptions.push(opt);

			/**
			 * Indicates which item is being highlighted by the user with his
			 * mouse. This is done so the user can start navigating the list
			 * with his keyboard from the item he was highlight with his mouse.
			 */
			 opt.addEventListener('mouseenter', function(e) {
			 	self.navItem = opt.tabIndex;

			 	self.highlightItem.call(self, self.navItem);
			 });

			/**
			 * Sets the selected value and HTML whenever the user clicks an
			 * option.
			 */
			opt.addEventListener('click', function(e) {
				e.stopPropagation();
				self.selectLast = opt;
				self.select.value = el.value;
				self.selectHTML = el.innerHTML;
			});

			/**
			 * Binds the itemSelect event to this element, so it can change the
			 * value of the select.
			 */
			opt.addEventListener('click', self.itemSelect.bind(self));
		}
	});

	/**
	 * Replace the former select with the new one.
	 */
	target.parentNode.replaceChild(this.select, target);

	/**
	 * We need a way to keep track of the height of the dropdown list, so we
	 * can animate it properly when the user clicks over the select element.
	 */
	this.selectDropList.height =
		this.selectDropList.getBoundingClientRect().height;

	/**
	 * Since, by default, the select comes with its dropdown list hidden, we
	 * make sure it has no height.
	 */
	this.selectDropList.style.height = 0;


	/**
	 * Binding of the click event.
	 */
	this.select.addEventListener('click', self.click.bind(this));

	/**
	 * Binding of the keydown event.
	 */
	this.select.addEventListener('keydown', function(e) {
		// On ENTER
		if(e.keyCode == 13) {
			self.selectLast = self.selectOptions[self.navItem];
			self.select.value = self.selectLast.getAttribute('data-value');
			self.selectHTML = self.selectLast.innerHTML;

			self.itemSelect.call(self, e);
		}

		// On ESCAPE
		if(e.keyCode == 27) {
			self.raiseList.call(self);
		}

		// On SPACEBAR
		if(e.keyCode == 32) {
			self.switch.call(self);
		}

		// On ARROW UP
		if(e.keyCode == 38) {
			self.navigateUp.call(self);
		}

		// On ARROW DOWN
		if(e.keyCode == 40) {
			if(!self.open){
				self.dropList.call(self);
			}

			self.navigateDown.call(self);
		}
	});

	/**
	 * Raise the dropdown list whenever the select loses focus.
	 */
	//this.select.addEventListener('blur', self.raiseList.bind(self));

	/**
	 * Pushes the current instance of ceosSelect into the pool. For more
	 * information why this is done, check the {@see ceosSelect.prototype.pool}
	 * documentation.
	 */
	ceosSelect.prototype.pool.push(self);
}

/**
 * Arrows shown in the dropdown button
 */

ceosSelect.prototype.ARROW_UP = "&#x25B4;";
ceosSelect.prototype.ARROW_DOWN = "&#x25BE;";

/**
 * It's necessary to store all instances of ceosSelect into an accessible
 * and static place, so we can keep track of which selects are available in the
 * document. This is done so we can hide all ceosSelects whenever the user
 * clicks over the document or clicks over another ceosSelect, for instance.
 */
ceosSelect.prototype.pool = [];


/**
 * Shows or hides the dropdown list of the ceosSelect that the client clicked
 * over.
 */
ceosSelect.prototype.click = function(e) {
	e.stopPropagation();

	if(e.button == 0) {
		this.switch();
	}
}

ceosSelect.prototype.switch = function() {
	if(this.open) {
		this.raiseList();
	} else {
		this.dropList();
	}
}

/**
 * Change the ceosSelect value whenever the user clicks over an option within
 * the dropdown list.
 *
 * @param MouseEvent The mouse event instance sent by the client.
 */
ceosSelect.prototype.itemSelect = function(e) {
	e.stopPropagation();

	var self = this,
		target = this.selectLast;

	/**
	 * Change the value of the input and the inner content of the select display
	 */
	this.selectInput.setAttribute('value', this.select.value);
	this.selectDisplay.innerHTML = this.selectHTML;

	/**
	 * Blinking animation
	 */
	var animSwitch = false;
	var animInterval = setInterval(function() {
		if(animSwitch = !animSwitch) {
			target.classList.add('blink-off');
			target.classList.remove('blink-on');
		} else {
			target.classList.add('blink-on');
			target.classList.remove('blink-off');
		}
	}, 80);

	/**
	 * Stops the blinking animation and raises the list
	 */
	setTimeout(function() {
		clearInterval(animInterval);

		target.classList.remove('blink-on');
		target.classList.remove('blink-off');
		
		self.raiseList();
	}, 300);
}

/**
 * Highlights the previous option in the dropdown list.
 */
ceosSelect.prototype.navigateUp = function() {
	if(this.navItem > 0) {
		this.navItem--;
	}
	this.highlightItem.call(this, this.navItem);
}

/**
 * Highlights the next option in the dropdown list.
 */
ceosSelect.prototype.navigateDown = function() {
	if(this.navItem < this.selectOptions.length - 1) {
		this.navItem++;
	}
	this.highlightItem.call(this, this.navItem);
}

/**
 * Highlights the given option of the dropdown list.
 */
ceosSelect.prototype.highlightItem = function(index) {
	this.clearHighlight.call(this);
	this.selectOptions[index].classList.add('highlight');
}

/**
 * Unhighlights all options of the dropdown list.
 */
ceosSelect.prototype.clearHighlight = function() {
	this.selectOptions.forEach(function(el, i, arr){
		if(el.classList.contains('highlight')) {
			el.classList.remove('highlight');
		}
	});
}

/**
 * Shows the dropdown list of the ceosSelect instance.
 */
ceosSelect.prototype.dropList = function() {
	this.navItem = -1;
	this.clearHighlight.call(this);

	this.open = true;
	this.select.setAttribute('data-open', 'true');
	this.selectDropList.style.height =
		this.selectDropList.height + 'px';

	this.selectDropButton.innerHTML = ceosSelect.prototype.ARROW_UP;
}

/**
 * Hides the dropdown list of the ceosSelect instance.
 */
ceosSelect.prototype.raiseList = function() {
	this.open = false;
	this.select.removeAttribute('data-open');
	this.selectDropList.style.height = 0;

	this.selectDropButton.innerHTML = ceosSelect.prototype.ARROW_DOWN;
};

/**
 * Initialization procedures.
 */
(function init() {
	/**
	 * Replaces the 'select' elements within the document with an instance of
	 * ceosSelect. Have in mind that every select element will be replaced.
	 * If such behavior is not desired, disable this event and invoke the
	 * constructor passing the elements that you want to be converted.
	 */
	document.addEventListener('DOMContentLoaded', function () {
		var selects = document.querySelectorAll('select');
		var selectsArr = Array.prototype.slice.call(selects);

		selectsArr.forEach(function(el, i, arr) {
			new ceosSelect(el);
		});
	});

	/**
	 * Emulates the behavior or an actual select, hiding the dropdown list of
	 * all ceosSelect instances whenever the user clicks over the document.
	 */
	document.addEventListener('click', function() {
		ceosSelect.prototype.pool.forEach(function(el, i, arr) {
			if(el.open) {
				el.raiseList();
			}
		});
	});
})();