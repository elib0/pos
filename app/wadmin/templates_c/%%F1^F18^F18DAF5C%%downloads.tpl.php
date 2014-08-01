<?php /* Smarty version 2.6.26, created on 2012-05-16 20:42:22
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/downloads.tpl */ ?>
<p><?php echo $this->_tpl_vars['LANG']['downloadsintrotext']; ?>
</p>
<h2><?php echo $this->_tpl_vars['LANG']['downloadscategories']; ?>
</h2>
<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr> <?php $_from = $this->_tpl_vars['dlcats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['dlcat']):
?>
    <td width="33%" align="left" valign="top"><strong><img src="images/folder.gif" border="0" class="absmiddle" alt="folder" />&nbsp;<a href="<?php if ($this->_tpl_vars['seofriendlyurls']): ?>downloads/<?php echo $this->_tpl_vars['dlcat']['id']; ?>
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
<br />
<table width="100%" border="0" cellpadding="0" cellspacing="10">
  <tr>
    <td width="50%" align="left" valign="top"><h3><?php echo $this->_tpl_vars['LANG']['knowledgebasepopular']; ?>
 <?php echo $this->_tpl_vars['LANG']['downloadstitle']; ?>
</h3>
      <table width="100%" border="0" cellpadding="10" cellspacing="0">
        <?php $_from = $this->_tpl_vars['mostdownloads']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['download']):
?>
        <tr>
          <td><p><?php echo $this->_tpl_vars['download']['type']; ?>
 <a href="<?php echo $this->_tpl_vars['download']['link']; ?>
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
      </table></td>
    <td width="50%" align="left" valign="top"><form method="post" action="downloads.php?action=search">
        <h3><?php echo $this->_tpl_vars['LANG']['knowledgebasesearch']; ?>
</h3>
        <p align="center">
          <input type="text" name="search" size="25" /> 
          <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['knowledgebasesearch']; ?>
" />
        </p>
      </form></td>
  </tr>
</table><br />