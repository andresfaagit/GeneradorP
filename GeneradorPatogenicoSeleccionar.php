<?php
require("header.php");

require_once '../../ConexionSistemas/conexion.php';
require_once '../../menu1/coneccion1.php';
$_SESSION['dbname']= "ManifiestoV2";
include ('../ConexionSistemas/conexion.php');
$db = coneccionSG($_SESSION['dbhost'],$_SESSION['dbname']);

if (isset($_POST['ncuit'])) {
   $cuit = stripslashes(strip_tags( $_REQUEST['ncuit']));
   if (strlen(trim($cuit)) == 11) {$cuit = substr($cuit,0,2) . '-' .substr($cuit,2,8) . '/' .substr($cuit,10,1);} else {$cuit = '';}}
   $sql = "select razonsocial from generadorespatog where cuit = '" .$cuit. "'";
   $filas = $db->query($sql);
   $registro=$filas->fetchRow(DB_FETCHMODE_OBJECT);
   $_POST['razonsocial'] = $registro->razonsocial;
?>
<script>
function enviaform(ruta,id1,id2) {$("#idestablecimiento").val(id1);document.FrmRegistro.method='post';document.FrmRegistro.action=ruta;document.FrmRegistro.submit();}
</script>
<body>
<hr>

<div class="page-header clear-filter" filter-color="white">
    <div class="content">
        <div class="container">
            <div>
               <div class="col-auto"> <a class="text-info" href='javascript:enviaform("index.php","",<?php echo $_POST['ncuit']; ?>);'><i style="font-size:23px;" class="fas fa-reply"></i></a></div>
            </div> 
<br>

            <form class="form" id="FrmRegistro" name="FrmRegistro" method="post"> 
                 <input type="hidden" id="idestablecimiento" name="idestablecimiento" value="<?php if (isset($_POST['idestablecimiento'])) {echo $_POST['idestablecimiento'];}?>">
                 <div class="form-group row"> 
                    <div class="col-12 col-md-6"><label for="ncuit">Cuit</label>
                       <div>
                           <input class="form-control" id="ncuit" name="ncuit" type="number" value="<?php if (isset($_POST['ncuit'])) {echo $_POST['ncuit'];}?>" readonly placeholder="Cuit">
                       </div>
                    </div>
                    <div class="col-12 col-md-6"><label for="razonsocial">Razón Social</label>
                       <div>
                           <input class="form-control" id="razonsocial" name="razonsocial" type="text" value="<?php if (isset($_POST['razonsocial'])) {echo $_POST['razonsocial'];}?>" readonly placeholder="Razón Social">
                       </div>
                    </div>

                 </div>

<br>
                 <div class="form-group row"><div class="col"></div>
                     <div class="col-md-4">
                         <button type="submit" id="btnAgregarEstablecimiento" name="btnAgregarEstablecimiento" onClick="enviaform('GeneradorPatogenicoAgregar.php','',<?php echo $_POST['ncuit']; ?>)" class="btn btn-primary btn-round btn-block btn-md">Agregar</button>
                     </div><div class="col"></div>
                 </div>


<br>
<?php
                 if (isset($_REQUEST['ncuit'])) {$cuit = stripslashes(strip_tags( $_REQUEST['ncuit']));
                 if (strlen(trim($cuit)) == 11) {$cuit = substr($cuit,0,2) . '-' .substr($cuit,2,8) . '/' .substr($cuit,10,1);} else {$cuit = '';}}
 
                 if ($cuit != '') {
                    $sql="select idestablecimiento, planta, localidad, partido, calle, nro, ruta, km from vw_EstablecimientosPatog where cuit = '" . $cuit . "'";
                    $filas = $db->query($sql);

                    $resultado= $filas->numRows();
                    if ($resultado >= 1) {
?>
                       <div class="alert alert-success text-center">SELECCIONAR ESTABLECIMIENTO</div>
                       <table class="table class=table table-striped table-hover table-sm table-responsive-sm" id="example">
                       <table class="table table-striped table-bordered" style="width:100%" id="tblgenerador">

                             <thead class="table-success">
                                   <tr>
                                      <th>Id</th>
                                      <th>Planta</th>
                                      <th>Localidad</th>
                                      <th>Partido</th>
                                      <th>Calle</th>
                                      <th>Nro</th>
                                      <th>Ruta</th>
                                      <th>Km</th>
                                   </tr>                                
                             </thead>


<?php 
                       while ($registro=$filas->fetchRow(DB_FETCHMODE_OBJECT))
                             {           
?>
                             <tr>
                                <td><a class="text-success" href='javascript:enviaform("GeneradorPatogenicoAgregar.php",<?php echo $registro->idestablecimiento; ?>,<?php echo $_POST['ncuit']; ?>);'><?php echo $registro->idestablecimiento;?></a></td>
                                <td><?php echo $registro->planta;?></td>
                                <td><?php echo $registro->localidad;?></td>
                                <td><?php echo $registro->partido;?></td>
                                <td><?php echo $registro->calle;?></td>
                                <td><?php echo $registro->nro;?></td>
                                <td><?php echo $registro->ruta;?></td>
                                <td><?php echo $registro->km;?></td>                                
                             </tr> 
<?php                  
                             }
?>                
                       </table>
<?php                  
                       }}
?>                

            </form>
        </div>
    </div>
</div>


</body>




<?php
require 'footer.php';
?>
</html>