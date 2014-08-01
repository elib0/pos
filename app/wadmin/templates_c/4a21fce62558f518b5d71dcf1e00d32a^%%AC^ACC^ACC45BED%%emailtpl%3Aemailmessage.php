<?php /* Smarty version 2.6.26, created on 2012-05-22 21:21:42
         compiled from emailtpl:emailmessage */ ?>
<p>Estimado(a) <?php echo $this->_tpl_vars['client_name']; ?>
,</p>
<p><span id="result_box" lang="es"><span class="hps">Recientemente</span> <span class="hps">se presentó una solicitud</span> <span class="hps">para restablecer su contraseña</span> <span class="hps">para nuestra</span> <span class="hps">área de cliente.</span> <span class="hps">Si</span> <span class="hps">usted no solicitó</span><span>, por favor</span> <span class="hps">ignore este mensaje</span><span>.</span> <span class="hps">El plazo vencerá</span> <span class="hps">y será inútil</span> <span class="hps">hasta dentro de 2</span> <span class="hps">horas.</span><br /><br /> <span class="hps">Para restablecer su contraseña</span><span>, por favor visite</span> <span class="hps">la siguiente URL</span><span>:</span></span></p>
<p><a href="<?php echo $this->_tpl_vars['pw_reset_url']; ?>
"><?php echo $this->_tpl_vars['pw_reset_url']; ?>
</a></p>
<p><span id="result_box" lang="es"><span class="hps">Cuando visite</span> <span class="hps">el enlace de arriba</span><span>, su contraseña</span> <span class="hps">se restablecerá</span><span>,</span> <span class="hps">y la</span> <span class="hps">nueva contraseña le será</span> <span class="hps">enviada por correo electrónico</span><span>.</span></span></p>
<p><?php echo $this->_tpl_vars['signature']; ?>
</p>