<?php get_header(); ?>

	<div class="c_page">
		<div class="ins">
			<?php if( is_singular('akt') or in_category('akt') ) { 
			 } else { get_sidebar(); } ?>
			<div class="c_box">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				<h1><?php the_title(); ?></h1>
				<?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
				<div class="c_bread"></div>
				<div class="c_txt"><?php the_content(); ?></div>
			<?php endwhile; else : endif; ?>
			</div>
		</div>
	</div>

<?php if (file_exists(TEMPLATEPATH.'/bottom.php')) {require(TEMPLATEPATH.'/bottom.php');}; ?>

<?php get_footer(); ?>