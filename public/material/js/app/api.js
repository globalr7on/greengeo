class Api {
	constructor({...params}) {
		this.token = params?.token
		this.baseUrl = params?.baseUrl || '/api'
	}

	getApiHeaders(withContentType) {
		return {
			...{
				'Authorization': 'Bearer ' + this.token
			},
			...withContentType ? {
				'Content-Type': 'application/json',
			} : {}
		}
	}

	get(url) {
		return this.send(url, 'GET')
	}

	post(url, params = {}, isFormData = false) {
		return this.send(url, 'POST', params, isFormData)
	}

	put(url, params = {}, isFormData = false) {
		return this.send(url, 'PUT', params, isFormData)
	}

	delete(url) {
		return this.send(url, 'DELETE')
	}

	send(url, method = 'GET', params = {}, isFormData = false, showLoading = true, headers = null) {
		const fullURL = (this.baseUrl ? this.baseUrl : '') + url
		return new Promise(
			(resolve, reject) => {
				let data = isFormData
          ? params
          : Object.keys(params).length == 0
            ? null
            : method == 'GET'
              ? params
              : JSON.stringify(params)

				$.ajax({
          ...{
            url: fullURL,
            type: method,
            headers: this.getApiHeaders(!isFormData),
            data: data,
          }, ...isFormData ? {
            contentType: false,
            processData: false,
          } : {}
        })
				.done(function (response) {
				  resolve(response)
				})
				.fail(function (error) {
				  reject(error?.responseJSON)
				})
			}
		)
	}
}