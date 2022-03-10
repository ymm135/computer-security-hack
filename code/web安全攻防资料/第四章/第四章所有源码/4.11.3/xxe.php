<?php 
	$xmlfile = file_get_contents('php://input'); 
	$dom = new DOMDocument(); 
	$dom->loadXML($xmlfile); 
	$xml = simplexml_import_dom($dom); 
	#print_r($xml);
	$xxe = $xml->xxe;
	$str = "$xxe \n";
	echo $str; 
?>