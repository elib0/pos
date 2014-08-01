<?php /* Smarty version 2.6.26, created on 2012-06-19 11:07:05
         compiled from whois.tpl */ ?>
<html>
<head>
<title><?php echo $this->_tpl_vars['companyname']; ?>
 - <?php echo $this->_tpl_vars['pagetitle']; ?>
</title>
<link rel="stylesheet" type="text/css" href="templates/<?php echo $this->_tpl_vars['template']; ?>
/invoicestyle.css">
</head>
<body bgcolor="#efefef">

<p><strong><?php echo $this->_tpl_vars['LANG']['whoisresults']; ?>
 <?php echo $this->_tpl_vars['domain']; ?>
</strong></p>

<p><?php echo $this->_tpl_vars['whois']; ?>
</p>

<p align="center"><a href="javascript:window.close()"><?php echo $this->_tpl_vars['LANG']['closewindow']; ?>
</a></p>

</body>
</html>