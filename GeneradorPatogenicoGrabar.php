<?php
if(isset($_REQUEST['idestablecimiento'])) {$idestablecimiento = stripslashes(strip_tags( $_REQUEST['idestablecimiento']));}
if(isset($_REQUEST['cuit']))              {$cuit              = stripslashes(strip_tags( $_REQUEST['cuit']));}
if(isset($_REQUEST['razonsocial']))       {$razonsocial       = stripslashes(strip_tags( $_REQUEST['razonsocial']));}
if(isset($_REQUEST['planta']))            {$planta            = stripslashes(strip_tags( $_REQUEST['planta']));}
if(isset($_REQUEST['idlocalidad']))       {$idlocalidad       = stripslashes(strip_tags( $_REQUEST['idlocalidad']));}
if(isset($_REQUEST['cp']))                {$cp                = stripslashes(strip_tags( $_REQUEST['cp']));}
if(isset($_REQUEST['calle']))             {$calle             = stripslashes(strip_tags( $_REQUEST['calle']));}
if(isset($_REQUEST['nro']))               {$nro               = stripslashes(strip_tags( $_REQUEST['nro']));}
if(isset($_REQUEST['ruta']))              {$ruta              = stripslashes(strip_tags( $_REQUEST['ruta']));}
if(isset($_REQUEST['km']))                {$km                = stripslashes(strip_tags( $_REQUEST['km']));}
if(isset($_REQUEST['piso']))              {$piso              = stripslashes(strip_tags( $_REQUEST['piso']));}
if(isset($_REQUEST['dpto']))              {$dpto              = stripslashes(strip_tags( $_REQUEST['dpto']));}
if(isset($_REQUEST['telefono']))          {$telefono        = stripslashes(strip_tags( $_REQUEST['telefono']));}
if(isset($_REQUEST['email']))             {$email           = stripslashes(strip_tags( $_REQUEST['email']));}
/*
$archivo_log = fopen('../../pdfs/error.log','a');
fwrite($archivo_log,"[".date("r")."] idestablecimiento $idestablecimiento \r\n");
fwrite($archivo_log,"[".date("r")."] planta $planta \r\n");
fwrite($archivo_log,"[".date("r")."] telefono $telefono \r\n");
fwrite($archivo_log,"[".date("r")."] email $email \r\n");
fwrite($archivo_log,"[".date("r")."] responsable $responsable \r\n");
fwrite($$archivo_log,"[".date("r")."] cargo $cargo \r\n");
fwrite($archivo_log,"[".date("r")."] capacitacion $capacitacion \r\n");
fwrite($archivo_log,"[".date("r")."] telefonoguardia $telefonoguardia \r\n");
fwrite($archivo_log,"[".date("r")."] balanza $balanza \r\n");
fwrite($archivo_log,"[".date("r")."] camas $camas \r\n");
fwrite($archivo_log,"[".date("r")."] espacio $espacio \r\n");
fwrite($archivo_log,"[".date("r")."] transportista $idtransportista \r\n");
fwrite($archivo_log,"[".date("r")."] operador $idoperador \r\n");
*/
$sql="exec ManifiestoV2.dbo.EstablecimientosPatogUpdate ".
$idestablecimiento.",'".
$planta."','".
$telefono."','".
$email."','".
$responsable."','".
$cargo."','".
$capacitacion."','".
$telefonoguardia."','".
$camas."','".
$balanza."',".
$espacio.",".
$idtransportista.",".
$idoperador.",".
$idfrecuencia.",'".
$lunes."','".
$martes."','".
$miercoles."','".
$jueves."','".
$viernes."','".
$sabado."','".
$domingo."'";
//fwrite($archivo_log,"[".date("r")."] $sql \r\n");

require_once '../../../ConexionSistemas/conexion.php';
require_once '../../../menu1/coneccion1.php';
require("../../../lib/sqlaPantalla.php");
$_SESSION['dbname']= "Formularios";
include ('../../ConexionSistemas/conexion.php');

$db = coneccionSG($_SESSION['dbhost'],$_SESSION['dbname']);
$res = $db->query($sql);
$row=$res->fetchRow(DB_FETCHMODE_OBJECT);
$resultado= $res->numRows();

//fwrite($archivo_log,"[".date("r")."] $row->resultado \r\n");
//fclose($archivo_log);


if ($resultado >= 1) {echo $row->resultado;} else {echo 0;}
