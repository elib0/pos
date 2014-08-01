<?php /* Smarty version 2.6.26, created on 2012-06-01 14:22:28
         compiled from boxslots/supportticketsubmit-kbsuggestions.tpl */ ?>
<h2><?php echo $this->_tpl_vars['LANG']['kbsuggestions']; ?>
</h2>
<p><?php echo $this->_tpl_vars['LANG']['kbsuggestionsexplanation']; ?>
</p>
<p><?php $_from = $this->_tpl_vars['kbarticles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['kbarticle']):
?> <img src="images/article.gif" class="absmiddle" border="0" alt="" /> <a href="knowledgebase.php?action=displayarticle&id=<?php echo $this->_tpl_vars['kbarticle']['id']; ?>
" target="_blank"><?php echo $this->_tpl_vars['kbarticle']['title']; ?>
</a> - <?php echo $this->_tpl_vars['kbarticle']['article']; ?>
...<br>
  <?php endforeach; endif; unset($_from); ?></p>