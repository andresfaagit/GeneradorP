$(document).ready(function() {
    $('#tblgenerador').DataTable({
        "language": {
                    "decimal":        "",
                    "emptyTable":     "Sin resultados",
                    "info":           "_START_  - _END_ de _TOTAL_ Registros",
                    "infoEmpty":      "0 Registros",
                    "infoFiltered":   "(filtrado de un total de _MAX_ Registros)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Mostrar _MENU_ Registros",
                    "loadingRecords": "Cargando...",
                    "processing":     "Procesando...",
                    "search":         "Buscar:",
                    "zeroRecords":    "No se encontraron coincidencias",
                    "paginate": {
                                 "first":      "Primero",
                                 "last":       "Último",
                                 "next":       "Siguiente",
                                 "previous":   "Anterior"
                                },
                    "aria": {
                            "sortAscending":  ": activate to sort column ascending",
                            "sortDescending": ": activate to sort column descending"
                            }
                    },responsive: true
    } );

if ($("#hidprovincia").val() == '') {$("#hidprovincia").val(1);}
if ($("#hidpartido").val() == '') {$("#hidpartido").val(81);}
if ($("#hidlocalidad").val() == '') {$("#hidlocalidad").val(2487);}

$("#idprovincia").load("genera-select-provincia.php?idprovincia=" + $("#hidprovincia").val());
$("#idprovincia").change(function () {if ($("#idprovincia").val() != '') {$("#hidprovincia").val($("#idprovincia").val());}})
$("#idpartido").load("genera-select-partido.php?idprovincia=" + $("#hidprovincia").val() + "&idpartido="+ $("#hidpartido").val()); 
$("#idlocalidad").load("genera-select-localidad.php?idpartido=" + $("#hidpartido").val() + "&idlocalidad="+ $("#hidlocalidad").val()); 
$("#idprovincia").change(function () {
                    $('#idpartido').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
                    $("#hidprovincia").val($("#idprovincia").val());
                    $("#idprovincia option:selected").each(function () {
                        idprovincia = $(this).val();
                        $.post("get_partido.php", { idprovincia: idprovincia }, function(data){
                            $("#idpartido").html(data);
                            $("#hidpartido").val($("#idpartido").val());
                            $("#idpartido").change();
                        });            
                    });

  })

$("#idpartido").change(function () {
                    $('#idlocalidad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
                    $("#hidpartido").val($("#idpartido").val());
                    $("#idpartido option:selected").each(function () {
                        idpartido = $(this).val();
                        $.post("get_localidad.php", { idpartido: idpartido }, function(data){
                            $("#idlocalidad").html(data);
                            $("#hidlocalidad").val($("#idlocalidad").val());
                        });            
                    });
  })

  
$("#idlocalidad").change(function () {if ($("#idlocalidad").val() != '') {
                      $("#hidlocalidad").val($("#idlocalidad").val());
  }})

} );


$("#btnBuscarGeneradorPatogenico").click(function(e) {

  var form = document.getElementById('FrmRegistro');
  if (form.checkValidity()) {
        e.preventDefault();
        var parametros = {
                "ncuit"  : $("#ncuit").val()
            };

        $.ajax({
                data:  parametros, 
                url:   'GeneradorPatogenicoBuscar.php', 
                type:  'post', 
        beforeSend: function () {},
        success: function(data) {
          if (typeof data['error'] !== 'undefined') {bootbox.alert(data['error']);}
          else
             {
             if (data >= 1)      {enviaform('GeneradorPatogenicoSeleccionar.php',$("#ncuit").val());}
             else if (data == 0) {enviaform('GeneradorPatogenicoAgregar.php',$("#ncuit").val());}
             else {
                bootbox.alert('Error al buscar.');
                }                
                  }
                     },
        error: function() {
          bootbox.alert('Error!!!!');          
        }
        });
    }
})










  


  
  