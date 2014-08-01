<?php //00d4b
// *************************************************************************
// *                                                                       *
// * WHMCS - The Complete Client Management, Billing & Support Solution    *
// * Copyright (c) WHMCS Ltd. All Rights Reserved,                         *
// * Release Date: 17th June 2011                                          *
// * Version 4.5.2                                                         *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: info@whmcs.com                                                 *
// * Website: http://www.whmcs.com                                         *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.  This software  or any other *
// * copies thereof may not be provided or otherwise made available to any *
// * other person.  No title to and  ownership of the  software is  hereby *
// * transferred.                                                          *
// *                                                                       *
// * You may not reverse  engineer, decompile, defeat  license  encryption *
// * mechanisms, or  disassemble this software product or software product *
// * license.  WHMCompleteSolution may terminate this license if you don't *
// * comply with any of the terms and conditions set forth in our end user *
// * license agreement (EULA).  In such event,  licensee  agrees to return *
// * licensor  or destroy  all copies of software  upon termination of the *
// * license.                                                              *
// *                                                                       *
// * Please see the EULA file for the full End User License Agreement.     *
// *                                                                       *
// *************************************************************************
require( "../dbconnect.php" );
include( "../includes/functions.php" );
require( "../includes/adminfunctions.php" );
$aInt = new adminInterface( "WHOIS Lookups" );
$aInt->title = "Domain WHOIS Lookup";
$aInt->sidebar = "utilities";
$aInt->icon = "domains";
$aInt->requiredFiles( array( "domainfunctions", "whoisfunctions" ) );
ob_start( );
$whoisservers = file_get_contents( "../includes/whoisservers.php" );
$whoisservers = explode( "\n", $whoisservers );
foreach ( $whoisservers as $value )
{
	$value = explode( "|", $value );
	$mtlds[] = trim( strip_tags( $value[0] ) );
}
if ( $domain )
{
	$domain = strtolower( $domain );
	$domainbits = explode( ".", $domain, 2 );
	$sld = $domainbits[0];
	$tld = ".".$domainbits[1];
}
if ( $action == "checkavailability" )
{
	$result = lookupDomain( $sld, $tld );
	echo $result['result'];
	exit( );
}
echo "\r\n<form method=\"post\" action=\"";
echo $_SERVER['PHP_SELF'];
echo "\">\r\n<p align=center>www. <input type=\"text\" name=\"domain\" value=\"";
echo $domain;
echo "\" size=\"40\"> <input type=\"submit\" value=\"Lookup Domain\" class=\"button\"></p>\r\n</form>\r\n\r\n";
if ( $sld )
{
	$checkdomain = $sld.$tld;
	if ( !in_array( $tld, $mtlds ) )
	{
		echo "<p align=\"center\" style=\"font-size:18px;color:#cc0000;\">WHOIS Lookups cannot be performed for the TLD {$tld}</p>";
	}
	else
	{
		$result = lookupDomain( $sld, $tld );
		if ( $result['result'] == "available" )
		{
			echo "<p align=\"center\" style=\"font-size:18px;color:#669900;\">The domain {$checkdomain} is available for registration</p>";
		}
		else if ( $result['result'] == "error" )
		{
			echo "<p align=\"center\" style=\"font-size:18px;color:#cc0000;\">An error occured while checking the availability of this domain</p>";
		}
		else
		{
			echo "<p align=\"center\" style=\"font-size:18px;color:#cc0000;\">The domain {$checkdomain} is already registered</p>";
			echo "<p><strong>WHOIS Output</strong></p><p>{$result['whois']}</p>";
		}
	}
}
$content = ob_get_contents( );
ob_end_clean( );
$aInt->content = $content;
$aInt->display( );
?>