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
$aInt = new adminInterface( "Browser" );
$aInt->title = $aInt->lang( "utilities", "browser" );
$aInt->sidebar = "browser";
$aInt->icon = "browser";
if ( $action == "delete" )
{
	delete_query( "tblbrowserlinks", array( "id" => $id ) );
	header( "Location: ".$_SERVER['PHP_SELF'] );
	exit( );
}
if ( $action == "add" )
{
	insert_query( "tblbrowserlinks", array( "name" => $sitename, "url" => html_entity_decode( $siteurl ) ) );
	header( "Location: ".$_SERVER['PHP_SELF'] );
	exit( );
}
$result = select_query( "tblbrowserlinks", "", "", "name", "ASC" );
while ( $data = mysql_fetch_array( $result ) )
{
	$browserlinks[] = $data;
}
$aInt->assign( "browserlinks", $browserlinks );
$content = "<iframe width=\"1000\" height=\"580\" src=\"http://anonym.to/?http://www.whmcs.com\" name=\"brwsrwnd\"></iframe>";
$jscode = "function doDelete(id) {\r\n	if (confirm(\"".$aInt->lang( "browser", "deleteq" )."\")) {\r\n		window.location='".$_SERVER['PHP_SELF']."?action=delete&id='+id;\r\n		return false;\r\n	}\r\n}\r\n";
$aInt->content = $content;
$aInt->jquerycode = $jquerycode;
$aInt->jscode = $jscode;
$aInt->display( );
?>