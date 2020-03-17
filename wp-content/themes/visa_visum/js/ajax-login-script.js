jQuery(document).ready(function($) {
	$('#mlogin').on('click','.submit', function(e){
		$('form#mlogin p.status').show().text(ajax_login_object.loadingmessage);
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: ajax_login_object.ajaxurl,
			data: {
			'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
			'username': $('form#mlogin #username').val(),
			'password': $('form#mlogin #password').val(),
			'security': $('form#mlogin #security').val() },
			success: function(data){
				if (data.loggedin == true){
					$('form#mlogin p.status').addClass('sucess').text(data.message);
				}else{
					$('form#mlogin p.status').addClass('fail').text(data.message);
				}
				if (data.loggedin == true){
					document.location.href = ajax_login_object.redirecturl;
				}
			}
		});
		e.preventDefault();
	});
});