<?php
$dbname = "CATE";
require_once '../../ConexionSistemas/conexion.php';
require_once '../../menu1/coneccion1.php';
$db  = coneccionSG($_SESSION['dbhost'],$dbname);
$sql = "SELECT idlocalidad, localidad from cate.dbo.localidadsg where idpartido =". $_GET['idpartido']. " order by localidad";
$resultado = $db->query($sql);

while ($fila=$resultado->fetchRow(DB_FETCHMODE_OBJECT))
      {
      $str='';
      if ($_GET['idlocalidad'] == $fila->idlocalidad) {$str=' selected ';}
      echo '<option value="'.$fila->idlocalidad.'" ' . $str . '>'. utf8_encode($fila->localidad) .'</option>';
      }
