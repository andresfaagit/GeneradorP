<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	include 'Config/application.php';
	include 'Controller/Querys_Afip.php';
 
 	echo '<p>';
	echo 'Estado del servidor:';
	echo '<pre>';
	print_r(server_status($afip));