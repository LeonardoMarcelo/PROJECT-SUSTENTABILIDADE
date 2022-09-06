$(document).ready(function () {
	//Login

	$('body').on('click', "#btn_login", function (e) {
		e.preventDefault();

		var form = $("#form_login");
		var form_data = form.serialize();
		var url = "Ajax/Login/Login.php";


		$.ajax({
			url: url,
			type: 'POST',
			data: form_data,
			dataType: 'JSON',

			success: function (data, textStatus, jqXHR) {
				if (data['status'] == 'success') {
					$(".result").text('');
					$(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-check-circle"></span>' + data['message'] + '</div></div></div>');
					$("#form_login")[0].reset();


				} else if (data['status'] == 'info') {
					$(".result").text('');
					$(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-info-circle"></span>' + data['message'] + '</div></div></div>');
					$("#form_login")[0].reset();
				} else if (data['status'] == 'warning') {
					$(".result").text('');
					$(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-exclamation-triangle"></span>' + data['message'] + '</div></div></div>');
					$("#form_login")[0].reset();
				} else {
					$(".result").text('');
					$(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-times-circle"></span>' + data['message'] + '</div></div></div>');
					$("#form_login")[0].reset();
				}

				setTimeout(function () {
					$("#status-container").hide();
					if (data['redirect'] != '') {
						window.location.href = data['redirect'];
					}
				}, 3000);

			}
		});
	});

	//Logout
	$('body').on('click', "#logout", function (e) {
		e.preventDefault();

		var form_data = $('a').attr('id');
		var data = 'action=logout';
		var url = "../Ajax/Login/Logout.php";


		$.ajax({
			url: url,
			type: 'GET',
			data: data,
			dataType: 'JSON',

			success: function (data, textStatus, jqXHR) {
				if (data['status'] == 'success') {
					$(".result").text('');
					$(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-check-circle"></span>' + data['message'] + '</div></div></div>');
				


				} else if (data['status'] == 'info') {
					$(".result").text('');
					$(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-info-circle"></span>' + data['message'] + '</div></div></div>');
				
				} else if (data['status'] == 'warning') {
					$(".result").text('');
					$(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-exclamation-triangle"></span>' + data['message'] + '</div></div></div>');
				
				} else {
					$(".result").text('');
					$(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-times-circle"></span>' + data['message'] + '</div></div></div>');
				
				}

				setTimeout(function () {
					$("#status-container").hide();
					if (data['redirect'] != '') {
						window.location.href = data['redirect'];
					}
				}, 3000);

			}
		});
	});
	//Recuperação de Senha

	$('body').on('click', "#btn_password", function (e) {
		e.preventDefault();

		var form = $("#form_password");
		var form_data = form.serialize();
		var url = "Ajax/Login/Recovery.php";


		$.ajax({
			url: url,
			type: 'POST',
			data: form_data,
			dataType: 'JSON',

			success: function (data, textStatus, jqXHR) {
				if (data['status'] == 'success') {
					$(".result").text('');
					$(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-check-circle"></span>' + data['message'] + '</div></div></div>');
					 


				} else if (data['status'] == 'info') {
					$(".result").text('');
					$(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-info-circle"></span>' + data['message'] + '</div></div></div>');
					 
				} else if (data['status'] == 'warning') {
					$(".result").text('');
					$(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-exclamation-triangle"></span>' + data['message'] + '</div></div></div>');
					 
				} else {
					$(".result").text('');
					$(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-times-circle"></span>' + data['message'] + '</div></div></div>');
					 
				}

				setTimeout(function () {
					$("#status-container").hide();
					if (data['redirect'] != '') {
						window.location.href = data['redirect'];
					}
				}, 3000);

			}
		});
	});
	//Nova Senha
	$('body').on('click', "#btn_new_password", function (e) {
		e.preventDefault();

		var form = $("#form_new_password");
		var form_data = form.serialize();
		var url = "Ajax/Login/New-Password.php";


		$.ajax({
			url: url,
			type: 'POST',
			data: form_data,
			dataType: 'JSON',

			success: function (data, textStatus, jqXHR) {
				if (data['status'] == 'success') {
					$(".result").text('');
					$(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-check-circle"></span>' + data['message'] + '</div></div></div>');
					 


				} else if (data['status'] == 'info') {
					$(".result").text('');
					$(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-info-circle"></span>' + data['message'] + '</div></div></div>');
					 
				} else if (data['status'] == 'warning') {
					$(".result").text('');
					$(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-exclamation-triangle"></span>' + data['message'] + '</div></div></div>');
					 
				} else {
					$(".result").text('');
					$(".result").prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class="status-message"><span class="fa fa-times-circle"></span>' + data['message'] + '</div></div></div>');
					 
				}

				setTimeout(function () {
					$("#status-container").hide();
					if (data['redirect'] != '') {
						window.location.href = data['redirect'];
					}
				}, 3000);

			}
		});
	});
});
