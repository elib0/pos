<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset={$charset}" />
<title>WHMCS - {$pagetitle}</title>
<link href="templates/blend/style.css" rel="stylesheet" type="text/css" />
<link href="../includes/jscript/css/ui.all.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../includes/jscript/jquery.js"></script>
<script type="text/javascript" src="../includes/jscript/jqueryui.js"></script>
<script type="text/javascript" src="../includes/jscript/adminsearchbox.js"></script>
{literal}<script>
function intellisearch() {
    $("#greyout").fadeIn();
    $("#searchresultsscroller").html('<div align="center"><img src="../images/loading.gif"></div>');
    $("#searchresults").show();
    $("#popupcontainer").slideDown();
    $.post("search.php", { intellisearch: "true", value: $("#intellisearchval").val() },
    function(data){
        $("#searchresultsscroller").html(data);
    });
}
function searchclose() {
    $("#intellisearchval").val("");
    $("#popupcontainer").toggle("slow",function () {
        $("#searchresults").hide();
    });
    $("#greyout").fadeOut();
}
function notesclose(save) {
    $("#popupcontainer").toggle("slow",function () {
        $("#mynotes").hide();
    });
    if (save) $.post("index.php", { action: "savenotes", notes: $("#mynotesbox").val() });
    $("#greyout").fadeOut();
}
  $(document).ready(function(){
    $( "button, input:submit, input:button, input:reset" ).button();
    $("#shownotes").click(function () {
        $("#mynotes").show();
        $("#greyout").fadeIn();
        $("#popupcontainer").slideDown();
        return false;
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

<div class="topbar">
<div class="left"><a href="index.php">{$_ADMINLANG.home.title}</a> | <a href="../">{$_ADMINLANG.global.clientarea}</a> | <a href="#" id="shownotes">{$_ADMINLANG.global.mynotes}</a> | <a href="myaccount.php">{$_ADMINLANG.global.myaccount}</a> | <a href="logout.php">{$_ADMINLANG.global.logout}</a></div>
<div class="right">
{$smarty.now|date_format:"%A, %d %B %Y, %H:%M"}
</div>
</div>

<div class="header">
<div class="logo"><a href="index.php"><img src="templates/blend/logo.gif" border="0" /></a></div>
<div class="stats"><a href="orders.php?status=Pending"><span class="stat">{$sidebarstats.orders.pending}</span> {$_ADMINLANG.stats.pendingorders}</a> | <a href="invoices.php?status=Overdue"><span class="stat">{$sidebarstats.invoices.overdue}</span> {$_ADMINLANG.stats.overdueinvoices}</a> | <a href="supporttickets.php"><span class="stat">{$sidebarstats.tickets.awaitingreply}</span> {$_ADMINLANG.stats.ticketsawaitingreply}</a></div>
</div>

{include file="blend/menu.tpl"}

<div class="contentarea">

<h1>{$pagetitle}</h1>
