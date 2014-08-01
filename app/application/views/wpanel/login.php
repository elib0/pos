<div class="row">
	<article>
		<h3><img src="<?=base_url().str_replace('.', '45x45.',$content->icon)?>" alt="contact">&nbsp;<?=formatString($content->title)?></h3>
		<h5><small><?=$content->text_small?>.</small></h5>
		<div class="row">
			<form data-abide name="frmWpLogin" id="frmWpLogin" action="<?=$config['domain']?>/wpanel/login" method="POST">
				<div class="row">
					<div class="large-12 columns">
						<div class="large-6 columns">
							<label>Usuario:&nbsp;<small>(Requerido)</small>
								<input type="text" name="txtLogin" id="txtLogin" pattern="alpha_numeric" required />
							</label>
							<small class="error radius">Usuario es requerido y debe contener solo letras y numeros.</small>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns">
						<div class="large-6 columns">
							<label>Contrase&ntilde;a:&nbsp;<small>(Requerido)</small>
								<input type="text" name="txtPass" id="txtPass" required />
							</label>
							<small class="error radius">Contrase&ntilde;a es requerida.</small>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="large-6 columns">
						<div class="large-6 columns">
							<button type="button" id="btnWpLogin" name="btnWpLogin" class="button radius tiny">&nbsp;&nbsp;&nbsp;&nbsp;Enviar&nbsp;&nbsp;&nbsp;&nbsp;</button>
						</div>
					</div>
					<div class="large-6 columns">
						<div id="contact-reveal" class="reveal-modal small" data-reveal>
							<h2></h2>
							<h5></h5>
							<a class="close-reveal-modal">&#215;</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</article>
</div>
