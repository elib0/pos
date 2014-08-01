<?php /* Smarty version 2.6.26, created on 2012-05-22 21:22:12
         compiled from emailtpl:emailmessage */ ?>
<p>Estimado(a) <?php echo $this->_tpl_vars['client_name']; ?>
,</p>
<p><span id="result_box" lang="es"><span class="hps">Conforme a su solicitud</span><span>, su contraseña</span> <span class="hps">para nuestra</span> <span class="hps">área de cliente</span> <span class="hps">se ha</span> <span class="hps">reiniciado.</span> <span class="hps">Sus</span> <span class="hps">datos de acceso</span> <span class="hps">nuevos</span> <span class="hps">son los siguientes:</span></span><?php echo $this->_tpl_vars['whmcs_link']; ?>
</p>
<p>Email: <?php echo $this->_tpl_vars['client_email']; ?>
<br />Contraseña: <?php echo $this->_tpl_vars['client_password']; ?>
</p>
<div id="gt-res-content" class="almost_half_cell">
<div dir="ltr"><span id="result_box" lang="es"><span class="hps">Para cambiar la contraseña</span> <span class="hps">a algo</span> <span class="hps">más memorable,</span> <span class="hps">después de iniciar sesión</span><span>, vaya a Mis</span> <span class="hps">Datos</span><span>&gt; Cambiar contraseña.</span></span></div>
</div>
<p><?php echo $this->_tpl_vars['signature']; ?>
</p>