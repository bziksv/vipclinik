<?php get_header(); ?>
	<div class="c_page">
		<div class="ins">
			<?php //get_sidebar(); ?>
			<div class="c_box c_cart">
				<h1><?php single_cat_title(); ?></h1>
				<?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
			<div class="ind_act-box">
				<div class="ind_act-thumbs"><a href="<?php the_permalink(); ?>"><img src="<?php 
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
					echo get_img_theme($large_image_url[0], 200, 200); ?>" alt="<?php the_title(); ?>"></a></div>
				<div class="ind_act-head"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
				<div class="ind_act-txt"><?php echo get_post_meta($post->ID, 'wpcf-action-txt', 1); ?></div>
				<a href="<?php the_permalink(); ?>" class="ind_act-more">Подробнее</a>
			</div>
<?php endwhile; else : endif; ?>
		</div>
		</div>
	</div>
<?php get_footer(); ?>