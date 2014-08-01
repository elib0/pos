<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset={$charset}" />
<title>{$companyname} - {$pagetitle}{if $kbarticle.title} - {$kbarticle.title}{/if}</title>
{if $systemurl}<base href="{$systemurl}" />{/if}
<link rel="stylesheet" type="text/css" href="templates/{$template}/style.css" />
<script type="text/javascript" src="includes/jscript/jquery.js"></script>
{if $livehelpjs}{$livehelpjs}{/if}
<link rel="shortcut icon" href="http://www.whmcsthemes.com/images/favicon.ico" />

<link href="templates/{$template}/html/style.css" rel="stylesheet" type="text/css" />
<link href="templates/{$template}/html/layout.css" rel="stylesheet" type="text/css" />
</head>
<body id="page1">
<div class="tail-top-right"></div>
<div id="main">
  <!-- header -->
  <div id="header">
    <ul class="site-nav">
      <li><a href="#">Home</a></li>
      <li><a href="#">About-us</a></li>
      <li><a href="#">Articles</a></li>
      <li><a href="contact.php"{if $filename eq "contact"} class="act"{/if}>Contact-us</a></li>
      <li class="last"><a href="clientarea.php"{if $filename eq "clientarea"} class="act"{/if}>Clients</a></li> 
	  
    </ul>
    <div class="logo"><a href="index,php"><img src="templates/{$template}/html/images/logo.gif" alt="" /></a></div>
  </div>
  <!-- content -->
  <div id="content">
    <div class="wrapper">
      <div class="col-1">
        <div class="box">
          <div class="border-top">
            <div class="border-right">
              <div class="border-bot">
                <div class="border-left">
                  <div class="inner">
                    <div class="title"><img src="templates/{$template}/html/images/extra-title.gif" alt="" /></div>
                    <ul class="list">
	{if $loggedin}
      <li><span><a href="clientarea.php" title="{$LANG.clientareanavhome}">{$LANG.clientareanavhome}</a></span></li>
      <li><span><a href="clientarea.php?action=details" title="{$LANG.clientareanavdetails}">{$LANG.clientareanavdetails}</a></span></li>
      <li><span><a href="clientarea.php?action=products" title="{$LANG.clientareanavservices}">{$LANG.clientareanavservices}</a></span></li>
      <li><span><a href="clientarea.php?action=domains" title="{$LANG.clientareanavdomains}">{$LANG.clientareanavdomains}</a></span></li>
      <li><span><a href="clientarea.php?action=invoices" title="{$LANG.invoices}">{$LANG.invoices}</a></span></li>
      <li><span><a href="supporttickets.php" title="{$LANG.clientareanavsupporttickets}">{$LANG.clientareanavsupporttickets}</a></span></li>
      <li><span><a href="affiliates.php" title="{$LANG.affiliatestitle}">{$LANG.affiliatestitle}</a></span></li>
      <li><span><a href="clientarea.php?action=emails" title="{$LANG.clientareaemails}">{$LANG.clientareaemails}</a></span></li>
      <li><span><a href="logout.php" title="{$LANG.logouttitle}">{$LANG.logouttitle}</a></span></li>
	  {else}
      <li><span><a href="index.php" title="{$LANG.globalsystemname}">{$LANG.globalsystemname}</a></span></li>
      <li><span><a href="register.php" title="{$LANG.clientregistertitle}">{$LANG.clientregistertitle}</a></span></li>
      <li><span><a href="clientarea.php" title="{$LANG.clientareatitle}">{$LANG.clientareatitle}</a></span></li>
      <li><span><a href="announcements.php" title="{$LANG.announcementstitle}">{$LANG.announcementstitle}</a></span></li>
      <li><span><a href="knowledgebase.php" title="{$LANG.knowledgebasetitle}">{$LANG.knowledgebasetitle}</a></span></li>
      <li><span><a href="submitticket.php" title="{$LANG.supportticketspagetitle}">{$LANG.supportticketssubmitticket}</a></span></li>
      <li><span><a href="downloads.php" title="{$LANG.downloadstitle}">{$LANG.downloadstitle}</a></span></li>
      <li><span><a href="cart.php" title="{$LANG.ordertitle}">{$LANG.ordertitle}</a></span></li>
	  
	  {/if}
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="banner"><a href="#"><img src="templates/{$template}/html/images/banner.gif" alt="" /></a></div>

      </div>
      <div class="col-2">
        <div class="indent">
          <div class="title"><h1>{$pagetitle}</h1></div>
		 <p><em>You are here:</em> {$breadcrumbnav}</p>
		 <pre>
		 </pre>