<?php

// If the cmdi parameter is set start the process  
if (!empty($_GET['cmdi'])) {
    $oaipmhUrl = "https://arche.acdh.oeaw.ac.at/oaipmh?verb=GetRecordRaw&metadataPrefix=cmdi&identifier=" . rawurlencode($_GET['cmdi']);
    $content = file_get_contents($oaipmhUrl);
    
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
