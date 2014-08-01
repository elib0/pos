<div class="row">
	<article>
		<h3><img src="<?=base_url().$content->icon?>" alt="domains">&nbsp;<?=formatString($content->title)?></h3>
		<h5><small><?=$content->text_small?></small></h5>

		<div class="row">
			<div class="large-12 columns">
				<?php foreach ($plans as $plan){ ?>
					<div class="large-4 columns">
						<ul class="pricing-table">
							<li class="title"><?=$plan['name']?></li>	
							<li class="price">Bs.&nbsp;<?=$plan['price']?></li>
							<li class="description">Per&iacute;odo de pago anual</li>
							<?php 
								if (isset($plan['details']) && count($plan['details'])>0){
									foreach ($plan['details'] as $detail){ 
							?>
										<li class="bullet-item"><?=$detail?></li>
							<?php 	}
								} 
							?>
							<li class="cta-button"><a class="button radius tiny" href="#">Comprar Hosting&nbsp;&raquo;</a></li>
						</ul>
					</div>
				<?php } ?>
			</div>
		</div>

		<div class="row">
			<div class="large-12 columns">
				<hr>
			</div>		
		</div>
		
		<div class="row">
			<div class="large-12 columns">
				<dl class="accordion" data-accordion>
					<dd>
						<a href="#panel1">Caracter&iacute;sticas Generales.</a>
						<div id="panel1" class="content active paragraph">
							<p class="p-accordion"><strong>Setup sin cargo.</strong></p>
							<p class="p-accordion">No te cobramos ning&uacute;n tipo de cargo por el alta de tu plan de tu plan. No hay gastos ocultos y todos los cargos administrativos ya est&aacute;n inclu&iacute;dos en el precio.</p>
							<p class="p-accordion"><strong>Listo para desarrolladores.</strong></p>
							<p class="p-accordion">Tu hosting incluye todo lo necesario para que puedas instalar o programar tu aplicaci&oacute;n. Todos los planes incluyen Bases de Datos y la posibilidad de usar lenguajes de programaci&oacute;n din&aacute;micos.</p>
							<p class="p-accordion"><strong>Accede a tus correos de cualquier forma y lugar</strong></p>
							<p class="p-accordion">Vas a poder acceder a tus correos de la forma que prefieras y sin limitaciones. Webmail, POP3, IMAP, SMTP.</p>
							<p class="p-accordion"><strong>Completas estad&iacute;sticas de tu sitio</strong></p>
							<p class="p-accordion">Conoc&eacute; todos los detalles del tr&aacute;fico a trav&eacute;s de completas estad&iacute;sticas de acceso. Descubre de donde provienen y que hacen los visitantes en tu sitio.</p>
							<p class="p-accordion"><strong>Tu sitio m&aacute;s seguro (Anti-Virus)</strong></p>
							<p class="p-accordion">Basta de sitio infectados. Cuentas con un exclusivo sistema que neutraliza las posibles infecciones de las p&aacute;ginas de tu sitio a&uacute;n antes de que las publiques a trav&eacute;s de FTP.</p>
							<p class="p-accordion"><strong>Anti SPAM para tus correos</strong></p>
							<p class="p-accordion">Basta de correo basura! S&oacute;lo Websarrollo te brinda un Anti SPAM totalmente configurable por cuenta de correo. Configuralo a tu gusto o selecciona los valores por defecto desde una interfaz muy simple.</p>
							<p class="p-accordion"><strong>Copias de Respaldo (Backups)</strong></p>
							<p class="p-accordion">Para tu tranquilidad, cuentas con una copia de seguridad semanal de todos tus archivos, correos y bases de datos. Adem&aacute;s, puedes programar backups cuando quieras desde tu panel de control.</p>
							<p class="p-accordion"><strong>Apuntá m&uacute;ltiples dominios a tu sitio</strong></p>
							<p class="p-accordion">Apunt&aacute; a tu sitio todos los dominios que quieras a trav&eacute;s del parkeo ilimitado de Websarrollo. Aprovecha las ventajas de darle a tu sitio muchas puertas de entrada para que las visitas te encuentren f&aacute;cilmente.</p>
							<p class="p-accordion"><strong>Soporte 24x7x365</strong></p>
							<p class="p-accordion">A tu lado todo el tiempo. Mesa de soporte sin l&iacute;mites de consultas y acceso al historial. Tiempos de respuestas insuperables. Personal altamente capacitado. Soporte en espa&ntilde;ol e ingl&eacute;s</p>
						</div>
					</dd>
					<dd>
						<a href="#panel2">&iquest; C&oacute;mo funciona el web Hosting ?</a>
						<div id="panel2" class="content paragraph">
							<p class="p-accordion">Despu&eacute;s de que hayas comprado un plan de web hosting, Websarrollo almacena tu sitio en uno de nuestros servidores y le asigna un DNS &uacute;nico. El DNS sirve como la direcci&oacute;n que permite a las personas en todo el mundo encontrar y ver tu sitio web. Esta dirección &uacute;nica es necesaria para que las personas vean tu sitio.</p>
							<p class="p-accordion">Al comprar un paquete de hosting para sitios web, b&aacute;sicamente est&aacute;s comprando espacio en uno de nuestros servidores. Es similar al espacio en el disco duro de una computadora, pero el servidor permite el acceso a los archivos de tu sitio web desde cualquier lugar.</p>
						</div>
					</dd>
					<dd>
						<a href="#panel3">&iquest; Qu&eacute; clase de web Hosting necesito ?</a>
						<div id="panel3" class="content paragraph">
							<p class="p-accordion">Ofrecemos hosting tanto para Windows como para Linux. El que necesitas depende de lo que deseas hacer con su sitio, si deseas crear un carrito de compras, blog o podcast con una aplicaci&oacute;n espec&iacute;fica para la web. Si no est&aacute;s seguro si necesitas Windows o Linux, siempre puedes escribir al equipo de asistencia t&eacute;cnica de hosting de Websarrollo. Estamos aqu&iacute; para ayudarte las 24 horas del d&iacute;a, 7 días a la semana.</p>
						</div>
					</dd>
					<dd>
						<a href="#panel4">&iquest; C&oacute;mo transfiero mis p&aacute;ginas web a su servidor ?</a>
						<div id="panel4" class="content paragraph">
							<p class="p-accordion">Si has desarrollado tu sitio web en un editor HTML, como Dreamweaver o Microsoft Expression Studio, debes cargar tus archivos del sitio web por medio de FTP (File Transfer Protocol). Nuestro CPANEL incorpora un administrado FTP al que puedes acceder en cualquier momento.</p>
							<p class="p-accordion">Sin embargo, si tus archivos son de m&aacute;s de 20 MB, te recomendamos utilizar la herramienta FileZilla, que funciona con los sistemas operativos Windows, Mac y Linux, u otro cliente de FTP ajeno.</p>
							<p class="p-accordion"></p>
						</div>
					</dd>
				</dl>
			</div>
		</div>
	</article>
</div>