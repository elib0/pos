<?php /* Smarty version 2.6.26, created on 2012-05-16 15:32:54
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/knowledgebase.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', '/home/websarro/public_html/wadmin/templates/boxslots/knowledgebase.tpl', 23, false),)), $this); ?>
<p><?php echo $this->_tpl_vars['LANG']['knowledgebaseintrotext']; ?>
</p>
<h2><?php echo $this->_tpl_vars['LANG']['knowledgebasesearch']; ?>
</h2>
<form method="post" action="knowledgebase.php?action=search">
  <p align="center">
    <input type="text" name="search" size="40" /> <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['knowledgebasesearch']; ?>
" />
  </p>
</form>
<h2><?php echo $this->_tpl_vars['LANG']['knowledgebasecategories']; ?>
</h2>
<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr> <?php $_from = $this->_tpl_vars['kbcats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['kbcat']):
?>
    <td width="33%" align="left" valign="top"><img src="images/folder.gif" border="0" class="absmiddle" alt="Folder" /> <strong><a href="<?php if ($this->_tpl_vars['seofriendlyurls']): ?>knowledgebase/<?php echo $this->_tpl_vars['kbcat']['id']; ?>
/<?php echo $this->_tpl_vars['kbcat']['urlfriendlyname']; ?>
<?php else: ?>knowledgebase.php?action=displaycat&amp;catid=<?php echo $this->_tpl_vars['kbcat']['id']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['kbcat']['name']; ?>
</a></strong> (<?php echo $this->_tpl_vars['kbcat']['numarticles']; ?>
)<br />
      <?php echo $this->_tpl_vars['kbcat']['description']; ?>
 </td>
    <?php if (!($this->_tpl_vars['num'] % 3)): ?> </tr>
  <tr> <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?> </tr>
</table>
<br />
<h2><?php echo $this->_tpl_vars['LANG']['knowledgebasepopular']; ?>
 <?php echo $this->_tpl_vars['LANG']['knowledgebasearticles']; ?>
</h2>
<table width="100%">
    <?php $_from = $this->_tpl_vars['kbmostviews']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['kbarticle']):
?>
    <div class="kbarticle">
        <img src="images/article.gif" class="absmiddle" border="0" alt="Article" /> <strong><a href="<?php if ($this->_tpl_vars['seofriendlyurls']): ?>knowledgebase/<?php echo $this->_tpl_vars['kbarticle']['id']; ?>
/<?php echo $this->_tpl_vars['kbarticle']['urlfriendlytitle']; ?>
.html<?php else: ?>knowledgebase.php?action=displayarticle&amp;id=<?php echo $this->_tpl_vars['kbarticle']['id']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['kbarticle']['title']; ?>
</a></strong><br />
        <?php echo ((is_array($_tmp=$this->_tpl_vars['kbarticle']['article'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 150, "...") : smarty_modifier_truncate($_tmp, 150, "...")); ?>
<br />
        <span class="kbviews"><?php echo $this->_tpl_vars['LANG']['knowledgebaseviews']; ?>
: <?php echo $this->_tpl_vars['kbarticle']['views']; ?>
</span>
    </div>
    <?php endforeach; endif; unset($_from); ?>
</table>
<br />