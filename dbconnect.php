<?php
@$dbcnx = new mysqli('localhost', 'root', '','RetroCafe');
if ($dbcnx->connect_error){
	echo "Database is not online"; 
	exit;
	}
if (!$dbcnx->select_db ("RetroCafe"))
	exit("<p>Unable to locate the RetroCafe database</p>");
?>	