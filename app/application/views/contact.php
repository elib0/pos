<div class="row">
	<article>
		<h3><img src="<?=base_url().str_replace('.', '45x45.',$content->icon)?>" alt="<?=$content->title?>">&nbsp;<?=$content->title?></h3>
		<h5><small><?=$content->text_small?>.</small></h5>
		<div class="row">
			<div class="large-12 columns">
				<div class="large-12 columns contact-map" id="map"></div>
			</div>		
		</div>
		<div class="row">
			<div class="large-12 columns" id="out">
				<hr>
			</div>		
		</div>
		<div class="row">
			<form data-abide name="frmContact" id="frmContact" action="<?=$config['domain']?>/contact/sent" method="POST">
				<div class="large-7 columns">
					<div class="row">
						<div class="large-12 columns">
							<label><?=$language->line('support_request')?>:
								<select name="cboContactReason" id="cboContactReason">
									<?php foreach ($reasons as $value){ ?>
									<option value="<?=$value['id']?>"><?=formatString($value['name'],2)?></option>
									<?php } ?>
								</select>
							</label>
						</div>
					</div>
					<div class="row">
						<div class="large-5 columns">
							<label><?=$language->line('support_name')?>&nbsp;<small>(<?=$language->line('general_required')?>)</small>
								<input type="text" name="txtContactName" id="txtContactName" pattern="alpha_numeric" placeholder="Tu Nombre" required />
							</label>
							<small class="error radius"><?=$language->line('support_name_lblerror')?>.</small>
						</div>
						<div class="large-5 columns">
							<label><?=$language->line('support_last_name')?>&nbsp;<small>(<?=$language->line('general_required')?>)</small>
								<input type="text" name="txtContactLastName" id="txtContactLastName" pattern="alpha_numeric" placeholder="Tu Apellido" required />
							</label>
							<small class="error"><?=$language->line('support_last_name_lblerror')?>.</small>
						</div>
						<div class="large-2 columns">&nbsp;</div>
					</div>
					<div class="row">
						<div class="large-7 columns">
							<label><?=$language->line('support_subject')?>&nbsp;<small>(<?=$language->line('general_required')?>)</small>
								<input type="text" name="txtContactSubject" id="txtContactSubject" pattern="alpha_numeric" placeholder="Motivo del contacto" required />
							</label>
							<small class="error"><?=$language->line('support_subject_lblerror')?>.</small>
						</div>
					</div>
					<div class="row">
						<div class="large-7 columns">
							<label><?=$language->line('support_email')?>&nbsp;<small>(<?=$language->line('general_required')?>)</small>
								<input type="email" name="txtContactEmail" id="txtContactEmail" pattern="email" placeholder="tuemail@websarrollo.com" required />
							</label>
							<small class="error"><?=$language->line('support_email_lblerror')?>.</small>
						</div>
					</div>
					<div class="row">
						<div class="large-7 columns">
							<label><?=$language->line('support_phone_number_lblerror')?>&nbsp;<small>(<?=$language->line('general_required')?>)</small>
								<input type="text" name="txtContactTlf" id="txtContactTlf" placeholder="0241-824.56.56" required />
							</label>
							<small class="error"><?=$language->line('support_phone_number_lblerror')?>.</small>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<label><?=$language->line('support_message')?>&nbsp;<small>(<?=$language->line('general_required')?>)</small>
								<textarea name="txtContactMsg" id="txtContactMsg" placeholder="Explicanos el motivo de tu consulta" required></textarea>
							</label>
							<small class="error"><?=$language->line('support_message_lblerror')?>.</small>
						</div>
					</div>
					<div class="row">&nbsp;</div>
					<div class="row">
						<div class="large-4 columns">
							<button type="button" id="btnContactSave" name="btnContactSave" class="button radius tiny">&nbsp;&nbsp;&nbsp;&nbsp;<?=$language->line('general_send')?>&nbsp;&nbsp;&nbsp;&nbsp;</button>
						</div>
						<div class="large-2 columns">
							&nbsp;
						</div>
						<div class="large-6 columns">
							<div id="contact-reveal" class="reveal-modal small" data-reveal>
								<h2></h2>
								<h5></h5>
								<a class="close-reveal-modal">&#215;</a>
							</div>
						</div>
					</div>
				</div>
			</form>
			<div class="large-5 columns">
				<div class="large-12 columns">
					<ul class="pricing-table">
						<li class="title"><?=$companyInfo->name?></li>
						<li class="bullet-item"><?=$companyInfo->rif?></li>
						<li class="bullet-item"><?=$companyInfo->tlf?></li>
						<li class="bullet-item"><a href="mailto:<?=$companyInfo->email?>"><?=$companyInfo->email?></a></li>
						<li class="bullet-item"><?=$companyInfo->city.'.&nbsp;'.$companyInfo->state.',&nbsp;'.$companyInfo->country?></li>
						<li class="bullet-item"><a href="<?=$companyInfo->facebook?>" target="_blank">Facebook</a>&nbsp;|&nbsp;<a href="<?=$companyInfo->twitter?>" target="_blank">twitter</a></li>
					</ul>
				</div>
			</div>
		</div>
	</article>
</div>