function ajaxRequest(args) {
	var own = this,
		request,

		method = 			args.method.toUpperCase(),
		timeout =			args.timeout || 0,
		withCredentials = 	args.withCredentials || false,
		url =				args.url,
		data =				args.data || null,
		contentType =		args.contentType || 'text/plain',
		responseType =		args.responseType,
		
		callbackUnset = 	args.onUnset,
		callbackOpen = 		args.onOpen,
		callbackSent = 		args.onSent,
		callbackProgress = 	args.onProgress,
		callbackSuccess = 	args.onSuccess,
		callbackError = 	args.onError,
		callbackTimeout = 	args.onTimeOut;

	/**
	 * Verifies is the shorthand for a form submission was given
	 */

	contentType = (contentType == 'form')
		? 'application/x-www-form-urlencoded'
		: contentType;

	/**
	 * A valid request method must be supplied
	 */

	if(!method == 'GET' && method == 'POST') {
		throw "Invalid AJAX request method given";
	}

	/**
	 * Creates request object
	 */

	request = new XMLHttpRequest();
	request.onreadystatechange = function() {
		switch(request.readyState){
			case 1:
				break;
			case 2:
				break;
			case 3:
				break;
			case 4:
				console.log(request.responseText);
		}
	}

	/**
	 * Convert data object to string
	 */

	if( typeof data == 'object' &&
		(contentType == 'application/x-www-form-urlencoded' || method == 'GET')) {
	
		var encodedProperties = [];

		for(var key in data) {
			encodedProperties.push(key + '=' + data[key]);
		}

		if(method == 'GET') {
			url += '?' + encodedProperties.join('&');
			data = null;
		} else {
			data = encodedProperties.join('&');
		}
	}

	request.open(method, url, true);

	request.setRequestHeader('Content-Type', contentType);
	
	request.send(data);
}