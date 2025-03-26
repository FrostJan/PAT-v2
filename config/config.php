<?php

/***** Database Connection *****/
class Connection{
	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $dbname = "eventmanagementsystem";
	private $dsn;
	private $pdo;

	public function conn(){
		try {
		$this->dsn = "mysql:host=".$this->servername.";dbname=".$this->dbname;
		$this->pdo = new PDO($this->dsn, $this->username, $this->password);
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		return $this->pdo;			
		} catch (Exception $e) {
			echo 'error'. $e->getmessage();
		}

	}
}


?>