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
/*
This file can be uploaded to each of your linux web servers in order to
display current load and uptime statistics for the server in the Server
Status page of the WHMCS Client Area and Admin Area Homepage
*/

error_reporting( 0 );
if ( ini_get( "disable_functions" ) )
{
	$disabled_funcs = array_map( "trim", explode( ",", ini_get( "disable_functions" ) ) );
}
$action = $_GET['action'];
if ( $action == "phpinfo" )
{
	/*
	Uncoment the line below to allow users to view PHP Info for your
	server. This potentially allows access to information a malicious
	user could use to find weaknesses in your server.
	*/
	#phpinfo();
}
else
{
	$users[0] = "Unavailable";
	$users[1] = "--";
	$loadnow = "Unavailable";
	$load15 = "--";
	$load30 = "--";
	if ( in_array( "exec", $disabled_funcs ) )
	{
		$load = file_get_contents( "/proc/loadavg" );
		$load = explode( " ", $load );
		$loadnow = $load[0];
		$load15 = $load[1];
		$load30 = $load[2];
	}
	else
	{
		$reguptime = trim( exec( "uptime" ) );
		if ( $reguptime )
		{
			if ( preg_match( "/, *(\\d) (users?), .*: (.*), (.*), (.*)/", $reguptime, $uptime ) )
			{
				$users[0] = $uptime[1];
				$users[1] = $uptime[2];
				$loadnow = $uptime[3];
				$load15 = $uptime[4];
				$load30 = $uptime[5];
			}
		}
	}
	if ( in_array( "shell_exec", $disabled_funcs ) )
	{
		$uptime_text = file_get_contents( "/proc/uptime" );
		$uptime = substr( $uptime_text, 0, strpos( $uptime_text, " " ) );
	}
	else
	{
		$uptime = shell_exec( "cut -d. -f1 /proc/uptime" );
	}
	$days = floor( $uptime / 60 / 60 / 24 );
	$hours = str_pad( $uptime / 60 / 60 % 24, 2, "0", STR_PAD_LEFT );
	$mins = str_pad( $uptime / 60 % 60, 2, "0", STR_PAD_LEFT );
	$secs = str_pad( $uptime % 60, 2, "0", STR_PAD_LEFT );
	$phpver = phpversion( );
	if ( function_exists( "mysql_get_client_info()" ) )
	{
		$mysqlver = mysql_get_client_info( );
	}
	if ( function_exists( "zend_version()" ) )
	{
		$zendver = zend_version( );
	}
	echo "<load>{$loadnow}</load>\n";
	echo "<uptime>{$days} Days {$hours}:{$mins}:{$secs}</uptime>\n";
	echo "<phpver>{$phpver}</phpver>\n";
	echo "<mysqlver>{$mysqlver}</mysqlver>\n";
	echo "<zendver>{$zendver}</zendver>\n";
}
?>