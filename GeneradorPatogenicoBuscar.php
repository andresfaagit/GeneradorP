<?php
if(isset($_REQUEST['ncuit'])) {
  $cuit = stripslashes(strip_tags( $_REQUEST['ncuit']));
  if (strlen(trim($cuit)) == 11) {$cuit = substr($cuit,0,2) . '-' .substr($cuit,2,8) . '/' .substr($cuit,10,1);} else {$cuit = '';}}

if ($cuit != '') {
   $sql="select idestablecimiento as idestablecimiento from EstablecimientosPatog where cuit = '" . $cuit . "'";
   require_once '../../ConexionSistemas/conexion.php';
   require_once '../../menu1/coneccion1.php';
      $_SESSION['dbname']= "ManifiestoV2";
   include ('../ConexionSistemas/conexion.php');
   $db = coneccionSG($_SESSION['dbhost'],$_SESSION['dbname']);
   $res = $db->query($sql);
   $row=$res->fetchRow(DB_FETCHMODE_OBJECT);
   $resultado= $res->numRows();
   if ($resultado >= 1) {echo $row->idestablecimiento;} else {echo 0;}
   } 
else {echo -1;}

