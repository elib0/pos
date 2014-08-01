<?php /* Smarty version 2.6.26, created on 2012-06-30 00:00:03
         compiled from emailtpl:emailmessage */ ?>
<p>Estimado(a) <?php echo $this->_tpl_vars['client_name']; ?>
,</p>
<p>El dominio listado a continuación vence en <?php echo $this->_tpl_vars['domain_days_until_expiry']; ?>
 dias.</p>
<p><?php echo $this->_tpl_vars['domain_name']; ?>
 - <?php echo $this->_tpl_vars['domain_next_due_date']; ?>
</p>
<p><span id="result_box" lang="es"><span class="hps">Para asegurar</span> <span class="hps">el dominio</span><span>, usted debe</span> <span class="hps">renovarlo ahora</span><span>.</span> <span class="hps">Usted puede hacer esto</span> <span class="hps">en la sección de</span> <span class="hps">gestión de</span> <span class="hps">dominios</span> <span class="hps">de nuestro</span> <span class="hps">área de clientes</span></span>: <?php echo $this->_tpl_vars['whmcs_url']; ?>
</p>
<p><span id="result_box" lang="es"><span class="hps">U</span><span class="hps">sted será capaz</span> <span class="hps">de renovarlo por</span> <span class="hps">hasta 15</span> <span class="hps">días después de la</span> <span class="hps">fecha de renovación.</span> <span class="hps">Durante este tiempo,</span> <span class="hps">el dominio no</span> <span class="hps">será</span> <span class="hps">accesible via</span><span class="hps"> web, al igual que los</span> <span class="hps">servicios de correo electrónico</span> <span class="hps">asociada a el</span> <span class="hps">dejarán de funcionar.</span></span></p>
<p><?php echo $this->_tpl_vars['signature']; ?>
</p>