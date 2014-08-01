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
include( "../includes/functions.php" );
include( "../includes/adminfunctions.php" );
update_query( "tbladminlog", array( "logouttime" => "now()" ), array( "sessionid" => session_id() ) );
$adminid = $_SESSION['adminid'];
session_unset( );
session_destroy( );
setcookie( "WHMCSAdminID", "" );
setcookie( "WHMCSAdminUsername", "" );
setcookie( "WHMCSAdminPassword", "" );
run_hook( "AdminLogout", array( "adminid" => $adminid ) );
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />\r\n<title>WHMCS Complete Billing &amp; Support System - Logout</title>\r\n";
echo "<s";
echo "tyle type=\"text/css\">\r\n<!--\r\nbody, td, th {\r\n\tfont-family: Tahoma, Arial, Helvetica, sans-serif;\r\n\tfont-size: 11px;\r\n\tcolor: #333;\r\n}\r\nbody {\r\n\tbackground-color: #FFF;\r\n\tmargin: 0;\r\n}\r\na, a:visited {\r\n\tcolor: #000066;\r\n\ttext-decoration: underline;\r\n}\r\na:hover {\r\n\ttext-decoration: none;\r\n}\r\nform {\r\n\tmargin: 0;\r\n\tpadding: 0;\r\n}\r\ninput, select, textarea {\r\n\tfont-family: Tahoma, Arial, Helvetica, sans-";
echo "serif;\r\n\tfont-size: 11px;\r\n\tpadding: 3px;\r\n}\r\n#login_container {\r\n\tcolor: #333;\r\n\tbackground-color: #FFF;\r\n\ttext-align: left;\r\n\twidth: 330px;\r\n\tpadding: 1px;\r\n\tmargin: 20px auto 10px auto;\r\n\tborder: 1px solid #CCCCCC;\r\n}\r\n#logo {\r\n\ttext-align: center;\r\n\tmargin: 0;\r\n\tpadding: 50px 0 0 0;\r\n}\r\n#login_container #login {\r\n\tbackground-color: #EFEFEF;\r\n\ttext-align: left;\r\n\tmargin: 0;\r\n\tpadding: 10px;\r\n}\r";
echo "\n#login_container #login_failed {\r\n	background-color: #FCF9D2;\r\n	text-align: center;\r\n	padding: 10px;\r\n	margin: 0 0 1px 0;\r\n}\r\n#login_container #extra_info {\r\n\tbackground-color: #CCC;\r\n\ttext-align: left;\r\n\tpadding: 10px;\r\n\tmargin: 1px 0 0 0;\r\n}\r\n-->\r\n</style>\r\n</head>\r\n<body>\r\n<div id=\"logo\"><img src=\"images/loginlogo.gif\" alt=\"WHMCS\" width=\"205\" height=\"62\" /></div>\r\n<div id=\"login_container";
echo "\">\r\n  <div id=\"login_failed\">\r\n	";
echo "<s";
echo "trong>Logged Out</strong>\r\n  </div>\r\n  <div id=\"login\">\r\n\r\n<p align=\"center\">You have been successfully logged out.</p>\r\n<p align=\"center\"><a href=\"index.php\">Click here to login again</a></p>\r\n\r\n  </div>\r\n</div>\r\n</body>\r\n</html>";
?>