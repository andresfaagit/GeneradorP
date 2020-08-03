<?php
   	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	include 'Config/application.php';
	include 'Controller/Querys_Afip.php';
 
   $CUIT_ASK = $_GET['cuit'];
     
   echo '<pre>';
   print_r(details_By_Cuit5($afip, $CUIT_ASK));
	
