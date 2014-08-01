<?php /* Smarty version 2.6.26, created on 2012-06-01 14:18:55
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/masspay.tpl */ ?>
<link rel="stylesheet" type="text/css" href="templates/orderforms/web20cart/style.css" />

<h2><?php echo $this->_tpl_vars['LANG']['masspaytitle']; ?>
</h2>

<p><?php echo $this->_tpl_vars['LANG']['masspaydescription']; ?>
</p>

<form method="post" action="clientarea.php?action=masspay">
<input type="hidden" name="geninvoice" value="true" />

<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" class="data">
  <tr>
    <th><?php echo $this->_tpl_vars['LANG']['invoicesdescription']; ?>
</th>
    <th width="130"><?php echo $this->_tpl_vars['LANG']['invoicesamount']; ?>
</th>
  </tr>
  <?php $_from = $this->_tpl_vars['invoiceitems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['invid'] => $this->_tpl_vars['invoiceitem']):
?>
  <tr>
    <td colspan="2" style="text-align:left;">
      <strong><?php echo $this->_tpl_vars['LANG']['invoicenumber']; ?>
 <?php echo $this->_tpl_vars['invid']; ?>
</strong>
      <input type="hidden" name="invoiceids[]" value="<?php echo $this->_tpl_vars['invid']; ?>
" />
    </td>
  </tr>
  <?php $_from = $this->_tpl_vars['invoiceitem']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
    <tr>
      <td><?php echo $this->_tpl_vars['item']['description']; ?>
</td>
      <td><?php echo $this->_tpl_vars['item']['amount']; ?>
</td>
    </tr>
  <?php endforeach; endif; unset($_from); ?>
  <?php endforeach; else: ?>
  <tr>
    <td colspan="6" align="center"><?php echo $this->_tpl_vars['LANG']['norecordsfound']; ?>
</td>
  </tr>
  <?php endif; unset($_from); ?>
  <tr class="carttablesummary">
    <td style="text-align:right;"><?php echo $this->_tpl_vars['LANG']['invoicessubtotal']; ?>
:</td>
    <td><?php echo $this->_tpl_vars['subtotal']; ?>
</td>
  </tr>
  <?php if ($this->_tpl_vars['tax']): ?><tr class="carttablesummary">
    <td style="text-align:right;"><?php echo $this->_tpl_vars['LANG']['invoicestax']; ?>
:</td>
    <td><?php echo $this->_tpl_vars['tax']; ?>
</td>
  </tr><?php endif; ?>
  <?php if ($this->_tpl_vars['tax2']): ?><tr class="carttablesummary">
    <td style="text-align:right;"><?php echo $this->_tpl_vars['LANG']['invoicestax']; ?>
 2:</td>
    <td><?php echo $this->_tpl_vars['tax2']; ?>
</td>
  </tr><?php endif; ?>
  <?php if ($this->_tpl_vars['credit']): ?><tr class="carttablesummary">
    <td style="text-align:right;"><?php echo $this->_tpl_vars['LANG']['invoicescredit']; ?>
:</td>
    <td><?php echo $this->_tpl_vars['credit']; ?>
</td>
  </tr><?php endif; ?>
  <?php if ($this->_tpl_vars['partialpayments']): ?><tr class="carttablerecurring">
    <td style="text-align:right;"><?php echo $this->_tpl_vars['LANG']['invoicespartialpayments']; ?>
:</td>
    <td><?php echo $this->_tpl_vars['partialpayments']; ?>
</td>
  </tr><?php endif; ?>
  <tr class="carttabledue">
    <td style="text-align:right;"><?php echo $this->_tpl_vars['LANG']['invoicestotaldue']; ?>
:</td>
    <td><?php echo $this->_tpl_vars['total']; ?>
</td>
  </tr>
</table>

<h3><?php echo $this->_tpl_vars['LANG']['orderpaymentmethod']; ?>
</h3>

<p align="center"><?php $_from = $this->_tpl_vars['gateways']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['gateway']):
?>
    <input type="radio" name="paymentmethod" value="<?php echo $this->_tpl_vars['gateway']['sysname']; ?>
" id="pgbtn<?php echo $this->_tpl_vars['num']; ?>
"<?php if ($this->_tpl_vars['num'] == 0): ?> checked<?php endif; ?> />
    <label for="pgbtn<?php echo $this->_tpl_vars['num']; ?>
"><?php echo $this->_tpl_vars['gateway']['name']; ?>
</label>
    <?php endforeach; endif; unset($_from); ?></p>

<p align="center"><input type="submit" value="<?php echo $this->_tpl_vars['LANG']['masspaymakepayment']; ?>
" /></p>

</form>