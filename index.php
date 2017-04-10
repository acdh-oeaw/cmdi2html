<?php

	if (isset($_GET['cmdi'])) {
	    $cmdi = $_GET['cmdi'];
	} else {
	    // Fallback behaviour goes here
	}

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

?>