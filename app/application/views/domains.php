<div class="row">
	<article>
		<h3><img src="<?=base_url().$content->icon?>" alt="domains">&nbsp;<?=formatString($content->title)?></h3>
		<h5><small><?=$content->text_small?></small></h5>

		<div class="row">
			<?php if (empty($whois)){ ?>

			<form action="" method="POST" name="frmdomains" id="frmdomains" data-abide >
				<div class="row">
					<div class="large-12 columns">
						<div class="large-12 columns">
							<div class="row collapse panel radius">
								<div class="row">
									<p class="p-accordion"><?=$language->line('domains_availability')?>.</p>
								</div>
								<div class="large-1 columns">
      								<span class="prefix radius">www.</span>
    							</div>
								<div class="large-9 columns">
									<label for="_domain" class="error">
										<input type="text" id="txtDomain" name="txtDomain" class="imput-domains" placeholder="<?=$language->line('domains_what_kind')?>" required >
									</label>
									<small class="error radius"><?=$language->line('domains_what_kind_lblerror')?>.</small>
								</div>
								
								<div class="large-2 columns">
									<button type="submit" class="button radius postfix"><?=$language->line('general_search')?></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
			
			<?php }else{ ?>
				
			<div class="row">
				<div class="large-12 columns">
					<div class="large-12 columns">
						<div data-alert class="alert-box <?=($whois['available']=='1'?'success':'warning')?> radius">
							<h5 class="font-white">
								<?php  
									if ($whois['available']=='1') {
										echo '&iexcl;'.$language->line('general_congratulation').'! '.$whois['domain'].' '.$language->line('domains_is_available').'!';
									}else{
										echo '&iexcl;'.$language->line('general_sorry').'! '.$whois['domain'].' '.$language->line('domains_already_registered').'!';
									}
								?>
							</h5>
						</div>
							<ul class="pricing-table">
								<li class="title"><?=$whois['domain']?></li>
								<li class="price"><?=($whois['available']=='0'?'N/A':$language->line('general_currency').'&nbsp;'.$whois['price'])?></li>
								<li class="description"><?=$language->line('domains_include')?></li>
								<li class="bullet-item"><?=$language->line('domains_contacts_manage')?></li>
								<li class="bullet-item"><?=$language->line('domains_custom_dns')?></li>
								<li class="bullet-item"><?=$language->line('domains_servers_name')?></li>
								<li class="bullet-item"><?=$language->line('domains_whois_privacy')?></li>
								<li class="bullet-item"><?=$language->line('domains_spanish_support')?></li>
								<?php if ($whois['available']==0){ ?>
									<li class="bullet-item"><a href="http://www.<?=$whois['domain']?>" target="_blank"><?=$language->line('domains_goto_site')?></a></li>
								
								<li class="bullet-item">
									<a href="#" data-reveal-id="whoisDialog" data-reveal ><?=$language->line('domains_whois_summary')?></a>
									
									<div id="whoisDialog" class="reveal-modal" data-reveal>
										<h2><?=$language->line('domains_whois_summary')?>:&nbsp;<?=$whois['domain']?></h2>
										<div class="layer-scroll">
											<pre><?=$whois['out']?></pre>
										</div>
										<a class="close-reveal-modal">&#215;</a>
									</div>
								</li>
								<?php } ?>
								<li class="cta-button">
									<form action="http://www.websarrollo.com/wadmin/domainchecker.php" method="POST" target="_blank" name="registrar" id="registrar" >
											<a class="button radius tiny" href="<?=$config['domain']?>/content/body/registrar-dominios">&laquo;&nbsp;<?=$language->line('domains_search_again')?></a>
										<?php if ($whois['available']=='1'){ ?>
										 	<input type="hidden" name="token" value="da5a49dd4deab3cfb13ebb1f061b0524d26fa2bf">
										 	<input type="hidden" name="direct" value="true">
										 	<input type="hidden" name="domain" value="<?=str_replace($whois['tld'], '', $whois['domain'])?>">
										 	<input type="hidden" name="ext" value="<?=$whois['tld']?>">
											<button type="submit" value="Buscar" class="button radius tiny">&nbsp;&nbsp;<?=$language->line('domains_purchase_domain')?>&nbsp;&nbsp;&raquo;&nbsp;</button>
										
										<?php } ?>
									</form>			
								</li>
							</ul>
					</div>
				</div>
			</div>
			
			<?php } ?>

		</div>
		
		<?php if (empty($whois)){ ?>

		<div class="row">
			<div class="large-12 columns">
				<h5><?=$language->line('general_domains_rates')?></h5>
			</div>
			<div class="large-12 columns">
				<table>
				  <thead>
				    <tr>
				      <th width="200" class="center_content"><?=$language->line('general_tld')?></th>
				      <th width="150" class="center_content"><?=$language->line('general_years')?></th>
				      <th width="150" class="center_content"><?=$language->line('general_register')?></th>
				      <th width="150" class="center_content"><?=$language->line('general_transfers')?></th>
				      <th width="150" class="center_content"><?=$language->line('general_renewal')?></th>
				    </tr>
				  </thead>
				  <tbody>
				  <?php foreach ($domains_costs as $plan){ ?>
				    <tr>
				      <td class="center_content"><?=$plan['name']?></td>
				      <td class="center_content">1</td>
				      <td class="center_content"><?=$language->line('general_currency')?>&nbsp;<?=$plan['price']?></td>
				      <td class="center_content"><?=$language->line('general_currency')?>&nbsp;<?=$plan['price']?></td>
				      <td class="center_content"><?=$language->line('general_currency')?>&nbsp;<?=$plan['price']?></td>							      
				    </tr>
				    <?php }  ?>
				  </tbody>
				</table>
			</div>
		</div>

		<div class="row">
			<div class="large-12 columns">
				<hr>
			</div>		
		</div>

		<?php } ?>

		<div class="row">
			<div class="large-12 columns">
				<dl class="accordion" data-accordion>
					<dd>
						<a href="#panel1"><?=$language->line('domains_your_brand')?></a>
						<div id="panel1" class="content active paragraph">
							<p class="p-accordion"><strong><?=$language->line('domains_your_brand_title01')?></strong></p>
							<p class="p-accordion"><?=$language->line('domains_your_brand_text01')?>.</p>
							<p class="p-accordion"><?=$language->line('domains_your_brand_text02')?>.</p>
							<p class="p-accordion"><strong><?=$language->line('domains_your_brand_title02')?>.</strong></p>
							<p class="p-accordion"><?=$language->line('domains_your_brand_text03')?>.</p>
							<p class="p-accordion"><?=$language->line('domains_your_brand_text04')?>.</p>
						</div>
					</dd>
					<dd>
						<a href="#panel2"><?=$language->line('domains_your_brand_title03')?></a>
						<div id="panel2" class="content paragraph">
							<p class="p-accordion"><?=$language->line('domains_your_brand_text05')?>.</p>
							<p class="p-accordion">
								<strong><?=$language->line('domains_your_brand_title04')?></strong>
								<?=$language->line('domains_your_brand_text06')?>.
							</p>
							<p class="p-accordion">
								<strong><?=$language->line('domains_your_brand_title05')?></strong>
								<?=$language->line('domains_your_brand_text06')?>.
							</p>
							<p class="p-accordion">
								<strong><?=$language->line('domains_your_brand_title06')?></strong>
								<?=$language->line('domains_your_brand_text07')?>.
							</p>
							<p class="p-accordion">
								<strong><?=$language->line('domains_your_brand_title07')?></strong>
								<?=$language->line('domains_your_brand_text08')?>.
							</p>
							<p class="p-accordion"><?=$language->line('domains_your_brand_text09')?>.</p>
							<p class="p-accordion"><?=$language->line('domains_your_brand_text10')?>.</p>
						</div>
					</dd>
				</dl>
			</div>
		</div>
	</article>
</div>