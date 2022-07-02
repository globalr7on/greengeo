class Api {
	constructor({...params}) {
		this.token = params?.token
		this.baseUrl = params?.baseUrl || '/api'
	// 	this.message = new Message();
	// 	this.usuarioModel = new UsuarioModel();
	}

	getApiHeaders() {
		return {
			'Content-Type': 'application/json',
			'Authorization': 'Bearer ' + this.token
		};
	}
	// getApiHeadersPrivate() {
	// 	return {
	// 		'Content-Type': 'application/json',
	// 		'Authorization': 'Bearer ' + this.usuarioModel.token
	// 	};
	// }

	// getApiHeadersRefreshToken() {
	// 	return {
	// 		'Content-Type': 'application/json'
	// 	};
	// }

	get(url) {
		return this.send(url, 'GET');
	}

	post(url, params = {}) {
		return this.send(url, 'POST', params);
	}

	put(url, params = {}) {
		return this.send(url, 'PUT', params);
	}

	delete(url) {
		return this.send(url, 'DELETE');
	}

	send(url, method = 'GET', params = {}, showLoading = true, headers = null) {
		const fullURL = (this.baseUrl ? this.baseUrl : '') + url
		return new Promise(
			(resolve, reject) => {
				let data = Object.keys(params).length == 0
				? null
				: method == 'GET'
					? params
					: JSON.stringify(params)
				// let self = this
				// let retorno
				 // let allHeaders = headers ? headers : this.getApiHeaders()
				// allHeaders = {
				//   ...allHeaders,
				//   ...{
				//     Authorization: 'Bearer '
				//   }
				// }

        $.ajax({
          url: fullURL,
          method: method,
		  //   headers: headers ? headers : this.getApiHeaders(),
          headers: this.getApiHeaders(),
          data: data
          // beforeSend: function () {
          //   if (showLoading) {
          //     self.message.loadingShow('Por favor, aguarde...');
          //   }
          // }
        })
        .done(function (response) {
          // retorno = response;
          // if (showLoading) {
          //   self.message.loadingHide();
          // }
          resolve(response)
        })
        .fail(function (error) {
          // if (showLoading) {
          //   self.message.loadingHide();
          // }
          // setTimeout(function () {
          //   self.onResponseError(error);
          // }, 200);
          reject(error?.responseJSON)
        })
        // .always(function () {
        //   resolve(retorno)
        // })
			}
		)
	}

	/**
	 * Verifica se o token está próximo de expirar.
	 * Caso esteja então renova-o.
	 */
	// checkToken() {
	// 	return new Promise(
	// 		resolve => {
	// 			this.usuarioModel = new UsuarioModel();

	// 			if (this.usuarioModel.isTokenNearToExpire()) {
	// 				this.refreshToken()
	// 					.then(() => {
	// 						resolve();
	// 					});
	// 			} else {
	// 				resolve();
	// 			}
	// 		}
	// 	);
	// }

	// refreshToken() {
	// 	return new Promise(
	// 		resolve => {
	// 			let headers = this.getApiHeadersRefreshToken();
	// 			let params_refresh = {
	// 				token: this.usuarioModel.token,
	// 				refresh_token: this.usuarioModel.refresh_token
	// 			};
	// 			let self = this;

	// 			$.ajax({
	// 					url: urlApi + '/auth/refresh',
	// 					method: 'POST',
	// 					headers: headers,
	// 					data: JSON.stringify(params_refresh),
	// 					beforeSend: function () {
	// 						self.message.loadingShow('Por favor, aguarde...');
	// 					}
	// 				})
	// 				.done(function (response) {
	// 					try {
	// 						console.log(response);

	// 						if (response.code != 200) {
	// 							throw 'Falha ao renovar a sessão';
	// 						}

	// 						// token renovado
	// 						let usuarioModel = new UsuarioModel();
	// 						usuarioModel.save(
	// 							response.data.usuario.nome,
	// 							response.data.usuario.token,
	// 							response.data.usuario.refresh_token,
	// 							response.data.usuario.expira_em
	// 						);
	// 						// atualiza o objeto usuarioModel da classe
	// 						self.usuarioModel = usuarioModel;
	// 						console.log(usuarioModel);

	// 						resolve();
	// 					} catch (error) {
	// 						Swal.fire(
	// 								'Realize o login novamente',
	// 								'Sua sessão expirou e não foi possível renová-la automaticamente',
	// 								'error'
	// 							)
	// 							.then(() => {
	// 								window.location = '/login';
	// 							});
	// 					}
	// 				})
	// 				.fail(function () {
	// 					Swal.fire(
	// 							'Realize o login novamente',
	// 							"Sua sessão expirou e não foi possível renová-la automaticamente",
	// 							'error'
	// 						)
	// 						.then(() => {
	// 							window.location = '/login';
	// 						});
	// 				})
	// 				.always(function () {
	// 					self.message.loadingHide();
	// 				});
	// 		}
	// 	);
	// }

	// onResponseError(response) {
	// 	response = response ? response.responseJSON : response.responseText;

	// 	if (response.code != 401) {
	// 		this.showError('Falha ao realizar a operação', response);
	// 	} else {
	// 		let fnClicarEmOk = function () {
	// 			appCconet.route.redirect('login/logout');
	// 		};

	// 		this.message.alert(
	// 			'Realize o login novamente',
	// 			'Sua sessão expirou e não foi possível renová-la automaticamente',
	// 			fnClicarEmOk
	// 		);
	// 	}
	// }

	// showError(title, error) {
	// 	let msg = 'Caso o erro persista entre em contato com o suporte';
	// 	if (error.responseJSON && responseJSON.error.message) {
	// 		msg = error.message;
	// 	} else if (error.message) {
	// 		msg = error.message;
	// 	}

	// 	this.message.error(title, msg);
	// }
}