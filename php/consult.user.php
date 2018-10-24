<?php

require_once '../conf/configuration.php';
require_once '../class/db/mysql.php';
require_once '../dao/usuario.php';

$conf = new Configuration();
$user = new Usuario($conf);

$idUsuario = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : '';
$correo = isset($_POST['correo']) ? $_POST['correo'] : '';
$pass = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';

$res = $user->getUsuario($idUsuario, $correo, $pass);
$array['state'] = 'false';
$array['message'] = 'Usuario y/o contraseña no válidos';
$array['result'] = array();
if (count($res) > 0) {
    if ($res[0]['cambio'] == 'S') {
        $array['message'] = 'Por favor cambie su contraseña';
        $array['state'] = 'change';
    } else {
        $array['message'] = 'Usuario y contraseña válidos';
        $array['state'] = 'true';
    }
    $array['result'] = $res;
} else {
    $array['message'] = 'Usuario y/o contraseña no válidos';
}

echo json_encode($array);
?>