<?php /* Smarty version 2.6.26, created on 2012-05-17 06:56:01
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/supportticketsubmit-stepone.tpl */ ?>
<p><?php echo $this->_tpl_vars['LANG']['supportticketsheader']; ?>
</p>
<ul>
  <?php $_from = $this->_tpl_vars['departments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['department']):
?>
  <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>
?step=2&amp;deptid=<?php echo $this->_tpl_vars['department']['id']; ?>
"><strong><?php echo $this->_tpl_vars['department']['name']; ?>
</strong></a><?php if ($this->_tpl_vars['department']['description']): ?> - <?php echo $this->_tpl_vars['department']['description']; ?>
<?php endif; ?></li>
  <?php endforeach; endif; unset($_from); ?>
</ul>