<?php /* Smarty version 2.6.26, created on 2012-07-02 20:44:48
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/affiliatessignup.tpl */ ?>
<?php if ($this->_tpl_vars['affiliatesystemenabled']): ?>
<p><?php echo $this->_tpl_vars['LANG']['affiliatesintrotext']; ?>
</p>
<ul>
  <li><?php echo $this->_tpl_vars['LANG']['affiliatesbullet1']; ?>
 <?php echo $this->_tpl_vars['bonusdeposit']; ?>
</li>
  <li><?php echo $this->_tpl_vars['LANG']['affiliatesearn']; ?>
 <strong><?php echo $this->_tpl_vars['payoutpercentage']; ?>
</strong> <?php echo $this->_tpl_vars['LANG']['affiliatesbullet2']; ?>
</li>
</ul>
<p><?php echo $this->_tpl_vars['LANG']['affiliatesfootertext']; ?>
</p>
<br />
<p align="center">
  <input type="button" value="<?php echo $this->_tpl_vars['LANG']['affiliatesactivate']; ?>
" onclick="window.location='affiliates.php?activate=true'" />
</p>
<?php else: ?>
<p><?php echo $this->_tpl_vars['LANG']['affiliatesdisabled']; ?>
</p>
<?php endif; ?><br />