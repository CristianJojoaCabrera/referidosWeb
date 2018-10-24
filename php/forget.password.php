<?php

require_once '../conf/configuration.php';
require_once '../class/db/mysql.php';
require_once '../dao/usuario.php';

$conf = new Configuration();
$user = new Usuario($conf);

$correo = isset($_POST['correo']) ? $_POST['correo'] : '';

$res = $user->getUsuario('', $correo, '');
$array['state'] = 'false';
$array['message'] = '';
if (count($res) > 0) {
    $hash = rand(1000, 9999);
    $user->updUsuario('', $correo, '', $hash);
    mail($res[0]['correo'], "Recordar Contraseña Referidos App", "Su nueva contraseña es: " . $hash) ;
    $array['message'] = 'Su nueva contraseña ha sido enviada a su correo';
    $array['state'] = 'true';
} else {
    $array['message'] = 'El correo no se encuentra registrado';
    $array['state'] = 'false';
}

echo json_encode($array);
?>