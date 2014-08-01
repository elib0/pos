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
$licensing->forceRemoteCheck( );
$aInt = new adminInterface( "Configure General Settings" );
$aInt->title = $aInt->lang( "system", "checkforupdates" );
$aInt->sidebar = "help";
$aInt->icon = "support";

// Nulled begin
ob_start ();
infobox('Update Check', 'This page has been disabled. There is no reason to check for updates using this version.');
echo $infobox;
$content = ob_get_contents ();
ob_end_clean ();
$aInt->content = $content;
$aInt->display ();
exit();
// Nulled end

ob_start( );
if ( !$licensing->keydata['latestversion'] )
{
	infoBox( $aInt->lang( "system", "updatecheck" ), $aInt->lang( "system", "connectfailed" ) );
	echo $infobox;
}
else
{
	if ( $CONFIG['Version'] != $licensing->keydata['latestversion'] )
	{
		infoBox( $aInt->lang( "system", "updatecheck" ), $aInt->lang( "system", "upgrade" )." <a href=\"http://www.whmcs.com/clients\" target=\"_blank\">".$aInt->lang( "system", "clickhere" )."</a>" );
	}
	else
	{
		infoBox( $aInt->lang( "system", "updatecheck" ), $aInt->lang( "system", "runninglatestversion" ) );
	}
	echo $infobox;
	echo "\r\n<br />\r\n\r\n<table class=\"form\" width=\"40%\" border=\"0\" cellspacing=\"2\" cellpadding=\"3\" align=\"center\">\r\n<tr><td width=\"60%\" class=\"fieldlabel\">";
	echo $aInt->lang( "system", "yourversion" );
	echo "</td><td class=\"fieldarea\">";
	echo $CONFIG['Version'];
	echo "</td></tr>\r\n<tr><td class=\"fieldlabel\">";
	echo $aInt->lang( "system", "latestversion" );
	echo "</td><td class=\"fieldarea\">";
	echo $licensing->keydata['latestversion'];
	echo "</td></tr>\r\n</table>\r\n\r\n<br><br>\r\n\r\n";
}
echo "<p>".$aInt->lang( "system", "nottranslated" ).":</p>";
$data = curlCall( "http://www.whmcs.com/members/announcementsrss.php", "" );
$data = XMLtoArray( $data );
$count = 0;
foreach ( $data['RSS']['CHANNEL'] as $name => $values )
{
	if ( $count < 8 && substr( $name, 0, 4 ) == "ITEM" )
	{
		echo "<h2>".$values['TITLE']."</h2><p>".$values['DESCRIPTION']."</p><p><i>Date: ".$values['PUBDATE']."</i></p>";
		++$count;
	}
}
$content = ob_get_contents( );
ob_end_clean( );
$aInt->content = $content;
$aInt->display( );
?>