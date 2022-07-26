<?php
/*------------------------------------------------------------------------
# CGrocket Virtuemart Product Show Module
# ------------------------------------------------------------------------
# Author    CGrocket http://www.cgrocket.com
# Copyright (C) 2011 - 2012 CGrocket.com. All Rights Reserved.
# @license - GNU/GPL V2 for PHP files. CSS / JS are Copyrighted Commercial
# Websites: http://www.cgrocket.com
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$modId = $module->id;
if ($article_column>=$c_article_count):
	$article_column 	= $c_article_count;
	$article_row		= 1;
endif;
?>
<div id="rocket-<?php echo $modId; ?>" class="nsrocket rocket-<?php echo $uniqid ?>">
	<div class="rocket-wrap">
		<?php if ($c_article_count > 0): ?>
			<div class="rocket-art-wrap <?php if ($links_block && $c_links_count!=0 && $links_position=="right"): ?> col-2 flt-left<?php endif; ?>">
				<div class="rocket-art-pages">
				<?php for($i=0;$i<$c_article_count;$i++): ?>
					<div class="rocket-page">
						<?php for($j=0;$j<$article_row;$j++, $i++): ?>
							<div class="rocket-row <?php echo $j==0 ? 'rocket-first' : '' ?> <?php echo $j%2 ? 'rocket-even' : 'rocket-odd' ?>">
								<?php for($z=0;$z<$article_column;$z++, $i++): ?>
									<?php if ($i <$c_article_count): ?>
									<div class="rocket-column flt-left col-<?php echo $article_column ?>">
										<div style="padding:<?php echo $article_col_padding ?>">
											<div class="rocket-inner">
											
												<?php /*Image position before title*/if ($article_show_image && $article_image_pos=='top' && $list[$i]->image): ?>
													<?php if ($article_linked_image): ?>
														<a href="<?php echo $list[$i]->link ?>">
													<?php endif; ?>	
														<img class="rocket-image" style="<?php echo $article_image_float ?>;<?php echo ($article_image_margin) ? "margin:$article_image_margin" : "" ?>" src="<?php echo modnsrocketCommonHelper::thumb($list[$i]->image, $article_thumb_width, $article_thumb_height, $article_thumb_ratio, $uniqid) ?>" width="<?php echo $article_thumb_width ?>" height="<?php echo $article_thumb_height ?>" alt="<?php echo $list[$i]->title ?>" title="<?php echo $list[$i]->title ?>" />
													<?php if ($article_linked_image): ?>		
														</a>
													<?php endif; ?>			
												<?php endif; ?>												
												
												<?php /*Article title*/ if ($article_showtitle): ?>
													<h4 class="rocket-title">
														<?php if ($article_linkedtitle): ?>
															<a href="<?php echo $list[$i]->link ?>">
														<?php endif; ?>	
															<?php echo modnsrocketCommonHelper::cText($list[$i]->title, $article_count_title_text, $article_title_text_limit); ?>
														<?php if ($article_linkedtitle): ?>
															</a>
														<?php endif; ?>	
													</h4>
												<?php endif; ?>
												
												<?php /*Author, Category, date*/ if ($article_show_author || $article_date_format || $article_show_category): ?>
													<div class="rocket-tools">
														<?php /*Show Author*/ if ($article_show_author): ?>
															<div class="rocket-author">
																<? echo '<span>' . JText::_('MODROCKET_WRITTEN') . '</span>' . $list[$i]->author; ?>
															</div>
														<?php endif; ?>

														<?php /*Show category*/ if ($article_show_category): ?>
															<div class="rocket-category">
																<?php if ($article_show_author): ?>
																<span><?php echo JText::_('MODROCKET_CATEGORY'); ?></span>
																<?php endif; ?>	
																<?php if ($article_linked_category): ?>
																	<a href="<?php echo $list[$i]->cat_link ?>">
																<?php endif; ?>	
																	<?php echo $list[$i]->category ?>
																<?php if ($article_linked_category): ?>
																	</a>
																<?php endif; ?>	
															</div>														
														<?php endif; ?>													
														
														<?php /*Show date*/ if ($article_date_format): ?>
															<div class="rocket-created">
																<?php if ($article_show_author || $article_show_category): ?>
																	<span><?php echo JText::_('MODROCKET_CREATED') ?></span>
																<?php endif; ?>
																<?php echo JHTML::_('date', $list[$i]->created, JText::_($article_date_format)) ?>
															</div>
														<?php endif; ?>
													</div>
												<?php endif; ?>
	
												<?php /*Image position after title*/if ($article_show_image && $article_image_pos=='bottom' && $list[$i]->image): ?>
													<?php if ($article_linked_image): ?>
														<a href="<?php echo $list[$i]->link ?>">
													<?php endif; ?>	
														<img class="rocket-image" style="<?php echo $article_image_float ?>;<?php echo ($article_image_margin) ? "margin:$article_image_margin" : "" ?>" src="<?php echo modnsrocketCommonHelper::thumb($list[$i]->image, $article_thumb_width, $article_thumb_height, $article_thumb_ratio, $uniqid) ?>" width="<?php echo $article_thumb_width ?>" height="<?php echo $article_thumb_height ?>" alt="<?php echo $list[$i]->title ?>" title="<?php echo $list[$i]->title ?>" />
													<?php if ($article_linked_image): ?>		
														</a>
													<?php endif; ?>			
												<?php endif; ?>			
												
												<?php /*Ratings*/ if ($article_show_ratings): ?>
													<div class="rocket-rating">
														<div class="rocket-rating-bar">
															<div style="width:<?php echo $list[$i]->rating ?>%"></div>	
														</div>	
													</div>
												<?php endif; ?>

												<?php /*Introtext*/ if ($article_introtext): ?>
													<p class="rocket-introtext"><?php echo modnsrocketCommonHelper::cText($list[$i]->introtext, $article_count_intro_text, $article_intro_text_limit) ?></p>								
												<?php endif; ?>
												
												<?php /*Virtuemart*/ if ($art_show_price || $art_show_cart_button) : ?>
													<div class="rocket-vm-bar">
														<?php /*Show Price*/ if ($art_show_price) : ?>
															<p class="rocket-vm-price"><?php echo $list[$i]->price ?></p>
														<?php endif; ?>

														<?php /*Show Cart Button*/ if ($art_show_cart_button) : ?>
															<?php echo $list[$i]->addtocart ?>
														<?php endif; ?>
													</div>
												<?php endif; ?>

												<?php /*Comments, readmore, hits*/ if ($article_show_more || $article_hits || $article_comments): ?>
													<div class="rocket-links">
														<?php /*Comments*/ if ($article_comments):
															echo $list[$i]->comment;
														endif; ?>							
														<?php /*Hits*/ if ($article_hits): ?>
															<span class="rocket-hits"><?php echo JText::_('HITS_TEXT') . ':' . $list[$i]->hits ?></span>
														<?php endif; ?>

														<?php /*Readmore*/ if ($article_show_more): ?>
															<a class="rocket-readmore" href="<?php echo $list[$i]->link ?>"><span><?php echo $article_more_text ?></span></a>
														<?php endif; ?>
													</div>
												<?php endif; ?>
												<div style="clear:both"></div>
												
											</div>
										</div>
									</div>
									<?php endif; ?>
								<?php endfor; $i--; ?>
								<div style="clear:both"></div>
							</div>
						<?php endfor; $i--; ?>
					</div>
				<?php endfor; ?>
				</div>
				
				<?php /*Navigation*/ if ($article_animation!="disabled"): ?>
					<div style="clear:both"></div>
					<div class="rocket-art-controllers">
						<?php /*Pagination*/ if ($article_pagination): ?>
							<div class="rocket-art-pagination"></div>
						<?php endif; ?>
						<?php /*Previous*/ if ($article_arrows): ?>
							<div class="rocket-art-prev">&laquo;</div>
						<?php endif; ?>
						<?php /*Play & Pause*/ if ($article_play_button): ?>
							<div class="rocket-art-play">&rsaquo;</div>
							<div class="rocket-art-pause">||</div>
						<?php endif; ?>	
						<?php /*Next*/ if ($article_arrows): ?>					
							<div class="rocket-art-next">&raquo;</div>
						<?php endif; ?>
						<div style="clear:both"></div>
					</div>
				<?php endif; ?>
				<div style="clear:both"></div>
			</div>
		<?php endif; ?>
		<!--End article layout-->
		
		<!--Links Layout-->
		<?php if ($links_block && $c_links_count!=0): ?>
		<?php 
			$links=$c_article_count;
		?>
		<div class="rocket-links-wrap <?php if ($links_position=="right"): ?> col-2 flt-left<?php endif; ?>">
			<?php if ($links_more): ?>
				<strong><?php echo  JText::_($links_more_text) ?></strong>
			<?php endif; ?>
			<div class="rocket-links-pages">
			<?php for($i=$links;$i<$links+$c_links_count;$i++): ?>	
				<div class="rocket-page">
					<?php for ($ii=0; $ii<$links_count; $ii++, $i++): ?>
						<?php if ($i<$a_count): ?>
							<div class="rocket-row <?php echo $ii==0 ? 'rocket-first' : '' ?> <?php echo $ii%2 ? 'rocket-even' : 'rocket-odd' ?>">
								<div style="padding:<?php echo $links_col_padding ?>">
									<div class="rocket-inner">
									
										<?php /*Show Image*/ if ($links_show_image && $links_image_pos=='top' && $list[$i]->image): ?>
											<?php if ($links_linked_image): ?>
												<a href="<?php echo $list[$i]->link ?>">
											<?php endif; ?>	
												<img class="rocket-image" style="<?php echo $links_image_float ?>;<?php echo ($links_image_margin) ? "margin:$links_image_margin" : "" ?>" src="<?php echo modnsrocketCommonHelper::thumb($list[$i]->image, $links_thumb_width, $links_thumb_height, $links_thumb_ratio, $uniqid) ?>" width="<?php echo $links_thumb_width ?>" height="<?php echo $links_thumb_height ?>" alt="<?php echo $list[$i]->title ?>" title="<?php echo $list[$i]->title ?>" />
											<?php if ($links_linked_image): ?>		
												</a>
											<?php endif; ?>	
										<?php endif; ?>													
										
										<!--Start title-->											
										<h4 class="rocket-title">
											<a href="<?php echo $list[$i]->link ?>"><?php echo modnsrocketCommonHelper::cText($list[$i]->title, $links_title_count, $links_title_text_limit); ?></a>
										</h4>

										<?php /*Image after title*/ if ($links_show_image && $links_image_pos=='bottom' && $list[$i]->image): ?>
											<?php if ($links_linked_image): ?>
												<a href="<?php echo $list[$i]->link ?>">
											<?php endif; ?>	
												<img class="rocket-image" style="<?php echo $links_image_float ?>;<?php echo ($links_image_margin) ? "margin:$links_image_margin" : "" ?>" src="<?php echo modnsrocketCommonHelper::thumb($list[$i]->image, $links_thumb_width, $links_thumb_height, $links_thumb_ratio, $uniqid) ?>" width="<?php echo $links_thumb_width ?>" height="<?php echo $links_thumb_height ?>" alt="<?php echo $list[$i]->title ?>" title="<?php echo $list[$i]->title ?>" />
											<?php if ($links_linked_image): ?>		
												</a>
											<?php endif; ?>	
										<?php endif; ?>	
										
										<?php /*Intro Text*/ if ($links_show_intro): ?>
											<p class="rocket-introtext"><?php echo modnsrocketCommonHelper::cText($list[$i]->introtext, $links_intro_count, $links_intro_text_limit) ?></p>															
										<?php endif; ?>
					
										<?php /*Virtuemart*/ if ($links_show_price || $links_show_cart_button) : ?>
											<div class="rocket-vm-bar">
												<?php /*Show Price*/ if ($links_show_price) : ?>
													<p class="rocket-vm-price"><?php echo $list[$i]->price ?></p>
												<?php endif; ?>

												<?php /*Show Cart Button*/ if ($links_show_cart_button) : ?>
													<?php echo $list[$i]->addtocart ?>
												<?php endif; ?>
											</div>
										<?php endif; ?>
										<div style="clear:both"></div>
									</div>
								</div>
							</div>
						<?php endif; ?>
					<?php endfor; $i--; ?>
				</div>
			<?php endfor; ?>
			</div>
			
			<?php /*Navigation*/ if ($links_animation!="disabled"): ?>
				<div style="clear:both"></div>
				<div class="rocket-links-controllers">
					<?php /*Pagination*/ if ($links_pagination): ?>
						<div class="rocket-links-pagination"></div>
					<?php endif; ?>
					<?php /*Previous*/ if ($links_arrows): ?>
					<div class="rocket-links-prev">&laquo;</div>
					<?php endif; ?>
					<?php /*Play & Pause*/ if ($links_play_button): ?>
						<div class="rocket-links-play">&rsaquo;</div>
						<div class="rocket-links-pause">||</div>
					<?php endif; ?>	
					<?php /*Next*/ if ($links_arrows): ?>					
						<div class="rocket-links-next">&raquo;</div>
					<?php endif; ?>
					<div style="clear:both"></div>
				</div>
			<?php endif; ?>
			<div style="clear:both"></div>	
		</div>
		<?php endif; ?>
		<!--End Links Layout-->
		<div style="clear:both"></div>
	</div>
</div>

<script type="text/javascript">
//<![CDATA[
<?php if ($c_article_count > 0 && $article_animation!="disabled"): ?>
<?php $doc->addStyleDeclaration ("#rocket-{$modId} .rocket-art-pages{height:{$article_slide_height}px}"); ?>
window.addEvent('domready', function() {
	new nsrocket({
		container: document.getElement('#rocket-<?php echo $modId; ?> .rocket-art-pages'),
		interval: <?php echo $article_animation_interval ?>,
		activator: "<?php echo $article_activator ?>",
		transition: "<?php echo $article_animation ?>",		
		fxOptions: {
			duration:  <?php echo $article_animation_speed ?>, 
			transition: Fx.Transitions.<?php echo $article_animation_transition ?>
		},
		buttons: {
			<?php if ($article_arrows): ?>
			previous: document.getElement('#rocket-<?php echo $modId; ?> .rocket-art-prev')
			,next: document.getElement('#rocket-<?php echo $modId; ?> .rocket-art-next')
			<?php endif; ?>
			<?php if ($article_play_button): ?>
			,play: document.getElement('#rocket-<?php echo $modId; ?> .rocket-art-play')
			,stop: document.getElement('#rocket-<?php echo $modId; ?> .rocket-art-pause')
			<?php endif; ?>
		}
		<?php if ($article_pagination): ?>
		,pagination: document.getElement('#rocket-<?php echo $modId; ?> .rocket-art-pagination')
		<?php endif; ?>
		,autoPlay: <?php echo $article_autoplay ?>
	});
});
<?php endif; ?>

<?php if ($links_block && $c_links_count!=0 && $links_animation!="disabled"): ?>
<?php $doc->addStyleDeclaration ("#rocket-{$modId} .rocket-links-pages{height:{$links_slide_height}px}"); ?>
window.addEvent('domready', function() {
	new nsrocket({
		container: document.getElement('#rocket-<?php echo $modId; ?> .rocket-links-pages'),
		interval: <?php echo $links_animation_interval ?>,
		activator: "<?php echo $links_activator ?>",
		transition: "<?php echo $links_animation ?>",		
		fxOptions: {
			duration:  <?php echo $links_animation_speed ?>, 
			transition: Fx.Transitions.<?php echo $links_animation_transition ?>
		},
		buttons: {
			<?php if ($links_arrows): ?>
			previous: document.getElement('#rocket-<?php echo $modId; ?> .rocket-links-prev')
			,next: document.getElement('#rocket-<?php echo $modId; ?> .rocket-links-next')
			<?php endif; ?>
			<?php if ($links_play_button): ?>
			,play: document.getElement('#rocket-<?php echo $modId; ?> .rocket-links-play')
			,stop: document.getElement('#rocket-<?php echo $modId; ?> .rocket-links-pause')
			<?php endif; ?>
		}
		<?php if ($links_pagination): ?>
		,pagination: document.getElement('#rocket-<?php echo $modId; ?> .rocket-links-pagination')
		<?php endif; ?>
		,autoPlay: <?php echo $links_autoplay ?>
	});
});
<?php endif; ?>
//]]>
</script>