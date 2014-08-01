<?php /* Smarty version 2.6.26, created on 2012-05-14 23:33:44
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/supportticketsubmit-steptwo.tpl */ ?>
<script language="JavaScript" type="text/javascript">
<?php echo '
var currentcheckcontent,lastcheckcontent;
jQuery(document).ready(function(){
    jQuery("#addfileupload").click(function () {
        jQuery("#fileuploads").append("<input type=\\"file\\" name=\\"attachments[]\\" size=\\"50\\"><br />");
        return false;
    });
});
'; ?>

<?php if ($this->_tpl_vars['kbsuggestions']): ?>
<?php echo '
function getticketsuggestions() {
    currentcheckcontent = jQuery("#message").val();
    if (currentcheckcontent!=lastcheckcontent && currentcheckcontent!="") {
        $.post("submitticket.php", { action: "getkbarticles", text: currentcheckcontent },
        function(data){
            if (data) {
                jQuery("#searchresults").html(data);
                jQuery("#searchresults").slideDown();
            }
        });
        lastcheckcontent = currentcheckcontent;
	}
    setTimeout(\'getticketsuggestions();\', 3000);
}
getticketsuggestions();
'; ?>

<?php endif; ?>
</script>
<?php if ($this->_tpl_vars['errormessage']): ?>
<div class="errorbox"><?php echo $this->_tpl_vars['errormessage']; ?>
</div>
<br />
<?php endif; ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>
?step=3" method="post" enctype="multipart/form-data" name="submitticket" id="submitticket">
  <input type="hidden" name="deptid" value="<?php echo $this->_tpl_vars['deptid']; ?>
" />
  <table width="100%" cellspacing="1" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="120" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['supportticketsclientname']; ?>
</td>
            <td><?php if ($this->_tpl_vars['loggedin']): ?><?php echo $this->_tpl_vars['clientname']; ?>
<?php else: ?>
              <input type="text" name="name" size="30" value="<?php echo $this->_tpl_vars['name']; ?>
" />
              <?php endif; ?></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['supportticketsclientemail']; ?>
</td>
            <td><?php if ($this->_tpl_vars['loggedin']): ?><?php echo $this->_tpl_vars['email']; ?>
<?php else: ?>
              <input type="text" name="email" size="50" value="<?php echo $this->_tpl_vars['email']; ?>
" />
              <?php endif; ?></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['supportticketsdepartment']; ?>
</td>
            <td><?php echo $this->_tpl_vars['department']; ?>
</td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['supportticketsticketsubject']; ?>
</td>
            <td><input type="text" name="subject" size="60" value="<?php echo $this->_tpl_vars['subject']; ?>
" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['supportticketsticketurgency']; ?>
</td>
            <td><select name="urgency">
                <option value="High"><?php echo $this->_tpl_vars['LANG']['supportticketsticketurgencyhigh']; ?>
</option>
                <option value="Medium" selected="selected"><?php echo $this->_tpl_vars['LANG']['supportticketsticketurgencymedium']; ?>
</option>
                <option value="Low"><?php echo $this->_tpl_vars['LANG']['supportticketsticketurgencylow']; ?>
</option>
              </select></td>
          </tr>
          <?php if ($this->_tpl_vars['relatedservices']): ?>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['relatedservice']; ?>
</td>
            <td><select name="relatedservice">
                <option value=""><?php echo $this->_tpl_vars['LANG']['none']; ?>
</option>
                
<?php $_from = $this->_tpl_vars['relatedservices']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['relatedservice']):
?>

                <option value="<?php echo $this->_tpl_vars['relatedservice']['id']; ?>
"><?php echo $this->_tpl_vars['relatedservice']['name']; ?>
 (<?php echo $this->_tpl_vars['relatedservice']['status']; ?>
)</option>
                
<?php endforeach; endif; unset($_from); ?>

              </select></td>
          </tr>
          <?php endif; ?>
          <tr>
            <td colspan="2" class="fieldarea"><textarea name="message" id="message" rows="12" cols="60" style="width:100%"><?php echo $this->_tpl_vars['message']; ?>
</textarea></td>
          </tr>
          <?php $_from = $this->_tpl_vars['customfields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['customfield']):
?>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['customfield']['name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['customfield']['input']; ?>
 <?php echo $this->_tpl_vars['customfield']['description']; ?>
</td>
          </tr>
          <?php endforeach; endif; unset($_from); ?>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['supportticketsticketattachments']; ?>
</td>
            <td><input type="file" name="attachments[]" size="50" />
              <a href="#" id="addfileupload"><img src="images/add.gif" class="absmiddle" border="0" alt="" /> <?php echo $this->_tpl_vars['LANG']['addmore']; ?>
</a><br />
              <div id="fileuploads"></div>
              (<?php echo $this->_tpl_vars['LANG']['supportticketsallowedextensions']; ?>
: <?php echo $this->_tpl_vars['allowedfiletypes']; ?>
)</td>
          </tr>
      </table></td>
    </tr>
  </table>
  <br />
  <div id="searchresults" class="contentbox" style="display:none;"></div>
  <?php if ($this->_tpl_vars['capatacha']): ?>
  <p align="center"><?php echo $this->_tpl_vars['LANG']['imagecheck']; ?>
<br />
    <img src="includes/verifyimage.php" border="0" class="absmiddle" alt="Verify Image" />
     <input type="text" name="code" size="10" maxlength="5" />
  </p>
  <?php endif; ?>
  <p align="center">
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['supportticketsticketsubmit']; ?>
" />
  </p>
</form><br />