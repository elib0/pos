<?php /* Smarty version 2.6.26, created on 2012-06-04 11:56:40
         compiled from emailtpl:emailmessage */ ?>
<p>Estimado(a) <?php echo $this->_tpl_vars['client_name']; ?>
,</p>
<p align="center"><span id="result_box" lang="es"><strong><span class="hps">POR FAVOR, LEA</span> <span class="hps">ESTE MENSAJE</span> <span class="hps">EN SU TOTALIDAD</span> <span class="hps">E IMPRIMALO PARA SUS ARCHIVOS</span></strong></span></p>
<p><span id="result_box" lang="es"><span class="hps">Gracias por</span> <span class="hps">confiar en</span><span class="hps"> nosotros!</span> <span class="hps">Su</span> <span class="hps">cuenta de hosting</span> <span class="hps">ha</span> <span class="hps">sido</span> <span class="hps">la configuración y</span> <span class="hps">este</span> <span class="hps">correo electrónico</span><span class="hps"> contiene toda la</span> <span class="hps">información necesaria</span> <span class="hps">con el fin de</span> <span class="hps">comenzar a utilizar su</span> <span class="hps">cuenta.</span><br /><br /> <span class="hps">Si usted ha solicitado</span> <span class="hps">un nombre de dominio</span> <span class="hps">durante el registro</span><span>, por favor,</span> <span class="hps">tenga en cuenta que</span> <span class="hps">su nombre de dominio</span> <span class="hps">no será visible</span> <span class="hps">en Internet</span> <span class="hps">al instante.</span> <span class="hps">Este proceso se denomina</span> <span class="hps">propagación y</span> <span class="hps">puede tomar hasta</span> <span class="hps">48 horas.</span> <span class="hps">Hasta que su</span> <span class="hps">dominio</span> <span class="hps">se ha propagado</span><span>,</span> <span class="hps">su sitio web y</span> <span class="hps">correo electrónico</span> asociados a este <span class="hps">no funcionaran</span><span>, hemos proporcionado</span> <span class="hps">una URL</span> <span class="hps">temporal que</span> <span class="hps">puede usar</span> <span class="hps">para ver</span> <span class="hps">su sitio web y</span> <span class="hps">cargar archivos</span> <span class="hps">en el ínterin.</span></span></p>
<p><strong>Información de la nueva cuenta<br /></strong></p>
<p>Paquete de Hosting/Hospedaje: <?php echo $this->_tpl_vars['service_product_name']; ?>
<br />Dominio: <?php echo $this->_tpl_vars['service_domain']; ?>
<br />Primer monto de pago: <?php echo $this->_tpl_vars['service_first_payment_amount']; ?>
<br />Pago recurrente: <?php echo $this->_tpl_vars['service_recurring_amount']; ?>
<br />Ciclo de cobro: <?php echo $this->_tpl_vars['service_billing_cycle']; ?>
<br />Proxima fecha de cobra: <?php echo $this->_tpl_vars['service_next_due_date']; ?>
</p>
<p><strong>Detalles de acceso<br /></strong></p>
<p>Usuario: <?php echo $this->_tpl_vars['service_username']; ?>
<br />Contraseña: <?php echo $this->_tpl_vars['service_password']; ?>
</p>
<p>Direccion de panel de control (CPanel): <a href="http://<?php echo $this->_tpl_vars['service_server_ip']; ?>
:2082/">http://<?php echo $this->_tpl_vars['service_server_ip']; ?>
:2083/</a><br />Una vez el dominio este propagado podra accederlo tambien por esta dirección: <a href="http://www.<?php echo $this->_tpl_vars['service_domain']; ?>
:2082/">http://www.<?php echo $this->_tpl_vars['service_domain']; ?>
:2083/</a></p>
<p><strong>Información del servidor<br /></strong></p>
<p>Nombre: <?php echo $this->_tpl_vars['service_server_name']; ?>
<br />IP: <?php echo $this->_tpl_vars['service_server_ip']; ?>
</p>
<p><?php if ('1' == '2'): ?></p>
<p><span id="result_box" lang="es"><span class="hps">Si está utilizando</span> <span class="hps">un dominio existente</span> <span class="hps">con su</span> <span class="hps">nueva cuenta de alojamiento</span><span>, usted</span> <span class="hps">tendrá que actualizar</span> <span class="hps">los servidores de nombres</span> <span class="hps">para apuntar a</span> <span class="hps">los servidores de nombres</span> <span class="hps">se enumeran a continuación</span><span>.</span></span></p>
<p>Nameserver 1: <?php echo $this->_tpl_vars['service_ns1']; ?>
 (<?php echo $this->_tpl_vars['service_ns1_ip']; ?>
)<br />Nameserver 2: <?php echo $this->_tpl_vars['service_ns2']; ?>
 (<?php echo $this->_tpl_vars['service_ns2_ip']; ?>
)<?php if ($this->_tpl_vars['service_ns3']): ?><br />Nameserver 3: <?php echo $this->_tpl_vars['service_ns3']; ?>
 (<?php echo $this->_tpl_vars['service_ns3_ip']; ?>
)<?php endif; ?><?php if ($this->_tpl_vars['service_ns4']): ?><br />Nameserver 4: <?php echo $this->_tpl_vars['service_ns4']; ?>
 (<?php echo $this->_tpl_vars['service_ns4_ip']; ?>
)<?php endif; ?></p>
<p><?php endif; ?></p>
<p><strong><span id="result_box" class="short_text" lang="es"><span class="hps">Cargando Su Sitio Web</span></span></strong></p>
<div id="gt-res-content" class="almost_half_cell">
<div dir="ltr"><span id="result_box" lang="es"><span class="hps">Temporalmente</span> <span class="hps">se puede utilizar</span> <span class="hps">una de las</span> <span class="hps">direcciones que se indican</span> <span class="hps">a continuación para administrar</span> <span class="hps">su sitio web</span><span>:</span></span></div>
</div>
<p>Servidor FTP temporal: <?php echo $this->_tpl_vars['service_server_ip']; ?>
<br />URL temporal del sitio web: <a href="http://<?php echo $this->_tpl_vars['service_server_ip']; ?>
/~<?php echo $this->_tpl_vars['service_username']; ?>
/">http://<?php echo $this->_tpl_vars['service_server_ip']; ?>
/~<?php echo $this->_tpl_vars['service_username']; ?>
/</a></p>
<p><span id="result_box" lang="es"><span class="hps">Y una vez que</span> <span class="hps">su dominio</span> <span class="hps">se ha propagado</span> <span class="hps">puede utilizar los</span> <span class="hps">datos a continuación</span><span>:</span></span></p>
<p>Servidor FTP: <?php echo $this->_tpl_vars['service_domain']; ?>
<br />URL del sitio web: <a href="http://www.<?php echo $this->_tpl_vars['service_domain']; ?>
">http://www.<?php echo $this->_tpl_vars['service_domain']; ?>
</a></p>
<p><strong>Configuración de Email<br /></strong></p>
<p><span id="result_box" lang="es"><span class="hps">Para</span></span><span id="result_box" lang="es"><span class="hps"> la configuración</span></span><span id="result_box" lang="es"><span class="hps"> de las cuentas</span> <span class="hps">de correo electrónico</span><span>, deberá utilizar</span> <span class="hps">los siguientes parámetros</span> <span class="hps">en su</span> <span class="hps">programa de correo electrónico</span><span>:</span></span></p>
<p>Servidor POP3: mail.<?php echo $this->_tpl_vars['service_domain']; ?>
<br />Servidor SMTP : mail.<?php echo $this->_tpl_vars['service_domain']; ?>
<br />Usuario: <span id="result_box" lang="es"><span class="hps">La</span> <span class="hps">dirección de correo electrónico</span> <span class="hps"></span></span><br />Contraseña: La especificada en el panel cuando creo la cuenta de email</p>
<p><span id="result_box" class="short_text" lang="es"><span class="hps">Gracias por</span> <span class="hps">elegirnos.</span></span></p>
<p><?php echo $this->_tpl_vars['signature']; ?>
</p>