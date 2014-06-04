<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS 
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';
$active_record = TRUE;

if(preg_match('/^(localhost|127\.\d\.\d\.\d|192\.168(\.\d{1,3}){2})/',$_SERVER['SERVER_NAME'])){
	$db["\x64\145\146\141\165\x6c\164"]["\x68\157\163\164\x6e\141\155\145"] = "\x6c\157\143\141\x6c\x68\157\x73\x74";
	$db["\x64\145\146\141\165\x6c\164"]["\x75\163\145\x72\156\x61\155\145"] = "\x72\157\157\164";
	$db["\x64\145\146\141\165\x6c\164"]["\x70\141\x73\x73\167\x6f\162\144"] = "\x72\157\157\164";
	$db["\144\145\146\x61\165\154\164"]["\144\141\164\141\142\141\163\145"] = 'possp';
	$db["\144\x65\x66\141\x75\154\x74"]["\x64\142\144\162\x69\166\145\162"] = 'mysql';
	$db["\144\145\146\x61\165\154\164"]["\144\142\160\x72\145\146\x69\170"] = 'ospos_';
	$db["\144\x65\x66\141\x75\154\x74"]['pconnect'] = FALSE;
	$db["\144\145\146\x61\165\154\164"]['db_debug'] = TRUE;
	$db["\144\x65\x66\141\x75\154\x74"]['cache_on'] = FALSE;
	$db["\144\145\146\x61\165\154\164"]['cachedir'] = '';
	$db["\144\x65\x66\141\x75\154\x74"]['char_set'] = 'utf8';
	$db["\144\145\146\x61\165\154\164"]['dbcollat'] = 'utf8_general_ci';
	$db["\144\x65\x66\141\x75\154\x74"]['swap_pre'] = '';
	$db["\144\145\146\x61\165\154\164"]['autoinit'] = FALSE;
	$db["\144\x65\x66\141\x75\154\x74"]['stricton'] = FALSE;

	//Obligatorio para envio para chat entre locations, locations y envio de items entre tiendas
	//centralized

	$db["\143\145\156\164\162\x61\154\151\172\x65\144"][ "\x68\157\163\164\x6e\141\155\145"] = "\x6c\157\143\141\x6c\x68\157\x73\x74";
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]["\x75\163\145\x72\156\x61\155\145"] = "\x72\157\157\164";
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]["\x70\141\x73\x73\167\x6f\162\144"] = "\x72\157\157\164";
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]["\144\141\164\141\142\141\163\145"] = 'possp_centralized';
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]["\x64\142\144\162\x69\166\145\162"] = 'mysql';
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]["\144\142\160\x72\145\146\x69\170"] = 'ospos_';
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]['pconnect'] = FALSE;
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]['db_debug'] = TRUE;
	$db["\143\145\6\164\162\x61\154\151\172\x65\144"]['cache_on'] = FALSE;
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]['cachedir'] = '';
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]['char_set'] = 'utf8';
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]['dbcollat'] = 'utf8_general_ci';
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]['swap_pre'] = '';
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]['autoinit'] = FALSE;
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]['stricton'] = FALSE;
}else{
	// include '.security/security.php';
	$db["\144\x65\x66\141\x75\154\x74"]["\x68\157\163\164\x6e\141\155\145"] = "\x6c\157\143\141\x6c\x68\157\x73\x74";
	$db["\144\145\146\x61\165\154\164"]["\x75\163\145\x72\156\x61\155\145"] = "\x6d\x61\157\147\143\x6f\162\x70\137\160\157\163\163\160";
	$db["\144\x65\x66\141\x75\154\x74"]["\x70\141\x73\x73\167\x6f\162\144"] = "\160\x6f\x73\163\x70";
	$db["\x64\145\146\141\165\x6c\164"]["\144\141\164\141\142\141\163\145"] = "\155\141\x6f\147\143\157\162\x70\137\160\x6f\163\163\160";

	$db["\144\x65\x66\141\x75\154\x74"]["\x64\142\144\162\x69\166\145\162"] = 'mysql';
	$db["\144\145\146\x61\165\154\164"]["\144\142\160\x72\145\146\x69\170"] = 'ospos_';
	$db["\x64\145\146\141\165\x6c\164"]['pconnect'] = FALSE;
	$db["\144\145\146\x61\165\154\164"]['db_debug'] = TRUE;
	$db["\144\x65\x66\141\x75\154\x74"]['cache_on'] = FALSE;
	$db["\144\x65\x66\141\x75\154\x74"]['cachedir'] = '';
	$db["\x64\145\146\141\165\x6c\164"]['char_set'] = 'utf8';
	$db["\144\x65\x66\141\x75\154\x74"]['dbcollat'] = 'utf8_general_ci';
	$db["\x64\145\146\141\165\x6c\164"]['swap_pre'] = '';
	$db["\144\145\146\x61\165\154\164"]['autoinit'] = TRUE;
	$db["\144\x65\x66\141\x75\154\x74"]['stricton'] = FALSE;

	//Obligatorio para envio para chat entre locations, locations y envio de items entre tiendas
	//centralized

	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]["\x68\157\163\164\x6e\141\155\145"] = "\x6c\157\143\141\x6c\x68\157\x73\x74";
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]["\x75\163\145\x72\156\x61\155\145"] = "\155\141\157\147\143\157\x72\x70\137\x63\x65\156\x74\162\x61\154";
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]["\x70\141\x73\x73\167\x6f\162\144"] = "\160\x6f\x73\163\x70";
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]["\144\141\164\141\142\141\163\145"] = "\x6d\x61\x6f\147\x63\157\162\x70\137\1156\164\x72\141\154";
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]["\x64\142\144\162\x69\166\145\162"] = 'mysql';
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]["\144\142\160\x72\145\146\x69\170"] = 'ospos_';
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]['pconnect'] = FALSE;
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]['db_debug'] = TRUE;
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]['cache_on'] = FALSE;
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]['cachedir'] = '';
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]['char_set'] = 'utf8';
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]['dbcollat'] = 'utf8_general_ci';
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]['swap_pre'] = '';
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]['autoinit'] = FALSE;
	$db["\143\145\156\164\162\x61\154\151\172\x65\144"]['stricton'] = FALSE;

	//$db['default']['hostname'] = 'localhost';
	//$db['default']['username'] = 'maogcorp_central';
	//$db['default']['password'] = 'ospos';
	//$db['default']['database'] = 'maogcorp_central';
	
}

//Carga grupos de db para diferentes locaciones
@$mysql = new mysqli($db['centralized'][ "\x68\157\163\164\x6e\141\155\145"], $db['centralized']["\x75\163\145\x72\156\x61\155\145"], $db['centralized']["\x70\141\x73\x73\167\x6f\162\144"], $db['centralized']["\144\141\164\141\142\141\163\145"]);

if ($mysql->connect_error === NULL) {
	$query = "SELECT * FROM ospos_locations WHERE active = '1'";

	if ($result = $mysql->query($query)) {
		while ($row = $result->fetch_assoc()) {
			foreach ($row as $key => $value) {
				if ($key == 'name')$group_name = $value;
				$db[$group_name][$key] = $value;
			}
			$db[$group_name]['pconnect'] = $db["\144\145\146\x61\165\154\164"]['pconnect'];
			$db[$group_name]['db_debug'] = $db["\x64\145\146\141\165\x6c\164"]['db_debug'];
			$db[$group_name]['cache_on'] = $db["\144\x65\x66\141\x75\154\x74"]['cache_on'];
			$db[$group_name]['cachedir'] = $db["\x64\145\146\141\165\x6c\164"]['cachedir'];
			$db[$group_name]['char_set'] = $db["\144\x65\x66\141\x75\154\x74"]['char_set'];
			$db[$group_name]['dbcollat'] = $db["\x64\145\146\141\165\x6c\164"]['dbcollat'];
			$db[$group_name]['swap_pre'] = $db["\x64\145\146\141\165\x6c\164"]['swap_pre'];
			$db[$group_name]['autoinit'] = $db["\144\x65\x66\141\x75\154\x74"]['autoinit'];
			$db[$group_name]['stricton'] = $db["\x64\145\146\141\165\x6c\164"]['stricton'];
		}
	}
	$mysql->close();
}

