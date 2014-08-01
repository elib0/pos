<?php /* Smarty version 2.6.26, created on 2012-05-30 10:12:48
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/banned.tpl */ ?>
<br />
<br />
<div class="contentbox">
  <p align="center"><?php echo $this->_tpl_vars['LANG']['bannedyourip']; ?>
 <?php echo $this->_tpl_vars['ip']; ?>
 <?php echo $this->_tpl_vars['LANG']['bannedhasbeenbanned']; ?>
</p>
  <p align="center"><strong><?php echo $this->_tpl_vars['LANG']['bannedbanreason']; ?>
:</strong> <?php echo $this->_tpl_vars['reason']; ?>
</p>
  <p align="center"><strong><?php echo $this->_tpl_vars['LANG']['bannedbanexpires']; ?>
:</strong> <?php echo $this->_tpl_vars['expires']; ?>
</p>
  <br />
</div>