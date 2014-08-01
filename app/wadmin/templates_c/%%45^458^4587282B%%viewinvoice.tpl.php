<?php /* Smarty version 2.6.26, created on 2012-06-01 14:15:54
         compiled from viewinvoice.tpl */ ?>
<html>
<head>
<title><?php echo $this->_tpl_vars['companyname']; ?>
 - <?php echo $this->_tpl_vars['LANG']['invoicenumber']; ?>
<?php echo $this->_tpl_vars['invoicenum']; ?>
</title>
<link rel="stylesheet" type="text/css" href="templates/<?php echo $this->_tpl_vars['template']; ?>
/invoicestyle.css">
</head>
<body bgcolor="#efefef">

<?php if ($this->_tpl_vars['error']): ?>
<p style="color:#cc0000;"><?php echo $this->_tpl_vars['LANG']['invoiceserror']; ?>
</p>
<?php else: ?>

<table id="wrapper" cellspacing="1" cellpadding="10" bgcolor="#cccccc" align="center"><tr><td bgcolor="#ffffff">

<table width="100%"><tr><td width="50%">

<?php if ($this->_tpl_vars['logo']): ?><p><img src="<?php echo $this->_tpl_vars['logo']; ?>
"></p><?php else: ?><h1><?php echo $this->_tpl_vars['companyname']; ?>
</h1><?php endif; ?>

</td><td width="50%" align="center">

<?php if ($this->_tpl_vars['status'] == 'Unpaid'): ?>
<font class="unpaid"><?php echo $this->_tpl_vars['LANG']['invoicesunpaid']; ?>
</font><br />
<?php if ($this->_tpl_vars['allowchangegateway']): ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?id=<?php echo $this->_tpl_vars['invoiceid']; ?>
"><?php echo $this->_tpl_vars['gatewaydropdown']; ?>
</form>
<?php else: ?>
<?php echo $this->_tpl_vars['paymentmethod']; ?>
<br />
<?php endif; ?>
<?php echo $this->_tpl_vars['paymentbutton']; ?>

<?php elseif ($this->_tpl_vars['status'] == 'Paid'): ?>
<font class="paid"><?php echo $this->_tpl_vars['LANG']['invoicespaid']; ?>
</font><br />
<?php echo $this->_tpl_vars['paymentmethod']; ?>
<br />
(<?php echo $this->_tpl_vars['datepaid']; ?>
)
<?php elseif ($this->_tpl_vars['status'] == 'Refunded'): ?>
<font class="refunded"><?php echo $this->_tpl_vars['LANG']['invoicesrefunded']; ?>
</font>
<?php elseif ($this->_tpl_vars['status'] == 'Cancelled'): ?>
<font class="cancelled"><?php echo $this->_tpl_vars['LANG']['invoicescancelled']; ?>
</font>
<?php elseif ($this->_tpl_vars['status'] == 'Collections'): ?>
<font class="collections"><?php echo $this->_tpl_vars['LANG']['invoicescollections']; ?>
</font>
<?php endif; ?>

</td></tr></table>

<?php if ($_GET['paymentsuccess']): ?>
<p align="center" class="paid"><?php echo $this->_tpl_vars['LANG']['invoicepaymentsuccessconfirmation']; ?>
</p>
<?php elseif ($_GET['paymentfailed']): ?>
<p align="center" class="unpaid"><?php echo $this->_tpl_vars['LANG']['invoicepaymentfailedconfirmation']; ?>
</p>
<?php elseif ($this->_tpl_vars['offlinepaid']): ?>
<p align="center" class="refunded"><?php echo $this->_tpl_vars['LANG']['invoiceofflinepaid']; ?>
</p>
<?php else: ?>
<br />
<?php endif; ?>

<?php if ($this->_tpl_vars['manualapplycredit']): ?>
<div class="creditbox"><?php echo $this->_tpl_vars['LANG']['invoiceaddcreditdesc1']; ?>
 <?php echo $this->_tpl_vars['totalcredit']; ?>
. <?php echo $this->_tpl_vars['LANG']['invoiceaddcreditdesc2']; ?>
<br />
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?id=<?php echo $this->_tpl_vars['invoiceid']; ?>
"><input type="hidden" name="applycredit" value="true" />
<?php echo $this->_tpl_vars['LANG']['invoiceaddcreditamount']; ?>
: <input type="text" name="creditamount" size="10" value="<?php echo $this->_tpl_vars['creditamount']; ?>
" /> <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['invoiceaddcreditapply']; ?>
" />
</form></div>
<br />
<?php endif; ?>

<table width="100%" id="invoicetoptables" cellspacing="0"><tr><td width="50%" id="invoicecontent" style="border:1px solid #cccccc">

<table width="100%" height="100" cellspacing="0" cellpadding="10" id="invoicetoptables"><tr><td id="invoicecontent" valign="top" style="border:1px solid #cccccc">

<strong><?php echo $this->_tpl_vars['LANG']['invoicesinvoicedto']; ?>
</strong><br />
<?php if ($this->_tpl_vars['clientsdetails']['companyname']): ?><?php echo $this->_tpl_vars['clientsdetails']['companyname']; ?>
<br /><?php endif; ?>
<?php echo $this->_tpl_vars['clientsdetails']['firstname']; ?>
 <?php echo $this->_tpl_vars['clientsdetails']['lastname']; ?>
<br />
<?php echo $this->_tpl_vars['clientsdetails']['address1']; ?>
, <?php echo $this->_tpl_vars['clientsdetails']['address2']; ?>
<br />
<?php echo $this->_tpl_vars['clientsdetails']['city']; ?>
, <?php echo $this->_tpl_vars['clientsdetails']['state']; ?>
, <?php echo $this->_tpl_vars['clientsdetails']['postcode']; ?>
<br />
<?php echo $this->_tpl_vars['clientsdetails']['country']; ?>


</td></tr></table>

</td><td width="50%" id="invoicecontent" style="border:1px solid #cccccc;border-left:0px;">

<table width="100%" height="100" cellspacing="0" cellpadding="10" id="invoicetoptables"><tr><td id="invoicecontent" valign="top" style="border:1px solid #cccccc">

<strong><?php echo $this->_tpl_vars['LANG']['invoicespayto']; ?>
</strong><br />
<?php echo $this->_tpl_vars['payto']; ?>


</td></tr></table>

</td></tr></table>

<p><strong><?php echo $this->_tpl_vars['LANG']['invoicenumber']; ?>
<?php echo $this->_tpl_vars['invoicenum']; ?>
</strong><br />
<?php echo $this->_tpl_vars['LANG']['invoicesdatecreated']; ?>
: <?php echo $this->_tpl_vars['datecreated']; ?>
<br />
<?php echo $this->_tpl_vars['LANG']['invoicesdatedue']; ?>
: <?php echo $this->_tpl_vars['datedue']; ?>
</p>

<table cellspacing="0" id="invoiceitemstable" align="center"><tr><td id="invoiceitemsheading" align="center" width="70%" style="border:1px solid #cccccc;border-bottom:0px;"><strong><?php echo $this->_tpl_vars['LANG']['invoicesdescription']; ?>
</strong></td><td id="invoiceitemsheading" align="center" width="30%" style="border:1px solid #cccccc;border-left:0px;border-bottom:0px;"><strong><?php echo $this->_tpl_vars['LANG']['invoicesamount']; ?>
</strong></td></tr>
<?php $_from = $this->_tpl_vars['invoiceitems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['invoiceitem']):
?>
<tr bgcolor=#ffffff><td id="invoiceitemsrow" style="border:1px solid #cccccc;border-bottom:0px;"><?php echo $this->_tpl_vars['invoiceitem']['description']; ?>
<?php if ($this->_tpl_vars['invoiceitem']['taxed'] == 'true'): ?> *<?php endif; ?></td><td align="center" id="invoiceitemsrow" style="border:1px solid #cccccc;border-bottom:0px;border-left:0px;"><?php echo $this->_tpl_vars['invoiceitem']['amount']; ?>
</td></tr>
<?php endforeach; endif; unset($_from); ?>
<tr><td id="invoiceitemsheading" style="border:1px solid #cccccc;border-bottom:0px;"><div align="right"><?php echo $this->_tpl_vars['LANG']['invoicessubtotal']; ?>
:&nbsp;</div></td><td id="invoiceitemsheading" align="center" style="border:1px solid #cccccc;border-bottom:0px;border-left:0px;"><strong><?php echo $this->_tpl_vars['subtotal']; ?>
</strong></td></tr>
<?php if ($this->_tpl_vars['taxrate']): ?><tr><td id="invoiceitemsheading" style="border:1px solid #cccccc;border-bottom:0px;"><div align="right"><?php echo $this->_tpl_vars['taxrate']; ?>
% <?php echo $this->_tpl_vars['taxname']; ?>
:&nbsp;</div></td><td id="invoiceitemsheading" align="center" style="border:1px solid #cccccc;border-bottom:0px;border-left:0px;"><strong><?php echo $this->_tpl_vars['tax']; ?>
</strong></td></tr><?php endif; ?>
<?php if ($this->_tpl_vars['taxrate2']): ?><tr><td id="invoiceitemsheading" style="border:1px solid #cccccc;border-bottom:0px;"><div align="right"><?php echo $this->_tpl_vars['taxrate2']; ?>
% <?php echo $this->_tpl_vars['taxname2']; ?>
:&nbsp;</div></td><td id="invoiceitemsheading" align="center" style="border:1px solid #cccccc;border-bottom:0px;border-left:0px;"><strong><?php echo $this->_tpl_vars['tax2']; ?>
</strong></td></tr><?php endif; ?>
<tr><td id="invoiceitemsheading" style="border:1px solid #cccccc;border-bottom:0px;"><div align="right"><?php echo $this->_tpl_vars['LANG']['invoicescredit']; ?>
:&nbsp;</div></td><td id="invoiceitemsheading" align="center" style="border:1px solid #cccccc;border-bottom:0px;border-left:0px;"><strong><?php echo $this->_tpl_vars['credit']; ?>
</strong></td></tr>
<tr><td id="invoiceitemsheading" style="border:1px solid #cccccc;"><div align="right"><?php echo $this->_tpl_vars['LANG']['invoicestotal']; ?>
:&nbsp;</div></td><td id="invoiceitemsheading" align="center" style="border:1px solid #cccccc;border-left:0px;"><strong><?php echo $this->_tpl_vars['total']; ?>
</strong></td></tr>
</table>

<?php if ($this->_tpl_vars['taxrate']): ?><p>* <?php echo $this->_tpl_vars['LANG']['invoicestaxindicator']; ?>
</p><?php endif; ?>

<p><strong><?php echo $this->_tpl_vars['LANG']['invoicestransactions']; ?>
</strong></p>

<table cellspacing="0" id="invoiceitemstable" align="center"><tr><td id="invoiceitemsheading" align="center" width="30%" style="border:1px solid #cccccc"><strong><?php echo $this->_tpl_vars['LANG']['invoicestransdate']; ?>
</strong></td><td id="invoiceitemsheading" align="center" width="25%" style="border:1px solid #cccccc;border-left:0px;"><strong><?php echo $this->_tpl_vars['LANG']['invoicestransgateway']; ?>
</strong></td><td id="invoiceitemsheading" align="center" width="25%" style="border:1px solid #cccccc;border-left:0px;"><strong><?php echo $this->_tpl_vars['LANG']['invoicestransid']; ?>
</strong></td><td id="invoiceitemsheading" align="center" width="20%" style="border:1px solid #cccccc;border-left:0px;"><strong><?php echo $this->_tpl_vars['LANG']['invoicestransamount']; ?>
</strong></td></tr>
<?php $_from = $this->_tpl_vars['transactions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['transaction']):
?>
<tr bgcolor=#ffffff><td id="invoiceitemsrow" align="center" style="border:1px solid #cccccc;border-top:0px;"><?php echo $this->_tpl_vars['transaction']['date']; ?>
</td><td align="center" id="invoiceitemsrow" style="border:1px solid #cccccc;border-left:0px;border-top:0px;"><?php echo $this->_tpl_vars['transaction']['gateway']; ?>
</td><td align="center" id="invoiceitemsrow" style="border:1px solid #cccccc;border-left:0px;border-top:0px;"><?php echo $this->_tpl_vars['transaction']['transid']; ?>
</td><td align="center" id="invoiceitemsrow" style="border:1px solid #cccccc;border-left:0px;border-top:0px;"><?php echo $this->_tpl_vars['transaction']['amount']; ?>
</td></tr>
<?php endforeach; else: ?>
<tr bgcolor=#ffffff><td id="invoiceitemsrow" colspan=4 align="center" style="border:1px solid #cccccc;border-top:0px;"><?php echo $this->_tpl_vars['LANG']['invoicestransnonefound']; ?>
</td></tr>
<?php endif; unset($_from); ?>
<tr><td id="invoiceitemsheading" width="30%" style="border:1px solid #cccccc;border-top:0px;" colspan=3><DIV ALIGN="right"><strong><?php echo $this->_tpl_vars['LANG']['invoicesbalance']; ?>
:&nbsp;</strong></DIV></td><td id="invoiceitemsheading" align="center" width="20%" style="border:1px solid #cccccc;border-left:0px;border-top:0px;"><strong><?php echo $this->_tpl_vars['balance']; ?>
</strong></td></tr>
</table>

<?php if ($this->_tpl_vars['notes']): ?>
<p><?php echo $this->_tpl_vars['LANG']['invoicesnotes']; ?>
: <?php echo $this->_tpl_vars['notes']; ?>
</p>
<?php endif; ?>

<br /><br /><br /><br /><br />

</td></tr></table>

<?php endif; ?>

<p align="center"><a href="clientarea.php"><?php echo $this->_tpl_vars['LANG']['invoicesbacktoclientarea']; ?>
</a> | <a href="dl.php?type=i&amp;id=<?php echo $this->_tpl_vars['invoiceid']; ?>
"><?php echo $this->_tpl_vars['LANG']['invoicesdownload']; ?>
</a> | <a href="javascript:window.close()"><?php echo $this->_tpl_vars['LANG']['closewindow']; ?>
</a></p>

</body>
</html>