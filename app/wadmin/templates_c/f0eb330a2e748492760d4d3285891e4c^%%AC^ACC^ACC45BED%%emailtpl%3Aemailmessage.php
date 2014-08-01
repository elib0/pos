<?php /* Smarty version 2.6.26, created on 2012-05-31 11:07:39
         compiled from emailtpl:emailmessage */ ?>
<p>Estimado(a) <?php echo $this->_tpl_vars['client_name']; ?>
,</p>
<p> </p>
<div id="gt-res-content" class="almost_half_cell">
<div dir="ltr"><span id="result_box" lang="es"><span class="hps">Gracias por</span> registrarte <span class="hps">con</span> <span class="hps">nosotros.</span> <span class="hps">Su cuenta ha</span> <span class="hps">sido</span> <span class="hps">configurada y ahora</span> <span class="hps">puede entrar en nuestra</span> <span class="hps">área de cliente</span><span class="hps">.</span></span></div>
</div>
<p> </p>
<p>Email: <?php echo $this->_tpl_vars['client_email']; ?>
<br /> Contraseña: <?php echo $this->_tpl_vars['client_password']; ?>
</p>
<p><span id="result_box" class="short_text" lang="es"><span class="hps">Para iniciar sesión</span><span>, visite </span></span><?php echo $this->_tpl_vars['whmcs_url']; ?>
</p>
<p><?php echo $this->_tpl_vars['signature']; ?>
</p>