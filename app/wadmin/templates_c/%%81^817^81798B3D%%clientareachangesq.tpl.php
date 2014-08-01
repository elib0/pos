<?php /* Smarty version 2.6.26, created on 2013-07-27 10:07:59
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/clientareachangesq.tpl */ ?>
<div class="contentbox"><a href="<?php echo $_SERVER['PHP_SELF']; ?>
?action=details"><?php echo $this->_tpl_vars['LANG']['clientareanavdetails']; ?>
</a> | <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?action=contacts"><?php echo $this->_tpl_vars['LANG']['clientareanavcontacts']; ?>
</a> | <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?action=addcontact"><?php echo $this->_tpl_vars['LANG']['clientareanavaddcontact']; ?>
</a><?php if ($this->_tpl_vars['ccenabled']): ?> | <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?action=creditcard"><?php echo $this->_tpl_vars['LANG']['clientareanavchangecc']; ?>
</a><?php endif; ?> | <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?action=changepw"><?php echo $this->_tpl_vars['LANG']['clientareanavchangepw']; ?>
</a> | <strong><?php echo $this->_tpl_vars['LANG']['clientareanavsecurityquestions']; ?>
</strong></div>

<h2><?php echo $this->_tpl_vars['LANG']['clientareanavsecurityquestions']; ?>
</h2>

<?php if ($this->_tpl_vars['successful']): ?><div class="successbox"><?php echo $this->_tpl_vars['LANG']['changessavedsuccessfully']; ?>
</div><br /><?php endif; ?>
<?php if ($this->_tpl_vars['errormessage']): ?><div class="errorbox"><?php echo $this->_tpl_vars['errormessage']; ?>
</div><br /><?php endif; ?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?action=changesq">
<input type="hidden" name="submit" value="true" />
<?php if (! $this->_tpl_vars['nocurrent']): ?>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="250" class="fieldarea"><?php echo $this->_tpl_vars['currentquestion']; ?>
</td>
            <td><input type="password" name="currentsecurityqans" size="25" /></td>
          </tr>
      </table></td>
    </tr>
  </table>
<br /><br />
<?php endif; ?>

  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="250" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareasecurityquestion']; ?>
</td><td><select name="securityqid">
<?php $_from = $this->_tpl_vars['securityquestions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['question']):
?>  
	<option value=<?php echo $this->_tpl_vars['question']['id']; ?>
><?php echo $this->_tpl_vars['question']['question']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select></td></tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareasecurityanswer']; ?>
</td><td><input type="password" name="securityqans" size="25" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareasecurityconfanswer']; ?>
</td><td><input type="password" name="securityqans2" size="25" /></td>
          </tr>
      </table></td>
    </tr>
  </table>

<p align="center"><input type="submit" value="<?php echo $this->_tpl_vars['LANG']['clientareasavechanges']; ?>
" class="button" /> <input type="reset" value="<?php echo $this->_tpl_vars['LANG']['clientareacancel']; ?>
" class="button" /></p>

</form>