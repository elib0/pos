<?php /* Smarty version 2.6.26, created on 2012-06-04 09:04:31
         compiled from emailtpl:emailmessage */ ?>
<p>Estimado <?php echo $this->_tpl_vars['client_name']; ?>
,</p>
<p><span id="result_box" lang="es"><span class="hps">Este mensaje es</span> <span class="hps">para confirmar</span> <span class="hps">que su compra</span> <span class="hps">de dominio ha</span> <span class="hps">sido un éxito.</span> <span class="hps">Los detalles de</span> <span class="hps">la compra</span> <span class="hps">de dominio</span> <span class="hps">están a continuación:</span></span></p>
<p>Fecha de registro: <?php echo $this->_tpl_vars['domain_reg_date']; ?>
<br /> Dominio: <?php echo $this->_tpl_vars['domain_name']; ?>
<br /> Periodo de registro: <?php echo $this->_tpl_vars['domain_reg_period']; ?>
<br /> Monto: <?php echo $this->_tpl_vars['domain_first_payment_amount']; ?>
<br /> Proxima fecha de pago: <?php echo $this->_tpl_vars['domain_next_due_date']; ?>
</p>
<p><span id="result_box" lang="es"><span class="hps">Usted puede</span> <span class="hps">acceder a su</span> <span class="hps">área de cliente</span> <span class="hps atn">en </span></span> <?php echo $this->_tpl_vars['whmcs_url']; ?>
<span id="result_box" lang="es"> <span class="hps">para administrar su</span> <span class="hps">nuevo dominio.</span></span></p>
<p><?php echo $this->_tpl_vars['signature']; ?>
</p>