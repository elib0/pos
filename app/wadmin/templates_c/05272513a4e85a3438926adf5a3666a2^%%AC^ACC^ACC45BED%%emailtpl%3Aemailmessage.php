<?php /* Smarty version 2.6.26, created on 2012-05-14 15:19:34
         compiled from emailtpl:emailmessage */ ?>
<p>Estimado(a) <?php echo $this->_tpl_vars['client_name']; ?>
,</p>
<p>Esta es la confirmación de pago de la factura no. <?php echo $this->_tpl_vars['invoice_num']; ?>
 creada el <?php echo $this->_tpl_vars['invoice_date_created']; ?>
</p>
<p><?php echo $this->_tpl_vars['invoice_html_contents']; ?>
</p>
<p>Monto: <?php echo $this->_tpl_vars['invoice_last_payment_amount']; ?>
<br />Transacción #: <?php echo $this->_tpl_vars['invoice_last_payment_transid']; ?>
<br />Total Pagado: <?php echo $this->_tpl_vars['invoice_amount_paid']; ?>
<br />Monto restante: <?php echo $this->_tpl_vars['invoice_balance']; ?>
<br />Status: <?php echo $this->_tpl_vars['invoice_status']; ?>
</p>
<p><span id="result_box" lang="es"><span class="hps">Usted puede revisar</span> <span class="hps">su historial de</span> <span class="hps">facturación</span> <span class="hps">en cualquier momento</span> <span class="hps">iniciando sesión en su</span> <span class="hps">área de cliente.</span><br /><br /> <span class="hps">Nota:</span> <span class="hps">Este correo electrónico</span> <span class="hps">servirá como</span> <span class="hps">un recibo oficial</span> <span class="hps">para este pago para nuestro sistema.</span></span></p>
<p><?php echo $this->_tpl_vars['signature']; ?>
</p>