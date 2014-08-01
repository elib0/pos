<?php /* Smarty version 2.6.26, created on 2013-01-29 12:19:54
         compiled from /home/websarro/public_html/wadmin/templates/orderforms/slider/domainrenewals.tpl */ ?>
<script type="text/javascript" src="includes/jscript/jqueryui.js"></script>
<script type="text/javascript" src="templates/orderforms/<?php echo $this->_tpl_vars['carttpl']; ?>
/js/main.js"></script>
<link rel="stylesheet" type="text/css" href="templates/orderforms/<?php echo $this->_tpl_vars['carttpl']; ?>
/style.css" />
<link rel="stylesheet" type="text/css" href="templates/orderforms/<?php echo $this->_tpl_vars['carttpl']; ?>
/css/style.css" />

<br />

<div align="center"><span class="cartheading"><?php echo $this->_tpl_vars['LANG']['domainrenewals']; ?>
</span><br /><a href="#" onclick="showcats();return false;">(<?php echo $this->_tpl_vars['LANG']['cartchooseanothercategory']; ?>
)</a></div>

<div id="categories">
<?php $_from = $this->_tpl_vars['productgroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['productgroup']):
?>
<?php if ($this->_tpl_vars['productgroup']['gid'] != $this->_tpl_vars['gid']): ?><div class="cat"><a href="cart.php?gid=<?php echo $this->_tpl_vars['productgroup']['gid']; ?>
"><?php echo $this->_tpl_vars['productgroup']['name']; ?>
</a></div><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php if ($this->_tpl_vars['loggedin']): ?>
<?php if ($this->_tpl_vars['gid'] != 'addons'): ?><div class="cat"><a href="cart.php?gid=addons"><?php echo $this->_tpl_vars['LANG']['cartproductaddons']; ?>
</a></div><?php endif; ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['registerdomainenabled'] && $this->_tpl_vars['domain'] != 'register'): ?><div class="cat"><a href="cart.php?a=add&domain=register"><?php echo $this->_tpl_vars['LANG']['registerdomain']; ?>
</a></div><?php endif; ?>
<?php if ($this->_tpl_vars['transferdomainenabled'] && $this->_tpl_vars['domain'] != 'transfer'): ?><div class="cat"><a href="cart.php?a=add&domain=transfer"><?php echo $this->_tpl_vars['LANG']['transferdomain']; ?>
</a></div><?php endif; ?>
</div>
<div class="clear"></div>

<br />

<p><?php echo $this->_tpl_vars['LANG']['domainrenewdesc']; ?>
</p>

<form method="post" action="cart.php?a=add&renewals=true">

<table align="center" cellspacing="1" class="renewals">
<tr><th width="20"></th><th><?php echo $this->_tpl_vars['LANG']['orderdomain']; ?>
</th><th><?php echo $this->_tpl_vars['LANG']['domainstatus']; ?>
</th><th><?php echo $this->_tpl_vars['LANG']['domaindaysuntilexpiry']; ?>
</th><th></th></tr>
<?php $_from = $this->_tpl_vars['renewals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['renewal']):
?>
<tr><td><?php if (! $this->_tpl_vars['renewal']['pastgraceperiod']): ?><input type="checkbox" name="renewalids[]" value="<?php echo $this->_tpl_vars['renewal']['id']; ?>
" /><?php endif; ?></td><td><?php echo $this->_tpl_vars['renewal']['domain']; ?>
</td><td><?php echo $this->_tpl_vars['renewal']['status']; ?>
</td><td>
    <?php if ($this->_tpl_vars['renewal']['daysuntilexpiry'] > 30): ?>
    <span class="textgreen"><?php echo $this->_tpl_vars['renewal']['daysuntilexpiry']; ?>
 <?php echo $this->_tpl_vars['LANG']['domainrenewalsdays']; ?>
</span>
    <?php elseif ($this->_tpl_vars['renewal']['daysuntilexpiry'] > 0): ?>
    <span class="textred"><?php echo $this->_tpl_vars['renewal']['daysuntilexpiry']; ?>
 <?php echo $this->_tpl_vars['LANG']['domainrenewalsdays']; ?>
</span>
    <?php else: ?>
    <span class="textblack"><?php echo $this->_tpl_vars['renewal']['daysuntilexpiry']*-1; ?>
 <?php echo $this->_tpl_vars['LANG']['domainrenewalsdaysago']; ?>
</span>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['renewal']['ingraceperiod']): ?>
    <br />
    <span class="textred"><?php echo $this->_tpl_vars['LANG']['domainrenewalsingraceperiod']; ?>
<span>
    <?php endif; ?>
</td><td>
    <?php if ($this->_tpl_vars['renewal']['pastgraceperiod']): ?>
    <span class="textred"><?php echo $this->_tpl_vars['LANG']['domainrenewalspastgraceperiod']; ?>
<span>
    <?php else: ?>
    <select name="renewalperiod[<?php echo $this->_tpl_vars['renewal']['id']; ?>
]">
    <?php $_from = $this->_tpl_vars['renewal']['renewaloptions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['renewaloption']):
?>
        <option value="<?php echo $this->_tpl_vars['renewaloption']['period']; ?>
"><?php echo $this->_tpl_vars['renewaloption']['period']; ?>
 <?php echo $this->_tpl_vars['LANG']['orderyears']; ?>
 @ <?php echo $this->_tpl_vars['renewaloption']['price']; ?>
</option>
    <?php endforeach; endif; unset($_from); ?>
    </select>
    <?php endif; ?>
</td></tr>
<?php endforeach; else: ?>
<tr class="carttablerow"><td colspan="5"><?php echo $this->_tpl_vars['LANG']['domainrenewalsnoneavailable']; ?>
</td></tr>
<?php endif; unset($_from); ?>
</table>

<p align="center"><input type="submit" value="<?php echo $this->_tpl_vars['LANG']['ordernowbutton']; ?>
 &raquo;" /></p>

</form>

<br />

<p align="center"><input type="button" value="<?php echo $this->_tpl_vars['LANG']['viewcart']; ?>
" onclick="window.location='cart.php?a=view'" /></p>

<br />