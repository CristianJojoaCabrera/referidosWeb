myApp.onPageInit('recordar', function (page) {
		
	$('#btnRecordar').on('click', function() {
		if ($('#txtEmailRecordar').val() != '') {
			$.post('http://www.estrategicacomunicaciones.com/mobile/php/forget.password.php', {
				'correo' : $('#txtEmailRecordar').val()
			}, function(response) {
				if (response.state == 'true') {
					myApp.alert(response.message ,'Referidos');
					myApp.showTab('#view-4');
					view3.router.back();
				} else {
					myApp.alert(response.message ,'Referidos');
				}
			}, 'json');
		} else {
			myApp.alert('Ingrese su cuenta de correo', 'Referidos');
		}
	});
  
});