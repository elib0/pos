<?php /* Smarty version 2.6.26, created on 2013-02-18 17:52:42
         compiled from emailtpl:emailmessage */ ?>
<p><?php echo $this->_tpl_vars['client_name']; ?>
,</p>
<p> </p>
<div id="gt-res-content" class="almost_half_cell">
<div dir="ltr"><span id="result_box" lang="es"><span class="hps">Gracias por contactar con</span> <span class="hps">nuestro equipo de soporte</span><span>.</span> <span class="hps">Un</span> ticket<span class="hps"> de la ayuda</span> <span class="hps">se ha abierto</span> <span class="hps">para su solicitud.</span> <span class="hps">Se le notificará</span> <span class="hps">por correo electrónico </span></span><span id="result_box" lang="es"><span class="hps">cuando se de una respuesta</span></span><span id="result_box" lang="es"><span class="hps">.</span> <span class="hps">Los detalles de</span> <span class="hps">su ticket</span> <span class="hps">se muestran a continuación</span><span>.</span></span></div>
</div>
<p>Asunto: <?php echo $this->_tpl_vars['ticket_subject']; ?>
<br /> Prioridad: <?php echo $this->_tpl_vars['ticket_priority']; ?>
<br /> Estado: <?php echo $this->_tpl_vars['ticket_status']; ?>
</p>
<p>Usted podra ver su ticket en cualquier momento en:<?php echo $this->_tpl_vars['ticket_link']; ?>
</p>
<p><?php echo $this->_tpl_vars['signature']; ?>
</p>