<?php
header('Cache-Control: no cache');

require("header.php");
require_once '../../ConexionSistemas/conexion.php';
require_once '../../menu1/coneccion1.php';
$_SESSION['dbname']= "ManifiestoV2";
include ('../ConexionSistemas/conexion.php');
$db = coneccionSG($_SESSION['dbhost'],$_SESSION['dbname']);

include 'Config/application.php';
include 'Controller/Querys_Afip.php';
include 'Controller/Querys_GPatogenico.php';
?>
<script>
function enviaform(ruta) {document.FrmRegistro.method='post';document.FrmRegistro.action=ruta;document.FrmRegistro.submit();}
</script>

<?php

if (isset($_POST['ncuit'])) {
    $srv_status = server_status($afip);
    $resultArray = json_decode(json_encode($srv_status), true);  
 
    If(serverAFIP_OK($resultArray)){
        $CUIT_ASK = $_POST['ncuit'];

        $cuit_details = details_By_Cuit5($afip, $CUIT_ASK);
        $resultArrayCuitDetails = json_decode(json_encode($cuit_details), true);        
        //print_r($resultArrayCuitDetails);
        if (cuit_exists($cuit_details)){
            if(!cuit_error($resultArrayCuitDetails)){                  
                $razonSocial = get_razonSocial($resultArrayCuitDetails);
                if (!isset($razonSocial)){
                    //Contruyo la RZ con nombre y apellido
                    $razonSocial = get_nombreYapellido($resultArrayCuitDetails);               
                }
            }else{
                //No permite registrar. Cuit en afip -> ERROR (existe)
                $message = "El CUIT ingresado presenta error de constancia en AFIP.";
                include "index.php";  
                die(); 
            }
        }else{         
            //No permite registrar. Cuit en afip -> NULL (No existe)
            $message = "El CUIT ingresado no se encuentra registrado en AFIP.";
            include "index.php";  
            die();         
        }        
    }else{
        //Server AFIP caído
        print_r(" serverAFIP -> caido ");
        $message = "El servidor de AFIP se encuentra caído. Intente más tarde.";
        include "index.php";  
        die();  
    }
}

if (isset($_POST['idestablecimiento'])) {
   $sql="select planta, idprovincia, idpartido, idlocalidad, cp, calle, nro, ruta, km, piso, dpto, telefono, email from ManifiestoV2.dbo.vw_EstablecimientosPatog where idestablecimiento = ". $_POST['idestablecimiento'];

   $res = $db->query($sql);
   $row=$res->fetchRow(DB_FETCHMODE_OBJECT);
   $resultado= $res->numRows();
   if ($resultado >= 1) 
      {
      $_POST['planta']      = $row->planta;
      $_POST['idprovincia'] = $row->idprovincia;
      $_POST['hidprovincia'] = $row->idprovincia;
      $_POST['idpartido']   = $row->idpartido;
      $_POST['hidpartido']   = $row->idpartido;
      $_POST['idlocalidad'] = $row->idlocalidad;
      $_POST['hidlocalidad'] = $row->idlocalidad;
      $_POST['cp']          = $row->cp;
      $_POST['calle']       = $row->calle;
      $_POST['nro']         = $row->nro;
      $_POST['ruta']        = $row->ruta;
      $_POST['km']          = $row->km;
      $_POST['piso']        = $row->piso;
      $_POST['dpto']        = $row->dpto;
      $_POST['telefono']    = $row->Telefono;
      $_POST['email']       = $row->Email;
      }
   }
?>   
<body>
<hr>
<div class="page-header clear-filter" filter-color="white">
    <div class="content">
        <div class="container">
            <div>
            <div class="col-auto"> <a class="text-info" href='javascript:enviaform("GeneradorPatogenicoSeleccionar.php");'><i style="font-size:23px;" class="fas fa-reply"></i></a></div>
            </div> 
<br>

             <div class="col-md-auto ml-auto mr-auto">

            <form class="form" id="FrmRegistro" name="FrmRegistro" method="post"> 
                  <input type="hidden" id="idestablecimiento" name="idestablecimiento" value="<?php if (isset($_POST['idestablecimiento'])) {echo $_POST['idestablecimiento'];}?>">
<?php             if (isset($_POST['idestablecimiento']) && ($_POST['idestablecimiento'] != '')) { ?>
                     <div class="alert alert-info text-center">MODIFICAR ESTABLECIMIENTO GENERADOR DE RESIDUOS PATOGÉNICOS <?php echo '# ' . $_POST['idestablecimiento'];?></div>                    
<?php             } else { ?>
                     <div class="alert alert-info text-center">AGREGAR ESTABLECIMIENTO GENERADOR DE RESIDUOS PATOGÉNICOS</div>
<?php             } ?>                     
                  <br>

                          <div class="form-group row">
                               <div class="col-12 col-md-6"><label for="ncuit">Cuit</label>
                               <div><input class="form-control" type="text" id="ncuit" name="ncuit" readonly required value="<?php if (isset($_POST['ncuit'])) {echo $_POST['ncuit'];}?>"></div>
                               </div>
                            

                              <div class="col-12 col-md-6"><label for="razonsocial">Razón Social</label>
                              <div><input class="form-control" type="text" id="razonsocial" name="razonsocial" readonly required value="<?php if (isset($razonSocial)) {echo $razonSocial;}?>" placeholder="Razón Social" aria-describedby="razonsocialHelp">
                                    <small id="razonsocialHelp" class="form-text text-muted">Razón Social obtenida automáticamete desde AFIP.</small>

                              </div>
                              </div>
                           </div>


                          <div class="form-group row">
                               <div class="col-12 col-md-12"><label for="planta">Nombre del establecimiento</label>
                               <div>
                                    <input class="form-control" type="text" id="planta" name="planta" required value="<?php if (isset($_POST['planta'])) {echo $_POST['planta'];}?>" placeholder="Nombre" aria-describedby="plantaHelp">
                                    <small id="plantaHelp" class="form-text text-muted">Ingrese el nombre del establecimiento u hospital.</small>
                               </div>
                              </div>
                          </div>

                          <div class="form-group row">
                               <div class="col">    
                               <label for="idprovincia">Provincia.</label>
                               <select class="form-control" id="idprovincia" name="idprovincia" required></select>
                               <input  type="hidden" id="hidprovincia" name="hidprovincia" value="<?php if (isset($_POST['hidprovincia'])) {echo $_POST['hidprovincia'];}?>">
                               </div>
                               <div class="col">    
                               <label for="operador">Partido.</label>
                               <select class="form-control" id="idpartido" name="ìdpartido" required></select>
                               <input  type="hidden" id="hidpartido" name="hidpartido" value="<?php if (isset($_POST['hidpartido'])) {echo $_POST['hidpartido'];}?>">
                               </div>
                          </div>

                          <div class="form-group row">
                               <div class="col">    
                               <label for="idlocalidad">Localidad.</label>
                               <select class="form-control" id="idlocalidad" name="idlocalidad" required></select>
                               <input  type="hidden" id="hidlocalidad" name="hidlocalidad" value="<?php if (isset($_POST['hidlocalidad'])) {echo $_POST['hidlocalidad'];}?>">
                               </div>
                               <div class="col-12 col-md-6"><label for="cp">Código Postal</label>
                               <div>
                                    <input class="form-control" type="text" id="cp" name="cp" value="<?php if (isset($_POST['cp'])) {echo $_POST['cp'];}?>" placeholder="Código Postal" aria-describedby="cpHelp">
                                        <small id="cpHelp" class="form-text text-muted">Ingrese el Código Postal del establecimiento.</small>
                               </div>
                              </div>
                          </div>

                          <div class="form-group row">
                               <div class="col-12 col-md-6"><label for="calle">Calle</label>
                               <div>
                                    <input class="form-control" type="text" id="calle" name="calle" value="<?php if (isset($_POST['calle'])) {echo $_POST['calle'];}?>" placeholder="Calle" aria-describedby="calleHelp">
                                    <small id="calleHelp" class="form-text text-muted">Ingrese la calle del establecimiento.</small>
                               </div>
                              </div>
                               <div class="col-12 col-md-6"><label for="nro">Número</label>
                               <div>
                                    <input class="form-control" type="text" id="nro" name="nro" value="<?php if (isset($_POST['nro'])) {echo $_POST['nro'];}?>" placeholder="Número" aria-describedby="nroHelp">
                                        <small id="nroHelp" class="form-text text-muted">Ingrese el número del domicilio del establecimiento.</small>
                               </div>
                              </div>
                          </div>

                          <div class="form-group row">
                               <div class="col-12 col-md-6"><label for="ruta">Ruta</label>
                               <div>
                                    <input class="form-control" type="text" id="ruta" name="ruta" value="<?php if (isset($_POST['ruta'])) {echo $_POST['ruta'];}?>" placeholder="Ruta" aria-describedby="rutaHelp">
                                    <small id="rutaHelp" class="form-text text-muted">Cuando el establecimiento se encuentre sobre una ruta.</small>
                               </div>
                              </div>
                               <div class="col-12 col-md-6"><label for="km">Kilómetro</label>
                               <div>
                                    <input class="form-control" type="text" id="km" name="km" value="<?php if (isset($_POST['km'])) {echo $_POST['km'];}?>" placeholder="Kilómetro" aria-describedby="kmHelp">
                                        <small id="kmHelp" class="form-text text-muted">Cuando el establecimiento se encuentre sobre una ruta.</small>
                               </div>
                              </div>
                          </div>

                          <div class="form-group row">
                               <div class="col-12 col-md-6"><label for="piso">Piso</label>
                               <div>
                                    <input class="form-control" type="text" id="piso" name="piso" value="<?php if (isset($_POST['piso'])) {echo $_POST['piso'];}?>" placeholder="Piso" aria-describedby="pisoHelp">
                                    <small id="pisoHelp" class="form-text text-muted">Ingrese el Piso (en caso de corresponder).</small>
                               </div>
                              </div>
                               <div class="col-12 col-md-6"><label for="dpto">Departamento</label>
                               <div>
                                    <input class="form-control" type="dpto" id="dpto" name="dpto" required value="<?php if (isset($_POST['dpto'])) {echo $_POST['dpto'];}?>" placeholder="Departamento" aria-describedby="dptoHelp">
                                        <small id="dptoHelp" class="form-text text-muted">Ingrese Departamento (en caso de corresponder).</small>
                               </div>
                              </div>
                          </div>

                          <div class="form-group row">
                               <div class="col-12 col-md-6"><label for="telefono">Teléfono</label>
                               <div>
                                    <input class="form-control" type="text" id="telefono" name="telefono" required value="<?php if (isset($_POST['telefono'])) {echo $_POST['telefono'];}?>" placeholder="Teléfono" aria-describedby="telefonoHelp">
                                    <small id="telefonoHelp" class="form-text text-muted">Ingrese el teléfono.</small>
                               </div>
                              </div>
                               <div class="col-12 col-md-6"><label for="email">E-mail</label>
                               <div>
                                    <input class="form-control" type="email" id="email" name="email" required value="<?php if (isset($_POST['email'])) {echo $_POST['email'];}?>" placeholder="E-mail" aria-describedby="emailHelp">
                                        <small id="emailHelp" class="form-text text-muted">Ingrese E-mail de contacto del establecimiento.</small>
                               </div>
                              </div>
                          </div>

                          <div class="form-group row">
                               <div class="col-12 col-md-6"><label for="contrasenia">Contraseña</label>
                               <div>
                                    <input class="form-control" type="password" id="contrasenia" name="contrasenia" value="<?php if (isset($_POST['contrasenia'])) {echo $_POST['contrasenia'];}?>" placeholder="Contraseña" aria-describedby="contraseniaHelp">
                                    <small id="contraseniaHelp" class="form-text text-muted">Ingrese la Contraseña del establecimiento.</small>
                               </div>
                              </div>
                               <div class="col-12 col-md-6"><label for="contrasenia2">Repetir Contraseña</label>
                               <div>
                                    <input class="form-control" type="password" id="contrasenia2" name="contrasenia2" value="<?php if (isset($_POST['contrasenia2'])) {echo $_POST['contrasenia2'];}?>" placeholder="Repetir Contraseña" aria-describedby="contrasenia2Help">
                                    <small id="contrasenia2Help" class="form-text text-muted">Repita la Contraseña del establecimiento.</small>
                               </div>
                              </div>
                          </div>

<br>              
                  <div class="form-group row">
                     <div class="col-12 col-md-4 offset-4">
                         <button type="submit" id="btnGeneradorPatogenicoGrabar" name="btnGeneradorPatogenicoGrabar" class="btn btn-primary btn-round btn-block btn-md">Grabar</button>
                     </div>
                  </div>
            </form>
        </div>
    </div>
</div>

<br><br>

</body>




<?php
require 'footer.php';
?>
</html>