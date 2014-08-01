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