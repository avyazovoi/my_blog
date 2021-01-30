<?php
$db = mysqli_connect($config['db']['server'], $config['db']['username'], $config['db']['password'], $config['db']['db_name']);
if ( $db == false ) {
	echo 'db is not conected!';
	mysqli_connect_error();
	exit();
}