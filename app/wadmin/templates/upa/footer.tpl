  </div>
  <div id="side_menu">
{if $loggedin}
    <p class="header">{$LANG.accountinfo}</p>
<p style="line-height:24px;margin-left:5px;"><strong><img src="templates/{$template}/images/icons/user-business.png" alt="user" width="16" height="16" border="0" class="absmiddle" /> {$clientsdetails.firstname} {$clientsdetails.lastname} <br /><img src="templates/{$template}/images/icons/building-medium.png" alt="user" width="16" height="16" border="0" class="absmiddle" /> {if $clientsdetails.companyname}{$clientsdetails.companyname}{/if}</strong><br />
<img src="templates/{$template}/images/icons/marker.png" alt="user" width="16" height="16" border="0" class="absmiddle" /> {$clientsdetails.address1}, {$clientsdetails.address2}<br />
<img src="templates/{$template}/images/icons/map-pin.png" alt="user" width="16" height="16" border="0" class="absmiddle" /> {$clientsdetails.city}, {$clientsdetails.state}, {$clientsdetails.postcode}<br />
<img src="templates/{$template}/images/icons/locale.png" alt="user" width="16" height="16" border="0" class="absmiddle" /> {$clientsdetails.countryname}<br />
<img src="templates/{$template}/images/icons/mail.png" alt="user" width="16" height="16" border="0" class="absmiddle" /> {$clientsdetails.email}<br /><br />
{if $addfundsenabled}<img src="templates/{$template}/images/icons/money.gif" alt="Add Funds" width="22" height="22" border="0" class="absmiddle" /> <a href="clientarea.php?action=addfunds">{$LANG.addfunds}</a>{/if}</p>
    <p class="header">{$LANG.accountstats}</p>
    <p style="line-height:18px;">{$LANG.statsnumproducts}: <strong>{$clientsstats.productsnumactive}</strong> ({$clientsstats.productsnumtotal})<br />
{$LANG.statsnumdomains}: <strong>{$clientsstats.numactivedomains}</strong> ({$clientsstats.numdomains})<br />
{$LANG.statsnumtickets}: <strong>{$clientsstats.numtickets}</strong><br />
{$LANG.statsnumreferredsignups}: <strong>{$clientsstats.numaffiliatesignups}</strong><br />
{$LANG.statscreditbalance}: <strong>{$clientsstats.creditbalance}</strong><br />
{$LANG.statsdueinvoicesbalance}: <strong>{if $clientsstats.numdueinvoices>0}<span class="red">{/if}{$clientsstats.dueinvoicesbalance}{if $clientsstats.numdueinvoices>0}</span>{/if}</strong></p>
{else}
<form method="post" action="{$systemsslurl}dologin.php">
  <p class="header">{$LANG.clientlogin}</p>
  <p><input name="username" id="username" type="text" size="25" />  </p>
  <p><input name="password" id="password" type="password" size="25" /></p>
  <p><input type="submit" class="submitbutton" value="{$LANG.loginbutton}" /></p>
</form>

  <p class="header">{$LANG.knowledgebasesearch}</p>
<form method="post" action="knowledgebase.php?action=search">
  <p><input name="search" type="text" id="kb" size="25" /></p>
    <p><select name="searchin" id="kb-dos">
      <option value="Knowledgebase">{$LANG.knowledgebasetitle}</option>
      <option value="Downloads">{$LANG.downloadstitle}</option>
    </select>&nbsp;<input type="submit" value="{$LANG.go}" /></p>
  </p>
</form>
{/if}
{if $langchange}<br /><br /><div>{$setlanguage}</div><br />{/if}
  </div>
  <div class="clear"></div>
</div>
<div id=futer><a href="index.php" title="{$LANG.globalsystemname}">{$LANG.globalsystemname}</a> | <a href="clientarea.php" title="{$LANG.clientareatitle}">{$LANG.clientareatitle}</a> | <a href="announcements.php" title="{$LANG.announcementstitle}">{$LANG.announcementstitle}</a> | <a href="knowledgebase.php" title="{$LANG.knowledgebasetitle}">{$LANG.knowledgebasetitle}</a> | 
      </a> <a href="submitticket.php" title="{$LANG.supportticketspagetitle}">{$LANG.supportticketssubmitticket}</a> | <a href="downloads.php" title="{$LANG.downloadstitle}">{$LANG.downloadstitle}</a> | <a href="cart.php" title="{$LANG.ordertitle}">{$LANG.ordertitle}</a><br />Copyright &copy; 2010. Your Hosting Company - User Panel Awesome theme fueled by <a href="http://www.davidabellan.com">David Abellan</a> a proud member of <a href="http://www.abellandesign.com/">abellanDESIGN</a></div>
</body>
</html>