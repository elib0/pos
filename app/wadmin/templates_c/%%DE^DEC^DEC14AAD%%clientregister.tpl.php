<?php /* Smarty version 2.6.26, created on 2012-05-15 08:54:10
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/clientregister.tpl */ ?>
<?php if ($this->_tpl_vars['noregistration']): ?>
Not Allowed
<?php else: ?>
<script type="text/javascript" src="includes/jscript/pwstrength.js"></script>
<p><?php echo $this->_tpl_vars['LANG']['clientregisterheadertext']; ?>
</p>
<?php if ($this->_tpl_vars['errormessage']): ?>
<div class="errorbox"><?php echo $this->_tpl_vars['errormessage']; ?>
</div>
<br />
<?php endif; ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
">
  <input type="hidden" name="register" value="true" />
  <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="150" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareafirstname']; ?>
</td>
            <td><input type="text" name="firstname" size="30" value="<?php echo $this->_tpl_vars['clientfirstname']; ?>
" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientarealastname']; ?>
</td>
            <td><input type="text" name="lastname" size="30" value="<?php echo $this->_tpl_vars['clientlastname']; ?>
" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareacompanyname']; ?>
</td>
            <td><input type="text" name="companyname" size="30" value="<?php echo $this->_tpl_vars['clientcompanyname']; ?>
" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaemail']; ?>
</td>
            <td><input type="text" name="email" size="50" value="<?php echo $this->_tpl_vars['clientemail']; ?>
" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaaddress1']; ?>
</td>
            <td><input type="text" name="address1" size="40" value="<?php echo $this->_tpl_vars['clientaddress1']; ?>
" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaaddress2']; ?>
</td>
            <td><input type="text" name="address2" size="30" value="<?php echo $this->_tpl_vars['clientaddress2']; ?>
" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareacity']; ?>
</td>
            <td><input type="text" name="city" size="30" value="<?php echo $this->_tpl_vars['clientcity']; ?>
" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareastate']; ?>
</td>
            <td><input type="text" name="state" size="25" value="<?php echo $this->_tpl_vars['clientstate']; ?>
" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareapostcode']; ?>
</td>
            <td><input type="text" name="postcode" size="10" value="<?php echo $this->_tpl_vars['clientpostcode']; ?>
" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareacountry']; ?>
</td>
            <td><?php echo $this->_tpl_vars['clientcountriesdropdown']; ?>
</td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaphonenumber']; ?>
</td>
            <td><input type="text" name="phonenumber" size="20" value="<?php echo $this->_tpl_vars['clientphonenumber']; ?>
" /></td>
          </tr>
      </table></td>
    </tr>
  </table>

  <?php if ($this->_tpl_vars['customfields'] || $this->_tpl_vars['securityquestions']): ?>
  <br />
  <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <?php if ($this->_tpl_vars['securityquestions']): ?>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareasecurityquestion']; ?>
</td>
            <td><select name="securityqid">

<?php $_from = $this->_tpl_vars['securityquestions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['question']):
?>

                <option value="<?php echo $this->_tpl_vars['question']['id']; ?>
"><?php echo $this->_tpl_vars['question']['question']; ?>
</option>

<?php endforeach; endif; unset($_from); ?>

              </select></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareasecurityanswer']; ?>
</td>
            <td><input type="password" name="securityqans" size="30" /> *</td>
          </tr>
          <?php endif; ?>
          <?php $_from = $this->_tpl_vars['customfields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['customfield']):
?>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['customfield']['name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['customfield']['input']; ?>
 <?php echo $this->_tpl_vars['customfield']['description']; ?>
</td>
          </tr>
          <?php endforeach; endif; unset($_from); ?>
      </table></td>
    </tr>
  </table>
  <?php endif; ?>

  <h2><?php echo $this->_tpl_vars['LANG']['orderlogininfo']; ?>
</h2>
  <p><?php echo $this->_tpl_vars['LANG']['orderlogininfopart1']; ?>
 <?php echo $this->_tpl_vars['companyname']; ?>
 <?php echo $this->_tpl_vars['LANG']['orderlogininfopart2']; ?>
</p>
  <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="150" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareapassword']; ?>
</td>
            <td width="175"><input type="password" name="password" id="newpw" size="25" /></td>
            <td><script language="JavaScript" type="text/javascript">showStrengthBar();</script></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaconfirmpassword']; ?>
</td>
            <td colspan="2"><input type="password" name="password2" size="25" /></td>
          </tr>
      </table></td>
    </tr>
  </table>

  <?php if ($this->_tpl_vars['capatacha']): ?>
  <h2><?php echo $this->_tpl_vars['LANG']['clientregisterverify']; ?>
</h2>
  <p><?php echo $this->_tpl_vars['LANG']['clientregisterverifydescription']; ?>
</p>
  <p align="center"><img src="includes/verifyimage.php" class="absmiddle" border="0" alt="Verify Image" />
    <input type="text" name="code" size="10" maxlength="5" />
  </p>
  <?php endif; ?>

  <?php if ($this->_tpl_vars['accepttos']): ?>
  <p>
    <input type="checkbox" name="accepttos" id="accepttos" />
    <label for="accepttos"><?php echo $this->_tpl_vars['LANG']['ordertosagreement']; ?>
 <a href="<?php echo $this->_tpl_vars['tosurl']; ?>
" target="_blank"><?php echo $this->_tpl_vars['LANG']['ordertos']; ?>
</a></label>
    .  </p>
  <p> <?php endif; ?>  </p>
  <p align="center">
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['ordercontinuebutton']; ?>
" />
  </p>
</form>
<?php endif; ?><br />