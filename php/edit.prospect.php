<?php

require_once '../conf/configuration.php';
require_once '../class/db/mysql.php';
require_once '../dao/prospecto.php';

$conf = new Configuration();
$prospecto = new Prospecto($conf);

$idProspecto = $_POST['id_prospecto'];
$nombreEmpresa = isset($_POST['nombre_empresa']) ? $_POST['nombre_empresa'] : '';
$nombreContacto = isset($_POST['nombre_contacto']) ? $_POST['nombre_contacto'] : '';
$cargoContacto = isset($_POST['cargo_contacto']) ? $_POST['cargo_contacto'] : '';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
$oportunidad = isset($_POST['oportunidad']) ? $_POST['oportunidad'] : '';
$fechaCita = isset($_POST['fecha_cita']) ? $_POST['fecha_cita'] : '';
$horaCita = isset($_POST['hora_cita']) ? $_POST['hora_cita'] : '';
$idUsuario = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : '';

$res = $prospecto->updProspecto($idProspecto, $nombreEmpresa, $nombreContacto, $cargoContacto, $telefono, $oportunidad, $fechaCita, $horaCita, $idUsuario);
$array['state'] = 'false';
$array['message'] = 'Prospecto no modificado';
if ($res) {
        $array['message'] = 'Prospecto modificado exitosamente';
        $array['state'] = 'true';
}

echo json_encode($array);
?>