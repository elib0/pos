<?php /* Smarty version 2.6.26, created on 2012-05-14 11:52:22
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/knowledgebasearticle.tpl */ ?>
<script language="javascript">
function addBookmark() {
    if (window.sidebar) {
        window.sidebar.addPanel('<?php echo $this->_tpl_vars['kbarticle']['title']; ?>
', location.href,"");
    } else if( document.all ) {
        window.external.AddFavorite( location.href, '<?php echo $this->_tpl_vars['kbarticle']['title']; ?>
');
    } else if( window.opera && window.print ) {
        return true;
    }
}
</script>

<h2><?php echo $this->_tpl_vars['kbarticle']['title']; ?>
</h2>

<table width="100%" border="0" cellpadding="0" cellspacing="10">
  <tr>
    <td width="80%" align="left" valign="top"> <?php echo $this->_tpl_vars['kbarticle']['text']; ?>
 <br />
      <br />
      <form method="post" action="knowledgebase.php?action=displayarticle&amp;id=<?php echo $this->_tpl_vars['kbarticle']['id']; ?>
&amp;useful=vote">
        <p> <?php if ($this->_tpl_vars['kbarticle']['voted']): ?> <strong><?php echo $this->_tpl_vars['LANG']['knowledgebaserating']; ?>
</strong> <?php echo $this->_tpl_vars['kbarticle']['useful']; ?>
 <?php echo $this->_tpl_vars['LANG']['knowledgebaseratingtext']; ?>
 (<?php echo $this->_tpl_vars['kbarticle']['votes']; ?>
 <?php echo $this->_tpl_vars['LANG']['knowledgebasevotes']; ?>
)
          <?php else: ?> <strong><?php echo $this->_tpl_vars['LANG']['knowledgebasehelpful']; ?>
</strong>
          <select name="vote">
            <option value="yes"><?php echo $this->_tpl_vars['LANG']['knowledgebaseyes']; ?>
</option>
            <option value="no"><?php echo $this->_tpl_vars['LANG']['knowledgebaseno']; ?>
</option>
          </select>
          <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['knowledgebasevote']; ?>
" />
          <?php endif; ?> </p>
      </form></td>
    <td width="20%" align="center" valign="top"><p align="center"><img src="images/addtofavouritesicon.gif" class="absmiddle" border="0" alt="<?php echo $this->_tpl_vars['LANG']['knowledgebasefavorites']; ?>
" /> <a href="#" onclick="addBookmark();return false"><?php echo $this->_tpl_vars['LANG']['knowledgebasefavorites']; ?>
</a><br /><br />
        <img src="images/print.gif" class="absmiddle" border="0" alt="<?php echo $this->_tpl_vars['LANG']['knowledgebaseprint']; ?>
" /> <a href="#" onclick="window.print();return false"><?php echo $this->_tpl_vars['LANG']['knowledgebaseprint']; ?>
</a></p></td>
  </tr>
</table>
<?php if ($this->_tpl_vars['kbarticles']): ?>
  <div class="kbalsoread"><?php echo $this->_tpl_vars['LANG']['knowledgebasealsoread']; ?>
</div>
  <?php $_from = $this->_tpl_vars['kbarticles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['kbarticle']):
?>
    <div class="kbarticle">
      <img src="images/article.gif" align="middle" alt="" /> <strong><a href="<?php if ($this->_tpl_vars['seofriendlyurls']): ?>knowledgebase/<?php echo $this->_tpl_vars['kbarticle']['id']; ?>
/<?php echo $this->_tpl_vars['kbarticle']['urlfriendlytitle']; ?>
.html<?php else: ?>knowledgebase.php?action=displayarticle&amp;id=<?php echo $this->_tpl_vars['kbarticle']['id']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['kbarticle']['title']; ?>
</a></strong> <span class="kbviews">(<?php echo $this->_tpl_vars['LANG']['knowledgebaseviews']; ?>
: <?php echo $this->_tpl_vars['kbarticle']['views']; ?>
)</span>
    </div>
  <?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<br />