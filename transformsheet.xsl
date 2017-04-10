<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns="http://www.w3.org/1999/xhtml" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:cmd="http://www.clarin.eu/cmd/" xmlns:xd="http://www.oxygenxml.com/ns/doc/xsl" version="2.0" exclude-result-prefixes="#all">
	<xsl:template match="/cmd:CMD">
		<html>
			<head>
			    <meta charset="utf-8"/>
			    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
			    <meta name="viewport" content="width=device-width, initial-scale=1"/>
			    <!-- The above 3 meta tags *must* come first in the head -->   
			    <meta name="description" content=""/>
			    <meta name="author" content=""/>
			    <link rel="icon" href="favicon.ico"/>
			    <title>
			        <!-- <xsl:value-of select="cmd:Components/cmd:FrequencyListProfile/cmd:GeneralInfo/cmd:ResourceName"/> -->
			        CMDI2HTML by ÖAW-ACDH
			    </title>
			    <!-- Bootstrap core CSS -->
			    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
			    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
			    <link rel="stylesheet" type="text/css" href="css/ie10-viewport-bug-workaround.css"/>
			    <!-- Custom styles for this template -->
			    <link rel="stylesheet" type="text/css" href="css/style.css"/>
			</head>
			<body>
			    <div class="container">
			      	<div class="header clearfix">
						<h3 class="service-name">CMDI2HTML</h3>
						<a class="navbar-brand" target="_blank" href="http://www.oeaw.ac.at/acdh/en"><img src="img/acdhlogo.png"/></a>
			    	</div>
						
					<div class="jumbotron">
			        	<h2>Header</h2>
						<span>
							<strong>Creator: </strong>
							<xsl:value-of select="cmd:Header/cmd:MdCreator"/>
						</span>
						<span>
							<strong>Creation Date: </strong>
							<xsl:value-of select="cmd:Header/cmd:MdCreationDate"/>
						</span>
						<span>
							<strong>Self Link: </strong>
							<xsl:value-of select="cmd:Header/cmd:MdSelfLink"/>
						</span>							
						<span>
							<strong>Profile: </strong>
							<xsl:value-of select="cmd:Header/cmd:MdProfile"/>
						</span>														        	
						<span>
							<strong>Collection Display Name: </strong>
							<xsl:value-of select="cmd:Header/cmd:MdCollectionDisplayName"/>
						</span>					
			      	</div>

					<div class="jumbotron">
			        	<h2>Resources</h2>
			        	
	                    <xsl:for-each select="cmd:Resources/descendant::*">
							<span class="level-{count(ancestor::*)}">
								<strong><xsl:value-of select="local-name()"/>: </strong>
								<xsl:value-of select="."/>
							</span>
	                    </xsl:for-each>				        					
			      	</div>

					<div class="jumbotron">
			        	<h2>Components</h2>
			     
	                    <xsl:for-each select="cmd:Components/descendant::*">
							<span class="level-{count(ancestor::*)}">
								<strong><xsl:value-of select="local-name()"/>: </strong>
								<xsl:value-of select="text()"/>
							</span>
	                    </xsl:for-each>			        					
			      	</div>
		      	
		      	</div> <!-- /container -->
  			</body>
  		</html>
	</xsl:template>
</xsl:stylesheet>

