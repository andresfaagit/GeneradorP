<?php

	define("SERVER_PROTOCOL", "https://");
	define("SERVER", SERVER_PROTOCOL.$_SERVER['SERVER_NAME']/*.':'.$_SERVER['SERVER_PORT']*/);
	define("SERVER_DIRNAME", $_SERVER['DOCUMENT_ROOT']);
	define("APP_ROOT", SERVER_PROTOCOL.$_SERVER['SERVER_NAME']/*.':'.$_SERVER['SERVER_PORT']*/."/afip.ws");
	define("APP_DIRNAME", dirname(__FILE__));
	define("APP_NAME", "AFIP.WS");

	//define("URL_LOG_HOMO",'https://wsaahomo.afip.gov.ar/ws/services/LoginCms');
	//define("URL_LOG_PROD","https://wsaa.afip.gov.ar/ws/services/LoginCms");
	define("URL_LOG_HOMO",'https://200.1.116.66/ws/services/LoginCms');
	define("URL_LOG_PROD","https://200.1.116.76/ws/services/LoginCms");

	define ("SOAP_VERSION", SOAP_1_2);

	define ("WSDL_TEST",'ws_sr_padron_a5.wsdl');
	//define ("URL_TEST",'https://awshomo.afip.gov.ar/sr-padron/webservices/personaServiceA5');
	define ("URL_TEST",'https://200.1.116.91/sr-padron/webservices/personaServiceA5');

	define ("WSDL",'ws_sr_padron_a5-production.wsdl');
	define ("URL",'https://200.1.116.54/sr-padron/webservices/personaServiceA5');
  
	define("PROXY_HOST", NULL);
	define("PROXY_PORT", NULL);