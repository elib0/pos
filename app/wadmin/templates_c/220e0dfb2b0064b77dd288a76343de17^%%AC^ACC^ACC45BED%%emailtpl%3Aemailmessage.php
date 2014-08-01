<?php /* Smarty version 2.6.26, created on 2012-06-04 00:00:03
         compiled from emailtpl:emailmessage */ ?>
<p>Estimado(a) <?php echo $this->_tpl_vars['client_name']; ?>
,</p>
<p><span id="result_box" class="short_text" lang="es"><span class="hps">Este es el</span> <span class="hps">segundo</span> <span class="hps">aviso de cobro</span> <span class="hps">que</span> <span class="hps">la factura </span></span>no. <?php echo $this->_tpl_vars['invoice_num']; ?>
 la cual fue generada el <?php echo $this->_tpl_vars['invoice_date_created']; ?>
 y esta retrasada.</p>
<p>Su metodo de pago es: <?php echo $this->_tpl_vars['invoice_payment_method']; ?>
</p>
<p>Factura: <?php echo $this->_tpl_vars['invoice_num']; ?>
<br /> Monto pendiente: <?php echo $this->_tpl_vars['invoice_balance']; ?>
<br /> de Fecha: <?php echo $this->_tpl_vars['invoice_date_due']; ?>
</p>
<p><span id="result_box" lang="es"><span class="hps">Usted</span> <span class="hps">puede acceder a su</span> <span class="hps">área de cliente</span> <span class="hps">para ver y pagar</span> <span class="hps">la factura en</span></span> <?php echo $this->_tpl_vars['invoice_link']; ?>
</p>
<p>Sus datos de acceso son:</p>
<p>Email : <?php echo $this->_tpl_vars['client_email']; ?>
<br /> Contraseña : <?php echo $this->_tpl_vars['client_password']; ?>
</p>
<p><?php echo $this->_tpl_vars['signature']; ?>
</p>