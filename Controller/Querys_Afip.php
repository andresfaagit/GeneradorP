<?php
    function server_status($afip){
	    $server_status = $afip->RegisterScopeFive->GetServerStatus();
	    return($server_status);
	}

	function details_By_Cuit5($afip, $CUITRec){
		//Devuelve los datos del contribuyente correspondiente al identificador $CUITRec
		//De entre todos los datos tiene la razonSocial
		//Usa ws_sr_padron_a5

		//echo $CUITRec;
		$details = $afip->RegisterScopeFive->GetTaxpayerDetails($CUITRec);
		return ($details);
	}

	function serverAFIP_OK($resultArrayRec){
		$appserverOK = $resultArrayRec["appserver"];
		$dbserverOK = $resultArrayRec["dbserver"];
		If(isset($appserverOK) && ($dbserverOK == "OK")){
			return true;
		}else{
			return false;
		}
	}
?>