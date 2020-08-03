<?php
$dbname = "CATE";
require_once '../../ConexionSistemas/conexion.php';
require_once '../../menu1/coneccion1.php';
$db  = coneccionSG($_SESSION['dbhost'],$dbname);

$sql = "SELECT idlocalidad, localidad from cate.dbo.localidadsg where idpartido =". $_REQUEST['idpartido']. " order by localidad";
$resultado = $db->query($sql);

while ($fila=$resultado->fetchRow(DB_FETCHMODE_OBJECT)) {$html.= "<option value='".$fila->idlocalidad."'>".utf8_encode($fila->localidad)."</option>";}
echo $html;
