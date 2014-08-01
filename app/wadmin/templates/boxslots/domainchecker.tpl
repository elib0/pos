{if $bulkdomainsearchenabled}

<ul class="breadcrumbs">
  <li><strong>{$LANG.domainsimplesearch}</strong></li>
  <li><a href="domainchecker.php?search=bulkregister">{$LANG.domainbulksearch}</a></li>
  <li><a href="domainchecker.php?search=bulktransfer">{$LANG.domainbulktransfersearch}</a></li>
</ul>

{/if}

{if !$loggedin && $currencies}
<form method="post" action="domainchecker.php">
  <p align="right">{$LANG.choosecurrency}:
    <select name="currency" onchange="submit()">
      {foreach from=$currencies item=curr}

      <option value="{$curr.id}"{if $curr.id eq $currency.id} selected{/if}>{$curr.code}</option>
      
{/foreach}
    </select>
    <input type="submit" value="{$LANG.go}" />
  </p>
</form>
{/if}

{if $lookup}

{if $available}
  <p align="center" class="button success radius" style="font-size:18px;">{$LANG.domainavailable1} <strong>{$domain}{$ext}</strong> {$LANG.domainavailable2}</p>
{elseif $invalid}
  <p align="center" class="button alert radius" style="font-size:18px;">{$LANG.ordererrordomaininvalid}</p>
{elseif $error}
  <p align="center" class="button alert radius" style="font-size:18px;">{$LANG.domainerror}</p>
{else}
  <p align="center" class="button alert radius" style="font-size:18px;">{$LANG.domainunavailable1} <strong>{$domain}{$ext}</strong> {$LANG.domainunavailable2}</p>
{/if}

{if !$invalid}
<h4>{$LANG.morechoices}</h4>
<form method="post" action="{$systemsslurl}cart.php?a=add&domain=register">
  <table width="100%" border="0" cellpadding="10" cellspacing="0" class="data">
    <tr>
      <th width="20"></td>
      <th>{$LANG.domainname}</th>
      <th>{$LANG.domainstatus}</th>
      <th>{$LANG.domainmoreinfo}</th>
    </tr>
    {foreach key=num item=result from=$availabilityresults}
    <tr>
      <td>{if $result.status eq "available"}
        <input type="checkbox" name="domains[]" value="{$result.domain}" {if $num eq "0" && $available}checked {/if}/>
        <input type="hidden" name="domainsregperiod[{$result.domain}]" value="{$result.period}" />
        {else}X{/if}</td>
      <td>{$result.domain}</td>
      <td class="{if $result.status eq "available"}textgreen{else}textred{/if}">{if $result.status eq "available"}{$LANG.domainavailable}{else}{$LANG.domainunavailable}{/if}</td>
      <td>{if $result.status eq "unavailable"}<a href="http://{$result.domain}" target="_blank">WWW</a> <a href="#" onclick="window.open('whois.php?domain={$result.domain}','whois','width=500,height=400,scrollbars=yes');return false">WHOIS</a>{else}
        <select name="domainsregperiod[{$result.domain}]">
          {foreach key=period item=regoption from=$result.regoptions}
          <option value="{$period}">{$period} {$LANG.orderyears} @ {$regoption.register}</option>
          {/foreach}
        </select>
        {/if}</td>
    </tr>
    {/foreach}
  </table>
  <p align="center">
    <input type="submit" class="button  radius" value="{$LANG.ordernowbutton} >>" />
  </p>
</form>
{/if}

{else}
<h2>{$LANG.domainspricing}</h2>
<table width="100%" border="0" cellpadding="10" cellspacing="0" class="data">
  <tr>
    <th>{$LANG.domaintld}</th>
    <th>{$LANG.domainminyears}</th>
    <th>{$LANG.domainsregister}</th>
    <th>{$LANG.domainstransfer}</th>
    <th>{$LANG.domainsrenew}</th>
  </tr>
  {foreach key=num item=tldpricelist from=$tldpricelist}
  <tr>
    <td>{$tldpricelist.tld}</td>
    <td>{$tldpricelist.period}</td>
    <td>{if $tldpricelist.register}{$tldpricelist.register}{else}{$LANG.domainregnotavailable}{/if}</td>
    <td>{if $tldpricelist.transfer}{$tldpricelist.transfer}{else}{$LANG.domainregnotavailable}{/if}</td>
    <td>{if $tldpricelist.renew}{$tldpricelist.renew}{else}{$LANG.domainregnotavailable}{/if}</td>
  </tr>
  {/foreach}
</table>
{/if}


<p>{$LANG.domainintrotext}</p>
<form method="post" action="domainchecker.php">

  <div > 
  
    <div class="row collapse">
            <div class="small-1 columns">
              <span class="prefix radius">www.</span>
            </div>
            <div class="small-11 columns">
              <input type="text" id="domain" name="domain" class="imput-domains" value="{$domain}" /> 
            </div>
            
    </div>


    <table border="0" align="center" cellpadding="10" cellspacing="0">
      <tr> {foreach key=num item=listtld from=$tldslist}
        <td align="left"><input type="checkbox" name="tlds[]" value="{$listtld}"{if in_array($listtld,$tlds)} checked{/if}>
          {$listtld}</td>
        {if $num % 5 == 0}</tr>
      <tr>{/if}{/foreach} </tr>
    </table>
    {if $capatacha}
    

    <div class="row collapse">
           
            <div class="small-2 columns">
             <img src="includes/verifyimage.php" alt="Verify Image" border="0" class="absmiddle" />
            </div>
            <div class="small-3 columns">
              <input type="text" name="code" maxlength="5">
            </div>
             <div class="small-7 columns">
             <strong>{$LANG.imagecheck}</strong>
            </div>
    </div>
    {/if}
     
    <input type="submit" class="button  radius" id="Submit" value="{$LANG.domainlookupbutton}">
  </div>
</form>