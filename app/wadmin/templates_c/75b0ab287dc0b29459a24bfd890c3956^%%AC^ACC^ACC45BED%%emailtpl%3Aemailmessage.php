<?php /* Smarty version 2.6.26, created on 2012-06-01 14:15:50
         compiled from emailtpl:emailmessage */ ?>
<p>Estimado(a) <?php echo $this->_tpl_vars['client_name']; ?>
,</p>
<p><span id="result_box" lang="es"><span class="hps">Esto es</span> <span class="hps">un aviso de que</span> <span class="hps">una factura</span> <span class="hps">se ha generado</span> <span class="hps">en </span></span> <?php echo $this->_tpl_vars['invoice_date_created']; ?>
.</p>
<p>Su tipo de pago es: <?php echo $this->_tpl_vars['invoice_payment_method']; ?>
</p>
<p>Factura #<?php echo $this->_tpl_vars['invoice_num']; ?>
<br /> Monto: <?php echo $this->_tpl_vars['invoice_total']; ?>
<br /> Fecha: <?php echo $this->_tpl_vars['invoice_date_due']; ?>
</p>
<p>Factura Online: <?php echo $this->_tpl_vars['invoice_link']; ?>
</p>
<p> </p>
<div id="gt-res-content" class="almost_half_cell">
<div style="zoom:1" dir="ltr"><strong><span id="result_box" class="short_text" lang="es"><span class="hps">Artículos de la factura</span></span></strong></div>
</div>
<p> </p>
<p><?php echo $this->_tpl_vars['invoice_html_contents']; ?>
 <br /> ------------------------------------------------------</p>
<p><span id="result_box" lang="es"><span class="hps">Usted</span> <span class="hps">puede acceder a su</span> <span class="hps">área de cliente</span> <span class="hps">para ver y pagar</span> <span class="hps">la factura en</span></span> <?php echo $this->_tpl_vars['invoice_link']; ?>
</p>
<p><?php echo $this->_tpl_vars['signature']; ?>
</p>