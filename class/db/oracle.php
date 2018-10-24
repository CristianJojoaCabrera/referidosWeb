<?php

require_once 'sql.php';

class Oracle implements sql {

    private $connection;
    private $resource;

    public function Oracle($conf) {
        $this->connection = oci_connect($conf->dbuser, $conf->dbpassword, $conf->dbname);        
    }

    public function execute($sql, $params = null) {
        $this->resource = oci_parse($this->connection, $sql);
        if (!is_null($params)) {
            foreach ($params as $key => $value) {
                oci_bind_by_name($this->resource, $key, $params[$key]);
            }
        }
        return oci_execute($this->resource, OCI_NO_AUTO_COMMIT);
    }

    public function fetch_array() {
        $array = array();
        while (($row = oci_fetch_assoc($this->resource)) != false) {
            array_push($array, $row);
        }
        return $array;
    }
    
    public function error() {
        return oci_error($this->resource);
    }
    
    public function num_rows() {
        return oci_num_rows($this->resource);
    }

    public function commit() {
        oci_commit($this->connection);
    }

    public function rollback() {
        oci_rollback($this->connection);
    }

    public function free_result() {
        oci_free_statement($this->resource);
    }

    public function close() {
        oci_close($this->connection);
    }

}

?>