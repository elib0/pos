<?php /* Smarty version 2.6.26, created on 2012-06-01 14:00:11
         compiled from /home/websarro/public_html/wadmin/templates/orderforms/slider/ordersummary.tpl */ ?>
<div class="summaryproduct"><?php echo $this->_tpl_vars['producttotals']['productinfo']['groupname']; ?>
 - <b><?php echo $this->_tpl_vars['producttotals']['productinfo']['name']; ?>
</b></div>
<table class="ordersummarytbl">
<tr><td><?php echo $this->_tpl_vars['producttotals']['productinfo']['name']; ?>
</td><td align="right"><?php echo $this->_tpl_vars['producttotals']['pricing']['baseprice']; ?>
</td></tr>
<?php $_from = $this->_tpl_vars['producttotals']['configoptions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['configoption']):
?><?php if ($this->_tpl_vars['configoption']): ?>
<tr><td style="padding-left:10px;">&raquo; <?php echo $this->_tpl_vars['configoption']['name']; ?>
: <?php echo $this->_tpl_vars['configoption']['optionname']; ?>
</td><td align="right"><?php echo $this->_tpl_vars['configoption']['recurring']; ?>
</td></tr>
<?php endif; ?><?php endforeach; endif; unset($_from); ?>
<?php $_from = $this->_tpl_vars['producttotals']['addons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['addon']):
?>
<tr><td>+ <?php echo $this->_tpl_vars['addon']['name']; ?>
</td><td align="right"><?php echo $this->_tpl_vars['addon']['recurring']; ?>
</td></tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php if ($this->_tpl_vars['producttotals']['pricing']['setup'] || $this->_tpl_vars['producttotals']['pricing']['recurring'] || $this->_tpl_vars['producttotals']['pricing']['addons']): ?>
<div class="summaryproduct"></div>
<table width="100%">
<?php if ($this->_tpl_vars['producttotals']['pricing']['setup']): ?><tr><td><?php echo $this->_tpl_vars['LANG']['cartsetupfees']; ?>
:</td><td align="right"><?php echo $this->_tpl_vars['producttotals']['pricing']['setup']; ?>
</td></tr><?php endif; ?>
<?php $_from = $this->_tpl_vars['producttotals']['pricing']['recurring']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cycle'] => $this->_tpl_vars['recurring']):
?>
<tr><td><?php echo $this->_tpl_vars['cycle']; ?>
:</td><td align="right"><?php echo $this->_tpl_vars['recurring']; ?>
</td></tr>
<?php endforeach; endif; unset($_from); ?>
<?php if ($this->_tpl_vars['producttotals']['pricing']['tax1']): ?><tr><td><?php echo $this->_tpl_vars['carttotals']['taxname']; ?>
 @ <?php echo $this->_tpl_vars['carttotals']['taxrate']; ?>
%:</td><td align="right"><?php echo $this->_tpl_vars['producttotals']['pricing']['tax1']; ?>
</td></tr><?php endif; ?>
<?php if ($this->_tpl_vars['producttotals']['pricing']['tax2']): ?><tr><td><?php echo $this->_tpl_vars['carttotals']['taxname2']; ?>
 @ <?php echo $this->_tpl_vars['carttotals']['taxrate2']; ?>
%:</td><td align="right"><?php echo $this->_tpl_vars['producttotals']['pricing']['tax2']; ?>
</td></tr><?php endif; ?>
</table>
<?php endif; ?>
<div class="summaryproduct"></div>
<table width="100%">
<tr><td colspan="2" align="right"><?php echo $this->_tpl_vars['LANG']['ordertotalduetoday']; ?>
: <b><?php echo $this->_tpl_vars['producttotals']['pricing']['totaltoday']; ?>
</b></td></tr>
</table>