<div class="contentbox"><a href="{$smarty.server.PHP_SELF}?action=details">{$LANG.clientareanavdetails}</a> | <strong>{$LANG.clientareanavcontacts}</strong> | <a href="{$smarty.server.PHP_SELF}?action=addcontact">{$LANG.clientareanavaddcontact}</a>{if $ccenabled} | <a href="{$smarty.server.PHP_SELF}?action=creditcard">{$LANG.clientareanavchangecc}</a>{/if} | <a href="{$smarty.server.PHP_SELF}?action=changepw">{$LANG.clientareanavchangepw}</a> | <a href="{$smarty.server.PHP_SELF}?action=changesq">{$LANG.clientareanavsecurityquestions}</a></div>
<script langauge="JavaScript">
function deleteContact() {ldelim}
if (confirm("{$LANG.clientareadeletecontactareyousure}")) {ldelim}
window.location='clientarea.php?action=contacts&delete=true&id={$contactid}';
{rdelim}{rdelim}
</script>
<h2>{$LANG.clientareanavcontacts}</h2>
{if $contactid}
<form method="post" action="{$smarty.server.PHP_SELF}?action=contacts">
  <p>{$LANG.clientareachoosecontact}:
    <select name="id" onchange="submit()">
      {foreach item=contact from=$contacts}

      <option value="{$contact.id}"{if $contact.id eq $contactid} selected="selected"{/if}>{$contact.name} - {$contact.email}</option>
      
{/foreach}
    </select>
  </p>
</form>
{if $successful}
<div class="successbox">{$LANG.changessavedsuccessfully}</div>
<br />
{/if}
{if $errormessage}
<div class="errorbox">{$errormessage}</div>
<br />
{/if}
<form method="post" action="{$smarty.server.PHP_SELF}?action=contacts&id={$contactid}">
  <input type="hidden" name="submit" value="true" />
  <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" cellpadding="10" cellspacing="0">
          <tr>
            <td width="150" class="fieldarea">{$LANG.clientareafirstname}</td>
            <td><input type="text" name="firstname" value="{$clientfirstname}" size="25" /></td>
          </tr>
          <tr>
            <td class="fieldarea">{$LANG.clientarealastname}</td>
            <td><input type="text" name="lastname" value="{$clientlastname}" size="25" /></td>
          </tr>
          <tr>
            <td class="fieldarea">{$LANG.clientareacompanyname}</td>
            <td><input type="text" name="companyname" value="{$clientcompanyname}" size="25" /></td>
          </tr>
          <tr>
            <td class="fieldarea">{$LANG.clientareaemail}</td>
            <td><input type="text" name="email" value="{$clientemail}" size="50" /></td>
          </tr>
          <tr>
            <td class="fieldarea">{$LANG.clientareaaddress1}</td>
            <td><input type="text" name="address1" value="{$clientaddress1}" size="25" /></td>
          </tr>
          <tr>
            <td class="fieldarea">{$LANG.clientareaaddress2}</td>
            <td><input type="text" name="address2" value="{$clientaddress2}" size="25" /></td>
          </tr>
          <tr>
            <td class="fieldarea">{$LANG.clientareacity}</td>
            <td><input type="text" name="city" value="{$clientcity}" size="25" /></td>
          </tr>
          <tr>
            <td class="fieldarea">{$LANG.clientareastate}</td>
            <td><input type="text" name="state" value="{$clientstate}" size="25" /></td>
          </tr>
          <tr>
            <td class="fieldarea">{$LANG.clientareapostcode}</td>
            <td><input type="text" name="postcode" value="{$clientpostcode}" size="25" /></td>
          </tr>
          <tr>
            <td class="fieldarea">{$LANG.clientareacountry}</td>
            <td>{$countriesdropdown}</td>
          </tr>
          <tr>
            <td class="fieldarea">{$LANG.clientareaphonenumber}</td>
            <td><input type="text" name="phonenumber" value="{$clientphonenumber}" size="25" /></td>
          </tr>
          <tr>
            <td class="fieldarea">{$LANG.clientareacontactsemails}</td>
            <td><input type="checkbox" name="generalemails" value="1"{if $generalemails} checked{/if} />
              {$LANG.clientareacontactsemailsgeneral}<br />
              <input type="checkbox" name="productemails" value="1"{if $productemails} checked{/if} />
              {$LANG.clientareacontactsemailsproduct}<br />
              <input type="checkbox" name="domainemails" value="1"{if $domainemails} checked{/if} />
              {$LANG.clientareacontactsemailsdomain}<br />
              <input type="checkbox" name="invoiceemails" value="1"{if $invoiceemails} checked{/if} />
              {$LANG.clientareacontactsemailsinvoice}<br />
              <input type="checkbox" name="supportemails" value="1"{if $supportemails} checked{/if} />
              {$LANG.clientareacontactsemailssupport}<br /></td>
          </tr>
      </table></td>
    </tr>
  </table>
  <p align="center">
    <input type="submit" value="{$LANG.clientareasavechanges}" class="button" />
    <input type="reset" value="{$LANG.clientareacancel}" class="button" />
    <input type="button" value="{$LANG.clientareadeletecontact}" class="button" onclick="deleteContact()" />
  </p>
</form>
{else}
<div class="errorbox">{$LANG.clientareanocontacts}</div>
{/if}