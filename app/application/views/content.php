<div class="row">
	<article>
		<h3><img src="<?=base_url().$content->icon?>" alt="contact" class="content_icon">&nbsp;<?=formatString($content->title)?></h3>
		<h5>
			<small>
				<?php 
					if (isset($content->author) && trim($content->author)!=''){
						echo $language->line('general_published_by').': <a href="'.$config['not_click'].'">'.formatString($content->author).'</a> ';
					}

					if (isset($content->date) && trim($content->date)!=''){
						echo 'el '.formatDate($content->date);
					}
				?>	
			</small>
		</h5>

		<div class="row">
			<div class="large-12 columns" class="justify">
				<p>
					<img class="content_pic" src="<?=(file_exists($content->image)?base_url().$content->image:base_url().'img/no-pic.gif')?>" alt="<?=$content->title?>">
					<?php echo $content->summary; ?>
				</p>

				<p>
					<?php echo $content->body; ?>
				</p>
			</div>	
		</div>

		<?php if ($is_post){ ?>
		<div class="row">
			<div class="large-12 columns">
			<h3><small class="section-title"><?=$language->line('general_related_post')?></small></h3>
			<ul class="suggest-list">
				<?php 
					foreach ($more_posts as $array){
						$url_post = $config['domain'].'/content/body/'.str_replace(' ','-',formatString(convert_accented_characters($array['title']),3));
      					$title_post = formatString($array['title']); 
				?>
						<li>
							<img src="<?=base_url()?>img/arrow.png" alt="<?=$array['title']?>" width="24" height="24">&nbsp;
							<?=anchor($url_post,$title_post,'title="'.$language->line('general_go_to').': '.$title_post.'"')?>
						</li>
				<?php } ?>
			</ul>
		</div>
		<?php } ?>

		<div class="row">
			&nbsp;
		</div>
		
		<div class="row">
			&nbsp;
		</div>

		<div class="row">
			<div class="large-12 columns">
				<div class="large-12 columns"><?=comments()?></div>
			</div>
		</div>

	</article>
</div>