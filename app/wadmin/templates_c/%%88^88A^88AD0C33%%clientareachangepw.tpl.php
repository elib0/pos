<?php /* Smarty version 2.6.26, created on 2012-08-23 15:53:43
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/clientareachangepw.tpl */ ?>
<script type="text/javascript" src="includes/jscript/pwstrength.js"></script>
<div class="contentbox"><a href="<?php echo $_SERVER['PHP_SELF']; ?>
?action=details"><?php echo $this->_tpl_vars['LANG']['clientareanavdetails']; ?>
</a> | <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?action=contacts"><?php echo $this->_tpl_vars['LANG']['clientareanavcontacts']; ?>
</a> | <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?action=addcontact"><?php echo $this->_tpl_vars['LANG']['clientareanavaddcontact']; ?>
</a><?php if ($this->_tpl_vars['ccenabled']): ?> | <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?action=creditcard"><?php echo $this->_tpl_vars['LANG']['clientareanavchangecc']; ?>
</a><?php endif; ?> | <strong><?php echo $this->_tpl_vars['LANG']['clientareanavchangepw']; ?>
</strong> | <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?action=changesq"><?php echo $this->_tpl_vars['LANG']['clientareanavsecurityquestions']; ?>
</a></div>
<h2><?php echo $this->_tpl_vars['LANG']['clientareanavchangepw']; ?>
</h2>
<?php if ($this->_tpl_vars['successful']): ?>
<div class="successbox"><?php echo $this->_tpl_vars['LANG']['changessavedsuccessfully']; ?>
</div>
<br />
<?php endif; ?>
<?php if ($this->_tpl_vars['errormessage']): ?>
<div class="errorbox"><?php echo $this->_tpl_vars['errormessage']; ?>
</div>
<br />
<?php endif; ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?action=changepw">
  <input type="hidden" name="submit" value="true" />
  <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="150" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['existingpassword']; ?>
</td>
            <td><input type="password" name="existingpw" size="25" /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="150" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['newpassword']; ?>
</td>
            <td><input type="password" name="newpw" id="newpw" size="25" /></td>
            <td><script language="javascript">showStrengthBar();</script></td>
          </tr>
          <tr>
            <td width="150" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['confirmnewpassword']; ?>
</td>
            <td><input type="password" name="confirmpw" size="25" /></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
  </table>
  <p align="center">
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['clientareasavechanges']; ?>
" class="button" />
    <input type="reset" value="<?php echo $this->_tpl_vars['LANG']['clientareacancel']; ?>
" class="button" />
  </p>
</form>