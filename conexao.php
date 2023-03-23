<?php

define ('HOST', "127.0.0.1");
define ('USER' , 'root');
define ('PASS' , '');
define ('DBNAME' , 'db_ecommerce');

$conn = new PDO(
	"mysql:dbname=" . HOST . ';dbname=' . DBNAME . ';', USER, PASS
);


?>