<?php /* Smarty version 2.6.26, created on 2012-08-14 21:44:33
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/forwardpage.tpl */ ?>
<br /><br />
<p align="center"><?php echo $this->_tpl_vars['message']; ?>
</p>
<p align="center"><img src="images/loading.gif" alt="Loading" border="0" /></p>
<div align="center"><?php echo $this->_tpl_vars['code']; ?>
</div>
<form method="post" action="<?php if ($this->_tpl_vars['invoiceid']): ?>viewinvoice.php?id=<?php echo $this->_tpl_vars['invoiceid']; ?>
<?php else: ?>clientarea.php<?php endif; ?>"></form>
<br /><br /><br />
<?php echo '
<script language="javascript">
setTimeout ( "autoForward()" , 5000 );
function autoForward() {
	document.forms[0].submit()
}
</script>
'; ?>