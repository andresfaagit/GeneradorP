<?php
$dbname = "CATE";
require_once '../../ConexionSistemas/conexion.php';
require_once '../../menu1/coneccion1.php';
$db  = coneccionSG($_SESSION['dbhost'],$dbname);
$sql = "SELECT idpartido, partido from cate.dbo.partidosg where idprovincia =". $_GET['idprovincia']. " order by partido";
$resultado = $db->query($sql);

while ($fila=$resultado->fetchRow(DB_FETCHMODE_OBJECT)) {$html.= "<option value='".$fila->idpartido."'>".utf8_encode($fila->partido)."</option>";}
echo $html;