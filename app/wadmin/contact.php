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
$pagetitle = $_LANG['contacttitle'];
$breadcrumbnav = "<a href=\"index.php\">".$_LANG['globalsystemname']."</a> > <a href=\"contact.php\">".$_LANG['contacttitle']."</a>";
$templatefile = "contact";
$pageicon = "images/contact_big.gif";
initialiseClientArea( $pagetitle, $pageicon, $breadcrumbnav );
if ( $CONFIG['ContactFormDept'] )
{
	header( "Location: submitticket.php?step=2&deptid=".$CONFIG['ContactFormDept'] );
	exit( );
}
if ( $CONFIG['CaptchaSetting'] == "on" || $CONFIG['CaptchaSetting'] == "offloggedin" && !$_SESSION['uid'] )
{
	$capatacha = "on";
}
$errormessage = "";
if ( $action == "send" )
{
	if ( !$name )
	{
		$errormessage .= "<li>".$_LANG['contacterrorname'];
	}
	if ( !$email )
	{
		$errormessage .= "<li>".$_LANG['clientareaerroremail'];
	}
	else if ( !preg_match( "/^([a-zA-Z0-9])+([\\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\\.[a-zA-Z0-9_-]+)*\\.([a-zA-Z]{2,6})$/", $email ) )
	{
		$errormessage .= "<li>".$_LANG['clientareaerroremailinvalid'];
	}
	if ( !$subject )
	{
		$errormessage .= "<li>".$_LANG['contacterrorsubject'];
	}
	if ( !$message )
	{
		$errormessage .= "<li>".$_LANG['contacterrormessage'];
	}
	if ( $capatacha && $_SESSION['image_random_value'] != md5( strtoupper( $code ) ) )
	{
		$errormessage .= "<li>".$_LANG['imagecheck'];
	}
	if ( !$errormessage )
	{
		if ( $CONFIG['LogoURL'] )
		{
			$sendmessage = "<p><a href=\"".$CONFIG['Domain']."\" target=\"_blank\"><img src=\"".$CONFIG['LogoURL']."\" alt=\"".$CONFIG['CompanyName']."\" border=\"0\"></a></p>";
		}
		$sendmessage .= "<font style=\"font-family:Verdana;font-size:11px\"><p>".nl2br( $message )."</p>";
		$mail = new PHPMailer( );
		$mail->From = $email;
		$mail->FromName = $name;
		$mail->Subject = "Contact Form: ".$subject;
		$mail->CharSet = $CONFIG['Charset'];
		if ( $CONFIG['MailType'] == "mail" )
		{
			$mail->Mailer = "mail";
		}
		else if ( $CONFIG['MailType'] == "smtp" )
		{
			$mail->IsSMTP( );
			$mail->Host = $CONFIG['SMTPHost'];
			$mail->SMTPAuth = true;
			$mail->Hostname = $_SERVER['SERVER_NAME'];
			if ( $CONFIG['SMTPSSL'] == "on" )
			{
				$mail->SMTPSecure = $CONFIG['SMTPSSL'];
			}
			$mail->Port = $CONFIG['SMTPPort'];
			$mail->Username = $CONFIG['SMTPUsername'];
			$mail->Password = $CONFIG['SMTPPassword'];
		}
		$mail->Sender = $CONFIG['SystemEmailsFromEmail'];
		$message_text = str_replace( "</p>", "\n\n", $sendmessage );
		$message_text = str_replace( "<br>", "\n", $message_text );
		$message_text = str_replace( "<br />", "\n", $message_text );
		$message_text = strip_tags( $message_text );
		$mail->Body = $sendmessage;
		$mail->AltBody = $message_text;
		if ( !$CONFIG['ContactFormTo'] )
		{
			$contactformemail = $CONFIG['Email'];
		}
		else
		{
			$contactformemail = $CONFIG['ContactFormTo'];
		}
		$mail->AddAddress( $contactformemail );
		$mail->Send( );
		$mail->ClearAddresses( );
		$sent = "true";
		$smarty->assign( "sent", $sent );
	}
}
$smarty->assign( "errormessage", $errormessage );
$smarty->assign( "name", $name );
$smarty->assign( "email", $email );
$smarty->assign( "subject", $subject );
$smarty->assign( "message", $message );
$smarty->assign( "capatacha", $capatacha );
outputClientArea( $templatefile );
?>