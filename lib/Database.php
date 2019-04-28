<?php
class Database extends PDO{
	public function __construct($DB_VENDOR, $DB_HOST, $DB_NAME,
		$DB_USR, $DB_PWD){
		parent::__construct($DB_VENDOR.':host='.$DB_HOST.';
		dbname='.$DB_NAME, $DB_USR, $DB_PWD);
	}
}

?>