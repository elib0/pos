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
function htmlspecialchars_array( $arr )
{
	$cleandata = array( );
	if ( is_array( $arr ) )
	{
		foreach ( $arr as $key => $val )
		{
			if ( is_array( $val ) )
			{
				$cleandata[$key] = htmlspecialchars_array( $val );
			}
			else
			{
				$cleandata[$key] = htmlspecialchars( $val );
				if ( get_magic_quotes_gpc( ) )
				{
					$cleandata[$key] = stripslashes( $cleandata[$key] );
				}
			}
		}
	}
	else
	{
		$cleandata = htmlspecialchars( $arr );
		if ( get_magic_quotes_gpc( ) )
		{
			$cleandata = stripslashes( $cleandata );
		}
	}
	return $cleandata;
}

function checkIP( $ip )
{
	if ( !empty( $ip ) && ip2long( $ip ) != 0 - 1 && ip2long( $ip ) != false )
	{
		$private_ips = array(
			array( "0.0.0.0", "2.255.255.255" ),
			array( "10.0.0.0", "10.255.255.255" ),
			array( "127.0.0.0", "127.255.255.255" ),
			array( "169.254.0.0", "169.254.255.255" ),
			array( "172.16.0.0", "172.31.255.255" ),
			array( "192.0.2.0", "192.0.2.255" ),
			array( "192.168.0.0", "192.168.255.255" ),
			array( "255.255.255.0", "255.255.255.255" )
		);
		foreach ( $private_ips as $r )
		{
			$min = ip2long( $r[0] );
			$max = ip2long( $r[1] );
			if ( $min <= ip2long( $ip ) && ip2long( $ip ) <= $max )
			{
				return false;
			}
		}
		return true;
	}
	return false;
}

function determineIP( )
{
	if ( checkip( $_SERVER['HTTP_CLIENT_IP'] ) )
	{
		return $_SERVER['HTTP_CLIENT_IP'];
	}
	$ip_array = explode( ",", $_SERVER['HTTP_X_FORWARDED_FOR'] );
	if ( checkip( trim( $ip_array[count( $ip_array ) - 1] ) ) )
	{
		return trim( $ip_array[count( $ip_array ) - 1] );
	}
	if ( checkip( $_SERVER['HTTP_X_FORWARDED'] ) )
	{
		return $_SERVER['HTTP_X_FORWARDED'];
	}
	if ( checkip( $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'] ) )
	{
		return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
	}
	if ( checkip( $_SERVER['HTTP_FORWARDED_FOR'] ) )
	{
		return $_SERVER['HTTP_FORWARDED_FOR'];
	}
	if ( checkip( $_SERVER['HTTP_FORWARDED'] ) )
	{
		return $_SERVER['HTTP_FORWARDED'];
	}
	return $_SERVER['REMOTE_ADDR'];
}

define( "WHMCS", true );
define( "ROOTDIR", dirname( __FILE__ ) );
$systemtemplate = $ordertemplate = $nameserver = $display_errors = $debug_output = $mysql_errors = $currency = "";
/*
if ( isset( $_REQUEST['display_errors'] ) && $_REQUEST['xdebug'] == "c8RoE6aW08m" )
{
	$display_errors = true;
	$debug_output = true;
	$mysql_errors = true;
}
*/
if ( isset( $_REQUEST['display_errors'] ) )
{
	unset( $_REQUEST['display_errors'] );
}
if ( isset( $_REQUEST['debug_output'] ) )
{
	unset( $_REQUEST['debug_output'] );
}
if ( isset( $_REQUEST['mysql_errors'] ) )
{
	unset( $_REQUEST['mysql_errors'] );
}
$PHP_SELF = htmlspecialchars_array( $_SERVER['PHP_SELF'] );
$_SERVER['PHP_SELF'] = $PHP_SELF;
foreach ( $_COOKIE as $reg_globals_key => $reg_globals_value )
{
	unset( $_REQUEST[$reg_globals_key] );
}
$_GET = htmlspecialchars_array( $_GET );
$_POST = htmlspecialchars_array( $_POST );
$_REQUEST = htmlspecialchars_array( $_REQUEST );
$_COOKIE = htmlspecialchars_array( $_COOKIE );
foreach ( $_REQUEST as $reg_globals_key => $reg_globals_value )
{
	if ( $reg_globals_key == "_SERVER" || $reg_globals_key == "_COOKIE" || $reg_globals_key == "_SESSION" )
	{
		exit( );
	}
	$$reg_globals_key = $reg_globals_value;
}
unset( $reg_globals_key );
unset( $reg_globals_value );
$smtp_debug = $attachments_dir = $downloads_dir = $customadminpath = $mysql_charset = $overidephptimelimit = $orderform = $smartyvalues = $usingsupportmodule = $copyrighttext = $adminorder = $revokelocallicense = $allow_idn_domains = "";
ob_start( );
if ( file_exists( ROOTDIR."/configuration.php" ) )
{
	require( ROOTDIR."/configuration.php" );
}
error_reporting( 0 );
include( ROOTDIR."/includes/dbfunctions.php" );
include( ROOTDIR."/includes/licensefunctions.php" );
@session_start( );
if ( $templates_compiledir == "templates_c/" || !$templates_compiledir )
{
	$templates_compiledir = ROOTDIR."/templates_c/";
}
if ( !$attachments_dir )
{
	$attachments_dir = ROOTDIR."/attachments/";
}
if ( !$downloads_dir )
{
	$downloads_dir = ROOTDIR."/downloads/";
}
if ( !$customadminpath )
{
	$customadminpath = "admin";
}
if ( !$overidephptimelimit )
{
	$overidephptimelimit = 300;
}
@set_time_limit( $overidephptimelimit );
$whmcsmysql = @mysql_connect( $db_host, $db_username, $db_password );
if ( !@mysql_select_db( $db_name ) )
{
	exit( "<div style=\"border: 1px dashed #cc0000;font-family:Tahoma;background-color:#FBEEEB;width:100%;padding:10px;color:#cc0000;\"><strong>Critical Error</strong><br>Could not connect to the database</div>" );
}
full_query( "SET SESSION wait_timeout=600" );
if ( $mysql_charset )
{
	full_query( "SET NAMES '{$mysql_charset}'" );
}
$remote_ip = determineip( );
$CONFIG = array( );
$result = select_query( "tblconfiguration", "", "" );
while ( $data = @mysql_fetch_array( $result ) )
{
	$setting = $data['setting'];
	$value = $data['value'];
	$CONFIG["{$setting}"] = "{$value}";
}
$CONFIG['SystemURL'] = substr( $CONFIG['SystemURL'], 0 - 1, 1 ) == "/" ? substr( $CONFIG['SystemURL'], 0, 0 - 1 ) : $CONFIG['SystemURL'];
$CONFIG['SystemSSLURL'] = substr( $CONFIG['SystemSSLURL'], 0 - 1, 1 ) == "/" ? substr( $CONFIG['SystemSSLURL'], 0, 0 - 1 ) : $CONFIG['SystemSSLURL'];
$CONFIG['Domain'] = substr( $CONFIG['Domain'], 0 - 1, 1 ) == "/" ? substr( $CONFIG['Domain'], 0, 0 - 1 ) : $CONFIG['Domain'];
if ( $CONFIG['SystemURL'] == $CONFIG['SystemSSLURL'] )
{
	$CONFIG['SystemSSLURL'] = "";
}
if ( substr( $CONFIG['SystemSSLURL'], 0, 5 ) != "https" )
{
	$CONFIG['SystemSSLURL'] = "";
}
if ( $CONFIG['Version'] == "4.5.0" )
{
	update_query( "tblconfiguration", array( "value" => "4.5.1" ), array( "setting" => "Version" ) );
	$CONFIG['Version'] = "4.5.1";
}
if ( $CONFIG['Version'] == "4.5.1" )
{
	full_query( "ALTER TABLE `tblsslorders` CHANGE `status` `status` TEXT NOT NULL" );
	full_query( "UPDATE `tblsslorders` SET status='Awaiting Configuration' WHERE status='Incomplete'" );
	full_query( "ALTER TABLE `tblsslorders` ADD `configdata` TEXT NOT NULL AFTER `certtype`" );
	update_query( "tblconfiguration", array( "value" => "4.5.2" ), array( "setting" => "Version" ) );
	$CONFIG['Version'] = "4.5.2";
}
if ( $CONFIG['Version'] != "4.5.2" )
{
	if ( file_exists( "../install/install.php" ) )
	{
		header( "Location: ../install/install.php" );
		exit( );
	}
	echo "<div style=\"border: 1px dashed #cc0000;font-family:Tahoma;background-color:#FBEEEB;width:100%;padding:10px;color:#cc0000;\"><strong>Down for Maintenance</strong><br>An upgrade is currently in progress... Please come back soon...</div>";
	exit( );
}
if ( file_exists( ROOTDIR."/install/install.php" ) )
{
	echo "<div style=\"border: 1px dashed #cc0000;font-family:Tahoma;background-color:#FBEEEB;width:100%;padding:10px;color:#cc0000;\"><strong>Security Warning</strong><br>The install folder needs to be deleted for security reasons before using WHMCS</div>";
	exit( );
}
if ( !is_writeable( $templates_compiledir ) )
{
	echo "<div style=\"border: 1px dashed #cc0000;font-family:Tahoma;background-color:#FBEEEB;width:100%;padding:10px;color:#cc0000;\"><strong>Permissions Error</strong><br>The templates compiling directory '{$templates_compiledir}' must be writeable (CHMOD 777) before you can continue.<br>If the path shown is incorrect, you can update it in the configuration.php file.</div>";
	exit( );
}
header( "Content-Type: text/html; charset=".$CONFIG['Charset'] );
if ( defined( "CLIENTAREA" ) && $CONFIG['MaintenanceMode'] && !$_SESSION['adminid'] )
{
	echo "<div style=\"border: 1px dashed #cc0000;font-family:Tahoma;background-color:#FBEEEB;width:100%;padding:10px;color:#cc0000;\"><strong>Down for Maintenance</strong><br>".$CONFIG['MaintenanceModeMessage']."</div>";
	exit( );
}
$licensing = new WHMCSLicense827( );
/*
if ( $licensing->version != "0466cbb5679eb882c93bf46f1a1e79e1" )
{
	exit( "License Checking Error" );
}
*/
if ( $display_errors )
{
	@ini_set( "display_errors", "on" );
	@error_reporting( E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING );
}
if ( $systemtemplate )
{
	$systpl = $systemtemplate;
}
if ( $ordertemplate )
{
	$carttpl = $ordertemplate;
}
$systpl = preg_replace( "/[^0-9a-z-]/i", "", $systpl );
$carttpl = preg_replace( "/[^0-9a-z-]/i", "", $carttpl );
if ( isset( $language ) )
{
	$language = preg_replace( "/[^0-9a-z-]/i", "", $language );
}
if ( $debug_output && !$_SESSION['adminid'] )
{
	$debug_output = "";
}
if ( $systpl && is_dir( ROOTDIR."/templates/{$systpl}" ) )
{
	$_SESSION['Template'] = $systpl;
}
if ( $_SESSION['Template'] )
{
	$CONFIG['Template'] = $_SESSION['Template'];
}
if ( $carttpl && is_dir( ROOTDIR."/templates/orderforms/{$carttpl}" ) )
{
	$_SESSION['OrderFormTemplate'] = $carttpl;
}
if ( $_SESSION['OrderFormTemplate'] )
{
	$CONFIG['OrderFormTemplate'] = $_SESSION['OrderFormTemplate'];
}
if ( is_array( $_SESSION['currency'] ) )
{
	$_SESSION['currency'] = $_SESSION['currency']['id'];
}
if ( !$_SESSION['uid'] && $_REQUEST['currency'] )
{
	$result = select_query( "tblcurrencies", "id", array( "id" => (int)$_REQUEST['currency'] ) );
	$data = mysql_fetch_array( $result );
	if ( $data['id'] )
	{
		$_SESSION['currency'] = $data['id'];
	}
}
if ( !$CONFIG['Template'] )
{
	$CONFIG['Template'] = "default";
}
if ( !$CONFIG['Language'] )
{
	$CONFIG['Language'] = "English";
}
if ( substr( $PHP_SELF, 0 - 10, 10 ) != "banned.php" )
{
	$query = "DELETE FROM tblbannedips WHERE expires<now()";
	$result = full_query( $query );
	$bannedipcheck = explode( ".", $remote_ip );
	$remote_ip1 = $bannedipcheck[0].".".$bannedipcheck[1].".".$bannedipcheck[2].".*";
	$remote_ip2 = $bannedipcheck[0].".".$bannedipcheck[1].".*.*";
	$result = full_query( "SELECT * FROM tblbannedips WHERE ip='".db_escape_string( $remote_ip )."' OR ip='".db_escape_string( $remote_ip1 )."' OR ip='".db_escape_string( $remote_ip2 )."' ORDER BY id DESC" );
	@$data = @mysql_fetch_array( @$result );
	if ( $data['id'] )
	{
		header( "Location: ".$CONFIG['SystemURL']."/banned.php" );
		exit( );
	}
}
if ( defined( "CLIENTAREA" ) && ( !isset( $_SESSION['uid'] ) && isset( $_COOKIE['WHMCSUID'] ) && isset( $_COOKIE['WHMCSPW'] ) ) )
{
	$_SESSION['uid'] = $_COOKIE['WHMCSUID'];
	$_SESSION['upw'] = $_COOKIE['WHMCSPW'];
}
if ( $_SESSION['uid'] )
{
	if ( !is_numeric( $_SESSION['uid'] ) )
	{
		session_unset( );
		session_destroy( );
	}
	else
	{
		$result = select_query( "tblclients", "password", array( "id" => $_SESSION['uid'] ) );
		$data = mysql_fetch_array( $result );
		if ( is_numeric( $_SESSION['cid'] ) )
		{
			$result = select_query( "tblcontacts", "password", array( "id" => $_SESSION['cid'] ) );
			$data = mysql_fetch_array( $result );
		}
		if ( $CONFIG['DisableSessionIPCheck'] )
		{
			$haship = "";
		}
		else
		{
			$haship = $remote_ip;
		}
		if ( $_SESSION['upw'] != md5( $_SESSION['uid'].$_SESSION['cid'].$data['password'].$haship ) )
		{
			unset( $_SESSION['uid'] );
			unset( $_SESSION['cid'] );
			unset( $_SESSION['upw'] );
			setcookie( "WHMCSUID" );
			setcookie( "WHMCSPW" );
		}
	}
	if ( $_SESSION['currency'] )
	{
		$_SESSION['currency'] = "";
	}
}
$arrayoflanguagefiles = array( );
if ( defined( "CLIENTAREA" ) )
{
	$dh = opendir( ROOTDIR."/lang/" );
	while ( $dh && false !== ( $file2 = readdir( $dh ) ) )
	{
		if ( !is_dir( ROOTDIR."/lang/{$file2}" ) )
		{
			$pieces = explode( ".", $file2 );
			if ( $pieces[1] == "txt" )
			{
				$arrayoflanguagefiles[] = $pieces[0];
			}
		}
	}
	closedir( $dh );
	if ( isset( $language ) && in_array( $language, $arrayoflanguagefiles ) )
	{
		$language = strip_tags( $language );
		$_SESSION['Language'] = $language;
	}
	if ( isset( $_SESSION['Language'] ) && in_array( $_SESSION['Language'], $arrayoflanguagefiles ) )
	{
		$CONFIG['Language'] = $_SESSION['Language'];
		if ( isset( $_SESSION['uid'] ) )
		{
			update_query( "tblclients", array( "language" => $_SESSION['Language'] ), array( "id" => $_SESSION['uid'] ) );
		}
	}
}
ob_start( );
include( ROOTDIR."/lang/".$CONFIG['Language'].".txt" );
$templang = ob_get_contents( );
ob_end_clean( );
eval( $templang );
if ( defined( "CLIENTAREA" ) && $CONFIG['SystemSSLURL'] )
{
	$files = array( "aff.php", "clientarea.php", "supporttickets.php", "contact.php", "passwordreminder.php", "login.php", "logout.php", "affiliates.php", "submitticket.php", "viewemail.php", "viewinvoice.php", "viewticket.php", "creditcard.php", "register.php", "upgrade.php", "cart.php", "configuressl.php", "domainchecker.php", "networkissues.php", "pwreset.php" );
	$nonsslfiles = array( "announcements.php", "banned.php", "contact.php", "dl.php", "downloads.php", "index.php", "serverstatus.php", "tutorials.php", "whois.php", "knowledgebase.php" );
	$filename = $_SERVER['PHP_SELF'];
	$filename = substr( $filename, strrpos( $filename, "/" ) );
	$filename = str_replace( "/", "", $filename );
	$requesturl = $_SERVER['PHP_SELF']."?";
	foreach ( $_REQUEST as $key => $value )
	{
		if ( !is_array( $value ) )
		{
			$requesturl .= "{$key}=".urlencode( $value )."&";
		}
	}
	$requesturl = substr( $requesturl, 0, 0 - 1 );
	$requesturl = substr( $requesturl, strrpos( $requesturl, "/" ) );
	$ssldomain = $CONFIG['SystemSSLURL'];
	$nonssldomain = $CONFIG['SystemURL'];
	if ( in_array( $filename, $files ) || defined( "FORCESSL" ) )
	{
		if ( !$_SERVER['HTTPS'] || $_SERVER['HTTPS'] == "off" )
		{
			header( "Location: ".$ssldomain.$requesturl );
			exit( );
		}
		$in_ssl = true;
	}
	else if ( in_array( $filename, $nonsslfiles ) && $_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off" )
	{
		header( "Location: ".$nonssldomain.$requesturl );
		exit( );
	}
}
require( ROOTDIR."/includes/hookfunctions.php" );
ob_end_clean( );
?>