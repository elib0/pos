<?php /* Smarty version 2.6.26, created on 2012-05-20 05:54:05
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/downloadscat.tpl */ ?>
<p><?php echo $this->_tpl_vars['LANG']['downloadsintrotext']; ?>
</p>
<?php if ($this->_tpl_vars['dlcats']): ?>
<h2><?php echo $this->_tpl_vars['LANG']['downloadscategories']; ?>
</h2>
<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr> <?php $_from = $this->_tpl_vars['dlcats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['dlcat']):
?>
    <td width="33%" align="left" valign="top"><img src="images/folder.gif" border="0" class="absmiddle" alt="folder" />&nbsp;<strong><a href="<?php if ($this->_tpl_vars['seofriendlyurls']): ?>downloads/<?php echo $this->_tpl_vars['dlcat']['id']; ?>
/<?php echo $this->_tpl_vars['dlcat']['urlfriendlyname']; ?>
<?php else: ?>downloads.php?action=displaycat&amp;catid=<?php echo $this->_tpl_vars['dlcat']['id']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['dlcat']['name']; ?>
</a></strong> (<?php echo $this->_tpl_vars['dlcat']['numarticles']; ?>
)<br />
      <?php echo $this->_tpl_vars['dlcat']['description']; ?>
 </td>
    <?php if (!($this->_tpl_vars['num'] % 3)): ?> </tr>
  <tr> <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?> </tr>
</table>
<?php endif; ?>

<?php if ($this->_tpl_vars['downloads']): ?>
<h2><?php echo $this->_tpl_vars['LANG']['downloadsfiles']; ?>
</h2>
<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <?php $_from = $this->_tpl_vars['downloads']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['download']):
?>
  <tr>
    <td><p><?php echo $this->_tpl_vars['download']['type']; ?>
 <a href="<?php echo $this->_tpl_vars['download']['link']; ?>
" title="<?php echo $this->_tpl_vars['download']['title']; ?>
"><strong><?php echo $this->_tpl_vars['download']['title']; ?>
</strong></a><br />
        <?php if ($this->_tpl_vars['download']['clientsonly']): ?><em>Login Required</em><br />
        <?php endif; ?><?php echo $this->_tpl_vars['download']['description']; ?>
<br />
        <span style="color:#A8A8A8;font-size:11px;"><?php echo $this->_tpl_vars['LANG']['downloadsfilesize']; ?>
: <?php echo $this->_tpl_vars['download']['filesize']; ?>
</span><br />
        <br />
    </p></td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
</table>
<?php else: ?>
<p align="center"><strong><?php echo $this->_tpl_vars['LANG']['downloadsnone']; ?>
</strong></p>
<?php endif; ?><br />