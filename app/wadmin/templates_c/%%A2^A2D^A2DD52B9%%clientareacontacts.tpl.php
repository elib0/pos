<?php /* Smarty version 2.6.26, created on 2013-03-27 20:36:21
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/clientareacontacts.tpl */ ?>
<script type="text/javascript" src="includes/jscript/pwstrength.js"></script>
<script type="text/javascript">
<?php echo '
jQuery(document).ready(function(){
    jQuery("#subaccount").click(function () {
        if (jQuery("#subaccount:checked").val()!=null) {
            jQuery(".subaccountfields").show();
        } else {
            jQuery(".subaccountfields").hide();
        }
    });
});
'; ?>

function deleteContact() {
if (confirm("<?php echo $this->_tpl_vars['LANG']['clientareadeletecontactareyousure']; ?>
")) {
window.location='clientarea.php?action=contacts&delete=true&id=<?php echo $this->_tpl_vars['contactid']; ?>
';
}}
</script>

<div class="contentbox"><a href="<?php echo $_SERVER['PHP_SELF']; ?>
?action=details"><?php echo $this->_tpl_vars['LANG']['clientareanavdetails']; ?>
</a> | <strong><?php echo $this->_tpl_vars['LANG']['clientareanavcontacts']; ?>
</strong> | <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?action=addcontact"><?php echo $this->_tpl_vars['LANG']['clientareanavaddcontact']; ?>
</a><?php if ($this->_tpl_vars['ccenabled']): ?> | <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?action=creditcard"><?php echo $this->_tpl_vars['LANG']['clientareanavchangecc']; ?>
</a><?php endif; ?> | <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?action=changepw"><?php echo $this->_tpl_vars['LANG']['clientareanavchangepw']; ?>
</a> | <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?action=changesq"><?php echo $this->_tpl_vars['LANG']['clientareanavsecurityquestions']; ?>
</a></div>

<h2><?php echo $this->_tpl_vars['LANG']['clientareanavcontacts']; ?>
</h2>

<?php if ($this->_tpl_vars['contactid']): ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?action=contacts">
  <p><?php echo $this->_tpl_vars['LANG']['clientareachoosecontact']; ?>
:
    <select name="id" onchange="submit()">
      <?php $_from = $this->_tpl_vars['contacts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['contact']):
?>

      <option value="<?php echo $this->_tpl_vars['contact']['id']; ?>
"<?php if ($this->_tpl_vars['contact']['id'] == $this->_tpl_vars['contactid']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['contact']['name']; ?>
 - <?php echo $this->_tpl_vars['contact']['email']; ?>
</option>
      
<?php endforeach; endif; unset($_from); ?>
    </select>
  </p>
</form>

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
?action=contacts&id=<?php echo $this->_tpl_vars['contactid']; ?>
">
  <input type="hidden" name="submit" value="true" />
  <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" cellpadding="10" cellspacing="0">
          <tr>
            <td width="150" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareafirstname']; ?>
</td>
            <td><input type="text" name="firstname" value="<?php echo $this->_tpl_vars['contactfirstname']; ?>
" size="25" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientarealastname']; ?>
</td>
            <td><input type="text" name="lastname" value="<?php echo $this->_tpl_vars['contactlastname']; ?>
" size="25" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareacompanyname']; ?>
</td>
            <td><input type="text" name="companyname" value="<?php echo $this->_tpl_vars['contactcompanyname']; ?>
" size="25" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaemail']; ?>
</td>
            <td><input type="text" name="email" value="<?php echo $this->_tpl_vars['contactemail']; ?>
" size="50" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaaddress1']; ?>
</td>
            <td><input type="text" name="address1" value="<?php echo $this->_tpl_vars['contactaddress1']; ?>
" size="25" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaaddress2']; ?>
</td>
            <td><input type="text" name="address2" value="<?php echo $this->_tpl_vars['contactaddress2']; ?>
" size="25" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareacity']; ?>
</td>
            <td><input type="text" name="city" value="<?php echo $this->_tpl_vars['contactcity']; ?>
" size="25" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareastate']; ?>
</td>
            <td><input type="text" name="state" value="<?php echo $this->_tpl_vars['contactstate']; ?>
" size="25" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareapostcode']; ?>
</td>
            <td><input type="text" name="postcode" value="<?php echo $this->_tpl_vars['contactpostcode']; ?>
" size="25" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareacountry']; ?>
</td>
            <td><?php echo $this->_tpl_vars['countriesdropdown']; ?>
</td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaphonenumber']; ?>
</td>
            <td><input type="text" name="phonenumber" value="<?php echo $this->_tpl_vars['contactphonenumber']; ?>
" size="25" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['subaccountactivate']; ?>
</td>
            <td><input type="checkbox" name="subaccount" id="subaccount"<?php if ($this->_tpl_vars['subaccount']): ?> checked<?php endif; ?> /> <label for="subaccount"><?php echo $this->_tpl_vars['LANG']['subaccountactivatedesc']; ?>
</label></td>
          </tr>
          <tr class="subaccountfields"<?php if (! $this->_tpl_vars['subaccount']): ?> style="display:none;"<?php endif; ?>>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareapassword']; ?>
</td>
            <td><table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border:0;"><input type="password" name="password" id="newpw" size="25" /></td>
                <td style="border:0;"><script language="JavaScript" type="text/javascript">showStrengthBar();</script></td>
              </tr>
            </table></td>
          </tr>
          <tr class="subaccountfields"<?php if (! $this->_tpl_vars['subaccount']): ?> style="display:none;"<?php endif; ?>>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaconfirmpassword']; ?>
</td>
            <td><input type="password" name="password2" size="25" /></td>
          </tr>
          <tr class="subaccountfields"<?php if (! $this->_tpl_vars['subaccount']): ?> style="display:none;"<?php endif; ?>>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['subaccountpermissions']; ?>
</td>
            <td><input type="checkbox" name="permissions[]" id="permprofile" value="profile"<?php if (in_array ( 'profile' , $this->_tpl_vars['permissions'] )): ?> checked<?php endif; ?> /> <label for="permprofile"><?php echo $this->_tpl_vars['LANG']['subaccountpermsprofile']; ?>
</label><br />
<input type="checkbox" name="permissions[]" id="permcontacts" value="contacts"<?php if (in_array ( 'contacts' , $this->_tpl_vars['permissions'] )): ?> checked<?php endif; ?> /> <label for="permcontacts"><?php echo $this->_tpl_vars['LANG']['subaccountpermscontacts']; ?>
</label><br />
<input type="checkbox" name="permissions[]" id="permproducts" value="products"<?php if (in_array ( 'products' , $this->_tpl_vars['permissions'] )): ?> checked<?php endif; ?> /> <label for="permproducts"><?php echo $this->_tpl_vars['LANG']['subaccountpermsproducts']; ?>
</label><br />
<input type="checkbox" name="permissions[]" id="permmanageproducts" value="manageproducts"<?php if (in_array ( 'manageproducts' , $this->_tpl_vars['permissions'] )): ?> checked<?php endif; ?> /> <label for="permmanageproducts"><?php echo $this->_tpl_vars['LANG']['subaccountpermsmanageproducts']; ?>
</label><br />
<input type="checkbox" name="permissions[]" id="permdomains" value="domains"<?php if (in_array ( 'domains' , $this->_tpl_vars['permissions'] )): ?> checked<?php endif; ?> /> <label for="permdomains"><?php echo $this->_tpl_vars['LANG']['subaccountpermsdomains']; ?>
</label><br />
<input type="checkbox" name="permissions[]" id="permmanagedomains" value="managedomains"<?php if (in_array ( 'managedomains' , $this->_tpl_vars['permissions'] )): ?> checked<?php endif; ?> /> <label for="permmanagedomains"><?php echo $this->_tpl_vars['LANG']['subaccountpermsmanagedomains']; ?>
</label><br />
<input type="checkbox" name="permissions[]" id="perminvoices" value="invoices"<?php if (in_array ( 'invoices' , $this->_tpl_vars['permissions'] )): ?> checked<?php endif; ?> /> <label for="perminvoices"><?php echo $this->_tpl_vars['LANG']['subaccountpermsinvoices']; ?>
</label><br />
<input type="checkbox" name="permissions[]" id="permtickets" value="tickets"<?php if (in_array ( 'tickets' , $this->_tpl_vars['permissions'] )): ?> checked<?php endif; ?> /> <label for="permtickets"><?php echo $this->_tpl_vars['LANG']['subaccountpermstickets']; ?>
</label><br />
<input type="checkbox" name="permissions[]" id="permaffiliates" value="affiliates"<?php if (in_array ( 'affiliates' , $this->_tpl_vars['permissions'] )): ?> checked<?php endif; ?> /> <label for="permaffiliates"><?php echo $this->_tpl_vars['LANG']['subaccountpermsaffiliates']; ?>
</label><br />
<input type="checkbox" name="permissions[]" id="permemails" value="emails"<?php if (in_array ( 'emails' , $this->_tpl_vars['permissions'] )): ?> checked<?php endif; ?> /> <label for="permemails"><?php echo $this->_tpl_vars['LANG']['subaccountpermsemails']; ?>
</label><br />
<input type="checkbox" name="permissions[]" id="permorders" value="orders"<?php if (in_array ( 'orders' , $this->_tpl_vars['permissions'] )): ?> checked<?php endif; ?> /> <label for="permorders"><?php echo $this->_tpl_vars['LANG']['subaccountpermsorders']; ?>
</label></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareacontactsemails']; ?>
</td>
            <td><input type="checkbox" name="generalemails" id="generalemails" value="1"<?php if ($this->_tpl_vars['generalemails']): ?> checked<?php endif; ?> />
              <label for="generalemails"><?php echo $this->_tpl_vars['LANG']['clientareacontactsemailsgeneral']; ?>
</label><br />
              <input type="checkbox" name="productemails" id="productemails" value="1"<?php if ($this->_tpl_vars['productemails']): ?> checked<?php endif; ?> />
              <label for="productemails"><?php echo $this->_tpl_vars['LANG']['clientareacontactsemailsproduct']; ?>
</label><br />
              <input type="checkbox" name="domainemails" id="domainemails" value="1"<?php if ($this->_tpl_vars['domainemails']): ?> checked<?php endif; ?> />
              <label for="domainemails"><?php echo $this->_tpl_vars['LANG']['clientareacontactsemailsdomain']; ?>
</label><br />
              <input type="checkbox" name="invoiceemails" id="invoiceemails" value="1"<?php if ($this->_tpl_vars['invoiceemails']): ?> checked<?php endif; ?> />
              <label for="invoiceemails"><?php echo $this->_tpl_vars['LANG']['clientareacontactsemailsinvoice']; ?>
</label><br />
              <input type="checkbox" name="supportemails" id="supportemails" value="1"<?php if ($this->_tpl_vars['supportemails']): ?> checked<?php endif; ?> />
              <label for="supportemails"><?php echo $this->_tpl_vars['LANG']['clientareacontactsemailssupport']; ?>
</label><br /></td>
          </tr>
      </table></td>
    </tr>
  </table>
  <p align="center">
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['clientareasavechanges']; ?>
" class="button" />
    <input type="reset" value="<?php echo $this->_tpl_vars['LANG']['clientareacancel']; ?>
" class="button" />
    <input type="button" value="<?php echo $this->_tpl_vars['LANG']['clientareadeletecontact']; ?>
" class="button" onclick="deleteContact()" />
  </p>
</form>
<?php else: ?>
<div class="errorbox"><?php echo $this->_tpl_vars['LANG']['clientareanocontacts']; ?>
</div>
<?php endif; ?>