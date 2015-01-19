<?php get_header(); ?>

<?php if(siteorigin_setting('type_slide')) get_template_part('slider') ?>

<?php if(siteorigin_setting('front_page_cta_text')) : ?>
	<div id="call-to-action">
		<div class="container">
			<h3><?php echo esc_html(siteorigin_setting('front_page_cta_text')) ?></h3>
			<?php if(siteorigin_setting('front_page_cta_button_text') && siteorigin_setting('front_page_cta_button_url')) : ?>
				<a href="<?php echo esc_url(siteorigin_setting('front_page_cta_button_url')) ?>"><?php echo esc_html(siteorigin_setting('front_page_cta_button_text')) ?></a>
			<?php endif ?>
		</div>
	</div>
<?php endif ?>

<?php
if(siteorigin_setting('type_feature')){
	get_template_part('features');
}

if(siteorigin_setting('type_project')){
	pitch_display_loop(
		siteorigin_setting('front_page_home_title_latest_projects', __('Latest Projects', 'pitch')),
		array(
			'posts_per_page' => 10,
			'post_type' => 'project',
			'order_by' => 'menu_order',
			'order' => 'ASC',
		),
		get_post_type_archive_link('project'),
		'home'
	);
}

if(siteorigin_setting('front_page_home_blog')){
	pitch_display_loop(
		siteorigin_setting('front_page_home_title_blog', __('From Our Blog', 'pitch')),
		array(
			'posts_per_page' => 10,
			'post_type' => 'post',
		),
		get_post_type_archive_link('post'),
		'home'
	);
}

if(siteorigin_setting('type_client')){
	pitch_display_loop(
		siteorigin_setting('front_page_home_title_clients', __('Our Clients', 'pitch')),
		array(
			'posts_per_page' => 10,
			'post_type' => 'client',
			'order_by' => 'menu_order',
			'order' => 'ASC',
		),
		get_post_type_archive_link('post'),
		'home'
	);
	
}

get_footer();