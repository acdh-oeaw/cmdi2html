<?php

// If the cmdi parameter is set start the process  
if (isset($_GET['cmdi'])) {
	$cmdi = $_GET['cmdi'];
	if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
		$context = stream_context_create(array(
    			'http' => array(
				'header' => "Authorization: Basic " . base64_encode($_SERVER['PHP_AUTH_USER'] . ":" . $_SERVER['PHP_AUTH_PW'])
			)
		));
		$content = file_get_contents($cmdi, false, $context);
	} else {
		$content = file_get_contents($cmdi);
		if ($content === false) {
			header('HTTP/1.1 401 Unauthorized');
			header('WWW-Authenticate: Basic realm="repository"');
		}
	}
	
	// Load the cmdi file from the given uri
	$xmlDoc = new DOMDocument();
	$xmlDoc->loadXML($content);
	
	// Load our xslt transformsheet
	$xslDoc = new DOMDocument();
	$xslDoc->loadXML(file_get_contents('transformsheet.xsl'));
	
	// Initiate xslt processor and transform the cmdi
	$proc = new XSLTProcessor();
	$proc->importStylesheet($xslDoc);
	$data = $proc->transformToXML($xmlDoc);
	header('Content-Type:text/html');
	$data = str_replace("<title/>", '', $data);
	
	// If cmdi processing was successful show the page
	if (!empty($data)) { 
		echo $data;
	} else {
	    // If cmdi file cannot be processed throw an error
	    include('error_page.php');
	}
} else {
	// If cmdi parameter is not set throw an error
	include('error_page.php');
}	

