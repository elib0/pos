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
if ( !function_exists( "curl_init" ) )
{
	echo "<div style=\"border: 1px dashed #cc0000;font-family:Tahoma;background-color:#FBEEEB;width:100%;padding:10px;color:#cc0000;\"><strong>Critical Error</strong><br>CURL is not installed or is disabled on your server and it is required for WHMCS to run</div>";
	exit( );
}
require( "../dbconnect.php" );
require( "../includes/functions.php" );
require( "../includes/adminfunctions.php" );
if ( $licensing->keydata['productname'] == "Owned License" || $licensing->keydata['productname'] == "Owned License No Branding" )
{
	$releasedate = "20110617";
	$validversion = false;
	foreach ( $licensing->keydata['addons'] as $addon )
	{
		if ( !( $addon['name'] == "Support and Updates" ) || !( $releasedate < str_replace( "-", "", $addon['nextduedate'] ) ) )
		{
			$validversion = true;
		}
	}
	if ( !$validversion )
	{
		header( "Location: licenseerror.php?licenseerror=version" );
		exit( );
	}
}
if ( !checkPermission( "Main Homepage", true ) && checkPermission( "Support Center Overview", true ) )
{
	header( "Location: supportcenter.php" );
	exit( );
}
$aInt = new adminInterface( "Main Homepage" );
$aInt->title = $aInt->lang( "global", "hometitle" );
$aInt->sidebar = "home";
$aInt->icon = "home";
$aInt->requiredFiles( array( "clientfunctions", "invoicefunctions", "gatewayfunctions", "ccfunctions", "processinvoices" ) );
$aInt->template = "homepage";
if ( $optimize )
{
	update_query( "tblclients", array( "currency" => "1" ), array( "currency" => "0" ) );
	update_query( "tblaccounts", array( "currency" => "1" ), array( "currency" => "0", "userid" => "0" ) );
	full_query( "DELETE FROM tblinvoices WHERE userid NOT IN (SELECT id FROM tblclients)" );
	full_query( "UPDATE tbltickets SET did=(SELECT id FROM tblticketdepartments ORDER BY `order` ASC LIMIT 1) WHERE did NOT IN (SELECT id FROM tblticketdepartments)" );
	exit( );
}
if ( $action == "savenotes" )
{
	update_query( "tbladmins", array( "notes" => $notes ), array( "id" => $_SESSION['adminid'] ) );
	header( "Location: ".$_SERVER['PHP_SELF']."" );
	exit( );
}
$templatevars['licenseinfo'] = array( "registeredname" => $licensing->keydata['registeredname'], "productname" => $licensing->keydata['productname'], "expires" => $licensing->keydata['nextduedate'], "currentversion" => $CONFIG['Version'], "latestversion" => $licensing->keydata['latestversion'] );
if ( $licensing->keydata['productname'] == "15 Day Free Trial" )
{
	$templatevars['freetrial'] = true;
}
if ( $createinvoices == "true" || $generateinvoices == "true" )
{
	createInvoices( "", $noemails );
	$infoboxdescription = str_replace( "<br>", "", $cronreport );
	infoBox( $aInt->lang( "invoices", "gencomplete" ), $infoboxdescription );
}
if ( $attemptccpayments == "true" )
{
	ccProcessing( );
	$infoboxdescription = str_replace( "<br>", "", $cronreport );
	$infoboxdescription = str_replace( "Credit Card Payments: ", "", $infoboxdescription );
	infoBox( $aInt->lang( "invoices", "attemptcccapturessuccess" ), $infoboxdescription );
}
$templatevars['infobox'] = $infobox;
$addons_html = run_hook('AdminHomepage', array());
$templatevars['addons_html'] = $addons_html;
$stats = getAdminHomeStats( );
$query = "SELECT supportdepts,notes FROM tbladmins WHERE id='".$_SESSION['adminid']."'";
$result = full_query( $query );
$data = mysql_fetch_array( $result );
$supportdepts = $data['supportdepts'];
$notes = $data['notes'];
$templatevars['adminnotes'] = $notes;
$jquerycode = "$(\"textarea.expanding\").autogrow({\r\n	minHeight: 16,\r\n	lineHeight: 14\r\n});";
$query = "SELECT COUNT(*) FROM tblpaymentgateways WHERE setting='type' AND value='CC'";
$result = full_query( $query );
$data = mysql_fetch_array( $result );
if ( $data[0] )
{
	$templatevars['showattemptccbutton'] = true;
}
if ( $CONFIG['MaintenanceMode'] )
{
	$templatevars['maintenancemode'] = true;
}
$gatewaysarray = getGatewaysArray( );
$query = "SELECT tblinvoices.*,tblinvoices.total-COALESCE((SELECT SUM(amountin) FROM tblaccounts WHERE tblaccounts.invoiceid=tblinvoices.id),0) AS invoicebalance,tblclients.firstname,tblclients.lastname FROM tblinvoices INNER JOIN tblclients ON tblclients.id=tblinvoices.userid WHERE tblinvoices.status='Unpaid' ORDER BY duedate,date ASC";
$result = full_query( $query );
$templatevars['totalunpaidinvoices'] = mysql_num_rows( $result );
$query .= " LIMIT 0,5";
$result = full_query( $query );
while ( $data = mysql_fetch_array( $result ) )
{
	$id = $data['id'];
	$invoicenum = $data['invoicenum'];
	$userid = $data['userid'];
	$date = $data['date'];
	$duedate = $data['duedate'];
	$total = $data['total'];
	$invoicebalance = format_as_currency( $data['invoicebalance'] );
	$paymentmethod = $data['paymentmethod'];
	$paymentmethod = $gatewaysarray[$paymentmethod];
	$date = fromMySQLDate( $date );
	$duedate = fromMySQLDate( $duedate );
	$firstname = $data['firstname'];
	$lastname = $data['lastname'];
	$currency = getCurrency( $userid );
	if ( !$invoicenum )
	{
		$invoicenum = $id;
	}
	$unpaidinvoices[] = array( "id" => $id, "invoicenum" => $invoicenum, "userid" => $userid, "client" => $firstname." ".$lastname, "date" => $date, "duedate" => $duedate, "amount" => formatCurrency( $total ), "total" => formatCurrency( $total ), "balance" => formatCurrency( $invoicebalance ), "paymentmethod" => $paymentmethod );
}
$templatevars['unpaidinvoices'] = $unpaidinvoices;
$query = "SELECT * FROM tbltodolist WHERE status!='Completed' ORDER BY duedate ASC";
$result = full_query( $query );
while ( $data = mysql_fetch_array( $result ) )
{
	$id = $data['id'];
	$date = $data['date'];
	$title = $data['title'];
	$description = $data['description'];
	$admin = $data['admin'];
	$status = $data['status'];
	$duedate = $data['duedate'];
	$date = fromMySQLDate( $date );
	$duedate = $duedate == "0000-00-00" ? "-" : fromMySQLDate( $duedate );
	$bgcolor = $admin == $_SESSION['adminid'] ? "#f5f5d7" : "#ffffff";
	$todoitems[] = array( "id" => $id, "date" => $date, "title" => $title, "description" => $description, "duedate" => $duedate, "status" => $status, "bgcolor" => $bgcolor );
}
$templatevars['todoitems'] = $todoitems;
$query = "SELECT * FROM tblservers WHERE disabled=0 ORDER BY name ASC";
$result = full_query( $query );
while ( $data = mysql_fetch_array( $result ) )
{
	$id = $data['id'];
	$name = $data['name'];
	$ipaddress = $data['ipaddress'];
	$maxaccounts = $data['maxaccounts'];
	$statusaddress = $data['statusaddress'];
	$active = $data['active'];
	$active = $active ? "*" : "";
	$query2 = "SELECT COUNT(*) FROM tblhosting WHERE server='{$id}' AND (domainstatus='Active' OR domainstatus='Suspended')";
	$result2 = full_query( $query2 );
	$data = mysql_fetch_array( $result2 );
	$numaccounts = $data[0];
	$percentuse = @round( @$numaccounts / @$maxaccounts * 100, 0 );
	if ( $checknetwork )
	{
		$http = $serverload = $uptime = "";
		$http = @fsockopen( $ipaddress, 80, $errno, $errstr, 5 );
		$http = $http ? "Online" : "Offline";
		if ( $statusaddress )
		{
			$q = $statusaddress."index.php";
			$ch = curl_init( );
			curl_setopt( $ch, CURLOPT_URL, $q );
			curl_setopt( $ch, CURLOPT_HEADER, 0 );
			curl_setopt( $ch, CURLOPT_TIMEOUT, 5 );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
			$filecontents = curl_exec( $ch );
			if ( curl_error( $ch ) && $display_errors == "on" )
			{
				echo "Curl Error: ".curl_error( $ch );
			}
			curl_close( $ch );
			preg_match( "/\\<load\\>(.*?)\\<\\/load\\>/", $filecontents, $serverload );
			preg_match( "/\\<uptime\\>(.*?)\\<\\/uptime\\>/", $filecontents, $uptime );
			$serverload = $serverload[1];
			$uptime = $uptime[1];
			if ( !$serverload )
			{
				$serverload = "-";
			}
			if ( !$uptime )
			{
				$uptime = "-";
			}
		}
	}
	$servers[] = array( "name" => $name." ".$active, "http" => $http, "load" => $serverload, "uptime" => $uptime, "usage" => $percentuse."%" );
}
$templatevars['servers'] = $servers;
if ( checkPermission( "View Income Totals", true ) )
{
	function ah_formatstat( $billingcycle, $stat )
	{
		global $data;
		global $currency;
		global $currencytotal;
		$value = $data[$billingcycle][$stat];
		if ( !$value )
		{
			$value = 0;
		}
		if ( $stat == "sum" )
		{
			if ( $billingcycle == "Monthly" )
			{
				$currencytotal += $value * 12;
			}
			else if ( $billingcycle == "Quarterly" )
			{
				$currencytotal += $value * 4;
			}
			else if ( $billingcycle == "Semi-Annually" )
			{
				$currencytotal += $value * 2;
			}
			else if ( $billingcycle == "Annually" )
			{
				$currencytotal += $value;
			}
			else if ( $billingcycle == "Biennially" )
			{
				$currencytotal += $value / 2;
			}
			else if ( $billingcycle == "Triennially" )
			{
				$currencytotal += $value / 3;
			}
			$value = formatCurrency( $value );
		}
		return $value;
	}
	$incomestats = array( );
	$result = select_query( "tblhosting,tblclients", "currency,billingcycle,COUNT(*),SUM(amount)", "tblclients.id = tblhosting.userid AND (domainstatus = 'Active' OR domainstatus = 'Suspended') GROUP BY currency, billingcycle" );
	while ( $data = mysql_fetch_array( $result ) )
	{
		$incomestats[$data['currency']][$data['billingcycle']]['count'] = $data[2];
		$incomestats[$data['currency']][$data['billingcycle']]['sum'] = $data[3];
	}
	$result = select_query( "tblhostingaddons,tblhosting,tblclients", "currency,tblhostingaddons.billingcycle,COUNT(*),SUM(recurring)", "tblhostingaddons.hostingid=tblhosting.id AND tblclients.id=tblhosting.userid AND (tblhostingaddons.status='Active' OR tblhostingaddons.status='Suspended') GROUP BY currency, tblhostingaddons.billingcycle" );
	while ( $data = mysql_fetch_array( $result ) )
	{
		$incomestats[$data['currency']][$data['billingcycle']]['count'] += $data[2];
		$incomestats[$data['currency']][$data['billingcycle']]['sum'] += $data[3];
	}
	$result = select_query( "tbldomains,tblclients", "currency,COUNT(*),SUM(recurringamount/registrationperiod)", "tblclients.id=tbldomains.userid AND tbldomains.status='Active' GROUP BY currency" );
	while ( $data = mysql_fetch_array( $result ) )
	{
		$incomestats[$data['currency']]['Annually']['count'] += $data[1];
		$incomestats[$data['currency']]['Annually']['sum'] += $data[2];
	}
	$incomestattemp = "";
	foreach ( $incomestats as $currency => $data )
	{
		$currency = getCurrency( "", $currency );
		$currencytotal = 0;
		$incomestattemp .= "<b>&raquo; {$currency['code']} ".$aInt->lang( "currencies", "currency" )."</b><br>\r\n".$aInt->lang( "billingcycles", "monthly" ).": ".ah_formatstat( "Monthly", "sum" )." (".ah_formatstat( "Monthly", "count" ).")<br>\r\n".$aInt->lang( "billingcycles", "quarterly" ).": ".ah_formatstat( "Quarterly", "sum" )." (".ah_formatstat( "Quarterly", "count" ).")<br>\r\n".$aInt->lang( "billingcycles", "semiannually" ).": ".ah_formatstat( "Semi-Annually", "sum" )." (".ah_formatstat( "Semi-Annually", "count" ).")<br>\r\n".$aInt->lang( "billingcycles", "annually" ).": ".ah_formatstat( "Annually", "sum" )." (".ah_formatstat( "Annually", "count" ).")<br>\r\n".$aInt->lang( "billingcycles", "biennially" ).": ".ah_formatstat( "Biennially", "sum" )." (".ah_formatstat( "Biennially", "count" ).")<br>\r\n".$aInt->lang( "billingcycles", "triennially" ).": ".ah_formatstat( "Triennially", "sum" )." (".ah_formatstat( "Triennially", "count" ).")<br>\r\n<b>".$aInt->lang( "billing", "annualestimate" ).": ".formatCurrency( $currencytotal )."</b><br><br>";
	}
	$templatevars['incomestats'] = $incomestattemp;
}
$templatevars['viewincometotals'] = checkPermission( "View Income Totals", true );
$templatevars['stats'] = $stats;
$result = select_query( "tbladminlog", "", "", "lastvisit", "DESC", "0,5" );
while ( $data = mysql_fetch_array( $result ) )
{
	$recentadmins[] = array( "id" => $data['id'], "username" => $data['adminusername'], "ip" => $data['ipaddress'], "lastvisit" => fromMySQLDate( $data['lastvisit'], true ) );
}
$templatevars['recentadmins'] = $recentadmins;
$result = select_query( "tblclients", "id,firstname,lastname,ip,lastlogin", "", "lastlogin", "DESC", "0,5" );
while ( $data = mysql_fetch_array( $result ) )
{
	$recentclients[] = array( "id" => $data['id'], "firstname" => $data['firstname'], "lastname" => $data['lastname'], "ip" => $data['ip'], "lastlogin" => fromMySQLDate( $data['lastlogin'], true ) );
}
$templatevars['recentclients'] = $recentclients;
$patterns = $replacements = array( );
$patterns[] = "/User ID: (.*?) /";
$patterns[] = "/Service ID: (.*?) /";
$patterns[] = "/Domain ID: (.*?) /";
$patterns[] = "/Invoice ID: (.*?) /";
$patterns[] = "/Order ID: (.*?) /";
$patterns[] = "/Transaction ID: (.*?) /";
$replacements[] = "<a href=\"clientssummary.php?userid=$1\">User ID: $1</a> ";
$replacements[] = "<a href=\"clientshosting.php?id=$1\">Service ID: $1</a> ";
$replacements[] = "<a href=\"clientsdomains.php?id=$1\">Domain ID: $1</a> ";
$replacements[] = "<a href=\"invoices.php?action=edit&id=$1\">Invoice ID: $1</a> ";
$replacements[] = "<a href=\"orders.php?action=view&id=$1\">Order ID: $1</a> ";
$replacements[] = "<a href=\"transactions.php?action=edit&id=$1\">Transaction ID: $1</a> ";
$result = select_query( "tblactivitylog", "", "", "id", "DESC", "0,10" );
while ( $data = mysql_fetch_array( $result ) )
{
	$description = $data['description'];
	$description .= " ";
	$description = preg_replace( $patterns, $replacements, $description );
	$recentactivity[] = array( "date" => fromMySQLDate( $data['date'], true ), "description" => $description, "username" => $data['user'], "ipaddr" => $data['ipaddr'] );
}
$templatevars['recentactivity'] = $recentactivity;
$invoicedialog = $aInt->jqueryDialog( "geninvoices", $aInt->lang( "invoices", "geninvoices" ), $aInt->lang( "invoices", "geninvoicessendemails" ), array( "window.location='index.php?generateinvoices=true'", "window.location='index.php?generateinvoices=true&noemails=true'" ) );
$cccapturedialog = $aInt->jqueryDialog( "cccapture", $aInt->lang( "invoices", "attemptcccaptures" ), $aInt->lang( "invoices", "attemptcccapturessure" ), array( "window.location='index.php?attemptccpayments=true'", "" ) );
$aInt->jscode = $jscode;
$aInt->jquerycode = $jquerycode;
$aInt->templatevars = $templatevars;
$aInt->display( );
echo "<img src=\"index.php?optimize=1\" width=\"1\" height=\"1\" />";
?>