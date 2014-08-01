<?php /* Smarty version 2.6.26, created on 2012-06-01 14:47:45
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/viewticket.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', '/home/websarro/public_html/wadmin/templates/boxslots/viewticket.tpl', 75, false),)), $this); ?>
<?php if ($this->_tpl_vars['error']): ?>
<p><?php echo $this->_tpl_vars['LANG']['supportticketinvalid']; ?>
</p>
<?php else: ?>

<?php echo '
<script language="javascript">
jQuery(document).ready(function(){
    jQuery("#addfileupload").click(function () {
        jQuery("#fileuploads").append("<input type=\\"file\\" name=\\"attachments[]\\" size=\\"50\\"><br />");
        return false;
    });
});
function rating_hover(id) {
  var selrating=id.split(\'_\');
  for(var i=1; i<=5; i++){
    if(i<=selrating[1]) document.getElementById(selrating[0]+\'_\'+i).style.background="url(images/rating_pos.png)";
    if(i>selrating[1]) document.getElementById(selrating[0]+\'_\'+i).style.background="url(images/rating_neg.png)";
  }
}
function rating_leave(id){
  for(var i=1; i<=5; i++){
    document.getElementById(id+\'_\'+i).style.background="url(images/rating_neg.png)";
  }
}
function rating_select(id){
  '; ?>
window.location='viewticket.php?tid=<?php echo $this->_tpl_vars['tid']; ?>
&c=<?php echo $this->_tpl_vars['c']; ?>
&rating='+id;<?php echo '
}
</script>
'; ?>


<h2><?php echo $this->_tpl_vars['LANG']['supportticketsviewticket']; ?>
 #<?php echo $this->_tpl_vars['tid']; ?>
</h2>

<?php if ($this->_tpl_vars['errormessage']): ?>
<div class="errorbox"><?php echo $this->_tpl_vars['errormessage']; ?>
</div>
<br />
<?php endif; ?>

<table width="100%" border="0" cellpadding="10" cellspacing="0" class="data">
        <tr>
          <th><?php echo $this->_tpl_vars['LANG']['supportticketsdepartment']; ?>
</th>
          <th><?php echo $this->_tpl_vars['LANG']['supportticketsdate']; ?>
</th>
          <th><?php echo $this->_tpl_vars['LANG']['supportticketssubject']; ?>
</th>
          <th><?php echo $this->_tpl_vars['LANG']['supportticketsstatus']; ?>
</th>
          <th><?php echo $this->_tpl_vars['LANG']['supportticketsticketurgency']; ?>
</th>
        </tr>
        <tr>
          <td><?php echo $this->_tpl_vars['department']; ?>
</td>
          <td><?php echo $this->_tpl_vars['date']; ?>
</td>
          <td><?php echo $this->_tpl_vars['subject']; ?>
</td>
          <td><?php echo $this->_tpl_vars['status']; ?>
</td>
          <td><?php echo $this->_tpl_vars['urgency']; ?>
</td>
        </tr>
</table>
<br />

<?php if ($this->_tpl_vars['customfields']): ?>
<table width="100%" cellspacing="0" cellpadding="0" class="frame">
  <tr>
    <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
        <?php $_from = $this->_tpl_vars['customfields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['customfield']):
?>
        <tr>
          <td width="150" class="fieldarea"><?php echo $this->_tpl_vars['customfield']['name']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['customfield']['value']; ?>
&nbsp;</td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
    </table></td>
  </tr>
</table>
<br />
<?php endif; ?>

<div class="clientticketreplyheader">
  <table width="100%" border="0" cellpadding="10" cellspacing="0">
    <tr>
      <td><?php echo ((is_array($_tmp=$this->_tpl_vars['user'])) ? $this->_run_mod_handler('replace', true, $_tmp, "<br />
      ", " || ") : smarty_modifier_replace($_tmp, "<br />
      ", " || ")); ?>
</td>
      <td align="right"><?php echo $this->_tpl_vars['date']; ?>
</td>
    </tr>
  </table>
</div>
<div class="clientticketreply"><?php echo $this->_tpl_vars['message']; ?>
<?php if ($this->_tpl_vars['attachments']): ?><br />
  <br />
  <b><?php echo $this->_tpl_vars['LANG']['supportticketsticketattachments']; ?>
</b><br />
  <?php $_from = $this->_tpl_vars['attachments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['attachment']):
?> <img src="images/article.gif" class="absmiddle" border="0" alt="<?php echo $this->_tpl_vars['attachment']; ?>
" /> <a href="dl.php?type=a&id=<?php echo $this->_tpl_vars['id']; ?>
&i=<?php echo $this->_tpl_vars['num']; ?>
"><?php echo $this->_tpl_vars['attachment']; ?>
</a><br />
  <?php endforeach; endif; unset($_from); ?><?php endif; ?></div>
<?php $_from = $this->_tpl_vars['replies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['reply']):
?>
<div class="<?php if ($this->_tpl_vars['reply']['admin']): ?>admin<?php else: ?>client<?php endif; ?>ticketreplyheader">
  <table width="100%" border="0" cellpadding="10" cellspacing="0">
    <tr>
      <td><?php echo ((is_array($_tmp=$this->_tpl_vars['reply']['user'])) ? $this->_run_mod_handler('replace', true, $_tmp, "<br />
      ", " || ") : smarty_modifier_replace($_tmp, "<br />
      ", " || ")); ?>
</td>
      <td align="right"><?php echo $this->_tpl_vars['reply']['date']; ?>
</td>
    </tr>
  </table>
</div>
<div class="<?php if ($this->_tpl_vars['reply']['admin']): ?>admin<?php else: ?>client<?php endif; ?>ticketreply"><?php echo $this->_tpl_vars['reply']['message']; ?>
<?php if ($this->_tpl_vars['reply']['attachments']): ?><br />
  <br />
  <b><?php echo $this->_tpl_vars['LANG']['supportticketsticketattachments']; ?>
</b><br />
  <?php $_from = $this->_tpl_vars['reply']['attachments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['attachment']):
?> <img src="images/article.gif" class="absmiddle" border="0" alt="<?php echo $this->_tpl_vars['attachment']; ?>
" /> <a href="dl.php?type=ar&id=<?php echo $this->_tpl_vars['reply']['id']; ?>
&i=<?php echo $this->_tpl_vars['num']; ?>
"><?php echo $this->_tpl_vars['attachment']; ?>
</a><br />
  <?php endforeach; endif; unset($_from); ?><?php endif; ?>
  <?php if ($this->_tpl_vars['reply']['admin'] && $this->_tpl_vars['ratingenabled']): ?><?php if ($this->_tpl_vars['reply']['rating']): ?>
  <table align="right" cellspacing="0" cellpadding="0">
    <tr height="16">
      <td><?php echo $this->_tpl_vars['LANG']['ticketreatinggiven']; ?>
&nbsp</td>
      <td width="16" background="images/rating_<?php if ($this->_tpl_vars['reply']['rating'] >= 1): ?>pos<?php else: ?>neg<?php endif; ?>.png"></td>
      <td width="16" background="images/rating_<?php if ($this->_tpl_vars['reply']['rating'] >= 2): ?>pos<?php else: ?>neg<?php endif; ?>.png"></td>
      <td width="16" background="images/rating_<?php if ($this->_tpl_vars['reply']['rating'] >= 3): ?>pos<?php else: ?>neg<?php endif; ?>.png"></td>
      <td width="16" background="images/rating_<?php if ($this->_tpl_vars['reply']['rating'] >= 4): ?>pos<?php else: ?>neg<?php endif; ?>.png"></td>
      <td width="16" background="images/rating_<?php if ($this->_tpl_vars['reply']['rating'] >= 5): ?>pos<?php else: ?>neg<?php endif; ?>.png"></td>
    </tr>
  </table>
  <?php else: ?>
  <table align="right" cellspacing="0" cellpadding="0">
    <tr height="16" onmouseout="rating_leave('rate<?php echo $this->_tpl_vars['reply']['id']; ?>
')" style="cursor: pointer; cursor: hand;">
      <td><?php echo $this->_tpl_vars['LANG']['ticketratingquestion']; ?>
&nbsp</td>
      <td onmouseover="rating_hover('rate<?php echo $this->_tpl_vars['reply']['id']; ?>
_1')" onclick="rating_select('rate<?php echo $this->_tpl_vars['reply']['id']; ?>
_1')"><b><?php echo $this->_tpl_vars['LANG']['ticketratingpoor']; ?>
&nbsp;</td>
      <td width="16" id="rate<?php echo $this->_tpl_vars['reply']['id']; ?>
_1" onmouseover="rating_hover(this.id)" onclick="rating_select(this.id)" background="images/rating_neg.png"></td>
      <td width="16" id="rate<?php echo $this->_tpl_vars['reply']['id']; ?>
_2" onmouseover="rating_hover(this.id)" onclick="rating_select(this.id)" background="images/rating_neg.png"></td>
      <td width="16" id="rate<?php echo $this->_tpl_vars['reply']['id']; ?>
_3" onmouseover="rating_hover(this.id)" onclick="rating_select(this.id)" background="images/rating_neg.png"></td>
      <td width="16" id="rate<?php echo $this->_tpl_vars['reply']['id']; ?>
_4" onmouseover="rating_hover(this.id)" onclick="rating_select(this.id)" background="images/rating_neg.png"></td>
      <td width="16" id="rate<?php echo $this->_tpl_vars['reply']['id']; ?>
_5" onmouseover="rating_hover(this.id)" onclick="rating_select(this.id)" background="images/rating_neg.png"></td>
      <td onmouseover="rating_hover('rate<?php echo $this->_tpl_vars['reply']['id']; ?>
_5')" onclick="rating_select('rate<?php echo $this->_tpl_vars['reply']['id']; ?>
_5')"><b>&nbsp;<?php echo $this->_tpl_vars['LANG']['ticketratingexcellent']; ?>
</td>
    </tr>
  </table>
  <?php endif; ?><br />
  <br />
  <br />
  <?php endif; ?></div>
  <br />
<?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['showclosebutton']): ?>
<p align="center">
  <input type="button" value="<?php echo $this->_tpl_vars['LANG']['supportticketsstatuscloseticket']; ?>
" onclick="window.location='<?php echo $_SERVER['PHP_SELF']; ?>
?tid=<?php echo $this->_tpl_vars['tid']; ?>
&amp;c=<?php echo $this->_tpl_vars['c']; ?>
&amp;closeticket=true'" />
</p>
<?php endif; ?>
<h3><?php echo $this->_tpl_vars['LANG']['supportticketsreply']; ?>
</h3>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?tid=<?php echo $this->_tpl_vars['tid']; ?>
&amp;c=<?php echo $this->_tpl_vars['c']; ?>
&amp;postreply=true" enctype="multipart/form-data">
  <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="120" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['supportticketsclientname']; ?>
</td>
            <td><?php if ($this->_tpl_vars['loggedin']): ?><?php echo $this->_tpl_vars['clientname']; ?>
<?php else: ?>
              <input type="text" name="replyname" size=30 value="<?php echo $this->_tpl_vars['replyname']; ?>
" />
              <?php endif; ?></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['supportticketsclientemail']; ?>
</td>
            <td><?php if ($this->_tpl_vars['loggedin']): ?><?php echo $this->_tpl_vars['email']; ?>
<?php else: ?>
              <input type="text" name="replyemail" size=50 value="<?php echo $this->_tpl_vars['replyemail']; ?>
" />
              <?php endif; ?></td>
          </tr>
          <tr>
            <td colspan="2" class="fieldarea"><textarea name="replymessage" rows="12" cols="60" style="width:100%"><?php echo $this->_tpl_vars['replymessage']; ?>
</textarea></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['supportticketsticketattachments']; ?>
</td>
            <td><input type="file" name="attachments[]" size="50" />
              <a href="#" id="addfileupload"><img src="images/add.gif" class="absmiddle" alt="" border="0" /> <?php echo $this->_tpl_vars['LANG']['addmore']; ?>
</a><br />
              <div id="fileuploads"></div>
              (<?php echo $this->_tpl_vars['LANG']['supportticketsallowedextensions']; ?>
: <?php echo $this->_tpl_vars['allowedfiletypes']; ?>
)</td>
          </tr>
      </table></td>
    </tr>
  </table>
  <p align="center">
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['supportticketsticketsubmit']; ?>
" class="button" />
  </p>
</form>
<?php endif; ?><br />