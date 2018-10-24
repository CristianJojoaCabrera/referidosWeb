<?php

require_once '../conf/configuration.php';
require_once '../class/db/mysql.php';
require_once '../dao/usuario.php';

$conf = new Configuration();
$user = new Usuario($conf);
  echo 22;
$identificacion = isset($_POST['identificacion']) ? $_POST['identificacion'] : '';
$correo = isset($_POST['correo']) ? $_POST['correo'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$nombres = isset($_POST['nombres']) ? $_POST['nombres'] : '';
$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : '';
$genero = isset($_POST['genero']) ? $_POST['genero'] : '';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
$id_perfil = isset($_POST['id_perfil']) ? $_POST['id_perfil'] : '';
$cambio_password = 'N';

$array['state'] = 'false';
$array['message'] = 'Usuario no guardado';
$array['result'] = array();
if (count($user->getUsuario(null, $correo)) > 0) {
    $array['message'] = 'Ya existe un usuario con el correo ingresado';
} else {
    $res = $user->setUsuario($identificacion, $correo, $password, $nombres, $apellidos, $genero, $telefono, $id_perfil, $cambio_password);
    if ($res) {
        $array['message'] = 'Usuario registrado exitosamente';
        $array['state'] = 'true';
        $res = $user->getUsuario(null, $correo, $pass);
        $array['result'] = $res;
    }
    echo 1111111;
}

echo json_encode($array);
?>
