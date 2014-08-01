<?php /* Smarty version 2.6.26, created on 2012-07-10 14:26:55
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/clientareainvoices.tpl */ ?>
<h2 ><?php echo $this->_tpl_vars['LANG']['invoices']; ?>
</h2>
<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <td><?php echo $this->_tpl_vars['numproducts']; ?>
 <?php echo $this->_tpl_vars['LANG']['recordsfound']; ?>
,  <?php echo $this->_tpl_vars['LANG']['page']; ?>
 <?php echo $this->_tpl_vars['pagenumber']; ?>
 <?php echo $this->_tpl_vars['LANG']['pageof']; ?>
 <?php echo $this->_tpl_vars['totalpages']; ?>
</td>
    <td align="right"><?php if ($this->_tpl_vars['prevpage']): ?><a href="clientarea.php?action=invoices&amp;page=<?php echo $this->_tpl_vars['prevpage']; ?>
"><?php endif; ?>&laquo; <?php echo $this->_tpl_vars['LANG']['previouspage']; ?>
<?php if ($this->_tpl_vars['prevpage']): ?></a><?php endif; ?> &nbsp; <?php if ($this->_tpl_vars['nextpage']): ?><a href="clientarea.php?action=invoices&amp;page=<?php echo $this->_tpl_vars['nextpage']; ?>
"><?php endif; ?><?php echo $this->_tpl_vars['LANG']['nextpage']; ?>
 &raquo;<?php if ($this->_tpl_vars['nextpage']): ?></a><?php endif; ?></td>
  </tr>
</table>
<br />
<table class="data" width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <th><?php echo $this->_tpl_vars['LANG']['invoicestitle']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['invoicesdatecreated']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['invoicesdatedue']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['invoicestotal']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['invoicesstatus']; ?>
</th>
    <th>&nbsp;</th>
  </tr>
  <?php $_from = $this->_tpl_vars['invoices']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['invoice']):
?>
  <tr>
    <td><a href="viewinvoice.php?id=<?php echo $this->_tpl_vars['invoice']['id']; ?>
" target="_blank"><?php echo $this->_tpl_vars['invoice']['invoicenum']; ?>
</a></td>
    <td><?php echo $this->_tpl_vars['invoice']['datecreated']; ?>
</td>
    <td><?php echo $this->_tpl_vars['invoice']['datedue']; ?>
</td>
    <td><?php echo $this->_tpl_vars['invoice']['total']; ?>
</td>
    <td><?php echo $this->_tpl_vars['invoice']['status']; ?>
</td>
    <td><a href="viewinvoice.php?id=<?php echo $this->_tpl_vars['invoice']['id']; ?>
" target="_blank"><?php echo $this->_tpl_vars['LANG']['invoicesview']; ?>
</a></td>
  </tr>
  <?php endforeach; else: ?>
  <tr>
    <td colspan="6"><?php echo $this->_tpl_vars['LANG']['norecordsfound']; ?>
</td>
  </tr>
  <?php endif; unset($_from); ?>
</table>
<br />
<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <td><?php echo $this->_tpl_vars['LANG']['show']; ?>
: <a href="clientarea.php?action=invoices&itemlimit=10">10</a> <a href="clientarea.php?action=invoices&itemlimit=25">25</a> <a href="clientarea.php?action=invoices&itemlimit=50">50</a> <a href="clientarea.php?action=invoices&itemlimit=100">100</a> <a href="clientarea.php?action=invoices&itemlimit=all"><?php echo $this->_tpl_vars['LANG']['all']; ?>
</a></td>
    <td align="right"><?php if ($this->_tpl_vars['prevpage']): ?><a href="clientarea.php?action=invoices&amp;page=<?php echo $this->_tpl_vars['prevpage']; ?>
"><?php endif; ?>&laquo; <?php echo $this->_tpl_vars['LANG']['previouspage']; ?>
<?php if ($this->_tpl_vars['prevpage']): ?></a><?php endif; ?> &nbsp; <?php if ($this->_tpl_vars['nextpage']): ?><a href="clientarea.php?action=invoices&amp;page=<?php echo $this->_tpl_vars['nextpage']; ?>
"><?php endif; ?><?php echo $this->_tpl_vars['LANG']['nextpage']; ?>
 &raquo;<?php if ($this->_tpl_vars['nextpage']): ?></a><?php endif; ?></td>
  </tr>
</table><br />