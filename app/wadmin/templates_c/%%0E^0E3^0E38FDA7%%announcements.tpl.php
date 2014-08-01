<?php /* Smarty version 2.6.26, created on 2012-05-16 15:31:02
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/announcements.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', '/home/websarro/public_html/wadmin/templates/boxslots/announcements.tpl', 4, false),array('modifier', 'truncate', '/home/websarro/public_html/wadmin/templates/boxslots/announcements.tpl', 4, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['announcements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['announcement']):
?>
<h2><a href="<?php if ($this->_tpl_vars['seofriendlyurls']): ?>announcements/<?php echo $this->_tpl_vars['announcement']['id']; ?>
/<?php echo $this->_tpl_vars['announcement']['urlfriendlytitle']; ?>
.html<?php else: ?><?php echo $_SERVER['PHP_SELF']; ?>
?id=<?php echo $this->_tpl_vars['announcement']['id']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['announcement']['title']; ?>
</a></h2>
<p class="small"><strong><?php echo $this->_tpl_vars['announcement']['date']; ?>
</strong></p>
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['announcement']['text'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 200, "...") : smarty_modifier_truncate($_tmp, 200, "...")); ?>

<?php if (strlen ( $this->_tpl_vars['announcement']['text'] ) > 200): ?><p><a href="<?php if ($this->_tpl_vars['seofriendlyurls']): ?>announcements/<?php echo $this->_tpl_vars['announcement']['id']; ?>
/<?php echo $this->_tpl_vars['announcement']['urlfriendlytitle']; ?>
.html<?php else: ?><?php echo $_SERVER['PHP_SELF']; ?>
?id=<?php echo $this->_tpl_vars['announcement']['id']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['LANG']['more']; ?>
 &raquo</a></p><?php endif; ?>
<hr />
<?php endforeach; else: ?>
<h2><?php echo $this->_tpl_vars['LANG']['announcementsnone']; ?>
</h2>
<?php endif; unset($_from); ?>

<div style="float: left; width: 100px;">
<?php if ($this->_tpl_vars['prevpage']): ?><a href="announcements.php?page=<?php echo $this->_tpl_vars['prevpage']; ?>
"><?php endif; ?>&laquo; <?php echo $this->_tpl_vars['LANG']['previouspage']; ?>
<?php if ($this->_tpl_vars['prevpage']): ?></a><?php endif; ?>
</div>

<div style="float: right; width: 100px; text-align: right;">
<?php if ($this->_tpl_vars['nextpage']): ?><a href="announcements.php?page=<?php echo $this->_tpl_vars['nextpage']; ?>
"><?php endif; ?><?php echo $this->_tpl_vars['LANG']['nextpage']; ?>
 &raquo;<?php if ($this->_tpl_vars['nextpage']): ?></a><?php endif; ?>
</div>

<br />

<p align="center"><img src="images/rssfeed.gif" class="absmiddle" alt="" border="0" /> <a href="announcementsrss.php"><?php echo $this->_tpl_vars['LANG']['announcementsrss']; ?>
</a></p>