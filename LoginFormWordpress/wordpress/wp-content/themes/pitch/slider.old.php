<?php

$slides = new WP_Query(array(
	'numberposts' => $GLOBALS['pitch_theme_settings']['slider_max_slides'],
	'post_type' => 'slide',
	'orderby' => 'menu_order',
	'order' => 'ASC'
));

if($slides->have_posts()){
	?>
	<div id="slider">
		<div class="container">
			<div class="slides nivoSlider" style="height:<?php echo esc_attr(intval($GLOBALS['pitch_theme_settings']['slider_height'])) ?>px">
				<?php foreach($slides as $slide) : if(has_post_thumbnail($slide->ID)) : ?>
				
				
					<?php if(get_post_meta($slide->ID, 'slide_destination', true)) : $destination = get_post_meta($slide->ID, 'slide_destination', true) ?>
						<?php echo '<a href="'.esc_attr(get_permalink($destination)).'" title="'.esc_attr(get_the_title($destination)).'">' ?>
					<?php elseif(get_post_meta($slide->ID, 'slide_destination_url', true)) : $destination = get_post_meta($slide->ID, 'slide_destination_url', true) ?>
						<?php echo '<a href="'.esc_attr($destination).'">' ?>
					<?php endif; ?>
					<?php echo get_the_post_thumbnail($slide->ID, 'slide') ?>
					<?php if(!empty($destination)) echo '</a>' ?>
				<?php endif; endforeach; ?>
			</div>
			
			<div class="indicators-wrapper">
				<ul class="indicators">
					<?php foreach($slides as $i => $slide) : if(has_post_thumbnail($slide->ID)) : ?>
					<li class="indicator <?php if($i == 0) echo 'active' ?> indicator-group-<?php echo intval(count($slides)) ?>">
						<div class="indicator-container">
							<div class="pointer"></div>
							<h4><?php echo $slide->post_title ?></h4>
							<p><?php echo $slide->post_excerpt ?></p>
						</div>
					</li>
					<?php endif; endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
	<?php
}
else{
	get_template_part('demo/slider');
}