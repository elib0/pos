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
define( "CLIENTAREA", true );
require( "dbconnect.php" );
require( "includes/functions.php" );
require( "includes/clientareafunctions.php" );
$pagetitle = $_LANG['globalsystemname'];
$breadcrumbnav = "<a href=\"index.php\">".$_LANG['globalsystemname']."</a>";
$templatefile = "homepage";
$pageicon = "";
initialiseClientArea( $pagetitle, $pageicon, $breadcrumbnav );
$result = select_query( "tblannouncements", "", array( "published" => "on" ), "date", "DESC", "0,3" );
while ( $data = mysql_fetch_array( $result ) )
{
	$id = $data['id'];
	$date = $data['date'];
	$title = $data['title'];
	$announcement = $data['announcement'];
	$result2 = select_query( "tblannouncements", "", array( "parentid" => $id, "language" => $_SESSION['Language'] ) );
	$data = mysql_fetch_array( $result2 );
	if ( $data['title'] )
	{
		$title = $data['title'];
	}
	if ( $data['announcement'] )
	{
		$announcement = $data['announcement'];
	}
	$date = fromMySQLDate( $date );
	$announcements[] = array( "id" => $id, "date" => $date, "title" => $title, "urlfriendlytitle" => getModRewriteFriendlyString( $title ), "text" => $announcement );
}
$smartyvalues['announcements'] = $announcements;
$smartyvalues['seofriendlyurls'] = $CONFIG['SEOFriendlyUrls'];
outputClientArea( $templatefile );
?>