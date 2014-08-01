<?php /* Smarty version 2.6.26, created on 2012-05-14 16:58:08
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/clientareahome.tpl */ ?>
<p><?php echo $this->_tpl_vars['LANG']['clientareaheader']; ?>
</p>
<?php $_from = $this->_tpl_vars['addons_html']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['addon_html']):
?>
<div style="margin:15px 0 15px 0;"><?php echo $this->_tpl_vars['addon_html']; ?>
</div>
<?php endforeach; endif; unset($_from); ?>
<?php if (in_array ( 'tickets' , $this->_tpl_vars['contactpermissions'] )): ?>
<h2><strong><?php echo $this->_tpl_vars['clientsstats']['numactivetickets']; ?>
</strong> <?php echo $this->_tpl_vars['LANG']['supportticketsopentickets']; ?>
</h2>
<p><a href="submitticket.php"><?php echo $this->_tpl_vars['LANG']['supportticketssubmitticket']; ?>
</a></p>
<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" class="data">
  <tr>
    <th><?php echo $this->_tpl_vars['LANG']['supportticketsdate']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['supportticketssubject']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['supportticketsstatus']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['supportticketsticketurgency']; ?>
</th>
  </tr>
  <?php $_from = $this->_tpl_vars['tickets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['ticket']):
?>
  <tr>
    <td><?php echo $this->_tpl_vars['ticket']['date']; ?>
</td>
    <td><div align="left"><img src="images/article.gif" hspace="5" align="middle" alt="" /><a href="viewticket.php?tid=<?php echo $this->_tpl_vars['ticket']['tid']; ?>
&amp;c=<?php echo $this->_tpl_vars['ticket']['c']; ?>
"><?php if ($this->_tpl_vars['ticket']['unread']): ?><strong><?php endif; ?>#<?php echo $this->_tpl_vars['ticket']['tid']; ?>
 - <?php echo $this->_tpl_vars['ticket']['subject']; ?>
<?php if ($this->_tpl_vars['ticket']['unread']): ?></strong><?php endif; ?></a></div></td>
    <td width="120"><?php echo $this->_tpl_vars['ticket']['status']; ?>
</td>
    <td width="80"><?php echo $this->_tpl_vars['ticket']['urgency']; ?>
</td>
  </tr>
  <?php endforeach; else: ?>
  <tr>
    <td colspan="4" align="center"><?php echo $this->_tpl_vars['LANG']['norecordsfound']; ?>
</td>
  </tr>
  <?php endif; unset($_from); ?>
</table>
<?php endif; ?>
<?php if (in_array ( 'invoices' , $this->_tpl_vars['contactpermissions'] )): ?>
<h2><strong><?php echo $this->_tpl_vars['clientsstats']['numdueinvoices']; ?>
</strong> <?php echo $this->_tpl_vars['LANG']['invoicesdue']; ?>
</h2>
<form method="post" action="clientarea.php?action=masspay">
<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" class="data">
  <tr>
    <?php if ($this->_tpl_vars['masspay']): ?><th width="15"></th><?php endif; ?>
    <th><?php echo $this->_tpl_vars['LANG']['invoicenumber']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['invoicesdatecreated']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['invoicesdatedue']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['invoicestotal']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['invoicesbalance']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['invoicesstatus']; ?>
</th>
    <th>&nbsp;</th>
  </tr>
  <?php $_from = $this->_tpl_vars['invoices']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['invoice']):
?>
  <tr>
    <?php if ($this->_tpl_vars['masspay']): ?><td><input type="checkbox" name="invoiceids[]" value="<?php echo $this->_tpl_vars['invoice']['id']; ?>
" /></td><?php endif; ?>
    <td><a href="viewinvoice.php?id=<?php echo $this->_tpl_vars['invoice']['id']; ?>
" target="_blank"><?php echo $this->_tpl_vars['invoice']['invoicenum']; ?>
</a></td>
    <td><?php echo $this->_tpl_vars['invoice']['datecreated']; ?>
</td>
    <td><?php echo $this->_tpl_vars['invoice']['datedue']; ?>
</td>
    <td><?php echo $this->_tpl_vars['invoice']['total']; ?>
</td>
    <td><?php echo $this->_tpl_vars['invoice']['balance']; ?>
</td>
    <td><?php echo $this->_tpl_vars['invoice']['status']; ?>
</td>
    <td><a href="viewinvoice.php?id=<?php echo $this->_tpl_vars['invoice']['id']; ?>
" target="_blank"><?php echo $this->_tpl_vars['LANG']['invoicesview']; ?>
</a></td>
  </tr>
  <?php endforeach; else: ?>
  <tr>
    <td colspan="<?php if ($this->_tpl_vars['masspay']): ?>8<?php else: ?>7<?php endif; ?>" align="center"><?php echo $this->_tpl_vars['LANG']['norecordsfound']; ?>
</td>
  </tr>
  <?php endif; unset($_from); ?>
  <?php if ($this->_tpl_vars['invoices']): ?>
  <tr style="font-weight:bold;">
    <td colspan="<?php if ($this->_tpl_vars['masspay']): ?>4<?php else: ?>3<?php endif; ?>"><?php if ($this->_tpl_vars['masspay']): ?><input type="submit" value="<?php echo $this->_tpl_vars['LANG']['masspayselected']; ?>
" /><?php endif; ?></td>
    <td style="text-align:right;"><?php echo $this->_tpl_vars['LANG']['invoicestotaldue']; ?>
</td>
    <td><?php echo $this->_tpl_vars['totalbalance']; ?>
</td>
    <td colspan="2"><?php if ($this->_tpl_vars['masspay']): ?><a href="clientarea.php?action=masspay&all=true"><?php echo $this->_tpl_vars['LANG']['masspayall']; ?>
</a><?php endif; ?></td>
  </tr>
  <?php endif; ?>
</table>
</form>
<?php endif; ?>
<?php if ($this->_tpl_vars['files']): ?>
<h2><?php echo $this->_tpl_vars['LANG']['clientareafiles']; ?>
</h2>
<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" class="data">
  <tr>
    <th><?php echo $this->_tpl_vars['LANG']['clientareafilesdate']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['clientareafilesfilename']; ?>
</th>
  </tr>
  <?php $_from = $this->_tpl_vars['files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['file']):
?>
  <tr>
    <td><?php echo $this->_tpl_vars['file']['date']; ?>
</td>
    <td><img src="images/file.png" hspace="5" align="middle" alt="" /> <a href="dl.php?type=f&id=<?php echo $this->_tpl_vars['file']['id']; ?>
"><strong><?php echo $this->_tpl_vars['file']['title']; ?>
</strong></a></td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?>