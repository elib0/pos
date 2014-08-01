<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset={$charset}" />
<title>{$companyname} - {$pagetitle}{if $kbarticle.title} - {$kbarticle.title}{/if}</title>
{if $systemurl}<base href="{$systemurl}" />{/if}
<link rel="stylesheet" type="text/css" href="templates/{$template}/style.css" />
	<link rel="shortcut icon" href="templates/{$template}/favicon.ico" />
<script type="text/javascript" src="includes/jscript/jquery.js"></script>
</head>
<body>
<div id="top_container">
  <div id="top">
    <div id="company_title"><a class="nada" href="http://panel.superawesomehost.com/index.php"><img src="templates/{$template}/images/logo-panel.png" alt="logo" /></a></div>
    <div id="welcome_box">{if $loggedin}{$LANG.welcomeback}, <strong>{$clientsdetails.firstname}</strong><span style="padding-right:20px;"></span><img src="templates/{$template}/images/icons/user_suit_black.png" alt="{$LANG.clientareanavdetails}" width="16" height="16" border="0" class="absmiddle" /> <a href="clientarea.php?action=details" title="{$LANG.clientareanavdetails}"><strong>{$LANG.clientareanavdetails}</strong></a><span style="padding-right:20px;"></span><img src="templates/{$template}/images/icons/key_go.png" alt="{$LANG.logouttitle}" width="16" height="16" border="0" class="absmiddle" /> <a href="logout.php" title="Logout"><strong>{$LANG.logouttitle}</strong></a>{else}{$LANG.please} <a href="clientarea.php" title="{$LANG.loginbutton}"><strong>{$LANG.loginbutton}</strong></a> {$LANG.or} <a href="register.php" title="{$LANG.clientregistertitle}"><strong>{$LANG.clientregistertitle}</strong></a>{/if}</div>
  </div>
</div>
<div id="content_container">
{if $loggedin}
  <div id="top_menu">
    <ul>
      <li><a href="clientarea.php" title="{$LANG.clientareanavhome}">{$LANG.clientareanavhome}</a></li>
      <li><a href="clientarea.php?action=details" title="{$LANG.clientareanavdetails}">{$LANG.clientareanavdetails}</a></li>
      <li><a href="clientarea.php?action=products" title="{$LANG.clientareanavservices}">{$LANG.clientareanavservices}</a></li>
      <li><a href="clientarea.php?action=domains" title="{$LANG.clientareanavdomains}">{$LANG.clientareanavdomains}</a></li>
      <li><a href="clientarea.php?action=invoices" title="{$LANG.invoices}">{$LANG.invoices}</a></li>
      <li><a href="supporttickets.php" title="{$LANG.clientareanavsupporttickets}">{$LANG.clientareanavsupporttickets}</a></li>
      <li><a href="affiliates.php" title="{$LANG.affiliatestitle}">{$LANG.affiliatestitle}</a></li>
      <li><a href="clientarea.php?action=emails" title="{$LANG.clientareaemails}">{$LANG.clientareaemails}</a></li>
    </ul>
    <div class="clear"></div>
  </div>
{/if}
  <div id="content_left">
    <h1>{$pagetitle}</h1>
	<p class="breadcrumb">{$breadcrumbnav}</p>