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
function mysql_import_file( $filename )
{
	$querycount = 0;
	$queryerrors = "";
	$lines = file( $filename );
	if ( !$lines )
	{
		$errmsg = "cannot open file {$filename}";
		return false;
	}
	$scriptfile = false;
	foreach ( $lines as $line )
	{
		$line = trim( $line );
		if ( substr( $line, 0, 2 ) != "--" )
		{
			$scriptfile .= " ".$line;
		}
	}
	$queries = explode( ";", $scriptfile );
	foreach ( $queries as $query )
	{
		$query = trim( $query );
		++$querycount;
		if ( $query == "" )
		{
			continue;
		}
		if ( !mysql_query( $query ) )
		{
			$queryerrors .= "Line {$querycount} - ".mysql_error( )."<br>";
		}
	}
	if ( $queryerrors )
	{
		echo "<b>Errors Occured</b><br><br>Please open a ticket with the debug information below for support<br><br>File: {$filename}<br>{$queryerrors}";
	}
	return true;
}

function v321Upgrade( )
{
	mysql_import_file( "upgrade321.sql" );
}

function v322Upgrade( )
{
	mysql_import_file( "upgrade322.sql" );
}

function v323Upgrade( )
{
	mysql_import_file( "upgrade323.sql" );
}

function v330Upgrade( )
{
	mysql_import_file( "upgrade330.sql" );
	include( "../configuration.php" );
	$query = "SELECT id,AES_DECRYPT(cardnum,'{$cc_encryption_hash}') as cardnum,AES_DECRYPT(expdate,'{$cc_encryption_hash}') as expdate,AES_DECRYPT(issuenumber,'{$cc_encryption_hash}') as issuenumber,AES_DECRYPT(startdate,'{$cc_encryption_hash}') as startdate FROM tblclients";
	$result = mysql_query( $query );
	while ( $row = mysql_fetch_array( $result ) )
	{
		$id = $row['id'];
		$cardnum = $row['cardnum'];
		$cardexp = $row['expdate'];
		$cardissuenum = $row['issuenumber'];
		$cardstart = $row['startdate'];
		$query2 = "UPDATE tblclients SET cardnum=AES_ENCRYPT('{$cardnum}','54X6zoYZZnS35o6m5gEwGmYC6{$cc_encryption_hash}'),expdate=AES_ENCRYPT('{$cardexp}','54X6zoYZZnS35o6m5gEwGmYC6{$cc_encryption_hash}'),startdate=AES_ENCRYPT('{$cardstart}','54X6zoYZZnS35o6m5gEwGmYC6{$cc_encryption_hash}'),issuenumber=AES_ENCRYPT('{$cardissuenum}','54X6zoYZZnS35o6m5gEwGmYC6{$cc_encryption_hash}') WHERE id='{$id}'";
		$result2 = mysql_query( $query2 );
	}
}

function v340Upgrade( )
{
	mysql_import_file( "upgrade340.sql" );
	$result = mysql_query( "UPDATE tblhosting SET nextinvoicedate = nextduedate" );
	$result = mysql_query( "UPDATE tbldomains SET nextinvoicedate = nextduedate" );
	$result = mysql_query( "UPDATE tblhostingaddons SET nextinvoicedate = nextduedate" );
}

function v341Upgrade( )
{
	mysql_import_file( "upgrade341.sql" );
}

function v350Upgrade( )
{
	$query = "ALTER TABLE tblupgrades ADD `orderid` INT( 1 ) NOT NULL AFTER `id`";
	$result = mysql_query( $query );
	$query = "SELECT * FROM tblorders WHERE upgradeids!=''";
	$result = mysql_query( $query );
	while ( $data = mysql_fetch_array( $result ) )
	{
		$orderid = $data['id'];
		$upgradeids = $data['upgradeids'];
		$upgradeids = explode( ",", $upgradeids );
		foreach ( $upgradeids as $upgradeid )
		{
			if ( $upgradeid )
			{
				$query2 = "UPDATE tblupgrades SET orderid='{$orderid}' WHERE id='{$upgradeid}'";
				$result2 = mysql_query( $query2 );
			}
		}
	}
	mysql_import_file( "upgrade350.sql" );
}

function v351Upgrade( )
{
	mysql_import_file( "upgrade351.sql" );
}

function v360Upgrade( )
{
	mysql_import_file( "upgrade360.sql" );
	$query = "SELECT COUNT(*) FROM tblpaymentgateways WHERE gateway='paypal'";
	$result = mysql_query( $query );
	$data = mysql_fetch_array( $result );
	$paypalenabled = $data[0];
	if ( $paypalenabled )
	{
		$query = "INSERT INTO `tblpaymentgateways` (`id`, `gateway`, `type`, `setting`, `value`, `name`, `size`, `notes`, `description`, `order`) VALUES('', 'paypal', 'yesno', 'forceonetime', '', 'Force One Time Payments', 0, '', 'Tick this box to never show the subscription payment button', 0)";
		$result = mysql_query( $query );
	}
}

function v361Upgrade( )
{
	mysql_import_file( "upgrade361.sql" );
	include_once( "../includes/functions.php" );
	$query = "SELECT id,value FROM tblregistrars";
	$result = mysql_query( $query );
	while ( $row = mysql_fetch_array( $result ) )
	{
		$id = $row['id'];
		$value = $row['value'];
		$value = encrypt( $value );
		$query2 = "UPDATE tblregistrars SET value='{$value}' WHERE id='{$id}'";
		$result2 = mysql_query( $query2 );
	}
}

function v362Upgrade( )
{
	mysql_import_file( "upgrade362.sql" );
	mysql_query( "ALTER TABLE `tblaffiliateswithdrawals` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT , CHANGE `affiliateid` `affiliateid` INT( 10 ) NOT NULL" );
	mysql_query( "CREATE INDEX affiliateid ON tblaffiliateswithdrawals (affiliateid)" );
	$query = "SELECT * FROM tbladmins";
	$result = mysql_query( $query );
	while ( $data = mysql_fetch_array( $result ) )
	{
		$adminid = $data['id'];
		$supportdepts = $data['supportdepts'];
		$supportdepts = explode( ",", $supportdepts );
		$newsupportdepts = ",";
		foreach ( $supportdepts as $supportdept )
		{
			if ( $supportdept )
			{
				$newsupportdepts .= ltrim( $supportdept, 0 ).",";
			}
		}
		$query2 = "UPDATE tbladmins SET supportdepts='{$newsupportdepts}' WHERE id='{$adminid}'";
		$result2 = mysql_query( $query2 );
	}
}

function v370UpgradeX( $string )
{
	$key = "5a8ej8WndK\$3#9Ua425!hg741KknN";
	$result = "";
	$string = base64_decode( $string );
	$i = 0;
	while ( $i < strlen( $string ) )
	{
		$char = substr( $string, $i, 1 );
		$keychar = substr( $key, $i % strlen( $key ) - 1, 1 );
		$char = chr( ord( $char ) - ord( $keychar ) );
		$result .= $char;
		++$i;
	}
	unset( $key );
	return $result;
}

function v370Upgrade( )
{
	mysql_import_file( "upgrade370.sql" );
	include_once( "../includes/functions.php" );
	$query = "SELECT id,password FROM tblclients";
	$result = mysql_query( $query );
	while ( $row = mysql_fetch_array( $result ) )
	{
		$id = $row[0];
		$value = $row[1];
		$value = v370upgradex( $value );
		$value = encrypt( $value );
		$query2 = "UPDATE tblclients SET password='{$value}' WHERE id='{$id}'";
		$result2 = mysql_query( $query2 );
	}
	$query = "SELECT id,password FROM tblhosting";
	$result = mysql_query( $query );
	while ( $row = mysql_fetch_array( $result ) )
	{
		$id = $row[0];
		$value = $row[1];
		$value = v370upgradex( $value );
		$value = encrypt( $value );
		$query2 = "UPDATE tblhosting SET password='{$value}' WHERE id='{$id}'";
		$result2 = mysql_query( $query2 );
	}
	$query = "SELECT id,value FROM tblregistrars";
	$result = mysql_query( $query );
	while ( $row = mysql_fetch_array( $result ) )
	{
		$id = $row[0];
		$value = $row[1];
		$value = v370upgradex( $value );
		$value = encrypt( $value );
		$query2 = "UPDATE tblregistrars SET value='{$value}' WHERE id='{$id}'";
		$result2 = mysql_query( $query2 );
	}
	$query = "SELECT id,password FROM tblservers";
	$result = mysql_query( $query );
	while ( $row = mysql_fetch_array( $result ) )
	{
		$id = $row[0];
		$value = $row[1];
		$value = v370upgradex( $value );
		$value = encrypt( $value );
		$query2 = "UPDATE tblservers SET password='{$value}' WHERE id='{$id}'";
		$result2 = mysql_query( $query2 );
	}
	$general_email_merge_fields = array( );
	$general_email_merge_fields['CustomerID'] = "client_id";
	$general_email_merge_fields['CustomerName'] = "client_name";
	$general_email_merge_fields['CustomerFirstName'] = "client_first_name";
	$general_email_merge_fields['CustomerLastName'] = "client_last_name";
	$general_email_merge_fields['CompanyName'] = "client_company_name";
	$general_email_merge_fields['CustomerEmail'] = "client_email";
	$general_email_merge_fields['Address1'] = "client_address1";
	$general_email_merge_fields['Address2'] = "client_address2";
	$general_email_merge_fields['City'] = "client_city";
	$general_email_merge_fields['State'] = "client_state";
	$general_email_merge_fields['Postcode'] = "client_postcode";
	$general_email_merge_fields['Country'] = "client_country";
	$general_email_merge_fields['PhoneNumber'] = "client_phonenumber";
	$general_email_merge_fields['MAPassword'] = "client_password";
	$general_email_merge_fields['CAPassword'] = "client_password";
	$general_email_merge_fields['CreditBalance'] = "client_credit";
	$general_email_merge_fields['CCType'] = "client_cc_type";
	$general_email_merge_fields['CCLastFour'] = "client_cc_number";
	$general_email_merge_fields['CCExpiryDate'] = "client_cc_expiry";
	$general_email_merge_fields['SystemCompanyName'] = "company_name";
	$general_email_merge_fields['ClientAreaLink'] = "whmcs_url";
	$general_email_merge_fields['Signature'] = "signature";
	$general_email_merge_fields['http://smartftp.com'] = "http://www.filezilla-project.org/";
	$general_email_merge_fields['smart ftp'] = "FileZilla";
	$email_merge_fields = array( );
	$email_merge_fields['InvoiceID'] = "invoice_id";
	$email_merge_fields['InvoiceNo'] = "invoice_num";
	$email_merge_fields['InvoiceNum'] = "invoice_num";
	$email_merge_fields['InvoiceDate'] = "invoice_date_created";
	$email_merge_fields['DueDate'] = "invoice_date_due";
	$email_merge_fields['DatePaid'] = "invoice_date_paid";
	$email_merge_fields['Description'] = "invoice_html_contents";
	$email_merge_fields['SubTotal'] = "invoice_subtotal";
	$email_merge_fields['Credit'] = "invoice_credit";
	$email_merge_fields['Tax'] = "invoice_tax";
	$email_merge_fields['TaxRate'] = "invoice_tax_rate";
	$email_merge_fields['Total'] = "invoice_total";
	$email_merge_fields['AmountDue'] = "invoice_total";
	$email_merge_fields['AmountPaid'] = "invoice_amount_paid";
	$email_merge_fields['Balance'] = "invoice_balance";
	$email_merge_fields['LastPaymentAmount'] = "invoice_last_payment_amount";
	$email_merge_fields['Status'] = "invoice_status";
	$email_merge_fields['TransactionID'] = "invoice_last_payment_transid";
	$email_merge_fields['PayButton'] = "invoice_payment_link";
	$email_merge_fields['PaymentMethod'] = "invoice_payment_method";
	$email_merge_fields['InvoiceLink'] = "invoice_link";
	$email_merge_fields['PreviousBalance'] = "invoice_previous_balance";
	$email_merge_fields['AllDueInvoices'] = "invoice_all_due_total";
	$email_merge_fields['TotalBalanceDue'] = "invoice_total_balance_due";
	$query = "SELECT * FROM tblemailtemplates WHERE type='invoice'";
	$result = mysql_query( $query );
	while ( $data = mysql_fetch_array( $result ) )
	{
		$email_id = $data['id'];
		$email_subject = $data['subject'];
		$email_message = $data['message'];
		foreach ( $email_merge_fields as $old_email_merge_fields => $new_email_merge_fields )
		{
			$email_subject = str_replace( "[".$old_email_merge_fields."]", "{\$".$new_email_merge_fields."}", $email_subject );
			$email_message = str_replace( "[".$old_email_merge_fields."]", "{\$".$new_email_merge_fields."}", $email_message );
		}
		foreach ( $general_email_merge_fields as $old_email_merge_fields => $new_email_merge_fields )
		{
			$email_subject = str_replace( "[".$old_email_merge_fields."]", "{\$".$new_email_merge_fields."}", $email_subject );
			$email_message = str_replace( "[".$old_email_merge_fields."]", "{\$".$new_email_merge_fields."}", $email_message );
		}
		$query = "UPDATE tblemailtemplates SET subject='".mysql_real_escape_string( $email_subject )."',message='".mysql_real_escape_string( $email_message )."' WHERE id='{$email_id}'";
		$result2 = mysql_query( $query );
	}
	$email_merge_fields = array( );
	$email_merge_fields['OrderID'] = "domain_order_id";
	$email_merge_fields['RegDate'] = "domain_reg_date";
	$email_merge_fields['Status'] = "domain_status";
	$email_merge_fields['Domain'] = "domain_name";
	$email_merge_fields['Amount'] = "domain_first_payment_amount";
	$email_merge_fields['FirstPaymentAmount'] = "domain_first_payment_amount";
	$email_merge_fields['RecurringAmount'] = "domain_recurring_amount";
	$email_merge_fields['Registrar'] = "domain_registrar";
	$email_merge_fields['RegPeriod'] = "domain_reg_period";
	$email_merge_fields['ExpiryDate'] = "domain_expiry_date";
	$email_merge_fields['NextDueDate'] = "domain_next_due_date";
	$email_merge_fields['DaysUntilExpiry'] = "domain_days_until_expiry";
	$query = "SELECT * FROM tblemailtemplates WHERE type='domain'";
	$result = mysql_query( $query );
	while ( $data = mysql_fetch_array( $result ) )
	{
		$email_id = $data['id'];
		$email_subject = $data['subject'];
		$email_message = $data['message'];
		foreach ( $email_merge_fields as $old_email_merge_fields => $new_email_merge_fields )
		{
			$email_subject = str_replace( "[".$old_email_merge_fields."]", "{\$".$new_email_merge_fields."}", $email_subject );
			$email_message = str_replace( "[".$old_email_merge_fields."]", "{\$".$new_email_merge_fields."}", $email_message );
		}
		foreach ( $general_email_merge_fields as $old_email_merge_fields => $new_email_merge_fields )
		{
			$email_subject = str_replace( "[".$old_email_merge_fields."]", "{\$".$new_email_merge_fields."}", $email_subject );
			$email_message = str_replace( "[".$old_email_merge_fields."]", "{\$".$new_email_merge_fields."}", $email_message );
		}
		$query = "UPDATE tblemailtemplates SET subject='".mysql_real_escape_string( $email_subject )."',message='".mysql_real_escape_string( $email_message )."' WHERE id='{$email_id}'";
		$result2 = mysql_query( $query );
	}
	$email_merge_fields = array( );
	$email_merge_fields['Name'] = "client_name";
	$email_merge_fields['TicketID'] = "ticket_id";
	$email_merge_fields['Department'] = "ticket_department";
	$email_merge_fields['DateOpened'] = "ticket_date_opened";
	$email_merge_fields['Subject'] = "ticket_subject";
	$email_merge_fields['Message'] = "ticket_message";
	$email_merge_fields['Status'] = "ticket_status";
	$email_merge_fields['Priority'] = "ticket_priority";
	$email_merge_fields['TicketURL'] = "ticket_url";
	$email_merge_fields['TicketLink'] = "ticket_link";
	$email_merge_fields['AutoCloseTime'] = "ticket_auto_close_time";
	$query = "SELECT * FROM tblemailtemplates WHERE type='support'";
	$result = mysql_query( $query );
	while ( $data = mysql_fetch_array( $result ) )
	{
		$email_id = $data['id'];
		$email_subject = $data['subject'];
		$email_message = $data['message'];
		foreach ( $email_merge_fields as $old_email_merge_fields => $new_email_merge_fields )
		{
			$email_subject = str_replace( "[".$old_email_merge_fields."]", "{\$".$new_email_merge_fields."}", $email_subject );
			$email_message = str_replace( "[".$old_email_merge_fields."]", "{\$".$new_email_merge_fields."}", $email_message );
		}
		foreach ( $general_email_merge_fields as $old_email_merge_fields => $new_email_merge_fields )
		{
			$email_subject = str_replace( "[".$old_email_merge_fields."]", "{\$".$new_email_merge_fields."}", $email_subject );
			$email_message = str_replace( "[".$old_email_merge_fields."]", "{\$".$new_email_merge_fields."}", $email_message );
		}
		$query = "UPDATE tblemailtemplates SET subject='".mysql_real_escape_string( $email_subject )."',message='".mysql_real_escape_string( $email_message )."' WHERE id='{$email_id}'";
		$result2 = mysql_query( $query );
	}
	$email_merge_fields = array( );
	$email_merge_fields['OrderID'] = "service_order_id";
	$email_merge_fields['ProductID'] = "service_id";
	$email_merge_fields['RegDate'] = "service_reg_date";
	$email_merge_fields['Domain'] = "service_domain";
	$email_merge_fields['domain'] = "service_domain";
	$email_merge_fields['ServerName'] = "service_server_name";
	$email_merge_fields['ServerIP'] = "service_server_ip";
	$email_merge_fields['serverip'] = "service_server_ip";
	$email_merge_fields['DedicatedIP'] = "service_dedicated_ip";
	$email_merge_fields['AssignedIPs'] = "service_assigned_ips";
	$email_merge_fields['Nameserver1'] = "service_ns1";
	$email_merge_fields['Nameserver2'] = "service_ns2";
	$email_merge_fields['Nameserver3'] = "service_ns3";
	$email_merge_fields['Nameserver4'] = "service_ns4";
	$email_merge_fields['Nameserver1IP'] = "service_ns1_ip";
	$email_merge_fields['Nameserver2IP'] = "service_ns2_ip";
	$email_merge_fields['Nameserver3IP'] = "service_ns3_ip";
	$email_merge_fields['Nameserver4IP'] = "service_ns4_ip";
	$email_merge_fields['Product'] = "service_product_name";
	$email_merge_fields['Package'] = "service_product_name";
	$email_merge_fields['ConfigOptions'] = "service_config_options_html";
	$email_merge_fields['PaymentMethod'] = "service_payment_method";
	$email_merge_fields['Amount'] = "service_recurring_amount";
	$email_merge_fields['FirstPaymentAmount'] = "service_first_payment_amount";
	$email_merge_fields['RecurringAmount'] = "service_recurring_amount";
	$email_merge_fields['BillingCycle'] = "service_billing_cycle";
	$email_merge_fields['NextDueDate'] = "service_next_due_date";
	$email_merge_fields['Status'] = "service_status";
	$email_merge_fields['Username'] = "service_username";
	$email_merge_fields['Password'] = "service_password";
	$email_merge_fields['CpanelUsername'] = "service_username";
	$email_merge_fields['CpanelPassword'] = "service_password";
	$email_merge_fields['RootUsername'] = "service_username";
	$email_merge_fields['RootPassword'] = "service_password";
	$email_merge_fields['OrderNumber'] = "order_number";
	$email_merge_fields['OrderDetails'] = "order_details";
	$email_merge_fields['SSLConfigurationLink'] = "ssl_configuration_link";
	$query = "SELECT * FROM tblemailtemplates WHERE type='product'";
	$result = mysql_query( $query );
	while ( $data = mysql_fetch_array( $result ) )
	{
		$email_id = $data['id'];
		$email_subject = $data['subject'];
		$email_message = $data['message'];
		foreach ( $email_merge_fields as $old_email_merge_fields => $new_email_merge_fields )
		{
			$email_subject = str_replace( "[".$old_email_merge_fields."]", "{\$".$new_email_merge_fields."}", $email_subject );
			$email_message = str_replace( "[".$old_email_merge_fields."]", "{\$".$new_email_merge_fields."}", $email_message );
		}
		foreach ( $general_email_merge_fields as $old_email_merge_fields => $new_email_merge_fields )
		{
			$email_subject = str_replace( "[".$old_email_merge_fields."]", "{\$".$new_email_merge_fields."}", $email_subject );
			$email_message = str_replace( "[".$old_email_merge_fields."]", "{\$".$new_email_merge_fields."}", $email_message );
		}
		$query = "UPDATE tblemailtemplates SET subject='".mysql_real_escape_string( $email_subject )."',message='".mysql_real_escape_string( $email_message )."' WHERE id='{$email_id}'";
		$result2 = mysql_query( $query );
	}
	$email_merge_fields = array( );
	$email_merge_fields['TotalVisitors'] = "affiliate_total_visits";
	$email_merge_fields['CurrentBalance'] = "affiliate_balance";
	$email_merge_fields['AmountWithdrawn'] = "affiliate_withdrawn";
	$email_merge_fields['ReferralsTable'] = "affiliate_referrals_table";
	$email_merge_fields['ReferralLink'] = "affiliate_referral_url";
	$query = "SELECT * FROM tblemailtemplates WHERE type='affiliate'";
	$result = mysql_query( $query );
	while ( $data = mysql_fetch_array( $result ) )
	{
		$email_id = $data['id'];
		$email_subject = $data['subject'];
		$email_message = $data['message'];
		foreach ( $email_merge_fields as $old_email_merge_fields => $new_email_merge_fields )
		{
			$email_subject = str_replace( "[".$old_email_merge_fields."]", "{\$".$new_email_merge_fields."}", $email_subject );
			$email_message = str_replace( "[".$old_email_merge_fields."]", "{\$".$new_email_merge_fields."}", $email_message );
		}
		foreach ( $general_email_merge_fields as $old_email_merge_fields => $new_email_merge_fields )
		{
			$email_subject = str_replace( "[".$old_email_merge_fields."]", "{\$".$new_email_merge_fields."}", $email_subject );
			$email_message = str_replace( "[".$old_email_merge_fields."]", "{\$".$new_email_merge_fields."}", $email_message );
		}
		$query = "UPDATE tblemailtemplates SET subject='".mysql_real_escape_string( $email_subject )."',message='".mysql_real_escape_string( $email_message )."' WHERE id='{$email_id}'";
		$result2 = mysql_query( $query );
	}
	$query = "SELECT * FROM tblemailtemplates WHERE type='general'";
	$result = mysql_query( $query );
	while ( $data = mysql_fetch_array( $result ) )
	{
		$email_id = $data['id'];
		$email_subject = $data['subject'];
		$email_message = $data['message'];
		foreach ( $general_email_merge_fields as $old_email_merge_fields => $new_email_merge_fields )
		{
			$email_subject = str_replace( "[".$old_email_merge_fields."]", "{\$".$new_email_merge_fields."}", $email_subject );
			$email_message = str_replace( "[".$old_email_merge_fields."]", "{\$".$new_email_merge_fields."}", $email_message );
		}
		$query = "UPDATE tblemailtemplates SET subject='".mysql_real_escape_string( $email_subject )."',message='".mysql_real_escape_string( $email_message )."' WHERE id='{$email_id}'";
		$result2 = mysql_query( $query );
	}
}

function v371Upgrade( )
{
	mysql_import_file( "upgrade371.sql" );
}

function v372Upgrade( )
{
	mysql_import_file( "upgrade372.sql" );
}

function v380Upgrade( )
{
	$query = "ALTER TABLE `tblcustomfields` DROP `num` ;";
	$result = mysql_query( $query );
	mysql_query( "INSERT INTO `tblconfiguration` (`setting`, `value`) VALUES ('EmailCSS', 'body,td { font-family: verdana; font-size: 11px; font-weight: normal; }\na { color: #0000ff; }')" );
	mysql_import_file( "upgrade380.sql" );
	$query = "SELECT DISTINCT gid FROM tblproductconfigoptions";
	$result = mysql_query( $query );
	while ( $data = mysql_fetch_array( $result ) )
	{
		$productconfigoptionspid = $data['gid'];
		$query = "INSERT INTO tblproductconfiggroups (id,name,description) VALUES ('{$productconfigoptionspid}','Default Options','For product ID {$productconfigoptionspid} - created by upgrade script')";
		$result2 = mysql_query( $query );
		$query = "INSERT INTO tblproductconfiglinks (gid,pid) VALUES ('{$productconfigoptionspid}','{$productconfigoptionspid}')";
		$result2 = mysql_query( $query );
	}
}

function v381Upgrade( )
{
	mysql_import_file( "upgrade381.sql" );
}

function v382Upgrade( )
{
	mysql_import_file( "upgrade382.sql" );
}

function V4generateClientPW( $plain, $salt = "" )
{
	if ( !$salt )
	{
		$seeds = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ#!%()#!%()#!%()";
		$seeds_count = strlen( $seeds ) - 1;
		$i = 0;
		while ( $i < 5 )
		{
			$salt .= $seeds[rand( 0, $seeds_count )];
			++$i;
		}
	}
	$pw = md5( $salt.html_entity_decode( $plain ) ).":".$salt;
	return $pw;
}

function v400Upgrade( )
{
	global $license;
	include_once( "../includes/functions.php" );
	if ( !$_REQUEST['nomd5'] )
	{
		$query = "SELECT id, password FROM tblclients";
		$result = mysql_query( $query );
		while ( $data = mysql_fetch_assoc( $result ) )
		{
			$password = decrypt( $data['password'] );
			$password = v4generateclientpw( $password );
			$id = $data['id'];
			$upd_query = "UPDATE tblclients SET password = '".$password."' WHERE id = ".$id.";";
			mysql_query( $upd_query );
		}
		$query = "INSERT into tblconfiguration VALUES ('NOMD5', '');";
		mysql_query( $query );
	}
	else
	{
		$query = "INSERT into tblconfiguration VALUES ('NOMD5', 'on');";
		mysql_query( $query );
	}
	mysql_import_file( "upgrade400.sql" );
	$query = "SELECT id, category FROM tblknowledgebase";
	$result = mysql_query( $query );
	while ( $data = mysql_fetch_assoc( $result ) )
	{
		$id = $data['id'];
		$category = $data['category'];
		$query = "INSERT INTO tblknowledgebaselinks (categoryid,articleid) VALUES ('{$category}','{$id}')";
		mysql_query( $query );
	}
	mysql_query( "ALTER TABLE `tblknowledgebase` DROP `category`" );
	$existingcurrency = array( );
	$query = "SELECT * FROM tblconfiguration WHERE setting LIKE 'Currency%'";
	$result = mysql_query( $query );
	while ( $data = mysql_fetch_assoc( $result ) )
	{
		$existingcurrency[$data['setting']] = $data['value'];
	}
	$query = "TRUNCATE tblcurrencies";
	mysql_query( $query );
	$query = "INSERT INTO `tblcurrencies` (`id`, `code`, `prefix`, `suffix`, `format`, `rate`, `default`) VALUES\r\n(1, '".$existingcurrency['Currency']."', '".$existingcurrency['CurrencySymbol']."', ' ".$existingcurrency['Currency']."', 1, 1.00000, 1)";
	mysql_query( $query );
	$query = "DELETE FROM tblconfiguration WHERE setting='Currency' OR setting='CurrencySymbol'";
	mysql_query( $query );
	$query = "SELECT * FROM tblproducts WHERE paytype!='free' ORDER BY id ASC";
	$result = mysql_query( $query );
	while ( $data = mysql_fetch_assoc( $result ) )
	{
		$id = $data['id'];
		$paytype = $data['paytype'];
		$msetupfee = $data['msetupfee'];
		$qsetupfee = $data['qsetupfee'];
		$ssetupfee = $data['ssetupfee'];
		$asetupfee = $data['asetupfee'];
		$bsetupfee = $data['bsetupfee'];
		$monthly = $data['monthly'];
		$quarterly = $data['quarterly'];
		$semiannual = $data['semiannual'];
		$annual = $data['annual'];
		$biennial = $data['biennial'];
		if ( $paytype == "recurring" )
		{
			if ( $monthly <= 0 )
			{
				$monthly = "-1";
			}
			if ( $quarterly <= 0 )
			{
				$quarterly = "-1";
			}
			if ( $semiannual <= 0 )
			{
				$semiannual = "-1";
			}
			if ( $annual <= 0 )
			{
				$annual = "-1";
			}
			if ( $biennial <= 0 )
			{
				$biennial = "-1";
			}
		}
		$query = "INSERT INTO tblpricing (type,currency,relid,msetupfee,qsetupfee,ssetupfee,asetupfee,bsetupfee,monthly,quarterly,semiannually,annually,biennially) VALUES ('product','1','{$id}','{$msetupfee}','{$qsetupfee}','{$ssetupfee}','{$asetupfee}','{$bsetupfee}','{$monthly}','{$quarterly}','{$semiannual}','{$annual}','{$biennial}')";
		mysql_query( $query );
	}
	$query = "SELECT * FROM tblproductconfigoptionssub ORDER BY id ASC";
	$result = mysql_query( $query );
	while ( $data = mysql_fetch_assoc( $result ) )
	{
		$id = $data['id'];
		$setup = $data['setup'];
		$monthly = $data['monthly'];
		$quarterly = $data['quarterly'];
		$semiannual = $data['semiannual'];
		$annual = $data['annual'];
		$biennial = $data['biennial'];
		$query = "INSERT INTO tblpricing (type,currency,relid,msetupfee,qsetupfee,ssetupfee,asetupfee,bsetupfee,monthly,quarterly,semiannually,annually,biennially) VALUES ('configoptions','1','{$id}','{$setup}','{$setup}','{$setup}','{$setup}','{$setup}','{$monthly}','{$quarterly}','{$semiannual}','{$annual}','{$biennial}')";
		mysql_query( $query );
	}
	$query = "SELECT * FROM tbladdons ORDER BY id ASC";
	$result = mysql_query( $query );
	while ( $data = mysql_fetch_assoc( $result ) )
	{
		$id = $data['id'];
		$setupfee = $data['setupfee'];
		$recurring = $data['recurring'];
		$query = "INSERT INTO tblpricing (type,currency,relid,msetupfee,qsetupfee,ssetupfee,asetupfee,bsetupfee,monthly,quarterly,semiannually,annually,biennially) VALUES ('addon','1','{$id}','{$setupfee}','0','0','0','0','{$recurring}','0','0','0','0')";
		mysql_query( $query );
	}
	$domainpricing = array( );
	$query = "SELECT * FROM tbldomainpricing ORDER BY id ASC";
	$result = mysql_query( $query );
	while ( $data = mysql_fetch_assoc( $result ) )
	{
		$extension = $data['extension'];
		$regperiod = $data['registrationperiod'];
		if ( $data['register'] != "0.00" && $data['transfer'] <= 0 )
		{
			$data['transfer'] = "-1";
		}
		if ( $data['register'] != "0.00" && $data['renew'] <= 0 )
		{
			$data['renew'] = "-1";
		}
		$domainpricing[$extension][$regperiod]['register'] = $data['register'];
		$domainpricing[$extension][$regperiod]['transfer'] = $data['transfer'];
		$domainpricing[$extension][$regperiod]['renew'] = $data['renew'];
	}
	$query = "SELECT DISTINCT extension FROM tbldomainpricing";
	$result = mysql_query( $query );
	while ( $data = mysql_fetch_assoc( $result ) )
	{
		$extension = $data['extension'];
		$query = "SELECT id FROM tbldomainpricing WHERE extension='{$extension}' ORDER BY registrationperiod ASC";
		$result2 = mysql_query( $query );
		$data = mysql_fetch_assoc( $result2 );
		$id = $data['id'];
		$query = "DELETE FROM tbldomainpricing WHERE extension='{$extension}' AND id!='{$id}'";
		mysql_query( $query );
	}
	$query = "SELECT * FROM tbldomainpricing ORDER BY id ASC";
	$result = mysql_query( $query );
	while ( $data = mysql_fetch_assoc( $result ) )
	{
		$id = $data['id'];
		$extension = $data['extension'];
		$inserttype = "register";
		$query = "INSERT INTO tblpricing (type,currency,relid,msetupfee,qsetupfee,ssetupfee,asetupfee,bsetupfee,monthly,quarterly,semiannually,annually,biennially) VALUES ('domain".$inserttype."','1','{$id}','".$domainpricing[$extension][1][$inserttype]."','".$domainpricing[$extension][2][$inserttype]."','".$domainpricing[$extension][3][$inserttype]."','".$domainpricing[$extension][4][$inserttype]."','".$domainpricing[$extension][5][$inserttype]."','".$domainpricing[$extension][6][$inserttype]."','".$domainpricing[$extension][7][$inserttype]."','".$domainpricing[$extension][8][$inserttype]."','".$domainpricing[$extension][9][$inserttype]."','".$domainpricing[$extension][10][$inserttype]."')";
		mysql_query( $query );
		$inserttype = "transfer";
		$query = "INSERT INTO tblpricing (type,currency,relid,msetupfee,qsetupfee,ssetupfee,asetupfee,bsetupfee,monthly,quarterly,semiannually,annually,biennially) VALUES ('domain".$inserttype."','1','{$id}','".$domainpricing[$extension][1][$inserttype]."','".$domainpricing[$extension][2][$inserttype]."','".$domainpricing[$extension][3][$inserttype]."','".$domainpricing[$extension][4][$inserttype]."','".$domainpricing[$extension][5][$inserttype]."','".$domainpricing[$extension][6][$inserttype]."','".$domainpricing[$extension][7][$inserttype]."','".$domainpricing[$extension][8][$inserttype]."','".$domainpricing[$extension][9][$inserttype]."','".$domainpricing[$extension][10][$inserttype]."')";
		mysql_query( $query );
		$inserttype = "renew";
		$query = "INSERT INTO tblpricing (type,currency,relid,msetupfee,qsetupfee,ssetupfee,asetupfee,bsetupfee,monthly,quarterly,semiannually,annually,biennially) VALUES ('domain".$inserttype."','1','{$id}','".$domainpricing[$extension][1][$inserttype]."','".$domainpricing[$extension][2][$inserttype]."','".$domainpricing[$extension][3][$inserttype]."','".$domainpricing[$extension][4][$inserttype]."','".$domainpricing[$extension][5][$inserttype]."','".$domainpricing[$extension][6][$inserttype]."','".$domainpricing[$extension][7][$inserttype]."','".$domainpricing[$extension][8][$inserttype]."','".$domainpricing[$extension][9][$inserttype]."','".$domainpricing[$extension][10][$inserttype]."')";
		mysql_query( $query );
	}
	mysql_query( "ALTER TABLE `tblproducts` DROP `msetupfee`,DROP `qsetupfee`,DROP `ssetupfee`,DROP `asetupfee`,DROP `bsetupfee`,DROP `monthly`,DROP `quarterly`,DROP `semiannual`,DROP `annual`,DROP `biennial`" );
	mysql_query( "ALTER TABLE `tbldomainpricing`  DROP `registrationperiod`,  DROP `register`,  DROP `transfer`,  DROP `renew`" );
	mysql_query( "ALTER TABLE `tblproductconfigoptionssub` DROP `setup`,DROP `monthly`,DROP `quarterly`,DROP `semiannual`,DROP `annual`,DROP `biennial`" );
	mysql_query( "ALTER TABLE `tbladdons`  DROP `recurring`,  DROP `setupfee`" );
	mysql_query( "ALTER TABLE `mod_licensing` ADD `lastaccess` DATE NOT NULL" );
	/*
	$ch = curl_init( );
	curl_setopt( $ch, CURLOPT_URL, "http://www.whmcs.com/license/v4upgrade.php?licensekey=".$license );
	curl_setopt( $ch, CURLOPT_TIMEOUT, 30 );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	$data = curl_exec( $ch );
	curl_close( $ch );
	*/
}

function v401Upgrade( )
{
	mysql_import_file( "upgrade401.sql" );
}

function v410Upgrade( )
{
	mysql_import_file( "upgrade410.sql" );
	include( "../configuration.php" );
	$query = "SELECT id,AES_DECRYPT(cardnum,'54X6zoYZZnS35o6m5gEwGmYC6{$cc_encryption_hash}') as cardnum,AES_DECRYPT(expdate,'54X6zoYZZnS35o6m5gEwGmYC6{$cc_encryption_hash}') as expdate,AES_DECRYPT(issuenumber,'54X6zoYZZnS35o6m5gEwGmYC6{$cc_encryption_hash}') as issuenumber,AES_DECRYPT(startdate,'54X6zoYZZnS35o6m5gEwGmYC6{$cc_encryption_hash}') as startdate FROM tblclients WHERE cardnum!=''";
	$result = mysql_query( $query );
	while ( $row = mysql_fetch_array( $result ) )
	{
		$userid = $row['id'];
		$cardnum = $row['cardnum'];
		$cardexp = $row['expdate'];
		$cardissuenum = $row['issuenumber'];
		$cardstart = $row['startdate'];
		$cardlastfour = substr( $cardnum, 0 - 4 );
		$cchash = md5( $cc_encryption_hash.$userid );
		$query2 = "UPDATE tblclients SET cardlastfour='{$cardlastfour}',cardnum=AES_ENCRYPT('{$cardnum}','{$cchash}'),expdate=AES_ENCRYPT('{$cardexp}','{$cchash}'),startdate=AES_ENCRYPT('{$cardstart}','{$cchash}'),issuenumber=AES_ENCRYPT('{$cardissuenum}','{$cchash}') WHERE id='{$userid}'";
		$result2 = mysql_query( $query2 );
	}
}

function v411Upgrade( )
{
	mysql_import_file( "upgrade411.sql" );
}

function v412Upgrade( )
{
	mysql_import_file( "upgrade412.sql" );
}

function v420Upgrade( )
{
	mysql_import_file( "upgrade420.sql" );
}

function v421Upgrade( )
{
	mysql_import_file( "upgrade421.sql" );
}

function v430Upgrade( )
{
	mysql_import_file( "upgrade430.sql" );
	$query = "UPDATE tblconfiguration SET value='ssl' where setting = 'SMTPSSL' and value='on';";
	mysql_query( $query );
}

function v431Upgrade( )
{
	mysql_import_file( "upgrade431.sql" );
	$query = "UPDATE tblconfiguration SET value='cart' where setting = 'OrderFormTemplate' and value='singlepage';";
	mysql_query( $query );
}

function v440Upgrade( )
{
	mysql_import_file( "upgrade440.sql" );
}

function v441Upgrade( )
{
	mysql_import_file( "upgrade441.sql" );
}

function v442Upgrade( )
{
	mysql_import_file( "upgrade442.sql" );
	$query = "INSERT INTO tblconfiguration (setting,value) VALUES ('CCDoNotRemoveOnExpiry','')";
	mysql_query( $query );
}

function v450Upgrade( )
{
	$query = "UPDATE tblemailtemplates SET name='Hosting Account Welcome Email' WHERE name='Hosting Account Welcome Email (cPanel)'";
	mysql_query( $query );
	$query = "UPDATE tblemailtemplates SET custom='1' WHERE name='Hosting Account Welcome Email (DirectAdmin)'";
	mysql_query( $query );
	$query = "UPDATE tblemailtemplates SET custom='1' WHERE name='Hosting Account Welcome Email (Plesk)'";
	mysql_query( $query );
	mysql_import_file( "upgrade450.sql" );
}

function v451Upgrade( )
{
	mysql_import_file( "upgrade451.sql" );
}

function v452Upgrade( )
{
	mysql_query( "ALTER TABLE `tblsslorders` CHANGE `status` `status` TEXT NOT NULL" );
	mysql_query( "UPDATE `tblsslorders` SET status='Awaiting Configuration' WHERE status='Incomplete'" );
	mysql_query( "ALTER TABLE `tblsslorders` ADD `configdata` TEXT NOT NULL AFTER `certtype`" );
	mysql_import_file( "upgrade452.sql" );
}

error_reporting( 0 );
@set_time_limit( 0 );
define( "ROOTDIR", dirname( __FILE__ )."/../" );
$latestversion = "4.5.2";
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n\t<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<title>WHMCS Install/Upgrade</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">\r\n<link href=\"../templates/default/style.css\" rel=\"stylesheet\" type=\"text/css\">\r\n</head>\r\n<body>\r\n\r\n<div class=\"wrapper\">\r\n";
echo "\r\n<img src=\"../templates/default/header.jpg\" width=\"730\" height=\"118\" alt=\"\" />\r\n\r\n<br />\r\n\r\n";
$step = $_REQUEST['step'];
$type = $_REQUEST['type'];
$version = $_REQUEST['version'];
if ( $step == "" )
{
	echo "\r\n<p><b>End User License Agreement</b></p>\r\n<p>Please review the license terms before installing/upgrading WHMCS.  By installing, copying, or otherwise using the software, you are agreeing to be bound by the terms of the EULA.</p>\r\n<p align=\"center\"><textarea style=\"width:700px;font-family:Tahoma;font-size:10px;color:#666666\" rows=\"25\" readonly>\r\nWHMCompleteSolution Software License Agreement\r\n\r\nPlease re";
	echo "ad this End-User License Agreement (the \"EULA\")\r\n\r\nIMPORTANT --- READ CAREFULLY. By installing, copying, or otherwise using the Software, you are agreeing to be bound by the terms of this EULA, including the WARRANTY DISCLAIMERS, LIMITATIONS OF LIABILITY, and TERMINATION PROVISIONS. If you do not agree to the terms of this EULA do not install or use the Software.\r\n\r\nLICENSE TERMS\r\n\r\n1. The Softwar";
	echo "e is supplied by WHMCompleteSolution and is licensed, not sold, under the terms of this EULA and WHMCompleteSolution reserves all rights not expressly granted to you. WHMCompleteSolution retains the ownership of the Software.\r\n\r\n2. Software License:\r\n\r\na. WHMCompleteSolution grants you a license to use one copy of the Software. You may not modify or disable any licensing or control features of the";
	echo " Software.\r\n\r\nb. This Software is licensed to operate on only one domain.\r\n\r\nc. Only one company may use the Software for its intended purpose on the domain. This company may not sell the products or services of other companies in the capacity of an on-line mall or buyer service. If more than one company wishes to use the Software they must purchase a separate license.\r\n\r\n3. License Restrictions:\r";
	echo "\n\r\na. By accepting this EULA you are agreeing not to reverse engineer, decompile, or disassemble the Software Application, except and only to the extent that such activity is expressly permitted by applicable law notwithstanding this limitation.\r\n\r\nb. You are the exclusive licensee of the Software and sharing any source code of the Software with any individual or entity is a violation of copyright";
	echo " laws and international treaties and cause for license termination.\r\n\r\nc. Modifying any portion of the Software source code or asking any individual or entity to modify the Software source code other than WHMCompleteSolution is a violation of copyright laws and international treaties and cause for license termination.\r\n\r\nd. If you upgrade the Software to a higher version of the Software, this EULA";
	echo " is terminated and your rights shall be limited to the EULA associated with the higher version.\r\n\r\n4. Proprietary Rights: All title and copyrights in and to the Software (including, without limitation, any images, photographs, animations, video, audio, music, text, and \"applets\" incorporated into the Software Application), the accompanying media and printed materials, and any copies of the Softwar";
	echo "e are owned by WHMCompleteSolution. The Software is protected by copyright laws and international treaty provisions. Therefore, you must treat the Software like any other copyrighted material, subject to the provisions of this EULA.\r\n\r\n5. Termination Rights: Without prejudice to any other rights, WHMCompleteSolution may terminate this EULA if you fail to comply with the terms and conditions of thi";
	echo "s EULA. In such event, you must destroy all copies of the Software and all of its component parts, and WHMCompleteSolution may suspend or deactivate your use of the Software with or without notice.\r\n\r\n6. Export Control: You may not export or re-export the Software or any copy or adaptation of the Software in violation of any applicable laws or regulations.\r\n\r\n7. WHMCompleteSolution does not warran";
	echo "t that the operation of WHMCompleteSolution Software will be uninterrupted or error free. WHMCompleteSolution Software may contain third-party functions or may have been subject to incidental use.\r\n\r\n8. WHMCompleteSolution is not responsible for problems resulting from improper or inadequate maintenance or configuration; software or interface routines or functions NOT developed by WHMCompleteSolut";
	echo "ion; unauthorized specifications for the Software; improper site preparation or maintenance; Beta Software; encryption mechanisms or routines.\r\n\r\nGood data processing procedure dictates that any program be thoroughly tested with non-critical data before relying on it. The user must assume the entire risk of using the Software. IN NO EVENT WILL WHMCompleteSolution OR ITS SUPPLIERS BE LIABLE FOR DIR";
	echo "ECT, SPECIAL, INCIDENTAL, CONSEQUENTIAL (INCLUDING LOST PROFIT OR LOST SAVINGS) OR OTHER DAMAGE WHETHER BASED IN CONTRACT, TORT, OR OTHERWISE EVEN IF A WHMCompleteSolution REPRESENTATIVE HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES, OR FOR ANY CLAIM BY ANY THIRD PARTY. Some states or provinces do not allow the exclusion or limitation of incidental or consequential damages, so the above limi";
	echo "tation or exclusion may not apply to you.\r\n\r\n9. Submissions: Should you decide to transmit to WHMCompleteSolution by any means or by any media any information (including, without limitation, ideas, concepts, or techniques for new or improved services and products), whether as information, feedback, data, questions, comments, suggestions, or the like, you agree such submissions are unrestricted and";
	echo " shall be deemed non-confidential and you automatically grant WHMCompleteSolution and its assigns a non-exclusive, royalty-free, worldwide, perpetual, irrevocable license, with the right to sublicense, to use, copy, transmit, distribute, create derivative works of, display, and perform the same.\r\n\r\n10. Distribution and Backups\r\n\r\na. DISTRIBUTION OF THE REGISTERED VERSION OF THE Software IS STRICTL";
	echo "Y PROHIBITED and is a violation of United States copyright laws and international treaties punishable by severe criminal and civil penalties.\r\n\r\nb. You may make copies of the Registered Version of the Software for backup purposes only. All backup copies must be an exact copy of the original Software.\r\n\r\n11. Governing Law: The validity, construction, and performance of this Agreement will be govern";
	echo "ed by the substantive law of the State of Florida.\r\n\r\n12. Refunds Policy: Refunds are only issued for software failure. Refunds are not issued for server failure/issues, lack of features or if your server does not meet the Software Requirements. Refunds are determined on individual circumstances and only issued once our technical staff determine that WHMCS has a fault causing it to not run on your";
	echo " server. Installation charges are not refundable under any circumstances. Refunds are not available after 1 month from purchase date.\r\n\r\n13. U.S. Government Restricted Rights: The Software and documentation are provided with RESTRICTED RIGHTS. Use, duplication, or disclosure by the Government is subject to restrictions as set forth in subparagraph (c)(1)(ii) of the Rights in Technical Data and Com";
	echo "puter Software clause at DFARS 252.227-7013 or subparagraphs (c)(1) and (2) of the Commercial Computer Software - Restricted Rights at 48 CFR 52.227-19, as applicable.\r\n</textarea></p>\r\n\r\n<p align=center><input type=\"submit\" value=\"I AGREE\" class=\"button\" onClick=\"window.location='install.php?step=2'\"> <input type=\"button\" value=\"I DISAGREE\" class=\"button\" onClick=\"window.location='install.php'\">\r\n\r\n";
}
else if ( $step == "2" )
{
	include( "../configuration.php" );
	if ( function_exists( "mysql_connect" ) )
	{
		$link = mysql_connect( $db_host, $db_username, $db_password );
		mysql_select_db( $db_name );
		$query = "SELECT * FROM tblconfiguration WHERE setting='Version'";
		$result = mysql_query( $query );
		if ( ( $data = @mysql_fetch_array( $result ) ) )
		{
			$setting = $data['setting'];
			$value = $data['value'];
			$CONFIG["{$setting}"] = "{$value}";
		}
	}
	if ( $CONFIG['Version'] )
	{
		echo "\r\n";
		echo "<s";
		echo "pan class=\"heading\">Upgrade to V";
		echo $latestversion;
		echo "</span>\r\n\r\n";
		$upgradeversion = str_replace( ".", "", $CONFIG['Version'] );
		if ( $CONFIG['Version'] == $latestversion )
		{
			echo "<p style=\"font-size: 16px;\">You are already running the latest version of WHMCS and so cannot upgrade.</p>\r\n";
		}
		else
		{
			if ( $upgradeversion < 320 )
			{
				echo "<p style=\"font-size: 16px;\">The version of WHMCS you are running is too old to be upgraded automatically.</p>\r\n<p style=\"font-size: 16px;\">You will need to purchase our professional upgrade service @ <a href=\"http://anonym.to/?http://www.whmcs.com/upgradeservice.php\">www.whmcs.com/upgradeservice.php</a> to have it manually updated.</p>\r\n";
			}
			else
			{
				echo "<p align=\"center\" style=\"font-size:18px;\">Your Current Version is V";
				echo $CONFIG['Version'];
				echo "</p>\r\n<div style=\"border: 1px dashed #cc0000;\tfont-weight: bold;\tbackground-color: #FBEEEB;\ttext-align: center; padding: 10px;\tcolor: #cc0000;font-size:16px;\">Backup your database before continuing...</div>\r\n<form method=\"post\" action=\"install.php\">\r\n<input type=\"hidden\" name=\"step\" value=\"upgrade\" />\r\n<input type=\"hidden\" name=\"version\" value=\"";
				echo $upgradeversion;
				echo "\" />\r\n";
				if ( $upgradeversion < 400 )
				{
					echo "<p align=\"center\"><input type=\"checkbox\" name=\"nomd5\" /> Do not use MD5 client password encryption</p>";
				}
				echo "<p align=\"center\"><input type=\"checkbox\" name=\"confirmbackup\" /> I confirm I have backed up my database</p>\r\n<p align=\"center\"><input type=\"submit\" value=\"Perform Upgrade &raquo;\" class=\"button\"></p>\r\n</form>\r\n";
			}
		}
	}
	else
	{
		echo "\r\n<p><b>System Requirements Checks</b></p>\r\n<p style=\"font-size: 16px;\">\r\n&raquo; PHP Version .......... ";
		if ( "4.2.0" <= phpversion( ) )
		{
			echo "<font color=#99cc00><B>Passed</B></font>";
		}
		else
		{
			echo "Your PHP version needs to be upgraded to at least V4.2.0 before you can use WHMCS.";
			$error = "1";
		}
		echo "<br>\r\n&raquo; MySQL .......... ";
		if ( function_exists( "mysql_connect" ) )
		{
			echo "<font color=#99cc00><B>Passed</B></font>";
		}
		else
		{
			echo "MySQL support is not available in this PHP installation.  It is required by WHMCompleteSolution for it to function.";
			$error = "1";
		}
		echo "<br>\r\n&raquo; CURL .......... ";
		if ( function_exists( "curl_init" ) )
		{
			echo "<font color=#99cc00><B>Passed</B></font>";
		}
		else
		{
			echo "You must have CURL installed with SSL Support for WHMCS to function correctly";
			$error = "1";
		}
		echo "</p>\r\n\r\n<b>Permissions Checks</b></p>\r\n<p style=\"font-size: 16px;\">\r\n&raquo; Configuration File .......... ";
		if ( is_writable( "../configuration.php" ) )
		{
			echo "<font color=#99cc00><B>Passed</B></font>";
		}
		else
		{
			echo "You must set permissions for the configuration.php file so it can be written to (CHMOD 777)";
			$error = "1";
		}
		echo "<br>\r\n&raquo; Attachments Folder Permissions .......... ";
		if ( is_writable( "../attachments/" ) )
		{
			echo "<font color=#99cc00><B>Passed</B></font>";
		}
		else
		{
			echo "You must set permissions for the attachments folder so it can be written to (CHMOD 777)";
			$error = "1";
		}
		echo "<br>\r\n&raquo; Downloads Folder Permissions .......... ";
		if ( is_writable( "../downloads/" ) )
		{
			echo "<font color=#99cc00><B>Passed</B></font>";
		}
		else
		{
			echo "You must set permissions for the downloads folder so it can be written to (CHMOD 777)";
			$error = "1";
		}
		echo "<br>\r\n&raquo; Templates Folder Permissions .......... ";
		if ( is_writable( "../templates_c/" ) )
		{
			echo "<font color=#99cc00><B>Passed</B></font>";
		}
		else
		{
			echo "You must set permissions for the templates_c folder so it can be written to (CHMOD 777)";
			$error = "1";
		}
		echo "</p>\r\n\r\n";
		if ( $error == "1" )
		{
			echo "<p><b>Error!  Some Preinstallation Checks Failed.</b> You must correct the errors above before you can continue with installation.</p>\r\n<p><input type=\"button\" value=\"Recheck Requirements\" onClick=\"location.reload(true);\"></p>\r\n";
		}
		else
		{
			echo "<form method=\"post\" action=\"install.php?step=3\">\r\n<p align=\"center\"><input type=\"submit\" value=\"Continue &raquo;\" class=\"button\"></p>\r\n</form>\r\n";
		}
		echo "\r\n";
	}
}
else if ( $step == "3" )
{
	echo "\r\n<form method=\"post\" action=\"install.php?step=4\">\r\n<p><b>License Key</b></p>\r\n<p>You will find your license key in the <a href=\"http://anonym.to/?http://www.whmcs.com/clients\" target=\"_blank\">WHMCS Client Area</a> or alternatively if you obtained a license from a reseller your reseller should have already given the license key to you.</p>\r\n<table>\r\n<tr><td width=120>License Key</td><td><input type=\"text\" name=\"licensekey\" size=\"";
	echo "40\"></td></tr>\r\n</table>\r\n<p><b>Database Connection Details</b></p>\r\n<p>You must now create a MySQL database in your control panel and assign a user to it.  Once this is complete, enter the connection details below.</p>\r\n<table>\r\n<tr><td width=120>Database Host</td><td><input type=\"text\" name=\"dbhost\" size=\"20\" value=\"localhost\"></td></tr>\r\n<tr><td>Database Name</td><td><input type=\"text\" name=\"dbname\" size=\"20\" value=";
	echo "\"\"></td></tr>\r\n<tr><td>Database Username</td><td><input type=\"text\" name=\"dbusername\" size=\"20\" value=\"\"></td></tr>\r\n<tr><td>Database Password</td><td><input type=\"password\" name=\"dbpassword\" size=\"20\" value=\"\"></td></tr>\r\n</table>\r\n<p align=\"center\"><input type=\"submit\" value=\"Continue &raquo;\" class=\"button\"></p>\r\n</form>\r\n\r\n";
}
else if ( $step == "4" )
{
	if ( !$_REQUEST['licensekey'] )
	{
		// Keygen start
		$_REQUEST['licensekey']  = "Owned-".substr(md5(mt_rand().$_SERVER["HTTP_HOST"]),0,20);
		// Keygen end
	
		/*
		echo "You did not enter your license key.  You must go back and correct this.";
		exit( );
		*/
	}
	$length = 64;
	$seeds = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$str = null;
	$seeds_count = strlen( $seeds ) - 1;
	$i = 0;
	while ( $i < $length )
	{
		$str .= $seeds[rand( 0, $seeds_count )];
		++$i;
	}
	$output = "<?php\r\n\$license = \"".$_REQUEST['licensekey']."\";\r\n\$db_host = \"".$_REQUEST['dbhost']."\";\r\n\$db_username = \"".$_REQUEST['dbusername']."\";\r\n\$db_password = \"".$_REQUEST['dbpassword']."\";\r\n\$db_name = \"".$_REQUEST['dbname']."\";\r\n\$cc_encryption_hash = \"".$str."\";\r\n\$templates_compiledir = \"templates_c/\";\r\n?>";
	$fp = fopen( "../configuration.php", "w" );
	if ( fwrite( $fp, $output ) !== FALSE )
	{
		fclose( $fp );
	}
	else
	{
		header( "Content-Type: text/x-delimtext; name=\"configuration.php\"" );
		header( "Content-disposition: attachment; filename=configuration.php" );
		echo $output;
	}
	include( "../configuration.php" );
	$link = mysql_connect( $db_host, $db_username, $db_password );
	if ( !mysql_select_db( $db_name ) )
	{
		exit( "Could not connect to the database - check the database connection details you entered and go back and correct them if necessary" );
	}
	mysql_import_file( "install.sql" );
	mysql_import_file( "emailtemplates.sql" );
	echo "\r\n<p><b>Setup Administrator Account</b></p>\r\n<form method=\"post\" action=\"install.php?step=5\">\r\n<p>You now need to setup your administrator account.</p>\r\n<table>\r\n<tr><td width=120>First Name:</td><td><input type=\"text\" name=\"firstname\" size=\"30\"></td></tr>\r\n<tr><td>Last Name:</td><td><input type=\"text\" name=\"lastname\" size=\"30\"></td></tr>\r\n<tr><td>Email:</td><td><input type=\"text\" name=\"email\" size=\"50\"></td></tr>\r\n<tr><td>User";
	echo "name:</td><td><input type=\"text\" name=\"username\" size=\"20\"></td></tr>\r\n<tr><td>Password:</td><td><input type=\"password\" name=\"password\" size=\"20\"></td></tr>\r\n</table>\r\n<p align=\"center\"><input type=\"submit\" value=\"Continue\" class=\"button\"></p>\r\n</form>\r\n\r\n";
}
else if ( $step == "5" )
{
	include( "../configuration.php" );
	$link = mysql_connect( $db_host, $db_username, $db_password );
	if ( !mysql_select_db( $db_name ) )
	{
		exit( "Could not connect to the database - check the database connection details you entered and go back and correct them if necessary" );
	}
	$result = mysql_query( "INSERT INTO `tbladmins` ( `username` , `password` , `firstname` , `lastname` , `email` , `userlevel` , `signature` , `notes` , `supportdepts` ) VALUES ('".$_REQUEST['username']."', '".md5( $_REQUEST['password'] )."', '".$_REQUEST['firstname']."', '".$_REQUEST['lastname']."', '".$_REQUEST['email']."', '3', '', 'Welcome to WHMCS!  Please ensure you have setup the cron job in cPanel to automate tasks', ',')" );
	v321upgrade( );
	v322upgrade( );
	v323upgrade( );
	v330upgrade( );
	v340upgrade( );
	v341upgrade( );
	v350upgrade( );
	v351upgrade( );
	v360upgrade( );
	v361upgrade( );
	v362upgrade( );
	v370upgrade( );
	v371upgrade( );
	v372upgrade( );
	v380upgrade( );
	v381upgrade( );
	v382upgrade( );
	v400upgrade( );
	v401upgrade( );
	v410upgrade( );
	v411upgrade( );
	v412upgrade( );
	v420upgrade( );
	v421upgrade( );
	v430upgrade( );
	v431upgrade( );
	v440upgrade( );
	v441upgrade( );
	v442upgrade( );
	v450upgrade( );
	v451upgrade( );
	v452upgrade( );
	echo "\r\n<p><b>Installation Complete</b></p>\r\n\r\n<p>Here's what you should do next:</p>\r\n\r\n<p><b>1. Delete the Install Folder</b></p>\r\n<p>You should delete or rename the <b><i>install</i></b> directory.</p>\r\n\r\n<p><b>2. Secure the Writeable Directories</b></p>\r\n<p>It is advisable to move the attachments, downloads & templates_c directories (which need to be writeable for WHMCS to function) outside of the publically accessible ";
	echo "folder tree on your website.  Instructions for how to do that can be found in the article <a href=\"http://anonym.to/?http://wiki.whmcs.com/Further_Security_Steps\" target=\"_blank\">Further Security Steps</a></p>\r\n\r\n<p><b>3. Setup the Daily Cron Job</b></p>\r\n<p>You should setup a cron job in your control panel to run using the following command once per day:<br>\r\n<input type=\"text\" size=\"120\" value=\"php -q ";
	$pos = strrpos( $_SERVER['SCRIPT_FILENAME'], "/" );
	$filename = substr( $_SERVER['SCRIPT_FILENAME'], 0, $pos );
	$pos = strrpos( $filename, "/" );
	$filename = substr( $filename, 0, $pos );
	echo $filename;
	echo "/admin/cron.php\"></p>\r\n\r\n<p><b>4. Configure WHMCS</b></p>\r\n<p>You should now configure your installation.  Our recommend procedure for doing that can be seen in our manual section <a href=\"http://anonym.to/?http://wiki.whmcs.com/Installing_WHMCS#Post_Installation_Suggested_Steps\" target=\"_blank\">Post Installation Suggest Steps</a></p>\r\n\r\n<p><a href=\"../admin/\">Click here to go to the admin area &raquo;</a></p>\r\n\r\n<p><b>Thank you ";
	echo "for choosing WHMCS!</b></p>\r\n\r\n";
}
else if ( $step == "upgrade" )
{
	$customadminpath = "admin";
	include( "../configuration.php" );
	if ( !$_REQUEST['confirmbackup'] )
	{
		echo "<p>You must confirm you have backed up your database before upgrading. Please go back and try again.";
	}
	else
	{
		$link = mysql_connect( $db_host, $db_username, $db_password );
		if ( !mysql_select_db( $db_name ) )
		{
			exit( "Could not connect to the database" );
		}
		if ( $version <= 320 )
		{
			v321upgrade( );
		}
		if ( $version <= 321 )
		{
			v322upgrade( );
		}
		if ( $version <= 322 )
		{
			v323upgrade( );
		}
		if ( $version <= 323 )
		{
			v330upgrade( );
		}
		if ( $version <= 330 )
		{
			v340upgrade( );
		}
		if ( $version <= 340 )
		{
			v341upgrade( );
		}
		if ( $version <= 341 )
		{
			v350upgrade( );
		}
		if ( $version <= 350 )
		{
			v351upgrade( );
		}
		if ( $version <= 351 )
		{
			v360upgrade( );
		}
		if ( $version <= 360 )
		{
			v361upgrade( );
		}
		if ( $version <= 361 )
		{
			v362upgrade( );
		}
		if ( $version <= 362 )
		{
			v370upgrade( );
		}
		if ( $version <= 370 )
		{
			v371upgrade( );
		}
		if ( $version <= 371 )
		{
			v372upgrade( );
		}
		if ( $version <= 372 )
		{
			v380upgrade( );
		}
		if ( $version <= 380 )
		{
			v381upgrade( );
		}
		if ( $version <= 381 )
		{
			v382upgrade( );
		}
		if ( $version <= 383 )
		{
			v400upgrade( );
		}
		if ( $version <= 400 )
		{
			v401upgrade( );
		}
		if ( $version <= 402 )
		{
			v410upgrade( );
		}
		if ( $version <= 410 )
		{
			v411upgrade( );
		}
		if ( $version <= 411 )
		{
			v412upgrade( );
		}
		if ( $version <= 412 )
		{
			v420upgrade( );
		}
		if ( $version <= 420 )
		{
			v421upgrade( );
		}
		if ( $version <= 421 )
		{
			v430upgrade( );
		}
		if ( $version <= 430 )
		{
			v431upgrade( );
		}
		if ( $version <= 431 )
		{
			v440upgrade( );
		}
		if ( $version <= 440 )
		{
			v441upgrade( );
		}
		if ( $version <= 441 )
		{
			v442upgrade( );
		}
		if ( $version <= 442 )
		{
			v450upgrade( );
		}
		if ( $version <= 450 )
		{
			v451upgrade( );
		}
		if ( $version <= 451 )
		{
			v452upgrade( );
		}
		echo "\r\n<p><b>Upgrade Complete</b></p>\r\n\r\n<p>You should now delete the install folder from your web server.</p>\r\n\r\n<p><a href=\"../";
		echo $customadminpath;
		echo "/\">Click here to go to the admin area</a></p>\r\n\r\n<p><b>Thank you for choosing WHMCS!</b></p>\r\n\r\n";
	}
}
echo "\r\n<br />\r\n\r\n<p align=\"center\">Copyright &copy; WHMCompleteSolution</p>\r\n\r\n</div>\r\n\r\n</body>\r\n</html>";
?>