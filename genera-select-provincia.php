<?php
$dbname = "CATE";
require_once '../../ConexionSistemas/conexion.php';
require_once '../../menu1/coneccion1.php';
$db  = coneccionSG($_SESSION['dbhost'],$dbname);
$sql = "select idprovincia, provincia from cate.dbo.provinciasg order by idprovincia";
$resultado = $db->query($sql);

while ($fila=$resultado->fetchRow(DB_FETCHMODE_OBJECT))
      {
      $str='';
      if ($_GET['idprovincia'] == $fila->idprovincia) {$str=' selected ';}
      echo '<option value="'.$fila->idprovincia.'" ' . $str . '>'. utf8_encode($fila->provincia) .'</option>';
      }