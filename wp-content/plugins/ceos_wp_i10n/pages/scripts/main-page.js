var CEOS = CEOS || {};
	CEOS.WPi10n = CEOS.WPi10n || {};

CEOS.WPi10n.getLanguages = function() {}

CEOS.WPi10n.addNewLanguage = function() {

	var elLi = document.createElement('li');
		elLi.className = 'add-lang';

	var elLiInner = document.createElement('li');
		elLiInner.id = 'content';
		elLiInner.className = 'inner table';

	var elRowEnglish = document.createElement('div');
		elRowEnglish.className = 'row';
		elRowEnglish.innerHTML =
			'<span class="cell label-wrap">' +
				'<label for="eng-name">English name</label>' +
			'</span>' +
			'<span class="cell input-wrap" style="width:70%">' +
				'<input type="text" id="eng-name" name="eng-name" maxlength="255">' +
			'</span>';

	var elRowLocal = document.createElement('div');
		elRowLocal.className = 'row';
		elRowLocal.innerHTML =
			'<span class="cell label-wrap">' +
				'<label for="local-name">Local name</label>' +
			'</span>' +
			'<span class="cell input-wrap" style="width:70%">' +
				'<input type="text" id="local-name" name="local-name" maxlength="255">' +
			'</span>';

	var elRowCode = document.createElement('div');
		elRowCode.className = 'row';
		elRowCode.innerHTML =
			'<span class="cell label-wrap">' +
				'<label for="short-code">Short code</label>' +
			'</span>' +
			'<span class="cell input-wrap" style="width:70%">' +
				'<input type="text" id="short-code" name="short-code" maxlength="5">' +
			'</span>';

	var elControls = document.createElement('div');
		elControls.className = 'controls';
		elControls.innerHTML =
			'<div class="add-new-controls">' +
				'<input type="button" value="Cancel" class="button button-secondary">' +
				'<input type="button" value="Save" class="button button-primary">' +
			'</div>';

	elLi.appendChild(elLiInner);

	elLiInner.appendChild(elRowEnglish);
	elLiInner.appendChild(elRowLocal);
	elLiInner.appendChild(elRowCode);

	elLi.appendChild(elControls);

	var langsList = document.getElementById('langs-list');

	/**
	 * Remove the empty list notice
	 */
	
	Array.prototype.slice.call(langsList.childNodes).forEach(function(el, i, arr){
		if(arr[i].className == 'empty') {
			arr[i].remove();
		}
	});

	/**
	 * Save button event
	 */
	
	elControls.getElementsByClassName('button-primary')[0]
		.addEventListener('click', function(){
		ajaxRequest({
			method: 'post',
			url: pluginPathURL + '/services/add-language.php',
			contentType: 'form',
			responseType: 'application/json',
			data: {
				nonce: nonce,
				englishName: document.getElementById('eng-name').value,
				localName: document.getElementById('local-name').value,
				code: document.getElementById('short-code').value
			},
			onSuccess: function() {
				location.reload();
			},
			onError: function() {
				alert(
					'Error ' + this.status + '\n' +
					this.getResponseHeader('service-details'));
				console.log(this);
			}
		});
	});

	/**
	 * Cancel button event
	 */
	
	elControls.getElementsByClassName('button-secondary')[0]
		.addEventListener('click', function(){
		elLi.remove();	
	});

	langsList.appendChild(elLi);
}

CEOS.WPi10n.removeLanguage = function() {}

CEOS.WPi10n.editLanguage = function() {}

CEOS.WPi10n.saveSettings = function() {};

CEOS.WPi10n.init = function() {
	document.getElementById('add-lang-link')
		.addEventListener('click', CEOS.WPi10n.addNewLanguage);
}();