<?php /* Smarty version 2.6.26, created on 2012-06-19 14:00:49
         compiled from emailtpl:emailmessage */ ?>
<p>
<?php echo $this->_tpl_vars['ticket_message']; ?>

</p>
<p>
----------------------------------------------<br />
Ticket ID: #<?php echo $this->_tpl_vars['ticket_id']; ?>
<br />
Subject: <?php echo $this->_tpl_vars['ticket_subject']; ?>
<br />
Status: <?php echo $this->_tpl_vars['ticket_status']; ?>
<br />
Ticket URL: <?php echo $this->_tpl_vars['ticket_link']; ?>
<br />
----------------------------------------------
</p>