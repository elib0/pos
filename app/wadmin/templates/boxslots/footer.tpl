  </div> 
  </div>
  <div id="content-b"></div>
  </div>
  <div class="large-3 columns">
    <div id="side_menu_top"></div>
    <div id="side_menu_bg">
      <div id="side_menu_align">
        <p class="header">{$LANG.quicknav}</p>
        <ul class="side-nav">
          <li><a href="index.php"><img width="20px"   src="templates/{$template}/images/home.png" alt="{$LANG.globalsystemname}">&nbsp;Inicio</a></li>
          <li><a href="clientarea.php"><img width="20px"  src="templates/{$template}/images/clientarea.png" alt="{$LANG.clientareatitle}">&nbsp;{$LANG.clientareatitle}</a></li>
          <li><a href="announcements.php" title="{$LANG.announcementstitle}"><img width="20px"  src="templates/{$template}/images/announcements.png" alt="{$LANG.announcementstitle}">&nbsp;{$LANG.announcementstitle}</a></li>
          <li><a href="knowledgebase.php" title="{$LANG.knowledgebasetitle}"><img width="20px"  src="templates/{$template}/images/knowledgebase.png" alt="{$LANG.knowledgebasetitle}">&nbsp;{$LANG.knowledgebasetitle}</a></li>
          <li><a href="submitticket.php" title="{$LANG.supportticketssubmitticket}"><img width="20px"  src="templates/{$template}/images/supporttickets.png" alt="{$LANG.supportticketssubmitticket}">&nbsp;{$LANG.supportticketssubmitticket}</a></li>
          <li><a href="downloads.php" title="{$LANG.downloadstitle}"><img width="20px"  src="templates/{$template}/images/downloads.png" alt="{$LANG.downloadstitle}">&nbsp;{$LANG.downloadstitle}</a></li>
          <li><a href="cart.php" title="{$LANG.ordertitle}"><img width="20px"  src="templates/{$template}/images/cart.png" alt="{$LANG.ordertitle}">&nbsp;{$LANG.ordertitle}</a></li>
          {if $loggedin}
          <li><a href="submitticket.php?step=2&deptid=1" title="Registre los pagos de sus servicios."><img width="20px"  src="templates/{$template}/images/nav-order.png" alt="Registre los pagos de sus servicios.">&nbsp;Registre su Pago</a></li>
          {/if}
        </ul>
{if $livehelp}
<p class="header">{$LANG.chatlivehelp}</p>
{$livehelp}
{/if}
{if $loggedin}</div>
      <div class="side_menu_sep"></div>
      <div id="side_menu_align">
        <p class="header">{$LANG.accountinfo}</p>
        <p><strong>{$clientsdetails.firstname} {$clientsdetails.lastname} {if $clientsdetails.companyname}({$clientsdetails.companyname}){/if}</strong><br />
{$clientsdetails.address1}, {$clientsdetails.address2}<br />
{$clientsdetails.city}, {$clientsdetails.state}, {$clientsdetails.postcode}<br />
{$clientsdetails.countryname}<br />
{$clientsdetails.email}<br /><br />
{if $addfundsenabled}<img src="templates/{$template}/images/money.gif" alt="Add Funds" width="22" height="22" border="0" class="absmiddle" /> <a href="clientarea.php?action=addfunds">{$LANG.addfunds}</a>{/if}</p>
      </div>
      <div class="side_menu_sep"></div>
      <div id="side_menu_align">
        <p class="header">{$LANG.accountstats}</p>
        <p>{$LANG.statsnumproducts}: <strong>{$clientsstats.productsnumactive}</strong> ({$clientsstats.productsnumtotal})<br />
{$LANG.statsnumdomains}: <strong>{$clientsstats.numactivedomains}</strong> ({$clientsstats.numdomains})<br />
{$LANG.statsnumtickets}: <strong>{$clientsstats.numtickets}</strong><br />
{$LANG.statsnumreferredsignups}: <strong>{$clientsstats.numaffiliatesignups}</strong><br />
{$LANG.statscreditbalance}: <strong>{$clientsstats.creditbalance}</strong><br />
{$LANG.statsdueinvoicesbalance}: <strong>{if $clientsstats.numdueinvoices>0}<span class="red">{/if}{$clientsstats.dueinvoicesbalance}{if $clientsstats.numdueinvoices>0}</span>{/if}</strong></p>
{else}
<form method="post" action="{$systemsslurl}dologin.php">
  <p class="header">{$LANG.clientlogin}</p>
  <p><strong>{$LANG.email}</strong><br />
    <input name="username" type="text" size="25" />
  </p>
  <p><strong>{$LANG.loginpassword}</strong><br />
    <input name="password" type="password" size="25" />
  </p>
  <p>
    <input type="checkbox" name="rememberme" />
    {$LANG.loginrememberme}</p>
  <p>
    <input type="submit" class="button radius tiny" value="{$LANG.loginbutton}" />
  </p>
</form>
  <p class="header">{$LANG.knowledgebasesearch}</p>
<form method="post" action="knowledgebase.php?action=search">
  <p>
    <input name="search" type="text" size="25" /><br />
    <select name="searchin">
      <option value="Knowledgebase">{$LANG.knowledgebasetitle}</option>
      <option value="Downloads">{$LANG.downloadstitle}</option>
    </select>
    <input type="submit" class="button radius tiny" value="{$LANG.go}" />
  </p>
</form>
{/if} 
  
{if $twitterusername}<br />
<p align="center"><a href="http://twitter.com/{$twitterusername}" target="_blank"><img src="images/twitterfollow.png" width="150" border="0" alt="{$LANG.twitterfollow}" /></a></p>
{/if}

{if $langchange}<div align="right">{$setlanguage}</div><br />{/if}				
	</div>
	</div>
    <div id="side_menu_bottom"></div>
  </div>


  </div>
  </div>

</div>
</div>



<script src="http://www.websarrollo.com/js/foundation.min.js"></script>

<script src="http://www.websarrollo.com/js/functions.min.js"></script>
<script type="text/javascript" src="templates/orderforms/{$carttpl}/js/main.min.js"></script>
<script>
  $(document).foundation();
</script>

</body>
</html>