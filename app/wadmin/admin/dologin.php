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
include( "../dbconnect.php" );
include( "../includes/functions.php" );
session_regenerate_id( );
$result = select_query( "tbladmins", "id,username,password", array( "username" => $username ) );
$data = mysql_fetch_array( $result );
$login_uid = $data['id'];
$login_unm = $data['username'];
$login_pwd = $data['password'];
if ( $login_uid && md5( $password ) === $login_pwd )
{
	$_SESSION['adminloggedinstatus'] = "true";
	$_SESSION['adminid'] = $login_uid;
	$haship = $CONFIG['DisableSessionIPCheck'] ? "" : $remote_ip;
	$_SESSION['adminpw'] = md5( $login_uid.$login_pwd.$haship );
	if ( $language )
	{
		$_SESSION['adminlang'] = $language;
	}
	update_query( "tbladminlog", array( "logouttime" => "now()" ), array( "adminusername " => $login_unm, "logouttime" => "00000000000000" ) );
	insert_query( "tbladminlog", array( "adminusername" => $login_unm, "logintime" => "now()", "ipaddress" => $remote_ip, "sessionid" => session_id( ) ) );
	update_query( "tbladmins", array( "loginattempts" => "0" ), array( "username" => $login_unm ) );
	if ( $rememberme )
	{
		setcookie( "WHMCSAdminID", $login_uid, time( ) + 60 * 60 * 24 * 365 );
		setcookie( "WHMCSAdminPW", $_SESSION['adminpw'], time( ) + 60 * 60 * 24 * 365 );
	}
	else
	{
		setcookie( "WHMCSAdminID", "" );
		setcookie( "WHMCSAdminPW", "" );
	}
	run_hook( "AdminLogin", array( "adminid" => $login_uid ) );
	if ( isset( $_SESSION['loginurlredirect'] ) )
	{
		header( "Location: ".$_SESSION['loginurlredirect'] );
		unset( $_SESSION['loginurlredirect'] );
	}
	else
	{
		header( "Location: index.php" );
	}
	exit( );
}
if ( $login_unm )
{
	$result = update_query( "tbladmins", array( "loginattempts" => "+1" ), array( "username" => $login_unm ) );
	$result = select_query( "tbladmins", "loginattempts", array( "username" => $login_unm ) );
	$data = mysql_fetch_array( $result );
	$loginattempts = $data['loginattempts'];
	if ( 3 <= $loginattempts )
	{
		$expire_date = mktime( date( "H" ), date( "i" ) + $CONFIG['InvalidLoginBanLength'], date( "s" ), date( "m" ), date( "d" ), date( "Y" ) );
		$expire_date = date( "Y-m-d H:i:s", $expire_date );
		insert_query( "tblbannedips", array( "ip" => $remote_ip, "reason" => "3 Invalid Login Attempts", "expires" => $expire_date ) );
		update_query( "tbladmins", array( "loginattempts" => "0" ), array( "username" => $login_unm ) );
	}
}
sendAdminNotification( "system", "WHMCS Admin Failed Login Attempt", "<p>A recent login attempt failed.  Details of the attempt are below.</p><p>Date/Time: ".date( "d/m/Y H:i:s" )."<br>Username: {$username}<br>IP Address: {$remote_ip}<br>Hostname: ".gethostbyaddr( $remote_ip )."</p>" );
logActivity( "Failed Admin Login Attempt - Username: {$username}" );
header( "Location: login.php?func=incorrect" );
?>