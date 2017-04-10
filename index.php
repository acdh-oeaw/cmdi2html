<?php

if (isset($_GET['cmdi'])) {
	// If the cmdi parameter is set start the transformation    
    $cmdi = $_GET['cmdi'];

	$xslDoc = new DOMDocument();
	$xslDoc->loadXML(file_get_contents('transformsheet.xsl'));
	
	$xmlDoc = new DOMDocument();
	$xmlDoc->loadXML(file_get_contents($cmdi));
	
	$proc = new XSLTProcessor();
	$proc->importStylesheet($xslDoc);
	$data = $proc->transformToXML($xmlDoc);
	header('Content-Type:text/html');
	$data = str_replace("<title/>", '', $data);
	echo $data;

} else {
    // If no cmdi parameter is set throw an error
    include('error_page.php');
}	

?>