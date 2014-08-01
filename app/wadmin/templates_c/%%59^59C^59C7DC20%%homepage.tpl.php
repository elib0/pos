<?php /* Smarty version 2.6.26, created on 2012-05-14 09:35:39
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/homepage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', '/home/websarro/public_html/wadmin/templates/boxslots/homepage.tpl', 69, false),array('modifier', 'truncate', '/home/websarro/public_html/wadmin/templates/boxslots/homepage.tpl', 69, false),)), $this); ?>
<div id="welcome"><p><?php echo $this->_tpl_vars['LANG']['headertext']; ?>
</p></div>
<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td><div align="center"><a href="clientarea.php"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/clientarea.png" border="0" alt="" /></a></div></td>
    <td width="50%"><strong><a href="clientarea.php"><?php echo $this->_tpl_vars['LANG']['clientareatitle']; ?>
</a></strong><br />
      <?php echo $this->_tpl_vars['LANG']['clientareadescription']; ?>
</td>
    <td><div align="center"><a href="announcements.php"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/announcements.png" border="0" alt="" /></a></div></td>
    <td><strong><a href="announcements.php"><?php echo $this->_tpl_vars['LANG']['announcementstitle']; ?>
</a></strong><br />
      <?php echo $this->_tpl_vars['LANG']['announcementsdescription']; ?>
</td>
  </tr>
  <tr>
    <td><div align="center"><a href="submitticket.php"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/submitticket.png" border="0" alt="" /></a></div></td>
    <td><strong><a href="submitticket.php"><?php echo $this->_tpl_vars['LANG']['supportticketssubmitticket']; ?>
</a></strong><br />
      <?php echo $this->_tpl_vars['LANG']['submitticketdescription']; ?>
</td>
    <td><div align="center"><a href="downloads.php"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/downloads.png" border="0" alt="" /></a></div></td>
    <td><strong><a href="downloads.php"><?php echo $this->_tpl_vars['LANG']['downloadstitle']; ?>
</a></strong><br />
      <?php echo $this->_tpl_vars['LANG']['downloadsdescription']; ?>
</td>
  </tr>
  <tr>
    <td><div align="center"><a href="supporttickets.php"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/supporttickets.png" border="0" alt="" /></a></div></td>
    <td><strong><a href="supporttickets.php"><?php echo $this->_tpl_vars['LANG']['supportticketspagetitle']; ?>
</a><br />
    </strong><?php echo $this->_tpl_vars['LANG']['supportticketsdescription']; ?>
</td>
    <td><div align="center"><a href="knowledgebase.php"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/knowledgebase.png" border="0" alt="" /></a></div></td>
    <td width="50%"><strong><a href="knowledgebase.php"><?php echo $this->_tpl_vars['LANG']['knowledgebasetitle']; ?>
</a></strong><br />
      <?php echo $this->_tpl_vars['LANG']['knowledgebasedescription']; ?>
</td>
  </tr>
  <tr>
    <td><div align="center"><a href="affiliates.php"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/affiliates.png" border="0" alt="" /></a></div></td>
    <td><strong><a href="affiliates.php"><?php echo $this->_tpl_vars['LANG']['affiliatestitle']; ?>
</a></strong><br />
      <?php echo $this->_tpl_vars['LANG']['affiliatesdescription']; ?>
</td>
    <td><div align="center"><a href="cart.php"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/cart.png" border="0" alt="" /></a></div></td>
    <td><strong><a href="cart.php"><?php echo $this->_tpl_vars['LANG']['ordertitle']; ?>
</a></strong><br />
      <?php echo $this->_tpl_vars['LANG']['orderdescription']; ?>
</td>
  </tr>
  <tr>
    <td><div align="center"><a href="contact.php"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/contact.png" border="0" alt="" /></a></div></td>
    <td><strong><a href="contact.php"><?php echo $this->_tpl_vars['LANG']['contacttitle']; ?>
</a></strong><br />
      <?php echo $this->_tpl_vars['LANG']['presalescontactdescription']; ?>
</td>
    <td><div align="center"><a href="domainchecker.php"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/domainchecker.png" border="0" alt="" /></a></div></td>
    <td><strong><a href="domainchecker.php"><?php echo $this->_tpl_vars['LANG']['domaintitle']; ?>
</a></strong><br />
      <?php echo $this->_tpl_vars['LANG']['domaincheckerdescription']; ?>
</td>
  </tr>
  <tr>
    <td><div align="center"><a href="serverstatus.php"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/serverstatus.png" border="0" alt="" /></a></div></td>
    <td><strong><a href="serverstatus.php"><?php echo $this->_tpl_vars['LANG']['serverstatustitle']; ?>
</a></strong><br />
      <?php echo $this->_tpl_vars['LANG']['serverstatusdescription']; ?>
</td>
    <td><div align="center"><a href="networkissues.php"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/networkissues.png" border="0" alt="" /></a></div></td>
    <td><strong><a href="networkissues.php"><?php echo $this->_tpl_vars['LANG']['networkissuestitle']; ?>
</a></strong><br />
      <?php echo $this->_tpl_vars['LANG']['networkissuesdescription']; ?>
</td>
  </tr>
</table>

<?php if ($this->_tpl_vars['twitterusername']): ?>
<h2><?php echo $this->_tpl_vars['LANG']['twitterlatesttweets']; ?>
</h2>
<div id="twitterfeed">
  <p><img src="images/loading.gif"></p>
</div>
<?php echo '<script language="javascript">
jQuery(document).ready(function(){
  jQuery.post("announcements.php", { action: "twitterfeed", numtweets: 3 },
    function(data){
      jQuery("#twitterfeed").html(data);
    });
});
</script>'; ?>

<?php elseif ($this->_tpl_vars['announcements']): ?>
<h2><?php echo $this->_tpl_vars['LANG']['latestannouncements']; ?>
</h2>
<?php $_from = $this->_tpl_vars['announcements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['announcement']):
?>
<p><?php echo $this->_tpl_vars['announcement']['date']; ?>
 - <a href="<?php if ($this->_tpl_vars['seofriendlyurls']): ?>announcements/<?php echo $this->_tpl_vars['announcement']['id']; ?>
/<?php echo $this->_tpl_vars['announcement']['urlfriendlytitle']; ?>
.html<?php else: ?>announcements.php?id=<?php echo $this->_tpl_vars['announcement']['id']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['announcement']['title']; ?>
</a><br /><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['announcement']['text'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 100, "...") : smarty_modifier_truncate($_tmp, 100, "...")); ?>
</p>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>