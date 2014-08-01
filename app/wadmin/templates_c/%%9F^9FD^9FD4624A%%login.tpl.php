<?php /* Smarty version 2.6.26, created on 2012-05-14 09:35:57
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/login.tpl */ ?>
<p><?php echo $this->_tpl_vars['LANG']['loginintrotext']; ?>
</p>
<form action="<?php echo $this->_tpl_vars['systemsslurl']; ?>
dologin.php" method="post" name="frmlogin" id="frmlogin">
  <?php if ($this->_tpl_vars['incorrect']): ?>
  <div class="errorbox"><?php echo $this->_tpl_vars['LANG']['loginincorrect']; ?>
</div>
  <br />
  <?php endif; ?>
  <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" border="0" align="center" class="frame">
    <tr>
      <td><table border="0" align="center" cellpadding="10" cellspacing="0">
          <tr>
            <td width="150" align="right" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['loginemail']; ?>
:</td>
            <td><input type="text" name="username" size="40" value="<?php echo $this->_tpl_vars['username']; ?>
" /></td>
          </tr>
          <tr>
            <td width="150" align="right" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['loginpassword']; ?>
:</td>
            <td><input type="password" name="password" size="25" value="<?php echo $this->_tpl_vars['password']; ?>
" /></td>
          </tr>
          <tr>
            <td width="150" align="right" class="fieldarea"><input type="checkbox" name="rememberme"<?php if ($this->_tpl_vars['rememberme']): ?> checked="checked"<?php endif; ?> /></td>
            <td><?php echo $this->_tpl_vars['LANG']['loginrememberme']; ?>
</td>
          </tr>
          <tr>
            <td width="150" align="right" class="fieldarea">&nbsp;</td>
            <td><input type="submit" value="<?php echo $this->_tpl_vars['LANG']['loginbutton']; ?>
" /></td>
          </tr>
        </table></td>
    </tr>
  </table><br />
</form>
<p align="center"><strong><?php echo $this->_tpl_vars['LANG']['loginforgotten']; ?>
</strong> <a href="pwreset.php"><?php echo $this->_tpl_vars['LANG']['loginforgotteninstructions']; ?>
</a></p>
<script type="text/javascript">
document.frmlogin.username.focus();
</script>
<br />