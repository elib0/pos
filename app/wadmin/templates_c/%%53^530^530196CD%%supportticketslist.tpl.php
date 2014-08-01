<?php /* Smarty version 2.6.26, created on 2012-06-01 14:19:29
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/supportticketslist.tpl */ ?>
<h2><?php echo $this->_tpl_vars['LANG']['clientareanavsupporttickets']; ?>
</h2>
<p><?php echo $this->_tpl_vars['LANG']['supportticketssystemdescription']; ?>
</p>
<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <td><?php echo $this->_tpl_vars['LANG']['supportticketsopentickets']; ?>
: <strong><?php echo $this->_tpl_vars['numopentickets']; ?>
</strong></td>
    <td align="right"><a href="submitticket.php"><?php echo $this->_tpl_vars['LANG']['supportticketssubmitticket']; ?>
</a></td>
  </tr>
</table>
<form method="get" action="supporttickets.php">
  <p align="center"><b><?php echo $this->_tpl_vars['LANG']['knowledgebasesearch']; ?>
:</b>
    <input type="text" name="searchterm" size="25" value="<?php echo $this->_tpl_vars['searchterm']; ?>
" />
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['knowledgebasesearch']; ?>
" />
  </p>
</form>
<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <td><?php echo $this->_tpl_vars['numtickets']; ?>
 <?php echo $this->_tpl_vars['LANG']['recordsfound']; ?>
,  <?php echo $this->_tpl_vars['LANG']['page']; ?>
 <?php echo $this->_tpl_vars['pagenumber']; ?>
 <?php echo $this->_tpl_vars['LANG']['pageof']; ?>
 <?php echo $this->_tpl_vars['totalpages']; ?>
</td>
    <td align="right"><?php if ($this->_tpl_vars['prevpage']): ?><a href="supporttickets.php?page=<?php echo $this->_tpl_vars['prevpage']; ?>
"><?php endif; ?>&laquo; <?php echo $this->_tpl_vars['LANG']['previouspage']; ?>
<?php if ($this->_tpl_vars['prevpage']): ?></a><?php endif; ?> &nbsp; <?php if ($this->_tpl_vars['nextpage']): ?><a href="supporttickets.php?page=<?php echo $this->_tpl_vars['nextpage']; ?>
"><?php endif; ?><?php echo $this->_tpl_vars['LANG']['nextpage']; ?>
 &raquo;<?php if ($this->_tpl_vars['nextpage']): ?></a><?php endif; ?></td>
  </tr>
</table>
<br />
<table class="data" width="100%" border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <th><?php echo $this->_tpl_vars['LANG']['supportticketsdate']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['supportticketsdepartment']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['supportticketssubject']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['supportticketsstatus']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['supportticketsticketurgency']; ?>
</th>
  </tr>
  <?php $_from = $this->_tpl_vars['tickets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['ticket']):
?>
  <tr>
    <td><?php echo $this->_tpl_vars['ticket']['date']; ?>
</td>
    <td><?php echo $this->_tpl_vars['ticket']['department']; ?>
</td>
    <td><DIV ALIGN="left"><img src="images/article.gif" hspace="5" align="middle"><a href="viewticket.php?tid=<?php echo $this->_tpl_vars['ticket']['tid']; ?>
&amp;c=<?php echo $this->_tpl_vars['ticket']['c']; ?>
"><?php if ($this->_tpl_vars['ticket']['unread']): ?><strong><?php endif; ?><?php echo $this->_tpl_vars['ticket']['subject']; ?>
<?php if ($this->_tpl_vars['ticket']['unread']): ?></strong><?php endif; ?></a></DIV></td>
    <td><?php echo $this->_tpl_vars['ticket']['status']; ?>
</td>
    <td width=80><?php echo $this->_tpl_vars['ticket']['urgency']; ?>
</td>
  </tr>
  <?php endforeach; else: ?>
  <tr>
    <td colspan="5"><?php echo $this->_tpl_vars['LANG']['norecordsfound']; ?>
</td>
  </tr>
  <?php endif; unset($_from); ?>
</table>
<br />
<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <td><?php echo $this->_tpl_vars['LANG']['show']; ?>
: <a href="supporttickets.php?<?php if ($this->_tpl_vars['searchterm']): ?>searchterm=<?php echo $this->_tpl_vars['searchterm']; ?>
&<?php endif; ?>itemlimit=10">10</a> <a href="supporttickets.php?<?php if ($this->_tpl_vars['searchterm']): ?>searchterm=<?php echo $this->_tpl_vars['searchterm']; ?>
&<?php endif; ?>itemlimit=25">25</a> <a href="supporttickets.php?<?php if ($this->_tpl_vars['searchterm']): ?>searchterm=<?php echo $this->_tpl_vars['searchterm']; ?>
&<?php endif; ?>itemlimit=50">50</a> <a href="supporttickets.php?<?php if ($this->_tpl_vars['searchterm']): ?>searchterm=<?php echo $this->_tpl_vars['searchterm']; ?>
&<?php endif; ?>itemlimit=100">100</a> <a href="supporttickets.php?<?php if ($this->_tpl_vars['searchterm']): ?>searchterm=<?php echo $this->_tpl_vars['searchterm']; ?>
&<?php endif; ?>itemlimit=all"><?php echo $this->_tpl_vars['LANG']['all']; ?>
</a></td>
    <td align="right"><?php if ($this->_tpl_vars['prevpage']): ?><a href="supporttickets.php?<?php if ($this->_tpl_vars['searchterm']): ?>searchterm=<?php echo $this->_tpl_vars['searchterm']; ?>
&<?php endif; ?>page=<?php echo $this->_tpl_vars['prevpage']; ?>
"><?php endif; ?>&laquo; <?php echo $this->_tpl_vars['LANG']['previouspage']; ?>
<?php if ($this->_tpl_vars['prevpage']): ?></a><?php endif; ?> &nbsp; <?php if ($this->_tpl_vars['nextpage']): ?><a href="supporttickets.php?<?php if ($this->_tpl_vars['searchterm']): ?>searchterm=<?php echo $this->_tpl_vars['searchterm']; ?>
&<?php endif; ?>page=<?php echo $this->_tpl_vars['nextpage']; ?>
"><?php endif; ?><?php echo $this->_tpl_vars['LANG']['nextpage']; ?>
 &raquo;<?php if ($this->_tpl_vars['nextpage']): ?></a><?php endif; ?></td>
  </tr>
</table><br />