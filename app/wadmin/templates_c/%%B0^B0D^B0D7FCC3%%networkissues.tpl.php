<?php /* Smarty version 2.6.26, created on 2012-09-19 11:09:05
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/networkissues.tpl */ ?>
<div class="contentbox"> <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?view=open" class="networkissuesopen"><?php echo $this->_tpl_vars['opencount']; ?>
 <?php echo $this->_tpl_vars['LANG']['networkissuesstatusopen']; ?>
</a> | <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?view=scheduled" class="networkissuesscheduled"><?php echo $this->_tpl_vars['scheduledcount']; ?>
 <?php echo $this->_tpl_vars['LANG']['networkissuesstatusscheduled']; ?>
</a> | <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?view=resolved" class="networkissuesclosed"><?php echo $this->_tpl_vars['resolvedcount']; ?>
 <?php echo $this->_tpl_vars['LANG']['networkissuesstatusresolved']; ?>
</a> </div>
<?php $_from = $this->_tpl_vars['issues']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['issue']):
?>

<?php if ($this->_tpl_vars['issue']['clientaffected']): ?>
<div class="networkissueaffected"><?php endif; ?>
  <h2><?php echo $this->_tpl_vars['issue']['title']; ?>
 (<?php echo $this->_tpl_vars['issue']['status']; ?>
)</h2>
  <h3><?php echo $this->_tpl_vars['LANG']['networkissuesaffecting']; ?>
 <?php echo $this->_tpl_vars['issue']['type']; ?>
 - <?php if ($this->_tpl_vars['issue']['type'] == $this->_tpl_vars['LANG']['networkissuestypeserver']): ?><?php echo $this->_tpl_vars['issue']['server']; ?>
<?php else: ?><?php echo $this->_tpl_vars['issue']['affecting']; ?>
<?php endif; ?> | <?php echo $this->_tpl_vars['LANG']['networkissuespriority']; ?>
 - <?php echo $this->_tpl_vars['issue']['priority']; ?>
</h3>
  <p><?php echo $this->_tpl_vars['issue']['description']; ?>
 <strong><?php echo $this->_tpl_vars['LANG']['networkissuesdate']; ?>
</strong> - <?php echo $this->_tpl_vars['issue']['startdate']; ?>
<?php if ($this->_tpl_vars['issue']['enddate']): ?> - <?php echo $this->_tpl_vars['issue']['enddate']; ?>
<?php endif; ?><br />
    <strong><?php echo $this->_tpl_vars['LANG']['networkissueslastupdated']; ?>
</strong> - <?php echo $this->_tpl_vars['issue']['lastupdate']; ?>
</p>
  <?php if ($this->_tpl_vars['issue']['clientaffected']): ?></div>
<?php endif; ?><br />

<?php endforeach; else: ?>
<p align="center"><b><?php echo $this->_tpl_vars['LANG']['networkissuesnonefound']; ?>
</b></p>
<?php endif; unset($_from); ?> <br />
<p align="center"><?php if ($this->_tpl_vars['prevpage']): ?><a href="networkissues.php?<?php if ($this->_tpl_vars['view']): ?>view=<?php echo $this->_tpl_vars['view']; ?>
&<?php endif; ?>page=<?php echo $this->_tpl_vars['prevpage']; ?>
"><?php endif; ?>&laquo; <?php echo $this->_tpl_vars['LANG']['previouspage']; ?>
<?php if ($this->_tpl_vars['prevpage']): ?></a><?php endif; ?> &nbsp; <?php if ($this->_tpl_vars['nextpage']): ?><a href="networkissues.php?<?php if ($this->_tpl_vars['view']): ?>view=<?php echo $this->_tpl_vars['view']; ?>
&<?php endif; ?>page=<?php echo $this->_tpl_vars['nextpage']; ?>
"><?php endif; ?><?php echo $this->_tpl_vars['LANG']['nextpage']; ?>
 &raquo;<?php if ($this->_tpl_vars['nextpage']): ?></a><?php endif; ?></p>
<?php if ($this->_tpl_vars['loggedin']): ?>
<p><?php echo $this->_tpl_vars['LANG']['networkissuesaffectingyourservers']; ?>
</p>
<?php endif; ?><br />