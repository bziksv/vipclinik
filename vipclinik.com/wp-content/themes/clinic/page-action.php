<?php /*
Template name: Акции
*/ get_header(); ?>


	<div class="c_page">
		<div class="ins">
			<?php //get_sidebar(); ?>
			<div class="c_box c_cart">
				<h1>
					<?php if(is_page('131')): $type = 'act'; ?>
						Акции
					<?php elseif(is_page('609')): $type = 'publik'; ?>
						Публикации
					<?php else: $type = 'price';?>
						Прайс-лист
					<?php endif; ?>
				</h1>
				
				<?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
<?php $args = array( 'posts_per_page' => 21, 'post_type' => $type, 'post_status' => 'publish' ); 
$query = new WP_Query( $args );
if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); ?>
			<div class="ind_act-box">
				<div class="ind_act-thumbs"><a href="<?php the_permalink(); ?>"><img src="<?php 
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
					echo get_img_theme($large_image_url[0], 200, 200); ?>" alt="<?php the_title(); ?>"></a></div>
				<div class="ind_act-head"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
				<div class="ind_act-txt"><?php echo get_post_meta($post->ID, 'wpcf-action-txt', 1); ?></div>
				<a href="<?php the_permalink(); ?>" class="ind_act-more">Подробнее</a>
			</div>
<?php } } else {
// Постов не найдено
} wp_reset_postdata(); ?>
		</div>
		</div>
	</div>



<?php get_footer(); ?>