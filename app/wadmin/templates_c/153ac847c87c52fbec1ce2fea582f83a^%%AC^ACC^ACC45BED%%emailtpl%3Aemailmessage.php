<?php /* Smarty version 2.6.26, created on 2012-08-30 09:41:18
         compiled from emailtpl:emailmessage */ ?>
<p>A new support ticket response has been made.</p>
<p>Client: <?php echo $this->_tpl_vars['client_name']; ?>
<?php if ($this->_tpl_vars['client_id']): ?> #<?php echo $this->_tpl_vars['client_id']; ?>
<?php endif; ?> <br />Department: <?php echo $this->_tpl_vars['ticket_department']; ?>
 <br />Subject: <?php echo $this->_tpl_vars['ticket_subject']; ?>
 <br />Priority: <?php echo $this->_tpl_vars['ticket_priority']; ?>
</p>
<p>--- <br /><?php echo $this->_tpl_vars['ticket_message']; ?>
 <br />---</p>
<p>You can respond to this ticket by simply replying to this email or through the admin area at the url below.</p>
<p><a href="<?php echo $this->_tpl_vars['whmcs_admin_url']; ?>
supporttickets.php?action=viewticket&id=<?php echo $this->_tpl_vars['ticket_id']; ?>
"><?php echo $this->_tpl_vars['whmcs_admin_url']; ?>
supporttickets.php?action=viewticket&id=<?php echo $this->_tpl_vars['ticket_id']; ?>
</a></p>