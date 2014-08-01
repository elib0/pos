<?php
	if (empty($wp_user) && $wp_user['id']==''){
		redirect($config['domain'].'/wpanel');
		die();
		exit();
	}
?>
<div class="row">
	<article>
		<h3><img src="<?=base_url().$content->icon?>" alt="contact">&nbsp;<?=formatString($content->title)?></h3>
		<h5><small><?=$content->text_small?>.</small></h5>
		<div class="row">
			<form data-abide name="frmSections" id="frmSections" action="<?=$config['domain']?>/content/<?=(isset($new)?'insert':'update')?>" method="POST" enctype="multipart/form-data">
				<div class="large-12 columns">
					<div class="row">
						<div class="large-12 columns">
							<label>Titulo&nbsp;<small>(Requerido)</small>
								<input type="text" name="txtTitulo" id="txtTitulo" value="<?=isset($info->title)?$info->title:''?>" required />
							</label>
							<small class="error radius">Titulo es requerido.</small>
						</div>
					</div>
					<?php if (isset($info->icon)&&file_exists($info->icon)){ ?>
						<div class="row">
							<div class="large-12 columns">
								<label>Icono:&nbsp;<small>(Requerido)</small></label>
							</div>
						</div>	

						<div class="row">
							<div class="large-1 columns">
								<img src="<?=base_url().$info->icon?>" width="24" height="24" alt="">
							</div>
							<div class="large-11 columns">
								<label>
									<input type="file" name="icon" id="icon" />
								</label>
								<small class="error radius">Icon es requerido.</small>
							</div>
						</div>
					<?php }else{ ?>
						<div class="row">
							<div class="large-12 columns">
								<label>Icono:&nbsp;<small>(Requerido)</small>
									<input type="file" name="icon" id="icon" required />
								</label>
								<small class="error radius">Icon es requerido.</small>
							</div>
						</div>
					<?php } if (isset($info->image)&&file_exists($info->image)){  ?>
						<div class="row">
							<div class="large-12 columns">
								<label>Im&aacute;gen:&nbsp;<small>(Requerido)</small></label>
							</div>
						</div>	

						<div class="row">
							<div class="large-1 columns">
								<img src="<?=base_url().$info->image?>" width="24" height="24" alt="">
							</div>
							<div class="large-11 columns">
								<label>
									<input type="file" name="image" id="image" />
								</label>
								<small class="error radius">image es requerido.</small>
							</div>
						</div>
					<?php }else{ ?>
						<div class="row">
							<div class="large-12 columns">
								<label>Im&aacute;gen:&nbsp;<small>(Requerido)</small>
									<input type="file" name="image" id="image" required />
								</label>
								<small class="error radius">Image es requerido.</small>
							</div>
						</div>
					<?php } ?>
					<div class="row">
						<div class="large-12 columns">
							<label>Introducci&oacute;n:&nbsp;<small>(Requerido)</small>
								<textarea name="txtSmallText" id="txtSmallText" required><?=isset($info->text_small)?$info->text_small:''?></textarea>
							</label>
							<small class="error">Small Text es requerido.</small>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<label>Resumen:&nbsp;<small>(Requerido)</label>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<textarea name="summary" id="summary" rows="10" cols="80"><?=isset($info->summary)?$info->summary:''?></textarea>
						</div>
					</div>
					<div class="row">&nbsp;</div>
					<div class="row">
						<div class="large-12 columns">
							<label>Cuerpo:&nbsp;<small>(Requerido)</label>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<textarea name="body" id="body" rows="10" cols="80"><?=isset($info->body)?$info->body:''?></textarea>
						</div>
					</div>

					<div class="row">&nbsp;</div>

					<div class="row">
						<div class="large-4 columns">
							<label>Autor:&nbsp;<small>(Requerido)</small>
								<input type="text" name="txtAuthor" id="txtAuthor" value="<?=isset($info->author)?$info->author:''?>" required >
							</label>
							<small class="error">Autor es requerido.</small>
						</div>
						<div class="large-8 columns">
							&nbsp;
						</div>
					</div>	

					<div class="row">
						<div class="large-3 columns">
							<label>Tipo:&nbsp;<small>(Requerido)</small>&nbsp;
								<select name="cboType" id="cboType" required >
									<option value="" selected>---</option>
									<?php foreach ($type_list as $array){ ?>
									<option value="<?=$array['id']?>" <?php if (isset($info->id_type) && $info->id_type==$array['id']) echo 'selected'; ?> ><?=formatString($array['name'])?></option>
									<?php } ?>
								</select>
							</label>
							<small class="error">Tipo es requerido.</small>
						</div>

						<div class="large-9 columns">&nbsp;</div>

					</div>

					<div class="row">
						<div class="large-3 columns">
							<label>Status:&nbsp;<small>(Requerido)</small>
								<select name="cboStatus" id="cboStatus" required >
									<option value="" selected>---</option>
									<option value="1" <?php if (isset($info->id_status) && $info->id_status=='1') echo 'selected'; ?> >Activo</option>
									<option value="2" <?php if (isset($info->id_status) && $info->id_status=='2') echo 'selected'; ?> >Inactivo</option>
								</select>
							</label>
							<small class="error">Status es requerido.</small>
						</div>
						<div class="large-9 columns">
							<input type="hidden" name="id" id="id" value="<?=isset($info->id)?$info->id:''?>" >
							<input type="hidden" name="old_icon" id="old_icon" value="<?=isset($info->icon)?$info->icon:''?>" >
							<input type="hidden" name="old_image" id="old_image" value="<?=isset($info->image)?$info->image:''?>" >
						</div>
					</div>

					<div class="row">&nbsp;</div>
					
					<div class="row">
						<div class="large-4 columns">
							<button type="button" id="btnSectionsSave" name="btnSectionsSave" class="button radius tiny">&nbsp;&nbsp;&nbsp;&nbsp;Enviar&nbsp;&nbsp;&nbsp;&nbsp;</button>
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
		</div>
	</article>
</div>