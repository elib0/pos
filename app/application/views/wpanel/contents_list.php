<?php
	if (empty($wp_user) && $wp_user['id']==''){
		redirect($config['domain'].'/wpanel');
		die();
		exit();
	}
?>
<div class="row">
	<article>
		<h3><img src="<?=base_url().$content->icon?>" alt="list">&nbsp;<?=formatString($content->title)?></h3>
		<h5><small><?=$content->text_small?>.</small></h5>

		<div class="row">
			&nbsp;
		</div>

		<div class="row">
			<div class="large-10 columns">
				<label>Tipo:&nbsp;<small>(Requerido)</small>
					<select name="cboListContentFilter" id="cboListContentFilter" domain = "<?=$config['domain']?>" >
						<option value="" selected >---</option>
						<?php foreach ($list_type as $array){ ?>
						<option value="<?=$array['id']?>"><?=formatString($array['name'])?></option>
						<?php } ?>
					</select>
				</label>
			</div>
			<div class="large-2 columns">
				<label>&nbsp;
					<button type="button" id="btnListContentAdd" name="btnListContentAdd" class="button radius tiny"  onclick="redirect('<?=$config['domain']?>/content/add');" >&nbsp;&nbsp;&nbsp;&nbsp;Nuevo&nbsp;&nbsp;&nbsp;&nbsp;</button>
				</label>
			</div>
		</div>

		<div class="row">
			&nbsp;
		</div>

		<div class="row">
			<div class="large-12 columns" id="out_ajax">
				<table>
					<thead>
						<tr>
							<th>Icono</th>
							<th>T&iacute;tulo</th>
							<th>Introducci&oacute;n</th>
							<th>Actualizaci&oacute;n</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($contents_list as $array){ ?>
						<tr id="tr_<?=$array['id']?>">
							<td width="10%"><img src="<?=base_url().$array['icon']?>" alt="<?=$array['icon']?>"></td>
							<td width="20%"><?=formatString($array['title'])?></td>
							<td width="45%"><?=substr($array['text_small'],0,100)?>&nbsp;...</td>
							<td width="20%"><?=$array['date']?></td>
							<td width="5%">
								<img src="<?=base_url()?>img/edit.png" alt="edit" class="cursor_pointer" onclick="redirect('<?=$config['domain']?>/content/manage/<?=$array['id']?>');">
								<img src="<?=base_url()?>img/trash.png" alt="trash" class="cursor_pointer" onclick="deleteRecord('<?=$config['domain']?>/content/delete/<?=$array['id']?>','#tr_<?=$array['id']?>', '<?=formatString($array['title'])?>')">
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="row">
			<div class="large-12 columns">
				<div id="confirm-reveal" class="reveal-modal tiny" data-reveal>
					<h2>Borrar Contenido</h2>
					<h5>&iquest; Esta seguro de borrar el item:  </h5>
					<p>&nbsp;</p>
					<p>
						<a href="<?=$config['not_click']?>" id="delete" class="button radius small alert">Aceptar</a>
					</p>
					<a class="close-reveal-modal">&#215;</a>
				</div>
			</div>
		</div>

	</article>
</div>