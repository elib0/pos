<script type="text/javascript" src="includes/jscript/pwstrength.js"></script>


<ul class="breadcrumbs">
  <li ><a href="{$smarty.server.PHP_SELF}?action=details">{$LANG.clientareanavdetails}</a> </li>
  <li ><a href="{$smarty.server.PHP_SELF}?action=contacts">{$LANG.clientareanavcontacts}</a></li>
  <li ><a href="{$smarty.server.PHP_SELF}?action=addcontact">{$LANG.clientareanavaddcontact}</a>{if $ccenabled}</li>
  <li ><a href="{$smarty.server.PHP_SELF}?action=creditcard">{$LANG.clientareanavchangecc}</a>{/if}  </li>
  <li class="current"><strong>{$LANG.clientareanavchangepw}</strong>  </li>
  <li ><a href="{$smarty.server.PHP_SELF}?action=changesq">{$LANG.clientareanavsecurityquestions}</a></li>
</ul>

<h2>{$LANG.clientareanavchangepw}</h2>
{if $successful}
<div class="successbox">{$LANG.changessavedsuccessfully}</div>
<br />
{/if}
{if $errormessage}
<div class="errorbox">{$errormessage}</div>
<br />
{/if}
<form method="post" action="{$smarty.server.PHP_SELF}?action=changepw">
  <input type="hidden" name="submit" value="true" />
  <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="25%" >{$LANG.existingpassword}</td>
            <td><input type="password" name="existingpw" size="25" /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td  >{$LANG.newpassword}</td>
            <td><input type="password" name="newpw" id="newpw" size="25" /></td>
            <td><script language="javascript">showStrengthBar();</script></td>
          </tr>
          <tr>
            <td  >{$LANG.confirmnewpassword}</td>
            <td><input type="password" name="confirmpw" size="25" /></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
  </table>
  <p align="center">
    <input type="reset" value="{$LANG.clientareacancel}" class="tiny button secondary  radius" />
    <input type="submit" value="{$LANG.clientareasavechanges}" class="tiny button  radius" />
    
  </p>
</form>