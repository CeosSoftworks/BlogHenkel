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
		
		callbackUnset =
			(args.onUnset instanceof Function) ? args.onUnset : null,

		callbackOpen = 
			(args.onOpen instanceof Function) ? args.onOpen : null,
		
		callbackHeadersReceived = 
			(args.onHeadersReceived instanceof Function)
				? args.onHeadersReceived
				: null,
		
		callbackProgress = 
			(args.onProgress instanceof Function) ? args.onProgress : null,
		
		callbackComplete =
			(args.onComplete instanceof Function) ? args.onComplete : null,

		callbackSuccess = 
			(args.onSuccess instanceof Function) ? args.onSuccess : null,
		
		callbackError = 
			(args.onError instanceof Function) ? args.onError : null,
		
		callbackTimeout = 
			(args.onTimeOut instanceof Function) ? args.onTimeOut : null;

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
			case 0:
				if(callbackUnset) {
					callbackUnset.call(request);
				}
				break;

			case 1:
				if(callbackOpen) {
					callbackOpen.call(request);
				}
				break;
			
			case 2:
				if(callbackHeadersReceived) {
					callbackHeadersReceived.call(request);
				}
				break;
			
			case 3:
				if(callbackProgress) {
					callbackProgress.call(request);
				}
				break;
			
			case 4:
				if(callbackComplete) {
					callbackComplete.call(request);
				}

				if(request.status == 200 && callbackSuccess) {
					callbackSuccess.call(request);
				} else if(request.status != 200 && callbackError) {
					callbackError.call(request);
				}
		}
	}

	/**
	 * Serialize data object
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

	if(responseType) {
		request.setRequestHeader('Accept', responseType);
	}

	request.send(data);
}