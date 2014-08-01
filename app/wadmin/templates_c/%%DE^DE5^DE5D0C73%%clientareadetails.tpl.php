<?php /* Smarty version 2.6.26, created on 2012-05-22 21:34:46
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/clientareadetails.tpl */ ?>
<div class="contentbox"><strong><?php echo $this->_tpl_vars['LANG']['clientareanavdetails']; ?>
</strong> | <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?action=contacts"><?php echo $this->_tpl_vars['LANG']['clientareanavcontacts']; ?>
</a> | <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?action=addcontact"><?php echo $this->_tpl_vars['LANG']['clientareanavaddcontact']; ?>
</a><?php if ($this->_tpl_vars['ccenabled']): ?> | <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?action=creditcard"><?php echo $this->_tpl_vars['LANG']['clientareanavchangecc']; ?>
</a><?php endif; ?> | <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?action=changepw"><?php echo $this->_tpl_vars['LANG']['clientareanavchangepw']; ?>
</a> | <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?action=changesq"><?php echo $this->_tpl_vars['LANG']['clientareanavsecurityquestions']; ?>
</a></div>
<h2 class="heading2"><?php echo $this->_tpl_vars['LANG']['clientareanavdetails']; ?>
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
?action=details">
  <input type="hidden" name="save" value="true" />
  <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="150" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareafirstname']; ?>
</td>
            <td><?php if (in_array ( 'firstname' , $this->_tpl_vars['uneditablefields'] )): ?><?php echo $this->_tpl_vars['clientfirstname']; ?>
<?php else: ?><input type="text" name="firstname" value="<?php echo $this->_tpl_vars['clientfirstname']; ?>
" size="25" /><?php endif; ?></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientarealastname']; ?>
</td>
            <td><?php if (in_array ( 'lastname' , $this->_tpl_vars['uneditablefields'] )): ?><?php echo $this->_tpl_vars['clientlastname']; ?>
<?php else: ?><input type="text" name="lastname" value="<?php echo $this->_tpl_vars['clientlastname']; ?>
" size="25" /><?php endif; ?></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareacompanyname']; ?>
</td>
            <td><?php if (in_array ( 'companyname' , $this->_tpl_vars['uneditablefields'] )): ?><?php echo $this->_tpl_vars['clientcompanyname']; ?>
<?php else: ?><input type="text" name="companyname" value="<?php echo $this->_tpl_vars['clientcompanyname']; ?>
" size="25" /><?php endif; ?></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaemail']; ?>
</td>
            <td><?php if (in_array ( 'email' , $this->_tpl_vars['uneditablefields'] )): ?><?php echo $this->_tpl_vars['clientemail']; ?>
<?php else: ?><input type="text" name="email" value="<?php echo $this->_tpl_vars['clientemail']; ?>
" size="50" /><?php endif; ?></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaaddress1']; ?>
</td>
            <td><?php if (in_array ( 'address1' , $this->_tpl_vars['uneditablefields'] )): ?><?php echo $this->_tpl_vars['clientaddress1']; ?>
<?php else: ?><input type="text" name="address1" value="<?php echo $this->_tpl_vars['clientaddress1']; ?>
" size="25" /><?php endif; ?></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaaddress2']; ?>
</td>
            <td><?php if (in_array ( 'address2' , $this->_tpl_vars['uneditablefields'] )): ?><?php echo $this->_tpl_vars['clientaddress2']; ?>
<?php else: ?><input type="text" name="address2" value="<?php echo $this->_tpl_vars['clientaddress2']; ?>
" size="25" /><?php endif; ?></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareacity']; ?>
</td>
            <td><?php if (in_array ( 'city' , $this->_tpl_vars['uneditablefields'] )): ?><?php echo $this->_tpl_vars['clientcity']; ?>
<?php else: ?><input type="text" name="city" value="<?php echo $this->_tpl_vars['clientcity']; ?>
" size="25" /><?php endif; ?></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareastate']; ?>
</td>
            <td><?php if (in_array ( 'state' , $this->_tpl_vars['uneditablefields'] )): ?><?php echo $this->_tpl_vars['clientstate']; ?>
<?php else: ?><input type="text" name="state" value="<?php echo $this->_tpl_vars['clientstate']; ?>
" size="25" /><?php endif; ?></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareapostcode']; ?>
</td>
            <td><?php if (in_array ( 'postcode' , $this->_tpl_vars['uneditablefields'] )): ?><?php echo $this->_tpl_vars['clientpostcode']; ?>
<?php else: ?><input type="text" name="postcode" value="<?php echo $this->_tpl_vars['clientpostcode']; ?>
" size="25" /><?php endif; ?></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareacountry']; ?>
</td>
            <td><?php if (in_array ( 'country' , $this->_tpl_vars['uneditablefields'] )): ?><?php echo $this->_tpl_vars['clientcountry']; ?>
<?php else: ?><?php echo $this->_tpl_vars['clientcountriesdropdown']; ?>
<?php endif; ?></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaphonenumber']; ?>
</td>
            <td><?php if (in_array ( 'phonenumber' , $this->_tpl_vars['uneditablefields'] )): ?><?php echo $this->_tpl_vars['clientphonenumber']; ?>
<?php else: ?><input type="text" name="phonenumber" value="<?php echo $this->_tpl_vars['clientphonenumber']; ?>
" size="25" /><?php endif; ?></td>
          </tr>
      </table></td>
    </tr>
  </table>
  <br />
  <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="150" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['defaultbillingcontact']; ?>
</td>
            <td><select name="billingcid">
                <option value="0"><?php echo $this->_tpl_vars['LANG']['usedefaultcontact']; ?>
</option>
                
<?php $_from = $this->_tpl_vars['contacts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['contact']):
?>

                <option value="<?php echo $this->_tpl_vars['contact']['id']; ?>
"<?php if ($this->_tpl_vars['contact']['id'] == $this->_tpl_vars['billingcid']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['contact']['name']; ?>
</option>
                
<?php endforeach; endif; unset($_from); ?>

              </select></td>
          </tr>
      </table></td>
    </tr>
  </table>
  <?php if ($this->_tpl_vars['customfields']): ?> <br />
  <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <?php $_from = $this->_tpl_vars['customfields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['customfield']):
?>
          <tr>
            <td width="150" class="fieldarea"><?php echo $this->_tpl_vars['customfield']['name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['customfield']['input']; ?>
 <?php echo $this->_tpl_vars['customfield']['required']; ?>
</td>
          </tr>
          <?php endforeach; endif; unset($_from); ?>
      </table></td>
    </tr>
  </table>
  <?php endif; ?>
  <p align="center">
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['clientareasavechanges']; ?>
" class="button" />
    <input type="reset" value="<?php echo $this->_tpl_vars['LANG']['clientareacancel']; ?>
" class="button" />
  </p>
</form>