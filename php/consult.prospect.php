<?php

require_once '../conf/configuration.php';
require_once '../class/db/mysql.php';
require_once '../dao/prospecto.php';

$conf = new Configuration();
$prospecto = new Prospecto($conf);

$idProspecto = isset($_POST['id_prospecto']) ? $_POST['id_prospecto'] : '';
$idUsuario = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : '';

$res = $prospecto->getProspecto($idProspecto, $idUsuario);
$array['state'] = 'false';
$array['result'] = array();
if (count($res) > 0) {
    $array['state'] = 'true';
    $array['result'] = $res;
} else {
    $array['state'] = 'true';
    $array['message'] = 'No se encontraron resultados';
}

echo json_encode($array);
?>