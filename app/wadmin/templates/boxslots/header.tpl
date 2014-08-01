<!DOCTYPE html>
<html class="no-js" lang="es">
  <head>
    <title>{$companyname} - {$pagetitle}{if $kbarticle.title} - {$kbarticle.title}{/if}</title>
    {if $systemurl}<base href="{$systemurl}" />{/if}

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="http://www.websarrollo.com/css/foundation.min.css" />

    <link rel="stylesheet" href="http://www.websarrollo.com/css/style.min.css">
    
    <script src="http://www.websarrollo.com/js/vendor/modernizr.min.js"></script>
    {if $livehelpjs}{$livehelpjs}
{/if} 
<script src="http://www.websarrollo.com/js/vendor/jquery.min.js"></script>

</head>
<body>
<div class="fixed">

  <nav class="top-bar" data-topbar data-options="is_hover: true">

      <ul class="title-area">
          <li class="name">
              
                  <img src="http://www.websarrollo.com/wadmin/images/logo.png" class="logo" alt="Websarrollo">
                  <!-- <a href="http://www.websarrollo.com/">{$companyname}</a> -->
              
          </li>
          <li class="toggle-topbar menu-icon"><a href=""><span>Menu</span></a></li>
      </ul>

      <ul>
              
          <section class="top-bar-section">

             <!--  <ul class="left">
                  <li>&nbsp;</li>
              </ul> -->

              <ul class="right">
                   {if $loggedin}
                  <li class="divider"></li>
                  <li><a href="clientarea.php" title="{$LANG.clientareanavhome}">{$LANG.clientareanavhome}</a></li>
                  <!--<li class="divider"></li>
                  <li><a href="clientarea.php?action=details" title="{$LANG.clientareanavdetails}">{$LANG.clientareanavdetails}</a></li> -->
                  <li class="divider"></li>
                  <li><a href="clientarea.php?action=products" title="{$LANG.clientareanavservices}">{$LANG.clientareanavservices}</a></li>
                  <li class="divider"></li>
                  <li><a href="clientarea.php?action=domains" title="{$LANG.clientareanavdomains}">{$LANG.clientareanavdomains}</a></li>
                  <li class="divider"></li>
                  <li><a href="clientarea.php?action=invoices" title="{$LANG.invoices}">{$LANG.invoices}</a></li>
                  <li class="divider"></li>
                  <li><a href="supporttickets.php" title="{$LANG.clientareanavsupporttickets}">{$LANG.clientareanavsupporttickets}</a></li>
                  <li class="divider"></li>
                  <!-- <li><a href="affiliates.php" title="{$LANG.affiliatestitle}">{$LANG.affiliatestitle}</a></li>
                  <li class="divider"></li>--> 
                  <li><a href="clientarea.php?action=emails" title="{$LANG.clientareaemails}">{$LANG.clientareaemails}</a></li>
                  <li class="divider"></li>
                    <li class="has-dropdown not-click">
                      <a href="#"><img src="http://websarrollo.com/img/user.png" alt="{$LANG.clientregistertitle}"></a> 
                      <ul class="dropdown">
                        <li><a href="clientarea.php?action=details" title="{$LANG.clientareanavdetails}">{$LANG.clientareanavdetails}</a> </li>
                        <li><a href="logout.php" title="Logout">{$LANG.logouttitle}</a></li>
                      </ul> 
                    </li>
                    {else} 
                    <li><a href="clientarea.php" title="{$LANG.loginbutton}"><img src="http://websarrollo.com/img/lock.png" alt="{$LANG.loginbutton}">&nbsp;{$LANG.loginbutton}</a></li>
                    <li class="divider"></li>
                    <li><a href="register.php" title="{$LANG.clientregistertitle}"><img src="http://websarrollo.com/img/user.png" alt="{$LANG.clientregistertitle}">&nbsp;{$LANG.clientregistertitle}</a></li>
                       
                    {/if}

                  
              </ul>

          </section>

      </ul>
  </nav>

</div>
<div class="row">


  <div class="large-9 columns">
 
  	<div id="breadcrumb"> 
  	  <h2>{$pagetitle}</h2>
  	  <p>{$breadcrumbnav}</p>
	</div>
    	<div id="content-t"></div>
			<div id="content-bg">
				<div id="content">