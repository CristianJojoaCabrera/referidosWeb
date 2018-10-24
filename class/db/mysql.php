<?php

require_once 'sql.php';

class MySql implements sql {

    private $connection;
    private $resource;

    public function MySql($conf) {
        @$this->connection = mysql_connect($conf->dbhost, $conf->dbuser, $conf->dbpassword) or die ('Error en la conexi&oacute;n a la base de datos<br>');
        mysql_select_db($conf->dbname);
        mysql_set_charset('utf8');
    }

    public function execute($sql, $params = NULL) {
        $resource = mysql_query($sql, $this->connection);
		if (!$resource) {
			die('Consulta no válida: ' . mysql_error());
		}
		return $this->resource = $resource;
    }

    public function fetch_array() {
        $array = array();
        while ($row = mysql_fetch_assoc($this->resource)) {
            array_push($array, $row);
        }
        return $array;
    }

    public function num_rows() {
        return mysql_num_rows($this->resource);
    }

    public function free_result() {
        mysql_free_result($this->resource);
    }

    public function close() {
        @mysql_close($this->connection);
    }

    public function commit() {
        $this->resource->commit();
    }

    public function rollback() {
        $this->resource->rollback();
    }

}

?>