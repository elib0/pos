<?php /* Smarty version 2.6.26, created on 2012-05-22 21:22:12
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/pwresetvalidation.tpl */ ?>
<?php if ($this->_tpl_vars['errormessage']): ?>

  <div class="errorbox">
    <?php echo $this->_tpl_vars['errormessage']; ?>

  </div>

<?php else: ?>

  <div class="successbox">
    <?php echo $this->_tpl_vars['LANG']['pwresetvalidationsuccess']; ?>

  </div>

  <p><?php echo $this->_tpl_vars['LANG']['pwresetvalidationsuccessdesc']; ?>
</p>

<?php endif; ?>