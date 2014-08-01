<div class="row">
	<article>
		<h3><img src="<?=base_url().$content->icon?>" alt="contact">&nbsp;<?=formatString($content->title)?></h3>
		<h5><small><?=$content->summary?>.</small></h5>
		<div class="row">
				<div class="large-12 columns">
					<ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-3">
						<?php foreach ($gallery as $array){ ?>
							<li>
								<img src="<?=base_url().$array['pic']?>" alt="" class="gallery-customers-img">
								<div class="panel gallery-customers-box">
									<h6><?=formatString($array['name'])?></h6>
									<ul class="circle">
										<li><small><?=anchor($array['url'],$array['url'],'title="Ir a: '.formatString($array['name']).'" target="_blank"')?></small></li>
										<li><small><?=formatString($array['type_name'])?></small></li>
										<li><small><?=showDate($array['date'])?></small></li>
									</ul>
								</div>
							</li>
						<?php }  ?>
					</ul>
				</div>
		</div>
	</article>
</div>
