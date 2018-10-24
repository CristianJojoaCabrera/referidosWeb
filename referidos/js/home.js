// Referidos Page

// Portafolio Page

// Proyectos Page

// Prospectos Page
function cargarProspectos(id_usuario) {
	$.post('http://www.estrategicacomunicaciones.com/mobile/php/consult.prospect.php', {
		'id_usuario' : id_usuario
	}, function(resp) {
		if (resp.state == 'true') {
			$('#ulProspectos').html('');
			$.each(resp.result, function(i, item) {
				var parameters = 'id_prospecto=' + item.id_prospecto + '&';
				parameters += 'nombre_empresa=' + item.nombre_empresa + '&';
				parameters += 'nombre_contacto=' + item.nombre_contacto + '&';
				parameters += 'cargo_contacto=' + item.cargo_contacto + '&';
				parameters += 'telefono=' + item.telefono + '&';
				parameters += 'oportunidad=' + item.oportunidad + '&';
				parameters += 'fecha_cita=' + item.fecha_cita + '&';
				parameters += 'hora_cita=' + item.hora_cita;
				var li = '<li>';
				li += '<a href="register.prospect.html?' + parameters + '" class="item-link">';
				li += '<div class="item-content">';
				li += '<div class="item-inner">';
				li += '<div class="item-title">' + item.nombre_empresa +  '</div>';
				li += '</div>';
				li += '</div>';
				li += '</a>';
				li += '<li>';
				$('#ulProspectos').append(li);
			});
		}
	} , 'json');
}
// Usuarios Page

$('#btnGuardarUsuario').on('click', function () {
	console.log('llegaaa');
	if ($('#txtNombre').val() != '' && $('#txtApellido').val() != '' && $('#txtIdentificacion').val() != '' && $('#txtEmail').val() != '' && $('#txtTelefono').val() != '' && $('#cmbGenero').val() != '') {
		if ($('#txtPassword').val() == $('#txtPassword2').val()) {
			$.post('../php/register.user.php', {
				'nombres' : $('#txtNombre').val(),
				'apellidos' : $('#txtApellido').val(),
				'identificacion' : $('#txtIdentificacion').val(),
				'correo' : $('#txtEmail').val(),
				'password' : $('#txtPassword').val(),
				'telefono' : $('#txtTelefono').val(),
				'genero' : $('#cmbGenero').val(),
				'id_perfil' : $('#txtIdPerfil').val()
			}, function(response) {
				console.log('estate');
				console.log(response.state);
				if (response.state == 'true') {
					setCookie('id_usuario', response.result[0].id_usuario);
					$('#chkModificar').prop('checked', false);
					$('#txtNombre, #txtApellido, #txtIdentificacion, #txtEmail, #txtPassword, #txtPassword2, #txtTelefono, #cmbGenero').prop('disabled', true);
					$('#divGuardarUsuario').hide();
					$('#tb3').show();
				}
				myApp.alert(response.message, 'Referidos');
			}, 'json');
		} else {
			myApp.alert('La contraseña no coincide. Por favor verifíquela', 'Referidos');
		}
	} else {
		myApp.alert('Diligencie todos los campos', 'Referidos');
	}
});

$('#chkModificar').on('change', function() {
	$('#txtNombre, #txtApellido, #txtIdentificacion, #txtEmail, #txtPassword, #txtPassword2, #txtTelefono, #cmbGenero').prop('disabled', !$('#chkModificar').prop('checked'));
	($('#chkModificar').prop('checked')) ? $('#divGuardarUsuario').show() : $('#divGuardarUsuario').hide();
});
