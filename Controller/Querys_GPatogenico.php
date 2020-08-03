<?php
    function get_razonSocial($resultArrayRec){
    	$razonSocial = $resultArrayRec["datosGenerales"]["razonSocial"];   	
	    return($razonSocial);
	}

    function get_nombreYapellido($resultArrayRec){
    	$nombreYapellido = $resultArrayRec["datosGenerales"]["nombre"]." ".$resultArrayRec["datosGenerales"]["apellido"];
	    return($nombreYapellido);
	}

	function cuit_exists($resultArrayRec){
    	if(is_null($resultArrayRec)){
    		return false;
    	}else{
    		return true;
    	}   	
	}

	function cuit_error($resultArrayRec){
		$haveError = $resultArrayRec["errorConstancia"];
    	if(is_null($haveError)){
    		return false;
    	}else{
    		return true;
    	}   	
	}

?>