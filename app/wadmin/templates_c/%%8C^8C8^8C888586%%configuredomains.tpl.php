<?php /* Smarty version 2.6.26, created on 2012-06-15 13:30:36
         compiled from /home/websarro/public_html/wadmin/templates/orderforms/slider/configuredomains.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', '/home/websarro/public_html/wadmin/templates/orderforms/slider/configuredomains.tpl', 7, false),)), $this); ?>
<link rel="stylesheet" type="text/css" href="templates/orderforms/<?php echo $this->_tpl_vars['carttpl']; ?>
/style.css" />

<p class="cartheading"><?php echo $this->_tpl_vars['LANG']['cartdomainsconfig']; ?>
</p>

<p><?php echo $this->_tpl_vars['LANG']['cartdomainsconfiginfo']; ?>
</p>

<?php if ($this->_tpl_vars['errormessage']): ?><div class="errorbox" style="display:block;"><?php echo ((is_array($_tmp=$this->_tpl_vars['errormessage'])) ? $this->_run_mod_handler('replace', true, $_tmp, '<li>', ' &nbsp;#&nbsp; ') : smarty_modifier_replace($_tmp, '<li>', ' &nbsp;#&nbsp; ')); ?>
 &nbsp;#&nbsp; </div><br /><?php endif; ?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?a=confdomains">
<input type="hidden" name="update" value="true" />

<?php $_from = $this->_tpl_vars['domains']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['domain']):
?>

<p class="cartsubheading"><?php echo $this->_tpl_vars['domain']['domain']; ?>
 - <?php echo $this->_tpl_vars['domain']['regperiod']; ?>
 <?php echo $this->_tpl_vars['LANG']['orderyears']; ?>
 <?php if ($this->_tpl_vars['domain']['hosting']): ?><span style="color:#009900;">[<?php echo $this->_tpl_vars['LANG']['cartdomainshashosting']; ?>
]</span><?php else: ?><a href="cart.php" style="color:#cc0000;">[<?php echo $this->_tpl_vars['LANG']['cartdomainsnohosting']; ?>
]</a><br /><?php endif; ?></p>

<div id="domainconfig">

<table>
<tr><td width="120">Hosting:</td><td><?php if ($this->_tpl_vars['domain']['hosting']): ?><span style="color:#009900;">[<?php echo $this->_tpl_vars['LANG']['cartdomainshashosting']; ?>
]</span><?php else: ?><a href="cart.php" style="color:#cc0000;">[<?php echo $this->_tpl_vars['LANG']['cartdomainsnohosting']; ?>
]</a><br /><?php endif; ?></td></tr>
<tr><td><?php echo $this->_tpl_vars['LANG']['orderregperiod']; ?>
:</td><td><?php echo $this->_tpl_vars['domain']['regperiod']; ?>
 <?php echo $this->_tpl_vars['LANG']['orderyears']; ?>
</td></tr>
<?php if ($this->_tpl_vars['domain']['eppenabled']): ?><tr><td><?php echo $this->_tpl_vars['LANG']['domaineppcode']; ?>
:</td><td><input type="text" name="epp[<?php echo $this->_tpl_vars['num']; ?>
]" size="20" value="<?php echo $this->_tpl_vars['domain']['eppvalue']; ?>
" /> <?php echo $this->_tpl_vars['LANG']['domaineppcodedesc']; ?>
</td></tr><?php endif; ?>
<?php if ($this->_tpl_vars['domain']['dnsmanagement'] || $this->_tpl_vars['domain']['emailforwarding'] || $this->_tpl_vars['domain']['idprotection']): ?><tr><td class="fieldlabel"><?php echo $this->_tpl_vars['LANG']['cartaddons']; ?>
:</td><td>
<?php if ($this->_tpl_vars['domain']['dnsmanagement']): ?><input type="checkbox" name="dnsmanagement[<?php echo $this->_tpl_vars['num']; ?>
]" id="dnsm<?php echo $this->_tpl_vars['num']; ?>
"<?php if ($this->_tpl_vars['domain']['dnsmanagementselected']): ?> checked<?php endif; ?> /> <label for="dnsm<?php echo $this->_tpl_vars['num']; ?>
"><?php echo $this->_tpl_vars['LANG']['domaindnsmanagement']; ?>
 (<?php echo $this->_tpl_vars['domain']['dnsmanagementprice']; ?>
)</label><br /><?php endif; ?>
<?php if ($this->_tpl_vars['domain']['emailforwarding']): ?><input type="checkbox" name="emailforwarding[<?php echo $this->_tpl_vars['num']; ?>
]" id="emf<?php echo $this->_tpl_vars['num']; ?>
"<?php if ($this->_tpl_vars['domain']['emailforwardingselected']): ?> checked<?php endif; ?> /> <label for="emf<?php echo $this->_tpl_vars['num']; ?>
"><?php echo $this->_tpl_vars['LANG']['domainemailforwarding']; ?>
 (<?php echo $this->_tpl_vars['domain']['emailforwardingprice']; ?>
)</label><br /><?php endif; ?>
<?php if ($this->_tpl_vars['domain']['idprotection']): ?><input type="checkbox" name="idprotection[<?php echo $this->_tpl_vars['num']; ?>
]" id="idp<?php echo $this->_tpl_vars['num']; ?>
"<?php if ($this->_tpl_vars['domain']['idprotectionselected']): ?> checked<?php endif; ?> /> <label for="idp<?php echo $this->_tpl_vars['num']; ?>
"><?php echo $this->_tpl_vars['LANG']['domainidprotection']; ?>
 (<?php echo $this->_tpl_vars['domain']['idprotectionprice']; ?>
)</label><br /><?php endif; ?>
</td></tr><?php endif; ?>
<?php $_from = $this->_tpl_vars['domain']['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['domainfieldname'] => $this->_tpl_vars['domainfield']):
?>
<tr><td><?php echo $this->_tpl_vars['domainfieldname']; ?>
:</td><td><?php echo $this->_tpl_vars['domainfield']; ?>
</td></tr>
<?php endforeach; endif; unset($_from); ?>
</table>

</div>

<?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['atleastonenohosting']): ?>
<p class="cartsubheading"><?php echo $this->_tpl_vars['LANG']['domainnameservers']; ?>
</p>
<div id="domainconfig">
<?php echo $this->_tpl_vars['LANG']['cartnameserversdesc']; ?>

<table align="center">
<tr><td width="120"><?php echo $this->_tpl_vars['LANG']['domainnameserver1']; ?>
:</td><td><input type="text" name="domainns1" size="40" value="<?php echo $this->_tpl_vars['domainns1']; ?>
" /></td></tr>
<tr><td><?php echo $this->_tpl_vars['LANG']['domainnameserver2']; ?>
:</td><td><input type="text" name="domainns2" size="40" value="<?php echo $this->_tpl_vars['domainns2']; ?>
" /></td></tr>
<tr><td><?php echo $this->_tpl_vars['LANG']['domainnameserver3']; ?>
:</td><td><input type="text" name="domainns3" size="40" value="<?php echo $this->_tpl_vars['domainns3']; ?>
" /></td></tr>
<tr><td><?php echo $this->_tpl_vars['LANG']['domainnameserver4']; ?>
:</td><td><input type="text" name="domainns4" size="40" value="<?php echo $this->_tpl_vars['domainns4']; ?>
" /></td></tr>
</table>
</div>
<?php endif; ?>

<p align="center"><input type="submit" value="<?php echo $this->_tpl_vars['LANG']['updatecart']; ?>
" /></p>

</form>