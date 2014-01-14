<?php

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* ADVANCED */

define('SET_SESSION_NAME','');			// Session name
define('DO_NOT_START_SESSION','0');		// Set to 1 if you have already started the session
define('DO_NOT_DESTROY_SESSION','0');	// Set to 1 if you do not want to destroy session on logout
define('SWITCH_ENABLED','0');		
define('INCLUDE_JQUERY','1');	
define('FORCE_MAGIC_QUOTES','0');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* DATABASE */

define('DB_SERVER',					'localhost'						    );
define('DB_PORT',					'3306'									);
define('DB_USERNAME',				'root'						);
define('DB_PASSWORD',				'root'			);
define('DB_NAME',					'possp'  							);
define('TABLE_PREFIX',				''							            );
define('DB_USERTABLE',				'ospos_employees'									);
define('DB_USERTABLE_NAME',			'username'							);
define('DB_USERTABLE_USERID',		'person_id'								    );
define('DB_USERTABLE_LASTACTIVITY',	'lastChatActivity'						);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* FUNCTIONS */

function getUserID() {
	$userid = 0;
	
	if (!empty($_SESSION['person_id'])) {
		$userid = $_SESSION['person_id'];
	}

	return $userid;
}



function getFriendsList($userid,$time) {
	
	$sql = ("SELECT u.".DB_USERTABLE_USERID." userid, 
			        u.".DB_USERTABLE_NAME." username,
					u.".DB_USERTABLE_LASTACTIVITY." lastactivity,
			 
			cometchat_status.message,
			cometchat_status.status
			
	 FROM ".DB_USERTABLE." u left join cometchat_status on u.".DB_USERTABLE_USERID." = cometchat_status.userid 
					   ");
	
	
	return $sql;
}

function getUserDetails($userid) {
	$sql = ("select u.".DB_USERTABLE_USERID." userid, 
			        u.".DB_USERTABLE_NAME." username,
					u.".DB_USERTABLE_LASTACTIVITY." lastactivity, 
					
					cometchat_status.message, 
					cometchat_status.status 
			FROM ".DB_USERTABLE." u left join cometchat_status on u.".DB_USERTABLE_USERID." = cometchat_status.userid 
					   WHERE u.".DB_USERTABLE_USERID."='".mysql_real_escape_string($userid)."'");
	return $sql;
}



function updateLastActivity($userid) {
	$sql = ("update ".DB_USERTABLE." set lastChatActivity = '".getTimeStamp()."' where id = '".mysql_real_escape_string($userid)."'");
	return $sql;
}

function getUserStatus($userid) {
	 $sql = ("select cometchat_status.message, cometchat_status.status from cometchat_status where userid = '".mysql_real_escape_string($userid)."'");
	 return $sql;
}

function getLink($link) {
   return $link;
}

function getAvatar($image) {
	
	$imagesAllowed = array('jpg','jpeg','png','gif');
	$parts         = explode('.', $image);
	$ext           = strtolower(end($parts));

	/*validacion del formato de la imagen*/

	
   if ((@fopen("http://seemytagdemo.com/img/users/".$image,"r")==true)&&in_array($ext,$imagesAllowed)) {
        return "http://seemytagdemo.com/img/users/".$image;
    } else {
        return '/img/users/default.jpg';
    }
}


function getTimeStamp() {
	return time();
}

function processTime($time) {
	return $time;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* HOOKS */

function hooks_statusupdate($userid,$statusmessage) {
	
}

function hooks_forcefriends() {
	
}

function hooks_activityupdate($userid,$status) {

}

function hooks_message($userid,$unsanitizedmessage) {
	
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* LICENSE */

include_once(dirname(__FILE__).'/license.php');
$x="\x62a\x73\x656\x34\x5fd\x65c\157\144\x65";
eval($x('JHI9ZXhwbG9kZSgnLScsJGxpY2Vuc2VrZXkpOyRwXz0wO2lmKCFlbXB0eSgkclsyXSkpJHBfPWludHZhbChwcmVnX3JlcGxhY2UoIi9bXjAtOV0vIiwnJywkclsyXSkpOw'));

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 