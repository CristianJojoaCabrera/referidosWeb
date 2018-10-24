<?php

class Prospecto {

    private $db;

    /**
     *
     * @param configuration $conf Objeto de configuracion
     */
    function __construct($conf) {
        $this->db = new MySql($conf);
    }
    
    public function getProspecto($idProspecto = '', $idUsuario = '') {
        $sql = "SELECT "
                . "id_prospecto, nombre_empresa, nombre_contacto, cargo_contacto, telefono, oportunidad, fecha_cita, hora_cita, id_usuario, fecha "
                . "FROM prospecto p "
                . "WHERE 1 = 1 ";
                $sql .= ($idProspecto != '') ? "AND id_prospecto = $idProspecto " : "";
                $sql .= ($idUsuario != '') ? "AND id_usuario = $idUsuario " : "";
                $sql .= "ORDER BY id_prospecto ";
        $this->db->execute($sql);
        $return = $this->db->fetch_array();
        $this->db->free_result();
        return $return;
    }
    
    public function setProspecto($nombreEmpresa, $nombreContacto, $cargoContacto, $telefono, $oportunidad, $fechaCita, $horaCita, $idUsuario) {
        $sql = "INSERT INTO prospecto "
                . "(nombre_empresa, nombre_contacto, " 
                . "cargo_contacto, telefono, oportunidad, fecha_cita, hora_cita, id_usuario) "
                . "VALUES ('" . $nombreEmpresa . "', '" . $nombreContacto
                . "', '" . $cargoContacto . "', '" . $telefono . "', '" 
                . $oportunidad . "', '" . $fechaCita . "', '" . $horaCita . "', " . $idUsuario . ")";
        return $this->db->execute($sql);;
    }
    
    public function updProspecto($idProspecto, $nombreEmpresa = '', $nombreContacto = '', $cargoContacto = '', $telefono = '', $oportunidad = '', $fechaCita = '', $horaCita = '', $idUsuario = '') {
        $sql = "UPDATE prospecto "
                . "SET id_prospecto = id_prospecto ";
        $sql .= ($nombreEmpresa != '') ? ", nombre_empresa = '$nombreEmpresa' " : "";
        $sql .= ($nombreContacto != '') ? ", nombre_contacto  = '$nombreContacto' " : "";
        $sql .= ($cargoContacto != '') ? ", cargo_contacto = '$cargoContacto' " : "";
        $sql .= ($telefono != '') ? ", telefono = '$telefono' " : "";
        $sql .= ($oportunidad != '') ? ", oportunidad  = '$oportunidad' " : "";
        $sql .= ($fechaCita != '') ? ", fecha_cita  = '$fechaCita' " : "";
        $sql .= ($horaCita != '') ? ", hora_cita  = '$horaCita' " : "";
        $sql .= ($idUsuario != '') ? ", id_usuario  = $idUsuario " : "";
        $sql .= "WHERE id_prospecto = " . $idProspecto;
        return $this->db->execute($sql);;
    }
    
    /**
     * Confirma los cambios realizados durante una transacci¨®n
     */
    public function commit() {
        $this->db->commit();
    }

    /**
     * Cierra las conexiones a base de datos
     */
    function __destruct() {
        $this->db->close();
    }

}

?>