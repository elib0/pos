<?php /* Smarty version 2.6.26, created on 2012-05-15 08:41:10
         compiled from /home/websarro/public_html/wadmin/templates/orderforms/slider/products.tpl */ ?>
<script type="text/javascript" src="includes/jscript/jqueryui.js"></script>
<script type="text/javascript" src="templates/orderforms/<?php echo $this->_tpl_vars['carttpl']; ?>
/js/main.js"></script>
<link rel="stylesheet" type="text/css" href="templates/orderforms/<?php echo $this->_tpl_vars['carttpl']; ?>
/style.css" />
<link rel="stylesheet" type="text/css" href="templates/orderforms/<?php echo $this->_tpl_vars['carttpl']; ?>
/uistyle.css" />

<script type="text/javascript">

var productscount = <?php echo $this->_tpl_vars['productscount']; ?>
;

var productsNums = new Array();
<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['product']):
?>
productsNums[<?php echo $this->_tpl_vars['product']['pid']; ?>
] = <?php echo $this->_tpl_vars['num']; ?>
;
<?php endforeach; endif; unset($_from); ?>

<?php echo '
jQuery(document).ready(function(){
    jQuery( "#productslider" ).slider({
        min: 0,
        max: productscount-1,
        value: 0,
        range: "min",
        slide: function( event, ui ) {
            selproduct(ui.value);
		}
    });
    var width = jQuery("#productslider").width()/productscount;
    jQuery("#productslider").width(width*(productscount-1)+\'px\');
    jQuery(".sliderlabel").width(width+\'px\');
    selproduct(0);
'; ?>

<?php if ($this->_tpl_vars['pid']): ?>
    selproduct(productsNums[<?php echo $this->_tpl_vars['pid']; ?>
]);
    selectproduct('<?php echo $this->_tpl_vars['pid']; ?>
');
<?php endif; ?>
<?php echo '
});

'; ?>

</script>

<br />

<div align="center"><span class="cartheading"><?php echo $this->_tpl_vars['groupname']; ?>
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
<?php if ($this->_tpl_vars['renewalsenabled'] && $this->_tpl_vars['gid'] != 'renewals'): ?><div class="cat"><a href="cart.php?gid=renewals"><?php echo $this->_tpl_vars['LANG']['domainrenewals']; ?>
</a></div><?php endif; ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['registerdomainenabled'] && $this->_tpl_vars['domain'] != 'register'): ?><div class="cat"><a href="cart.php?a=add&domain=register"><?php echo $this->_tpl_vars['LANG']['registerdomain']; ?>
</a></div><?php endif; ?>
<?php if ($this->_tpl_vars['transferdomainenabled'] && $this->_tpl_vars['domain'] != 'transfer'): ?><div class="cat"><a href="cart.php?a=add&domain=transfer"><?php echo $this->_tpl_vars['LANG']['transferdomain']; ?>
</a></div><?php endif; ?>
</div>
<div class="clear"></div>

<?php if (! $this->_tpl_vars['loggedin'] && $this->_tpl_vars['currencies']): ?>
<div id="currencychooser">
<?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curr']):
?>
<a href="cart.php?gid=<?php echo $this->_tpl_vars['gid']; ?>
&currency=<?php echo $this->_tpl_vars['curr']['id']; ?>
"><img src="images/flags/<?php if ($this->_tpl_vars['curr']['code'] == 'AUD'): ?>au<?php elseif ($this->_tpl_vars['curr']['code'] == 'CAD'): ?>ca<?php elseif ($this->_tpl_vars['curr']['code'] == 'EUR'): ?>eu<?php elseif ($this->_tpl_vars['curr']['code'] == 'GBP'): ?>gb<?php elseif ($this->_tpl_vars['curr']['code'] == 'INR'): ?>in<?php elseif ($this->_tpl_vars['curr']['code'] == 'JPY'): ?>jp<?php elseif ($this->_tpl_vars['curr']['code'] == 'USD'): ?>us<?php elseif ($this->_tpl_vars['curr']['code'] == 'ZAR'): ?>za<?php else: ?>na<?php endif; ?>.png" border="0" alt="" /> <?php echo $this->_tpl_vars['curr']['code']; ?>
</a>
<?php endforeach; endif; unset($_from); ?>
</div>
<div class="clear"></div>
<?php else: ?>
<br />
<?php endif; ?>

<div class="cartslider">

<div align="center">
<div id="productslider"></div>
</div>

<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['product']):
?>
<div class="sliderlabel" id="prodlabel<?php echo $this->_tpl_vars['num']; ?>
" onclick="selproduct('<?php echo $this->_tpl_vars['num']; ?>
')"><?php echo $this->_tpl_vars['product']['name']; ?>
</div>
<?php endforeach; endif; unset($_from); ?>
<div class="clear"></div>

</div>

<div class="cartprods">

<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['product']):
?>
<div class="product" id="product<?php echo $this->_tpl_vars['num']; ?>
">

<table width="100%"><tr><td>

<div class="name"><?php echo $this->_tpl_vars['product']['name']; ?>
<?php if ($this->_tpl_vars['product']['qty'] != ""): ?> <span class="qty">(<?php echo $this->_tpl_vars['product']['qty']; ?>
 <?php echo $this->_tpl_vars['LANG']['orderavailable']; ?>
)</span><?php endif; ?></div>

<?php $_from = $this->_tpl_vars['product']['features']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['feature'] => $this->_tpl_vars['value']):
?>
<span class="prodfeature"><span class="feature"><?php echo $this->_tpl_vars['feature']; ?>
</span><br /><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endforeach; endif; unset($_from); ?>
<div class="clear"></div>

</td><td align="right" valign="top" nowrap>

<span class="pricing"><?php echo $this->_tpl_vars['product']['pricing']['minprice']['price']; ?>
</span><br />
<?php if ($this->_tpl_vars['product']['pricing']['minprice']['cycle'] == 'monthly'): ?>
<?php echo $this->_tpl_vars['LANG']['orderpaymenttermmonthly']; ?>

<?php elseif ($this->_tpl_vars['product']['pricing']['minprice']['cycle'] == 'quarterly'): ?>
<?php echo $this->_tpl_vars['LANG']['orderpaymenttermquarterly']; ?>

<?php elseif ($this->_tpl_vars['product']['pricing']['minprice']['cycle'] == 'semiannually'): ?>
<?php echo $this->_tpl_vars['LANG']['orderpaymenttermsemiannually']; ?>

<?php elseif ($this->_tpl_vars['product']['pricing']['minprice']['cycle'] == 'annually'): ?>
<?php echo $this->_tpl_vars['LANG']['orderpaymenttermannually']; ?>

<?php elseif ($this->_tpl_vars['product']['pricing']['minprice']['cycle'] == 'biennially'): ?>
<?php echo $this->_tpl_vars['LANG']['orderpaymenttermbiennially']; ?>

<?php elseif ($this->_tpl_vars['product']['pricing']['minprice']['cycle'] == 'triennially'): ?>
<?php echo $this->_tpl_vars['LANG']['orderpaymenttermtriennially']; ?>

<?php endif; ?>

</td></tr></table>

<div class="description"><?php echo $this->_tpl_vars['product']['featuresdesc']; ?>
</div>

<form method="post" action="cart.php?a=add&pid=<?php echo $this->_tpl_vars['product']['pid']; ?>
">
<div class="ordernowbox"><input type="submit" value="<?php echo $this->_tpl_vars['LANG']['ordernowbutton']; ?>
 &raquo;" class="ordernow" /></div>
</form>

</div>
<?php endforeach; endif; unset($_from); ?>

</div>

<?php if (! $this->_tpl_vars['loggedin'] && $this->_tpl_vars['currencies']): ?>
<div id="currencychooser">
<?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curr']):
?>
<a href="cart.php?gid=<?php echo $this->_tpl_vars['gid']; ?>
&currency=<?php echo $this->_tpl_vars['curr']['id']; ?>
"><img src="images/flags/<?php if ($this->_tpl_vars['curr']['code'] == 'AUD'): ?>au<?php elseif ($this->_tpl_vars['curr']['code'] == 'CAD'): ?>ca<?php elseif ($this->_tpl_vars['curr']['code'] == 'EUR'): ?>eu<?php elseif ($this->_tpl_vars['curr']['code'] == 'GBP'): ?>gb<?php elseif ($this->_tpl_vars['curr']['code'] == 'INR'): ?>in<?php elseif ($this->_tpl_vars['curr']['code'] == 'JPY'): ?>jp<?php elseif ($this->_tpl_vars['curr']['code'] == 'USD'): ?>us<?php elseif ($this->_tpl_vars['curr']['code'] == 'ZAR'): ?>za<?php else: ?>na<?php endif; ?>.png" border="0" alt="" /> <?php echo $this->_tpl_vars['curr']['code']; ?>
</a>
<?php endforeach; endif; unset($_from); ?>
</div>
<div class="clear"></div>
<?php endif; ?>

<br />

<p align="center"><input type="button" value="<?php echo $this->_tpl_vars['LANG']['viewcart']; ?>
" onclick="window.location='cart.php?a=view'" /></p>

<br />