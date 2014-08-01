</div>
<aside class="large-3 columns" id="middle">
	<h5><?=$language->line('sideBar_category')?></h5>
	<ul class="side-nav">
	  <?php foreach ($firstMenuSideBar as $array){ ?>
	    <li>
	      
		<?php if($array['id']!='5'){ ?> 
				
				<a href="<?=$config['domain'].'/content/body/'.str_replace(' ','-',formatString(convert_accented_characters($array['title']),3))?>">
			
		<?php }else{ ?>
				<a href="http://www.websarrollo.com/wadmin/cart.php" target="_blank">
		<?php } ?>
	      
	        <img src="<?=base_url().$array['icon']?>" alt="<?=$array['title']?>" width="24" height="24">&nbsp;<?=formatString($array['title'])?>
	      </a>
	    </li>
	  <?php } ?>
	</ul>

	<!-- Por que Websarrollo -->
	<hr>
	<h5><?=$language->line('sideBar_why_us')?></h5>
	<ul class="side-nav">
	  <?php foreach ($secondMenuSideBar as $array){ ?>
	    <li>
	      <a href="<?=$config['domain'].'/content/body/'.str_replace(' ','-',formatString(convert_accented_characters($array['title']),3))?>">
	        <img src="<?=base_url().$array['icon']?>" alt="<?=$array['title']?>" width="24" height="24">&nbsp;<?=formatString($array['title'])?>
	      </a>
	    </li>
	  <?php } ?>
	</ul>

	<!-- Newsletter -->
	<hr>
	<h5><?=$language->line('sideBar_newsletters')?></h5>
	<small><?=$language->line('newsletters_titleForm')?> ...</small>
	<form data-abide name="frmNewsletters" id="frmNewsletters" action="<?=$config['domain']?>/newsletters/sent" method="POST">
		<div class="row">&nbsp;</div>
		<div class="row">
			<div class="large-12 columns">
				<label>
					<input type="email" id="txtNewslettersName" name="txtNewslettersName" placeholder="<?=$language->line('newsletters_label01')?>" pattern="alpha" required />
				</label>
				<small class="error radius"><?=$language->line('newsletters_errorLabel01')?>.</small>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<label>
					<input type="text" id="txtNewslettersEmail" name="txtNewslettersEmail" placeholder="<?=$language->line('newsletters_label02')?>" pattern="email" required />
				</label>
				<small class="error radius"><?=$language->line('newsletters_errorLabel02')?>.</small>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<a id="btnSaveNewsletters" name="btnSaveNewsletters" class="button radius tiny"><?=$language->line('newsletters_btnSuscri')?></a>
			</div>
			<div id="newsletters-reveal" class="reveal-modal small" data-reveal>
				<h2></h2>
				<h5></h5>
				<a class="close-reveal-modal">&#215;</a>
			</div>
		</div>
	</form>

	<!-- Facebook -->
	<hr>
	<?php if ($_SERVER['SERVER_NAME']=="www.websarrollo.com" || $_SERVER['SERVER_NAME']=="websarrollo.com"){ ?>
		<iframe 
			src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fwebsarrollo&amp;width=220&amp;height=300&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=214247025290785" 
			scrolling="no" 
			frameborder="0" 
			style="border:none; overflow:hidden; width:220px; height:258px;" 
			allowTransparency="true">
		</iframe>
	<?php } ?>

	<!-- Twitter -->
	<hr>
	<h5><?=$language->line('sideBar_tweets')?></h5>
	<a class="twitter-timeline" href="https://twitter.com/websarrollo" data-widget-id="436195181553934336">Tweets by @websarrollo</a>
	<?php if ($_SERVER['SERVER_NAME']=="www.websarrollo.com" || $_SERVER['SERVER_NAME']=="websarrollo.com"){ ?>
	<script>
		!function(d,s,id){
			var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
			if(!d.getElementById(id)){
				js=d.createElement(s);
				js.id=id;
				js.src=p+"://platform.twitter.com/widgets.js";
				fjs.parentNode.insertBefore(js,fjs);
			}
		}(document,"script","twitter-wjs");
	</script>
	<?php } ?>
</aside>
</div>