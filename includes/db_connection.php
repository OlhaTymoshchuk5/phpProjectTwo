<!-- 
	File:    db_connection.php.php
	Purpose: to connect the database with PDO
	Authors: Barbara Bianca Zacchi
			 Millene L B S Cesconetto
			 Olha Tymoshchuk 
-->
<?php
	define("DBHOST", "localhost");
	define("DBDB",   "contacts");
	define("DBUSER", "lamp1user");
	define("DBPW", "!Lamp12!");

	function connectDB(){
		$dsn = "mysql:host=".DBHOST.";dbname=".DBDB.";charset=utf8";
		try{
			$db_conn = new PDO($dsn, DBUSER, DBPW);
			return $db_conn;
		} catch (PDOException $e){
			echo "<p>Error opening database <br/>\n".$e->getMessage()."</p>\n";
			exit(1);
		}
	}

?>
