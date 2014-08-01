<?php /* Smarty version 2.6.26, created on 2012-05-15 18:44:04
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/pwreset.tpl */ ?>
<?php if ($this->_tpl_vars['success']): ?>

  <div class="successbox">
    <?php echo $this->_tpl_vars['LANG']['pwresetvalidationsent']; ?>

  </div>

  <p><?php echo $this->_tpl_vars['LANG']['pwresetvalidationcheckemail']; ?>


<?php else: ?>

<p><?php echo $this->_tpl_vars['LANG']['pwresetdesc']; ?>
</p>

<?php if ($this->_tpl_vars['errormessage']): ?>
<div class="errorbox"><?php echo $this->_tpl_vars['errormessage']; ?>
</div>
<?php endif; ?>

<form method="post" action="pwreset.php">
<input type="hidden" name="action" value="reset" />

  <p align="center"><?php echo $this->_tpl_vars['LANG']['loginemail']; ?>
:
    <input type="text" name="email" size="50" value="<?php echo $this->_tpl_vars['email']; ?>
">
  </p>

  <?php if ($this->_tpl_vars['securityquestion']): ?>
    <p><?php echo $this->_tpl_vars['LANG']['pwresetsecurityquestionrequired']; ?>
</p>
    <p align="center"><strong><?php echo $this->_tpl_vars['securityquestion']; ?>
</strong></p>
    <p align="center"><?php echo $this->_tpl_vars['LANG']['clientareasecurityanswer']; ?>
:
      <input type="text" name="answer" size="30" value="<?php echo $this->_tpl_vars['answer']; ?>
">
    </p>
  <?php endif; ?>

  <p align="center">
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['pwresetsubmit']; ?>
">
  </p>

</form>

<?php endif; ?>