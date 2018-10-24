<?php

interface sql {

    public function execute($sql, $params = null);
    public function fetch_array();
    public function num_rows();
    public function commit();
    public function rollback();
    public function free_result();
    public function close();
    
}

?>
