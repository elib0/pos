<?php /* Smarty version 2.6.26, created on 2012-05-15 00:00:03
         compiled from emailtpl:emailmessage */ ?>
<p>Estimado(a) <?php echo $this->_tpl_vars['client_name']; ?>
,</p>
<p><span id="result_box" class="short_text" lang="es"><span class="hps">Este es un</span> <span class="hps">aviso de cobro</span> <span class="hps">que</span> <span class="hps">la factura </span></span>no. <?php echo $this->_tpl_vars['invoice_num']; ?>
 <span id="result_box" class="short_text" lang="es"><span class="hps">que se generó</span> <span class="hps">en</span></span> <?php echo $this->_tpl_vars['invoice_date_created']; ?>
 <span id="result_box" class="short_text" lang="es"><span class="hps">y está atrasado.</span></span></p>
<p>Tu forma de pago es: <?php echo $this->_tpl_vars['invoice_payment_method']; ?>
</p>
<p>Factura: <?php echo $this->_tpl_vars['invoice_num']; ?>
<br /> Monto: <?php echo $this->_tpl_vars['invoice_balance']; ?>
<br /> Fecha: <?php echo $this->_tpl_vars['invoice_date_due']; ?>
</p>
<p><span id="result_box" lang="es"><span class="hps">Usted</span> <span class="hps">puede acceder a su</span> <span class="hps">área de cliente</span> <span class="hps">para ver y pagar</span> <span class="hps">la factura en </span></span><?php echo $this->_tpl_vars['invoice_link']; ?>
</p>
<p> </p>
<div id="gt-res-content" class="almost_half_cell">
<div dir="ltr"><span id="result_box" class="short_text" lang="es"><span class="hps">Sus</span> <span class="hps">datos de acceso</span> <span class="hps">son los siguientes:</span></span></div>
</div>
<p> </p>
<p>Email : <?php echo $this->_tpl_vars['client_email']; ?>
<br /> Contraseña: <?php echo $this->_tpl_vars['client_password']; ?>
</p>
<p><?php echo $this->_tpl_vars['signature']; ?>
</p>