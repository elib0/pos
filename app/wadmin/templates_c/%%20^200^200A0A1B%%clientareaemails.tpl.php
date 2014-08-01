<?php /* Smarty version 2.6.26, created on 2012-05-22 21:35:39
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/clientareaemails.tpl */ ?>
<h2><?php echo $this->_tpl_vars['LANG']['clientareaemails']; ?>
</h2>
<p><?php echo $this->_tpl_vars['LANG']['clientareaemailsintrotext']; ?>
</p>
<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <td><?php echo $this->_tpl_vars['numproducts']; ?>
 <?php echo $this->_tpl_vars['LANG']['recordsfound']; ?>
, <?php echo $this->_tpl_vars['LANG']['page']; ?>
 <?php echo $this->_tpl_vars['pagenumber']; ?>
 <?php echo $this->_tpl_vars['LANG']['pageof']; ?>
 <?php echo $this->_tpl_vars['totalpages']; ?>
</td>
    <td align="right"><?php if ($this->_tpl_vars['prevpage']): ?><a href="clientarea.php?action=emails&amp;page=<?php echo $this->_tpl_vars['prevpage']; ?>
"><?php endif; ?>&laquo; <?php echo $this->_tpl_vars['LANG']['previouspage']; ?>
<?php if ($this->_tpl_vars['prevpage']): ?></a><?php endif; ?> &nbsp; <?php if ($this->_tpl_vars['nextpage']): ?><a href="clientarea.php?action=emails&amp;page=<?php echo $this->_tpl_vars['nextpage']; ?>
"><?php endif; ?><?php echo $this->_tpl_vars['LANG']['nextpage']; ?>
 &raquo;<?php if ($this->_tpl_vars['nextpage']): ?></a><?php endif; ?></td>
  </tr>
</table>
<br />
<table width="100%" border="0" cellpadding="10" cellspacing="0" class="data">
  <tr>
    <th width="30%"><?php echo $this->_tpl_vars['LANG']['clientareaemailsdate']; ?>
</th>
    <th width="70%"><?php echo $this->_tpl_vars['LANG']['clientareaemailssubject']; ?>
</th>
  </tr>
  <?php $_from = $this->_tpl_vars['emails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['email']):
?>
  <tr>
    <td><?php echo $this->_tpl_vars['email']['date']; ?>
</td>
    <td><a href="#" onclick="window.open('viewemail.php?id=<?php echo $this->_tpl_vars['email']['id']; ?>
','','width=650,height=400,scrollbars=yes');return false"><?php echo $this->_tpl_vars['email']['subject']; ?>
</a></td>
  </tr>
  <?php endforeach; else: ?>
  <tr>
    <td colspan="2"><?php echo $this->_tpl_vars['LANG']['norecordsfound']; ?>
</td>
  </tr>
  <?php endif; unset($_from); ?>
</table>
<br />
<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <td><?php echo $this->_tpl_vars['LANG']['show']; ?>
: <a href="clientarea.php?action=emails&itemlimit=10">10</a> <a href="clientarea.php?action=emails&itemlimit=25">25</a> <a href="clientarea.php?action=emails&itemlimit=50">50</a> <a href="clientarea.php?action=emails&itemlimit=100">100</a> <a href="clientarea.php?action=emails&itemlimit=all"><?php echo $this->_tpl_vars['LANG']['all']; ?>
</a></td>
    <td align="right"><?php if ($this->_tpl_vars['prevpage']): ?><a href="clientarea.php?action=emails&amp;page=<?php echo $this->_tpl_vars['prevpage']; ?>
"><?php endif; ?>&laquo; <?php echo $this->_tpl_vars['LANG']['previouspage']; ?>
<?php if ($this->_tpl_vars['prevpage']): ?></a><?php endif; ?> &nbsp; <?php if ($this->_tpl_vars['nextpage']): ?><a href="clientarea.php?action=emails&amp;page=<?php echo $this->_tpl_vars['nextpage']; ?>
"><?php endif; ?><?php echo $this->_tpl_vars['LANG']['nextpage']; ?>
 &raquo;<?php if ($this->_tpl_vars['nextpage']): ?></a><?php endif; ?></td>
  </tr>
</table><br />