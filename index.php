<?php
if(!isset($message)){
    require("header.php");
}
?>
<script>
function enviaform(ruta,id) {document.FrmRegistro.method='post';document.FrmRegistro.action=ruta;document.FrmRegistro.idestablecimiento=id; document.FrmRegistro.submit();}
</script>
<body>
<hr>
<div class="page-header clear-filter" filter-color="white">
    <div class="content">
        <div class="container">
            <form class="form" id="FrmRegistro" name="FrmRegistro" method="post"> 
            <div class="alert alert-info text-center">REGISTRO DE ESTABLECIMIENTO GENERADOR DE RESIDUOS PATOGENICOS</div>
                <br><br><br><br>
                <div class="form-group row">

                    <?php if(isset($message)){ ?>
                        <div class="col-12 col-md-6 offset-3">
                            <div>
                                <label><?php echo($message); ?></label>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="col-12 col-md-6 offset-3"><label for="ncuit">Cuit</label>
                       <div>
                           <input class="form-control" type="number" id="ncuit" name="ncuit" required min="20000000000" max="34000000000" value="<?php if (isset($_POST['ncuit'])) {echo $_POST['ncuit'];}?>" placeholder="Cuit" aria-describedby="ncuitHelp">
                           <small id="ncuitHelp" class="form-text text-muted">Ingrese el Número de la CUIT del Establecimiento.</small>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12 col-md-4 offset-4">
                        <button type="submit" id="btnBuscarGeneradorPatogenico" name="btnBuscarGeneradorPatogenico" class="btn btn-primary btn-round btn-block btn-md">Buscar</button>
                    </div>
                </div>
                </form>
        </div>
    </div>
</div>


</body>




<?php
require 'footer.php';
?>
</html>