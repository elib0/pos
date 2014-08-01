<?php /* Smarty version 2.6.26, created on 2012-08-07 00:30:06
         compiled from emailtpl:emailmessage */ ?>
<p>Estimado(a) <?php echo $this->_tpl_vars['client_name']; ?>
,</p>
<p><span id="result_box" lang="es"><span class="hps">Esta es</span> <span class="hps">una notificación de que</span> <span class="hps">su servicio</span> <span class="hps">ha sido suspendido</span><span>.</span> <span class="hps">Los detalles de esta</span> <span class="hps">suspensión</span> <span class="hps">son</span> <span class="hps">a continuación:</span></span></p>
<p>Producto/Servicio: <?php echo $this->_tpl_vars['service_product_name']; ?>
<br /><?php if ($this->_tpl_vars['service_domain']): ?>Dominio: <?php echo $this->_tpl_vars['service_domain']; ?>
<br /><?php endif; ?>Monto Deuda: <?php echo $this->_tpl_vars['service_recurring_amount']; ?>
<br />Proxima fecha de pago: <?php echo $this->_tpl_vars['service_next_due_date']; ?>
<br />Motivo de la Suspensión: <strong><?php echo $this->_tpl_vars['service_suspension_reason']; ?>
</strong></p>
<p><span id="result_box" lang="es"><span class="hps">Por favor,</span> <span class="hps">póngase en contacto con</span> <span class="hps">nosotros tan pronto</span> <span class="hps">como sea posible</span> <span class="hps">para poder </span></span><span id="result_box" lang="es"><span class="hps">reactivar el </span></span><span id="result_box" lang="es"><span class="hps">servicio</span><span class="hps">.</span></span></p>
<p><?php echo $this->_tpl_vars['signature']; ?>
</p>