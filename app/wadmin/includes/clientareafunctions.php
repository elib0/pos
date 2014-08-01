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
function initialiseClientArea( $pagetitle, $pageicon, $breadcrumbnav )
{
	global $CONFIG;
	global $_LANG;
	global $templates_compiledir;
	global $in_ssl;
	global $clientsdetails;
	global $smarty;
	global $smartyvalues;
	include_once( ROOTDIR."/includes/smarty/Smarty.class.php" );
	$smarty = new Smarty( );
	$smarty->caching = 0;
	$smarty->template_dir = ROOTDIR."/templates/";
	$smarty->compile_dir = $templates_compiledir;
	$filename = $_SERVER['PHP_SELF'];
	$filename = substr( $filename, strrpos( $filename, "/" ) );
	$filename = str_replace( "/", "", $filename );
	$filename = explode( ".", $filename );
	$filename = $filename[0];
	$smarty->assign( "template", $CONFIG['Template'] );
	$smarty->assign( "language", $CONFIG['Language'] );
	$smarty->assign( "LANG", $_LANG );
	$smarty->assign( "companyname", $CONFIG['CompanyName'] );
	$smarty->assign( "charset", $CONFIG['Charset'] );
	$smarty->assign( "pagetitle", $pagetitle );
	$smarty->assign( "pageicon", $pageicon );
	$smarty->assign( "filename", $filename );
	$smarty->assign( "breadcrumbnav", $breadcrumbnav );
	$smarty->assign( "todaysdate", date( "l, jS F Y" ) );
	if ( $CONFIG['SystemSSLURL'] )
	{
		$smarty->assign( "systemsslurl", $CONFIG['SystemSSLURL']."/" );
	}
	if ( $in_ssl && $CONFIG['SystemSSLURL'] )
	{
		$smarty->assign( "systemurl", $CONFIG['SystemSSLURL']."/" );
	}
	else if ( $CONFIG['SystemURL'] != "http://www.yourdomain.com/whmcs" )
	{
		$smarty->assign( "systemurl", $CONFIG['SystemURL']."/" );
	}
	if ( $_SESSION['uid'] )
	{
		$smarty->assign( "loggedin", true );
		if ( !function_exists( "getClientsDetails" ) )
		{
			require( ROOTDIR."/includes/clientfunctions.php" );
		}
		$clientsdetails = getClientsDetails( );
		$smarty->assign( "clientsdetails", $clientsdetails );
		$smarty->assign( "clientsstats", getClientsStats( $_SESSION['uid'] ) );
		if ( $_SESSION['cid'] )
		{
			$result = select_query( "tblcontacts", "id,firstname,lastname,email,permissions", array( "id" => $_SESSION['cid'], "userid" => $_SESSION['uid'] ) );
			$data = mysql_fetch_array( $result );
			$loggedinuser = array( "contactid" => $data['id'], "firstname" => $data['firstname'], "lastname" => $data['lastname'], "email" => $data['email'] );
			$contactpermissions = explode( ",", $data[4] );
		}
		else
		{
			$loggedinuser = array( "userid" => $_SESSION['uid'], "firstname" => $clientsdetails['firstname'], "lastname" => $clientsdetails['lastname'], "email" => $clientsdetails['email'] );
			$contactpermissions = array( "profile", "contacts", "products", "manageproducts", "domains", "managedomains", "invoices", "tickets", "affiliates", "emails", "orders" );
		}
		$smarty->assign( "loggedinuser", $loggedinuser );
		$smarty->assign( "contactpermissions", $contactpermissions );
	}
	if ( $CONFIG['AllowLanguageChange'] == "on" )
	{
		$smarty->assign( "langchange", "true" );
	}
	$setlanguage = "<form method=\"post\" action=\"".$_SERVER['PHP_SELF'];
	$count = 0;
	foreach ( $_GET as $k => $v )
	{
		$prefix = $count == 0 ? "?" : "&";
		$setlanguage .= $prefix.htmlentities( $k )."=".htmlentities( $v );
		++$count;
	}
	$setlanguage .= "\" name=\"languagefrm\" id=\"languagefrm\"><strong>".$_LANG['language'].":</strong> <select name=\"language\" onchange=\"languagefrm.submit()\">";
	$dh = opendir( ROOTDIR."/lang/" );
	while ( false !== ( $file = readdir( $dh ) ) )
	{
		if ( !is_dir( ROOTDIR."/lang/{$file}" ) )
		{
			$lang = explode( ".", $file );
			if ( $lang[1] == "txt" )
			{
				$lang = $lang[0];
				$setlanguage .= "<option value=\"".$lang."\"";
				if ( isset( $_SESSION['Language'] ) && $_SESSION['Language'] == $lang )
				{
					$setlanguage .= " selected=\"selected\"";
				}
				else if ( !isset( $_SESSION['Language'] ) && $lang == $CONFIG['Language'] )
				{
					$setlanguage .= " selected=\"selected\"";
				}
				$setlanguage .= ">".$lang."</option>";
			}
		}
	}
	closedir( $dh );
	$setlanguage .= "</select></form>";
	$smarty->assign( "setlanguage", $setlanguage );
	$currenciesarray = array( );
	$result = select_query( "tblcurrencies", "id,code", "", "code", "ASC" );
	while ( $data = mysql_fetch_array( $result ) )
	{
		$currenciesarray[] = array( "id" => $data['id'], "code" => $data['code'] );
	}
	if ( count( $currenciesarray ) == 1 )
	{
		$currenciesarray = "";
	}
	$smarty->assign( "currencies", $currenciesarray );
	$smarty->assign( "twitterusername", $CONFIG['TwitterUsername'] );
	$smartyvalues = array( );
}

function outputClientArea( $templatefile, $nowrapper = false )
{
	global $CONFIG;
	global $smarty;
	global $smartyvalues;
	global $orderform;
	global $usingsupportmodule;
	global $licensing;
	global $customadminpath;

	/*
	if ( $licensing->getBrandingRemoval( ) )
	{
	*/
		$copyrighttext = "";
	/*
	}
	else
	{
		$copyrighttext = "<p align=\"center\">Powered by <a href=\"http://www.whmcs.com/\" target=\"_blank\">WHMCompleteSolution</a></p>";
	}
	*/

	if ( $_SESSION['adminid'] )
	{
		$adminloginlink = "\r\n\r\n<div style=\"position:absolute;top:0px;right:0px;padding:5px;background-color:#000066;font-family:Tahoma;font-size:11px;color:#ffffff\">Logged in as Administrator | <a href=\"".$customadminpath."/";
		if ( $_SESSION['uid'] )
		{
			$adminloginlink .= "clientssummary.php?userid=".$_SESSION['uid'];
		}
		$adminloginlink .= "\" style=\"color:#6699ff\">Return to Admin Area</a></div>\r\n\r\n";
	}
	else
	{
		$adminloginlink = "";
	}
	if ( $smartyvalues )
	{
		foreach ( $smartyvalues as $key => $value )
		{
			$smarty->assign( $key, $value );
		}
	}
	run_hook( "ClientAreaPage", array( ) );
	if ( !$nowrapper )
	{
		$header_file = $smarty->fetch( $CONFIG['Template']."/header.tpl" );
		$footer_file = $smarty->fetch( $CONFIG['Template']."/footer.tpl" );
	}
	if ( $orderform )
	{
		$body_file = $smarty->fetch( ROOTDIR."/templates/orderforms/".$CONFIG['OrderFormTemplate']."/".$templatefile.".tpl" );
	}
	else if ( $usingsupportmodule )
	{
		$body_file = $smarty->fetch( ROOTDIR."/templates/".$CONFIG['SupportModule']."/".$templatefile.".tpl" );
	}
	else if ( substr( $templatefile, 0, 1 ) == "/" )
	{
		$body_file = $smarty->fetch( ROOTDIR.$templatefile );
	}
	else
	{
		$body_file = $smarty->fetch( ROOTDIR."/templates/".$CONFIG['Template']."/".$templatefile.".tpl" );
	}
	if ( $nowrapper )
	{
		$template_output = $body_file;
	}
	else
	{
		$template_output = $header_file.$body_file.$copyrighttext.$adminloginlink.$footer_file;
	}
	echo $template_output;
}

function processSingleTemplate( $templatepath, $templatevars )
{
	global $CONFIG;
	global $smarty;
	global $smartyvalues;
	if ( $smartyvalues )
	{
		foreach ( $smartyvalues as $key => $value )
		{
			$smarty->assign( $key, $value );
		}
	}
	foreach ( $templatevars as $key => $value )
	{
		$smarty->assign( $key, $value );
	}
	$templatecode = $smarty->fetch( ROOTDIR.$templatepath );
	return $templatecode;
}

?>