<?php

class configuration {

    public $dbhost;
    public $dbname;
    public $dbuser;
    public $dbpassword;

    public function configuration() {
		    $this->dbhost = 'localhost';
        $this->dbname = 'estrategica_db';
        $this->dbuser = 'root';
        $this->dbpassword = '';
    }

}

?>
