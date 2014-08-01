<?php /* Smarty version 2.6.26, created on 2012-05-14 09:35:41
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/twitterfeed.tpl */ ?>
<ul>
<?php $_from = $this->_tpl_vars['tweets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['tweet']):
?>
<?php if ($this->_tpl_vars['num'] < $this->_tpl_vars['numtweets']): ?>
  <li><b><?php echo $this->_tpl_vars['tweet']['date']; ?>
</b> - <?php echo $this->_tpl_vars['tweet']['tweet']; ?>
</li>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</ul>
<p><?php echo $this->_tpl_vars['LANG']['twitterfollowus']; ?>
 @ <a href="http://twitter.com/<?php echo $this->_tpl_vars['twitterusername']; ?>
" target="_blank">www.twitter.com/<?php echo $this->_tpl_vars['twitterusername']; ?>
</a> <?php echo $this->_tpl_vars['LANG']['twitterfollowuswhy']; ?>
</p>