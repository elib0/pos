<?php /* Smarty version 2.6.26, created on 2012-07-23 00:30:02
         compiled from emailtpl:emailmessage */ ?>
<p>EStimado(a) <?php echo $this->_tpl_vars['client_name']; ?>
,</p>
<p><span id="result_box" class="short_text" lang="es"><span class="hps">Este es un</span> <span class="hps">recordatorio de que</span> <span class="hps">su </span><span class="hps">factura </span></span><span id="result_box" class="short_text" lang="es"><span class="hps">no</span> </span><span id="result_box" class="short_text" lang="es"><span class="hps">.</span></span> <?php echo $this->_tpl_vars['invoice_num']; ?>
 generada el <?php echo $this->_tpl_vars['invoice_date_created']; ?>
 <span id="result_box" class="short_text" lang="es"><span class="hps">se debe</span> <span class="hps">desde</span></span> <?php echo $this->_tpl_vars['invoice_date_due']; ?>
.</p>
<p>Su forma de pago es: <?php echo $this->_tpl_vars['invoice_payment_method']; ?>
</p>
<p>Factura: <?php echo $this->_tpl_vars['invoice_num']; ?>
<br /> Monto: <?php echo $this->_tpl_vars['invoice_balance']; ?>
<br /> Fecha de vencimiento: <?php echo $this->_tpl_vars['invoice_date_due']; ?>
</p>
<p><span id="result_box" lang="es"><span class="hps">Usted</span> <span class="hps">puede acceder a su</span> <span class="hps">área de cliente</span> <span class="hps">para ver y pagar</span> <span class="hps">la factura en</span></span> <?php echo $this->_tpl_vars['invoice_link']; ?>
</p>
<p><?php echo $this->_tpl_vars['signature']; ?>
</p>