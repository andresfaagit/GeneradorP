<?php	
	include 'config.php';
	include 'Afip.php';

	$CUIT_OPERATION_HOMO = xxxxxxxxxxx; 
	$CUIT_OPERATION_PROD = 30710405863;
	$ISPROD = TRUE;
	$PF  = 'xxxxx';
	$CERTuse = '';
	$KEYuse  = '';

	if (($ISPROD == FALSE) || (!isset($ISPROD))) {
				$CUIT_OPERATION = $CUIT_OPERATION_HOMO;
				$CERTuse = 'xxxxx.crt';
				$KEYuse  = 'xxxxx.key';
			}
		else
		{
			$CUIT_OPERATION = $CUIT_OPERATION_PROD;
			$CERTuse = 'cert';
			$KEYuse  = 'key';
		}

	$afip = new Afip(array('CUIT' => $CUIT_OPERATION, 'production' => $ISPROD, 'passphrase' => $PF, 'cert' => $CERTuse, 'key' => $KEYuse));