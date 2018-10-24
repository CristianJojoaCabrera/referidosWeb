<?php

class Usuario {

    private $db;

    /**
     *
     * @param configuration $conf Objeto de configuracion
     */
    function __construct($conf) {
        $this->db = new MySql($conf);
    }
    
    public function getUsuario($idUsuario = '', $correo = '', $password = '') {
        $correo = strtoupper($correo);
        $sql = "SELECT "
                . "id_usuario, identificacion, correo, nombres, apellidos, "
                . "password, genero, telefono, perfil, cambio_password, fecha "
                . "FROM usuario u "
                . "INNER JOIN perfil p ON(u.id_perfil = p.id_perfil) "
                . "WHERE 1 = 1 ";
                $sql .= ($idUsuario != '') ? "AND id_usuario = $idUsuario " : "";
                $sql .= ($correo != '') ? "AND UPPER(correo) = '$correo' " : "";
                $sql .= ($password != '') ? "AND password = '$password' " : "";
                $sql .= "ORDER BY apellidos, nombres ";
        $this->db->execute($sql);
        $return = $this->db->fetch_array();
        $this->db->free_result();
        return $return;
    }
    
    public function setUsuario($identificacion, $correo, $password, $nombres, $apellidos, $genero, $telefono, $id_perfil, $cambio_password = 'N') {
        $sql = "INSERT INTO usuario "
                . "(identificacion, correo, password, nombres, apellidos, "
                . "genero, telefono, id_perfil, cambio_password) "
                . "VALUES ('" . $identificacion . "', '" . $correo . "', '" . $password . "', '" . $nombres . "', '" . $apellidos . "', '" . $genero . "', '" . $telefono . "', " . $id_perfil . ", '" . $cambio_password . "')";
        return $this->db->execute($sql);
    }
    
    public function updUsuario($idUsuario = '', $correo = '', $identificacion = '', $password = '', $nombres = '', $apellidos = '', $genero = '', $telefono = '', $id_perfil = '', $cambio_password = '') {
        $sql = "UPDATE usuario "
                . "SET id_usuario = id_usuario ";
        $sql .= ($identificacion != '') ? ", identificacion = '$identificacion' " : "";
        $sql .= ($password != '') ? ", password = '$password' " : "";
        $sql .= ($nombres != '') ? ", nombres = '$nombres' " : "";
        $sql .= ($apellidos != '') ? ", apellidos = '$apellidos' " : "";
        $sql .= ($genero != '') ? ", genero = '$genero' " : "";
        $sql .= ($telefono != '') ? ", telefono = '$telefono' " : "";
        $sql .= ($id_perfil != '') ? ", id_perfil = '$id_perfil' " : "";
        $sql .= ($cambio_password != '') ? ", cambio_password = '$cambio_password' " : "";
        $sql .= ($correo != '') ? "WHERE correo = '$correo' " : "WHERE id_usuario = $idUsuario";
        return $this->db->execute($sql);
    }
    
    /**
     * Confirma los cambios realizados durante una transacción
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