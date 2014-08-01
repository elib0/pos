<?php /* Smarty version 2.6.26, created on 2012-05-22 21:37:00
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/clientareaproductdetails.tpl */ ?>
<script type="text/javascript" src="includes/jscript/pwstrength.js"></script>
<h2><?php echo $this->_tpl_vars['LANG']['clientareaproductdetails']; ?>
</h2>
<table width="100%" cellspacing="0" cellpadding="0" class="frame">
  <tr>
    <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
        <tr>
          <td width="150" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareahostingregdate']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['regdate']; ?>
</td>
        </tr>
        <tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['orderproduct']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['groupname']; ?>
 - <?php echo $this->_tpl_vars['product']; ?>
</td>
        </tr>
        <?php if ($this->_tpl_vars['domain']): ?><tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareahostingdomain']; ?>
:</td>
          <td><a href="http://<?php echo $this->_tpl_vars['domain']; ?>
" target="_blank"><?php echo $this->_tpl_vars['domain']; ?>
</a></td>
        </tr>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['dedicatedip']): ?><tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['domainregisternsip']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['dedicatedip']; ?>
</td>
        </tr>
        <?php endif; ?>
        <?php $_from = $this->_tpl_vars['configoptions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['configoption']):
?><tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['configoption']['optionname']; ?>
:</td>
          <td><?php if ($this->_tpl_vars['configoption']['optiontype'] == 3): ?><?php if ($this->_tpl_vars['configoption']['selectedqty']): ?><?php echo $this->_tpl_vars['LANG']['yes']; ?>
<?php else: ?><?php echo $this->_tpl_vars['LANG']['no']; ?>
<?php endif; ?><?php elseif ($this->_tpl_vars['configoption']['optiontype'] == 4): ?><?php echo $this->_tpl_vars['configoption']['selectedqty']; ?>
 x <?php echo $this->_tpl_vars['configoption']['selectedoption']; ?>
<?php else: ?><?php echo $this->_tpl_vars['configoption']['selectedoption']; ?>
<?php endif; ?></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
        <?php $_from = $this->_tpl_vars['customfields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['customfield']):
?>
        <tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['customfield']['name']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['customfield']['value']; ?>
</td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
        <?php if ($this->_tpl_vars['lastupdate']): ?>
        <tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareadiskusage']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['diskusage']; ?>
MB / <?php echo $this->_tpl_vars['disklimit']; ?>
MB (<strong><?php echo $this->_tpl_vars['diskpercent']; ?>
</strong>)</td>
        </tr>
        <tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareabwusage']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['bwusage']; ?>
MB / <?php echo $this->_tpl_vars['bwlimit']; ?>
MB (<strong><?php echo $this->_tpl_vars['bwpercent']; ?>
</strong>)</td>
        </tr>
        <?php endif; ?>
        <tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['orderpaymentmethod']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['paymentmethod']; ?>
</td>
        </tr>
        <tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['firstpaymentamount']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['firstpaymentamount']; ?>
</td>
        </tr>
        <tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['recurringamount']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['recurringamount']; ?>
</td>
        </tr>
        <tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareahostingnextduedate']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['nextduedate']; ?>
</td>
        </tr>
        <tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['orderbillingcycle']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['billingcycle']; ?>
</td>
        </tr>
        <tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareastatus']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['status']; ?>
</td>
        </tr>
        <?php if ($this->_tpl_vars['suspendreason']): ?><tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['suspendreason']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['suspendreason']; ?>
</td>
        </tr><?php endif; ?>
    </table></td>
  </tr>
</table>

<br />

<div align="center"><?php echo $this->_tpl_vars['moduleclientarea']; ?>
</div>

<?php if ($this->_tpl_vars['username']): ?>

<?php if ($this->_tpl_vars['modulechangepassword']): ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?action=productdetails">
  <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" />
  <input type="hidden" name="modulechangepassword" value="true" />
  <?php endif; ?>
  <h3><?php echo $this->_tpl_vars['LANG']['serverlogindetails']; ?>
</h3>
  <?php if ($this->_tpl_vars['modulechangepasswordmessage']): ?>
  <div class="errorbox"><?php echo $this->_tpl_vars['modulechangepasswordmessage']; ?>
</div>
  <br />
  <?php endif; ?>
  <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="150" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['serverusername']; ?>
/<?php echo $this->_tpl_vars['LANG']['serverpassword']; ?>
:</td>
            <td colspan="2"><?php echo $this->_tpl_vars['username']; ?>
<?php if ($this->_tpl_vars['password']): ?> / <?php echo $this->_tpl_vars['password']; ?>
<?php endif; ?></td>
          </tr>
          <?php if ($this->_tpl_vars['modulechangepassword']): ?>
          <tr>
            <td width="150" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['serverchangepasswordenter']; ?>
:</td>
            <td width="175"><input type="password" name="newpassword1" id="newpw" size="25" /></td>
            <td><script type="text/javascript">showStrengthBar();</script></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['serverchangepasswordconfirm']; ?>
:</td>
            <td colspan="2"><input type="password" name="newpassword2" size="25" /></td>
          </tr>
          <?php endif; ?>
      </table></td>
    </tr>
  </table>
  <?php if ($this->_tpl_vars['modulechangepassword']): ?>
  <p align="center">
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['serverchangepasswordupdate']; ?>
" class="button" />
  </p>
</form>
<?php endif; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['downloads']): ?>
<h3><?php echo $this->_tpl_vars['LANG']['downloadstitle']; ?>
</h3>
<?php $_from = $this->_tpl_vars['downloads']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['download']):
?>
<table width="100%" cellspacing="0" cellpadding="0" class="frame">
  <tr>
    <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
        <tr>
          <td width="150" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['downloadname']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['download']['type']; ?>
 <a href="<?php echo $this->_tpl_vars['download']['link']; ?>
"><?php echo $this->_tpl_vars['download']['title']; ?>
</a></td>
        </tr>
        <tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['downloaddescription']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['download']['description']; ?>
</td>
        </tr>
    </table></td>
  </tr>
</table>
<br />
<?php endforeach; endif; unset($_from); ?>

<?php endif; ?>
<h3><?php echo $this->_tpl_vars['LANG']['clientareaaccountaddons']; ?>
</h3>
<p><?php if ($this->_tpl_vars['addonsavailable']): ?><a href="cart.php?gid=addons&pid=<?php echo $this->_tpl_vars['id']; ?>
"><?php echo $this->_tpl_vars['LANG']['orderavailableaddons']; ?>
</a><?php endif; ?></p>
<table class="data" width="100%" border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <th><?php echo $this->_tpl_vars['LANG']['clientareaaddon']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['clientareaaddonpricing']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['clientareahostingnextduedate']; ?>
</th>
  </tr>
  <?php $_from = $this->_tpl_vars['addons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['addon']):
?>
  <tr class="<?php echo $this->_tpl_vars['addon']['class']; ?>
">
    <td><?php echo $this->_tpl_vars['addon']['name']; ?>
</td>
    <td align="center"><?php echo $this->_tpl_vars['addon']['pricing']; ?>
</td>
    <td align="center"><?php echo $this->_tpl_vars['addon']['nextduedate']; ?>
</td>
  </tr>
  <?php endforeach; else: ?>
  <tr>
    <td colspan="3"><?php echo $this->_tpl_vars['LANG']['clientareanoaddons']; ?>
</td>
  </tr>
  <?php endif; unset($_from); ?>
</table>
<br />
<table border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td width="10" align="right"><table style="width:10px;height:10px;" cellspacing="1" class="clientareatable">
        <tr class="clientareatableactive">
          <td></td>
        </tr>
    </table></td>
    <td><?php echo $this->_tpl_vars['LANG']['clientareaactive']; ?>
</td>
    <td width="10" align="right"><table style="width:10px;height:10px;" cellspacing="1" class="clientareatable">
        <tr class="clientareatablepending">
          <td></td>
        </tr>
    </table></td>
    <td><?php echo $this->_tpl_vars['LANG']['clientareapending']; ?>
</td>
    <td width="10" align="right"><table style="width:10px;height:10px;" cellspacing="1" class="clientareatable">
        <tr class="clientareatablesuspended">
          <td></td>
        </tr>
    </table></td>
    <td><?php echo $this->_tpl_vars['LANG']['clientareasuspended']; ?>
</td>
    <td width="10" align="right"><table style="width:10px;height:10px;" cellspacing="1" class="clientareatable">
        <tr class="clientareatableterminated">
          <td></td>
        </tr>
    </table></td>
    <td><?php echo $this->_tpl_vars['LANG']['clientareaterminated']; ?>
</td>
  </tr>
</table>
<br />
<table border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td><input type="button" value="<?php echo $this->_tpl_vars['LANG']['clientareabacklink']; ?>
" onclick="window.location='clientarea.php?action=products'" class="button" /></td>
    <?php if ($this->_tpl_vars['packagesupgrade']): ?><td>
      <form method="post" action="upgrade.php">
        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" />
        <input type="hidden" name="type" value="package" />
        <p>
          <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['upgradedowngradepackage']; ?>
" class="button" />
        </p>
      </form>
      </td><?php endif; ?>
    <?php if ($this->_tpl_vars['configoptionsupgrade']): ?><td>
      <form method="post" action="upgrade.php">
        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" />
        <input type="hidden" name="type" value="configoptions" />
        <p>
          <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['upgradedowngradeconfigoptions']; ?>
" class="button" />
        </p>
      </form>
      </td><?php endif; ?>
    <?php if ($this->_tpl_vars['showcancelbutton'] && ( $this->_tpl_vars['status'] == $this->_tpl_vars['LANG']['clientareaactive'] || $this->_tpl_vars['status'] == $this->_tpl_vars['LANG']['clientareasuspended'] )): ?><td align="center">
      <input type="button" value="<?php echo $this->_tpl_vars['LANG']['clientareacancelrequestbutton']; ?>
" onclick="window.location='clientarea.php?action=cancel&amp;id=<?php echo $this->_tpl_vars['id']; ?>
'" class="button" />
      </td><?php endif; ?>
  </tr>
</table><br />