<?php /*
Template name: Пресса о нас
*/ get_header(); ?>


	<div class="c_page">
		<div class="ins">
			<?php //get_sidebar(); ?>
			<div class="c_box c_cart">
				<h1>СМИ о нас</h1>
				<?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
<?php
	if($_GET['page-pressa']){
		$pg = $_GET['page-pressa'];
	}else{
		$pg = 1;
	}
 $args = array( 'posts_per_page' => 20,'paged' => $pg, 'post_type' => 'pressa-onas', 'post_status' => 'publish' ); 
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
<?php 
}
$count = wp_count_posts( 'pressa-onas', '' );
$pages = $count->publish/20;
?>
<div class="news-pagination">
<?
for($i = 1; $i <= ceil($pages); $i++){

	if($_GET['page-pressa'] == $i){
		$act = 'class="active"'; 
	}else{
		$act = 'class=""'; 
	}
	?>
	<a <?=$act?> href="?page-pressa=<?=$i?>"><?=$i?></a>
	<?
}
?>
</div>
<?


 } else {
// Постов не найдено
} wp_reset_postdata(); ?>
		</div>
		</div>
	</div>



<?php get_footer(); ?>