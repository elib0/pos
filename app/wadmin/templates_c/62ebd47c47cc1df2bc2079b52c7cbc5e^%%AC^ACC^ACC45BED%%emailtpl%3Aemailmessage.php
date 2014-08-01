<?php /* Smarty version 2.6.26, created on 2012-06-01 14:15:50
         compiled from emailtpl:emailmessage */ ?>
<p>Estimado(a) <?php echo $this->_tpl_vars['client_name']; ?>
,</p>
<p> </p>
<div id="gt-res-content" class="almost_half_cell">
<div dir="ltr"><span id="result_box" lang="es"><span class="hps">Hemos recibido</span> <span class="hps">su pedido y</span> <span class="hps">se</span> <span class="hps">procesara</span> <span class="hps">en breve.</span> <span class="hps">Los detalles de</span> <span class="hps">la orden</span> <span class="hps">están a continuación:</span></span></div>
</div>
<p>Numero de Orden: <strong><?php echo $this->_tpl_vars['order_number']; ?>
</strong></p>
<p><?php echo $this->_tpl_vars['order_details']; ?>
</p>
<p><span id="result_box" lang="es"><span class="hps">Usted recibirá un</span> <span class="hps">mensaje de correo electrónico</span> <span class="hps">en breve</span> <span class="hps">una vez que su</span> <span class="hps">cuenta haya</span> <span class="hps">sido configurada</span><span>.</span> <span class="hps">Por favor, indique</span> <span class="hps">su número de</span> <span class="hps">referencia del pedido</span> <span class="hps">si</span> <span class="hps">desea hablar con nosotros</span> <span class="hps">sobre este pedido</span><span>.</span></span></p>
<p><?php echo $this->_tpl_vars['signature']; ?>
</p>