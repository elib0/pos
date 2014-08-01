
<div class="panel">{$LANG.cartproductselection}: {$productinfo.groupname} - {$productinfo.name} <br><small>{$LANG.cartmakedomainselection}</small></div>

<div id="domainpopupcontainer" class="panel callout radius">
    <form id="domainfrm" onsubmit="completedomain();return false">
        <div class="domainresults" id="domainresults"></div>
    </form>
</div>

<form onsubmit="checkdomain();return false">

<div class="domainoptions">
{if $incartdomains}
<div class="panel">
    <input type="radio" name="domainoption" value="incart" id="selincart" /><label for="selincart">{$LANG.cartproductdomainuseincart}</label>

    <div class="domainreginput" id="domainincart">

        <select id="incartsld" class="button radius" >
        {foreach key=num item=incartdomain from=$incartdomains}
        <option value="{$incartdomain}">{$incartdomain}</option>
        {/foreach}
        </select> <input type="submit" class="button  radius" value="{$LANG.ordercontinuebutton}" />
    
    </div>
</div>
{/if}
{if $registerdomainenabled}
<div class="panel">
    <input type="radio" name="domainoption" value="register" id="selregister" /><label for="selregister">{$LANG.cartregisterdomainchoice|sprintf2:$companyname}</label>
    <div class="domainreginput" id="domainregister">

        
          <div class="row collapse">
            <div class="small-1 columns">
              <span class="prefix radius">www.</span>
            </div>
            <div class="small-10 columns">
              <input type="text" id="registersld" class="imput-domains" value="{$sld}" /> 
            </div>
            <div class="small-1 columns">
              <select id="registertld" class="button radius postfix" >
                {foreach key=num item=listtld from=$registertlds}
                <option value="{$listtld}"{if $listtld eq $tld} selected="selected"{/if}>{$listtld}</option>
                {/foreach}
             </select> 
            </div>
            
          </div>

        
        <input type="submit" class="button  radius" value="{$LANG.checkavailability}" />


    </div>
</div>
{/if}
{if $transferdomainenabled}
<div class="panel">
<input type="radio" name="domainoption" value="transfer" id="seltransfer" /><label for="seltransfer">{$LANG.carttransferdomainchoice|sprintf2:$companyname}</label>
<div class="domainreginput" id="domaintransfer">
    
        <div class="row collapse">
            <div class="small-1 columns">
              <span class="prefix radius">www.</span>
            </div>
            <div class="small-10 columns">
              <input type="text" id="transfersld" class="imput-domains" value="{$sld}" /> 
            </div>
            <div class="small-1 columns">
              <select id="transfertld" class="button radius postfix" >
                {foreach key=num item=listtld from=$registertlds}
                <option value="{$listtld}"{if $listtld eq $tld} selected="selected"{/if}>{$listtld}</option>
                {/foreach}
             </select> 
            </div>
            
          </div>
        <input type="submit" class="button  radius" value="{$LANG.checkavailability}" />

</div>
</div>
{/if}
{if $owndomainenabled}
<div class="panel">
<input type="radio" name="domainoption" value="owndomain" id="selowndomain" /><label for="selowndomain">{$LANG.cartexistingdomainchoice|sprintf2:$companyname}</label>
<div class="domainreginput" id="domainowndomain">

    <div class="row collapse">
            <div class="small-1 columns">
              <span class="prefix radius">www.</span>
            </div>
            <div class="small-10 columns">
              <input type="text" id="owndomainsld" class="imput-domains" value="{$sld}" /> 
            </div>
            <div class="small-1 columns">
                <input type="text" id="owndomaintld" class="imput-domains" value="{$tld|substr:1}" />
              
            </div>
            
  </div>

    
    <input type="submit" class="button  radius" value="{$LANG.ordercontinuebutton}" />



</div>
</div>
{/if}
{if $subdomains}
<div class="panel">
<input type="radio" name="domainoption" value="subdomain" id="selsubdomain" /><label for="selsubdomain">{$LANG.cartsubdomainchoice|sprintf2:$companyname}</label>
<div class="domainreginput" id="domainsubdomain">

http:// <input type="text" id="subdomainsld" size="30" value="{$sld}" /> 
<select id="subdomaintld">
    {foreach from=$subdomains key=subid item=subdomain}
    <option value="{$subid}">{$subdomain}</option>
    {/foreach}
</select> 
<input type="submit" value="{$LANG.ordercontinuebutton}" />

</div>
</div>
{/if}
</div>

{if $freedomaintlds}<p>* <em>{$LANG.orderfreedomainregistration} {$LANG.orderfreedomainappliesto}: {$freedomaintlds}</em></p>{/if}

</form>

<div id="greyout"></div>


<div id="prodconfigcontainer"></div>

{literal}
<script language="javascript">
jQuery(".domainreginput").hide();
jQuery("#domainpopupcontainer").hide();
jQuery(".domainoptions input:first").attr('checked','checked');
//jQuery(".domainoptions input:first").parent().addClass('optionselected');
//jQuery(".domainoptions .option").first().css('-moz-border-radius-topleft','10px').css('-moz-border-radius-topright','10px');
//jQuery(".domainoptions .option").last().css('border-bottom','0').css('-moz-border-radius-bottomleft','10px').css('-moz-border-radius-bottomright','10px');
jQuery("#domain"+jQuery(".domainoptions input:first").val()).show();

jQuery(document).ready(function(){


    jQuery(".domainoptions input:radio").click(function(){
       // jQuery(".domainoptions .option").removeClass('optionselected');
        //jQuery(this).parent().addClass('optionselected');
        //jQuery("#domainresults").slideUp();

        jQuery("#domainpopupcontainer").hide();
        jQuery(".domainreginput").hide();
        jQuery("#domain"+jQuery(this).val()).show();
    });
});
function checkdomain() {
    jQuery("#greyout").fadeIn();
    jQuery("#domainpopupcontainer").fadeIn();
    jQuery("#domainpopupcontainer").slideDown();
    jQuery("#domainresults").html('<img src="images/loading.gif" border="0" alt="Loading..." />');
    var domainoption = jQuery(".domainoptions input:checked").val();
    var sld = jQuery("#"+domainoption+"sld").val();
    var tld = '';
    if (domainoption=='incart') var sld = jQuery("#"+domainoption+"sld option:selected").text();
    if (domainoption=='subdomain') var tld = jQuery("#"+domainoption+"tld option:selected").text();
    else var tld = jQuery("#"+domainoption+"tld").val();

    jQuery.post("cart.php", { ajax: 1, a: "domainoptions", sld: sld, tld: tld, checktype: domainoption },
    function(data){
        jQuery("#domainresults").html(data);
        jQuery("#domainfrm p input:submit").addClass('button radius');
        jQuery(".domainavailable").addClass('button success radius');
        jQuery(".domainunavailable").addClass('button alert radius');
        jQuery(".domaininvalid").addClass('button secondary radius');
        
    });
}
function cancelcheck() {
    jQuery("#domainpopupcontainer").fadeIn();
    jQuery("#domainpopupcontainer").slideUp('slow',function() {
        jQuery("#greyout").fadeOut();
        jQuery("#domainresults").html('<img src="images/loading.gif" border="0" alt="Loading..." />');
    });
}
function completedomain() {
    jQuery("#domainresults").append('<img src="images/loading.gif" border="0" alt="Loading..." />');
    window.location='cart.php?a=add&pid={/literal}{$pid}{literal}&'+jQuery("#domainfrm").serialize();
    // jQuery.post("cart.php", 'ajax=1&a=add&pid={/literal}{$pid}{literal}&'+jQuery("#domainfrm").serialize(),
    // function(data){
    //     if (data=='') {
    //         window.location='cart.php?a=view';
    //     } else {
    //         jQuery("#prodconfigcontainer").html(data);
    //         jQuery("#domainpopupcontainer").fadeIn();
    //         jQuery("#domainpopupcontainer").slideUp('slow',function() {
    //             jQuery("#greyout").fadeOut();
    //         });
    //         jQuery("#prodconfigcontainer").slideDown();
    //     }
    // });
}
</script>
{/literal}