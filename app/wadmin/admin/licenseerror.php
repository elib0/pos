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
require( "../includes/functions.php" );
require( "../includes/adminfunctions.php" );
if ( $updatekey == "true" )
{
	$result = select_query( "tbladmins", "", array( "username" => $username, "password" => md5( $password ) ) );
	$data = mysql_fetch_array( $result );
	$id = $data['id'];
	$roleid = $data['roleid'];
	$result = select_query( "tbladminperms", "COUNT(*)", array( "roleid" => $roleid, "permid" => "64" ) );
	$data = mysql_fetch_array( $result );
	$match = $data[0];
	if ( !$newlicensekey )
	{
		echo "You did not enter a new license key";
		exit( );
	}
	if ( !$id || !$match )
	{
		echo "You do not have permission to make this change";
		exit( );
	}
	$attachments_dir = "";
	$downloads_dir = "";
	$customadminpath = "";
	include( ROOTDIR."/configuration.php" );
	$output = "<?php\r\n\$license = \"".$newlicensekey."\";\r\n\$db_host = \"".$db_host."\";\r\n\$db_username = \"".$db_username."\";\r\n\$db_password = \"".$db_password."\";\r\n\$db_name = \"".$db_name."\";\r\n\$cc_encryption_hash = \"".$cc_encryption_hash."\"; \r\n\$templates_compiledir = \"".$templates_compiledir."\";\r\n";
	if ( $mysql_charset )
	{
		$output .= "\$mysql_charset = \"".$mysql_charset."\";\r\n";
	}
	if ( $attachments_dir )
	{
		$output .= "\$attachments_dir = \"".$attachments_dir."\";\r\n";
	}
	if ( $downloads_dir )
	{
		$output .= "\$downloads_dir = \"".$downloads_dir."\";\r\n";
	}
	if ( $customadminpath )
	{
		$output .= "\$customadminpath = \"".$customadminpath."\";\r\n";
	}
	if ( $api_access_key )
	{
		$output .= "\$api_access_key = \"".$api_access_key."\";\r\n";
	}
	$output .= "?>";
	$fp = fopen( "../configuration.php", "w" );
	fwrite( $fp, $output );
	fclose( $fp );
	update_query( "tblconfiguration", array( "value" => "" ), array( "setting" => "License" ) );
	header( "Location: index.php" );
	exit( );
}
if ( !$licenseerror )
{
	$licenseerror = "invalid";
}
$licenseerror = strtolower( $licenseerror );
$licensing->forceRemoteCheck( );
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />\r\n<title>WHMCS Complete Billing &amp; Support System - License ";
echo TitleCase( $licenseerror );
echo "</title>\r\n";
echo "<s";
echo "tyle type=\"text/css\">\r\n<!--\r\nbody, td, th {\r\n\tfont-family: Tahoma, Arial, Helvetica, sans-serif;\r\n\tfont-size: 11px;\r\n\tcolor: #333;\r\n}\r\nbody {\r\n\tbackground-color: #FFF;\r\n\tmargin: 0;\r\n}\r\na, a:visited {\r\n\tcolor: #000066;\r\n\ttext-decoration: underline;\r\n}\r\na:hover {\r\n\ttext-decoration: none;\r\n}\r\nform {\r\n\tmargin: 0;\r\n\tpadding: 0;\r\n}\r\ninput, select, textarea {\r\n\tfont-family: Tahoma, Arial, Helvetica, sans-";
echo "serif;\r\n\tfont-size: 11px;\r\n\tpadding: 3px;\r\n}\r\n#login_container {\r\n\tcolor: #333;\r\n\tbackground-color: #FFF;\r\n\ttext-align: left;\r\n\twidth: 330px;\r\n\tpadding: 1px;\r\n\tmargin: 20px auto 10px auto;\r\n\tborder: 1px solid #CCCCCC;\r\n}\r\n#logo {\r\n\ttext-align: center;\r\n\tmargin: 0;\r\n\tpadding: 50px 0 0 0;\r\n}\r\n#login_container #login {\r\n\tbackground-color: #EFEFEF;\r\n\ttext-align: left;\r\n\tmargin: 0;\r\n\tpadding: 10px;\r\n}\r";
echo "\n#login_container #login_failed {\r\n	background-color: #FCF9D2;\r\n	text-align: center;\r\n	padding: 10px;\r\n	margin: 0 0 1px 0;\r\n}\r\n#login_container #extra_info {\r\n\tbackground-color: #CCC;\r\n\ttext-align: left;\r\n\tpadding: 10px;\r\n\tmargin: 1px 0 0 0;\r\n}\r\n-->\r\n</style>\r\n</head>\r\n<body>\r\n<div id=\"logo\"><a href=\"index.php\"><img src=\"images/loginlogo.gif\" alt=\"WHMCS\" width=\"205\" height=\"62\" border=\"0\" />";
echo "</a></div>\r\n<div id=\"login_container\">\r\n  <div id=\"login_failed\">\r\n	";
echo "<s";
echo "trong>License ";
echo TitleCase( $licenseerror );
echo "</strong><br>";
echo $description;
echo "  </div>\r\n  <div id=\"login\">\r\n\r\n";
if ( $licenseerror == "suspended" )
{
	echo "<p>Your license key ";
	//echo $license;
	echo " has been suspended.  Possible reasons for this include:</p>\r\n<ul>\r\n<li>You have attempted to use two or more free trial licenses</li>\r\n<li>If purchased from a reseller, they have suspended the license for non-payment</li>\r\n<li>Your license was found to be being used against the License Agreement</li>\r\n</ul>\r\n<p>Got a new license key?  <a href=\"licenseerror.php?licenseerror=change\">Click here to enter it</a></";
	echo "p>\r\n";
}
else if ( $licenseerror == "pending" )
{
	echo "<p>The WHMCS License Key ";
	//echo $license;
	echo " you just tried to access is still pending. This error occurs when we have not yet received the payment for your license.</p>\r\n<p>Got a new license key?  <a href=\"licenseerror.php?licenseerror=change\">Click here to enter it</a></p>\r\n";
}
else if ( $licenseerror == "invalid" )
{
	echo "<p>Your license key ";
	//echo $license;
	echo " is invalid. Possible reasons for this include:</p>\r\n<ul>\r\n<li>An incorrect license key has been used</li>\r\n<li>The IP Address your system is using has changed</li>\r\n<li>The domain you are using has changed</li>\r\n<li>The directory you are using has changed</li>\r\n</ul>\r\n<p>You can reissue your license from the WHMCS client area to save the new IP, Domain & Directory settings and get your WHMCS system working a";
	echo "gain.</p>\r\n<p>Got a new license key?  <a href=\"licenseerror.php?licenseerror=change\">Click here to enter it</a></p>\r\n";
}
else if ( $licenseerror == "expired" )
{
	echo "<p>Your license key ";
	//echo $license;
	echo " has expired!  To resolve this you can:</p>\r\n<ul>\r\n<li>Check your email for our payment reminder sent on the renewal date of your license which contains payment links</li>\r\n<li>Order a new license from <a href=\"http://dereferer.ws/?http://www.whmcs.com/order.php\" target=\"_blank\">www.whmcs.com/order.php</a></li>\r\n</ul>\r\n<p>If you feel this message to be an error, please email us on <a href=\"mailto:licensing@whmcs.com\">licensing@w";
	echo "hmcs.com</a></p>\r\n<p>Got a new license key?  <a href=\"licenseerror.php?licenseerror=change\">Click here to enter it</a></p>\r\n";
}
else if ( $licenseerror == "version" )
{
	echo "<p>Your owned license updates period expired before this release!  In order to use this latest version of WHMCS, you need to renew your support & updates package for this license.  You can do this in the client area at <a href=\"http://dereferer.ws/?http://www.whmcs.com/clients\" target=\"_blank\">www.whmcs.com/clients</a></p>\r\n<p>If you feel this message to be an error, please email us on <a href=\"mailto:licensing@whmcs.com\">l";
	echo "icensing@whmcs.com</a></p>\r\n<p>Got a new license key?  <a href=\"licenseerror.php?licenseerror=change\">Click here to enter it</a></p>\r\n";
}
else if ( $licenseerror == "noconnection" )
{
	echo "<p>WHMCS has not been able to verify your license for the past 7 days or more.</p>\r\n<p>Before you can access your WHMCS Admin Area again your license needs to be verified.  Make sure you do not have a firewall blocking the connection to our server</p>\r\n<p>If you need assistance, email <a href=\"mailto:licensing@whmcs.com\">licensing@whmcs.com</a>.</p>\r\n";
}
else if ( $licenseerror == "change" )
{
	echo "<p>You can change your license key by entering your admin login details and new key below. Must have full admin access.</p>\r\n";
	if ( is_writable( "../configuration.php" ) )
	{
	}
	else
	{
		echo "<p align=center style=\"color:#cc0000\"><b>You must set the permissions for the configuration.php file to 777 so it can be written to before you can change your license key</b></p>";
	}
	if ( $loginincorrect )
	{
		echo "<p align=center><b>Login Details Incorrect</b></p>";
	}
	if ( $keyblank )
	{
		echo "<p align=center><b>You must enter a new license key to change your key</b></p>";
	}
	echo "<form method=\"post\" action=\"";
	echo $PHP_SELF;
	echo "?licenseerror=change&updatekey=true\">\r\n<table align=center>\r\n<tr><td align=right>Username:</td><td><input type=\"text\" name=\"username\"></td></tr>\r\n<tr><td align=right>Password:</td><td><input type=\"password\" name=\"password\"></td></tr>\r\n<tr><td align=right>New License Key:</td><td><input type=\"text\" name=\"newlicensekey\"></td></tr>\r\n</table>\r\n<p align=center><input type=\"submit\" value=\"Change License Key\"></p>\r\n</form>\r\n";
}
echo "\r\n  </div>\r\n</div>\r\n</body>\r\n</html>";
?>