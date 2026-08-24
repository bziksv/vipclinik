<?php /*
Template name: Контакты
*/get_header(); ?>


	<div class="c_page">
		<div class="ins">
			<div class="c_box c_cart c_contact">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				<h1><?php the_title(); ?></h1>
				<?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
				<div class="c_txt">
					<div class="c_txt-ins"><?php the_content(); ?>
<div class="c_txt-form"><?php echo do_shortcode('[contact-form-7 id="627" title="Обратная связь"]'); ?></div>
				</div>
			<?php endwhile; else : endif; ?>
			</div>
		</div>
	</div>


<?php if (file_exists(TEMPLATEPATH.'/bottom.php')) {require(TEMPLATEPATH.'/bottom.php');}; ?>

<?php get_footer(); ?>