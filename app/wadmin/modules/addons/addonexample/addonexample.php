<?php

if (!defined("WHMCS"))
	die("This file cannot be accessed directly");

/*
**********************************************

         *** Addon Module Example ***

This example addon module demonstrates all
the functions an addon module can contain.

Please refer to the PDF documentation @
http://wiki.whmcs.com/Addon_Modules
for more information

**********************************************
*/

function addonexample_config() {
    $configarray = array(
    "name" => "Addon Example",
    "version" => "1.0",
    "author" => "WHMCS",
    "language" => "english",
    "fields" => array(
        "option1" => array ("FriendlyName" => "Option1", "Type" => "text", "Size" => "25", "Description" => "Textbox"),
        "option2" => array ("FriendlyName" => "Option2", "Type" => "password", "Size" => "25", "Description" => "Password"),
        "option3" => array ("FriendlyName" => "Option3", "Type" => "yesno", "Size" => "25", "Description" => "Sample Check Box"),
        "option4" => array ("FriendlyName" => "Option4", "Type" => "textarea", "Size" => "25", "Description" => "Textarea"),
        "option5" => array ("FriendlyName" => "Option5", "Type" => "dropdown", "Options" => "1,2,3,4,5", "Description" => "Sample Dropdown"),
    ));
    return $configarray;
}

function addonexample_activate() {

    # Create Custom DB Table
    $query = "CREATE TABLE `mod_addonexample` (`id` INT( 1 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,`demo` TEXT NOT NULL )";
	$result = mysql_query($query);

}

function addonexample_deactivate() {

    # Remove Custom DB Table
    $query = "DROP TABLE `mod_addonexample`";
	$result = mysql_query($query);

}

function addonexample_upgrade($vars) {

    $version = $vars['version'];

    # Run SQL Updates for V1.0 to V1.1
    if ($version < 1.1) {
        $query = "ALTER `mod_addonexample` ADD `demo2` TEXT NOT NULL ";
    	$result = mysql_query($query);
    }

    # Run SQL Updates for V1.1 to V1.2
    if ($version < 1.2) {
        $query = "ALTER `mod_addonexample` ADD `demo3` TEXT NOT NULL ";
    	$result = mysql_query($query);
    }

}

function addonexample_output($vars) {

    $modulelink = $vars['modulelink'];
    $version = $vars['version'];
    $option1 = $vars['option1'];
    $option2 = $vars['option2'];
    $option3 = $vars['option3'];
    $option4 = $vars['option4'];
    $option5 = $vars['option5'];
    $LANG = $vars['_lang'];

    echo '<p>'.$LANG['intro'].'</p>
<p>'.$LANG['description'].'</p>
<p>'.$LANG['documentation'].'</p>';

}

function addonexample_sidebar($vars) {

    $modulelink = $vars['modulelink'];
    $version = $vars['version'];
    $option1 = $vars['option1'];
    $option2 = $vars['option2'];
    $option3 = $vars['option3'];
    $option4 = $vars['option4'];
    $option5 = $vars['option5'];
    $LANG = $vars['_lang'];

    $sidebar = '<span class="header"><img src="images/icons/addonmodules.png" class="absmiddle" width="16" height="16" /> Example</span>
<ul class="menu">
        <li><a href="#">Demo Sidebar Content</a></li>
        <li><a href="#">Version: '.$version.'</a></li>
    </ul>';
    return $sidebar;

}

?>