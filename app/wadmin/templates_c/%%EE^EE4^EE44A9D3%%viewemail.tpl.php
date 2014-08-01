<?php /* Smarty version 2.6.26, created on 2012-05-22 21:35:58
         compiled from viewemail.tpl */ ?>
<html>
<head>
<title><?php echo $this->_tpl_vars['companyname']; ?>
 - <?php echo $this->_tpl_vars['LANG']['clientareaemails']; ?>
</title>
<link rel="stylesheet" type="text/css" href="templates/<?php echo $this->_tpl_vars['template']; ?>
/invoicestyle.css">
</head>
<body bgcolor="#efefef">

<table id="wrapper" cellspacing="1" cellpadding="10" bgcolor="#cccccc" align="center"><tr><td bgcolor="#ffffff">

<p><strong>Subject:</strong> <?php echo $this->_tpl_vars['subject']; ?>
</p>
<?php echo $this->_tpl_vars['message']; ?>


</td></tr></table>

</body>
</html>