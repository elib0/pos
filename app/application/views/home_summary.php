<!-- News -->
<div class="row">
	<h3><img src="<?=base_url()?>/img/news.png" alt="">&nbsp;<?=$language->line('general_title_news')?></h3>
	<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-3">
	  <?php 
	    foreach ($blog_summary as $array){
	      $url_post = $config['domain'].'/content/body/'.str_replace(' ','-',formatString(convert_accented_characters($array['title']),3));
	      $title_post = substr(formatString($array['title']),0,100);
	  ?>
	      <li>
	      
			<div class="summary_pic">
	        	<img src="<?=(file_exists($array['image']) ? base_url().$array['image'] : base_url().'img/no-pic.gif')?>" alt="<?=formatString($array['title'])?>">
			</div>

	        <h6><?=anchor($url_post, $title_post, 'title="'.$language->line('general_go_to').': '.$title_post.'"')?></h6>

	        <div class="post-summary paragraph">
	          <?=substr($array['summary'],0,200)?>&nbsp;...
	          <br>
	          <?=anchor($url_post,$language->line('general_more_info'),'title="'.$language->line('general_go_to').': '.$title_post.'"')?>
	        </div>

	      </li>
	  <?php } ?>
	</ul>
</div>

<!-- hosting -->
<div class="row">
	<h3><img src="<?=base_url()?>/img/hosting.png" alt="hosting">&nbsp;<?=$language->line('general_hosting_rates')?></h3>
	<?php foreach ($hosting_summary as $plan){ ?>
		<div class="large-4 columns">
			<ul class="pricing-table">
				<li class="title"><?=$plan['name']?></li>	
				<li class="price"><?=$language->line('general_currency')?>&nbsp;<?=$plan['price']?></li>
				<li class="description"><?=$language->line('general_price_title')?></li>
				<?php 
					if (isset($plan['details']) && count($plan['details'])>0){
						foreach ($plan['details'] as $detail){ 
				?>
							<li class="bullet-item"><?=$detail?></li>
				<?php 	}
					} 
				?>
				<li class="cta-button">
					<a class="button radius tiny" href="<?=$config['domain'].'/content/body/hospedaje-web'?>"><?=$language->line('general_more_info')?></a>
				</li>
			</ul>
		</div>
	<?php } ?>
</div>

<!-- Domains -->
<div class="row">
	<h3><img src="<?=base_url()?>/img/link.png" alt="domains">&nbsp;<?=$language->line('general_domains_rates')?></h3>
	<table>
	  <thead>
	    <tr>
	      <th width="200" class="center_content"><?=$language->line('general_tld')?></th>
	      <th width="150" class="center_content"><?=$language->line('general_years')?></th>
	      <th width="150" class="center_content"><?=$language->line('general_register')?></th>
	      <th width="150" class="center_content"><?=$language->line('general_transfers')?></th>
	      <th width="150" class="center_content"><?=$language->line('general_renewal')?></th>
	      <th width="150" class="center_content"><?=$language->line('general_availability')?></th>
	    </tr>
	  </thead>
	  <tbody>
	  <?php foreach ($domains_summary as $plan){ ?>
	    <tr>
	      <td class="center_content"><?=anchor($config['domain'].'/content/body/registrar-dominios', $plan['name'], 'title="'.$language->line('general_availability').'"')?></td>
	      <td class="center_content">1</td>
	      <td class="center_content"><?=$language->line('general_currency')?>&nbsp;<?=$plan['price']?></td>
	      <td class="center_content"><?=$language->line('general_currency')?>&nbsp;<?=$plan['price']?></td>
	      <td class="center_content"><?=$language->line('general_currency')?>&nbsp;<?=$plan['price']?></td>
	      <td class="center_content">
	      	<?=anchor($config['domain'].'/content/body/registrar-dominios', $language->line('general_lookup').'&nbsp;&raquo;', 'title="'.$language->line('general_availability_help').'"')?>
	      </td>
	    </tr>
	    <?php }  ?>
	  </tbody>
	</table>
</div>