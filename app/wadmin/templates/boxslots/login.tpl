<p class="panel radius">{$LANG.loginintrotext}</p>
<form action="{$systemsslurl}dologin.php" method="post" name="frmlogin" id="frmlogin">
  {if $incorrect}
  <div class="panel radius warning">{$LANG.loginincorrect}</div>
  <br />
  {/if}
  <table >
          <tr>
            <td width="30%" >{$LANG.loginemail}:</td>
            <td><input type="text" name="username" size="40" required value="{$username}"  /></td>
          </tr>
          <tr>
            <td  >{$LANG.loginpassword}:</td>
            <td><input type="password" name="password" size="25" required value="{$password}" /></td>
          </tr>
          <tr>
            <td  ><input type="checkbox" name="rememberme"{if $rememberme} checked="checked"{/if} /></td>
            <td>{$LANG.loginrememberme}</td>
          </tr>
          <tr>
            <td  >&nbsp;</td>
            <td><input type="submit" value="{$LANG.loginbutton}" class="tiny button  radius" /></td>
          </tr>
    </table>
</form>
<p align="center"><strong>{$LANG.loginforgotten}</strong> <a href="pwreset.php">{$LANG.loginforgotteninstructions}</a></p>
<script type="text/javascript">
document.frmlogin.username.focus();
</script>
<br />