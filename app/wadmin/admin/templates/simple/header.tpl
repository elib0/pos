<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset={$charset}" />
<title>WHMCS - {$pagetitle}</title>
<link href="templates/simple/style.css" rel="stylesheet" type="text/css" />
<link href="../includes/jscript/css/ui.all.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../includes/jscript/jquery.js"></script>
<script type="text/javascript" src="../includes/jscript/jqueryui.js"></script>
<script type="text/javascript" src="../includes/jscript/adminsearchbox.js"></script>
{literal}<script>
function intellisearch() {
    $.post("search.php", { intellisearch: "true", value: $("#intellisearchval").val() },
    function(data){
        $("#searchresults").html(data);
        $("#searchresults").slideDown("slow");
    });
}
  $(document).ready(function(){
    $("#shownotes").click(function () {
        $("#mynotes").toggle("slow");
        return false;
    });
    $("#savenotes").click(function () {
        $("#mynotes").toggle("slow");
        $.post("index.php", { action: "savenotes", notes: $("#mynotesbox").val() });
    });
    $("#intellisearchcancel").click(function () {
        $("#intellisearchval").val("");
        $("#searchresults").slideUp("slow");
    });
    $(".datepick").datepicker({
        dateFormat: "{/literal}{$datepickerformat}{literal}",
        showOn: "button",
        buttonImage: "images/showcalendar.gif",
        buttonImageOnly: true,
        showButtonPanel: true
    });
    {/literal}{$jquerycode}{literal}
  });{/literal}
  {$jscode}
</script>
</head>
<body>

<table width="100%" cellspacing="0" cellpadding="0" id="header"><tr><td nowrap>

<div id="logoWrapper"><h1><img src="images/icons/{$pageicon}.png" width="16" height="16" /> {$pagetitle}</h1></div>

<div id="navigation">
  <ul id="menu">
    {include file="simple/menu.tpl"}
  </ul>
</div>

</td><td id="headerright" valign="top">

<a href="../"><strong>{$_ADMINLANG.global.clientarea}</strong></a> | <a href="#" id="shownotes"><strong>{$_ADMINLANG.global.mynotes}</strong></a> | <a href="myaccount.php"><strong>{$_ADMINLANG.global.myaccount}</strong></a> | <a href="logout.php"><strong>{$_ADMINLANG.global.logout}</strong></a><br />
{$smarty.now|date_format:"%A, %d %B %Y, %H:%M"}<br /><br />
{$_ADMINLANG.global.staffonline}: {$adminsonline}

</td></tr></table>

<div id="mynotes"><textarea id="mynotesbox" rows="15" cols="80">{$admin_notes}</textarea><br /><input type="button" value="Save" id="savenotes" /></div>

<table bgcolor="#ffffff" width="100%" cellspacing="0" cellpadding="0">
<tr><td valign="top" style="padding:15px;">

