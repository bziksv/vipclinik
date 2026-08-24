	<div class="ind_vigod">
		<div class="ins">
			<div class="ind_vigod-title">ЭТО ВЫГОДНО</div>
			<div class="ind_vigod-desc">МЫ ПОДГОТОВИЛИ ДЛЯ ВАС РЯД АКЦИЙ И ПРЕДЛОЖЕНИЙ<br>ПОДРОБНЕЕ СО ВСЕМ СПИСКОМ ВЫ МОЖЕТЕ ОЗНАКОМИТЬСЯ В РАЗДЕЛЕ</div>
			<a href="<?php bloginfo('url'); ?>/akcii/" class="ind_vigod-btn">Перейти в раздел акции</a>
		</div>
	</div>


	<div class="ind_act">
		<div class="ins ind_act-list">
<?php $args = array( 'posts_per_page' => 4, 'post_type' => 'act', 'post_status' => 'publish' ); 
$query = new WP_Query( $args );
if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); ?>
			<div class="ind_act-box">
				<a href="<?php the_permalink(); ?>">
					<span class="ind_act-thumbs"><img src="<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
						echo get_img_theme($large_image_url[0], 200, 200); ?>" alt="<?php the_title(); ?>"></span>
					<span class="ind_act-head"><?php the_title(); ?></span>
				</a>
				<div class="ind_act-txt"><?php echo get_post_meta($post->ID, 'wpcf-action-txt', 1); ?></div>
				<a href="<?php the_permalink(); ?>" class="ind_act-more">Подробнее</a>
			</div>
<?php } } else {
// Постов не найдено
} wp_reset_postdata(); ?>
		</div>
	</div>
	
