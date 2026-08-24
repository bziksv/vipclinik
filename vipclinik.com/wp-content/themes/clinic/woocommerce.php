<?php get_header(); ?>


	<div class="c_page">
		<div class="ins">
			<?php if( is_page( array('checkout', 'cart') ) ) { } else {
				if (file_exists(TEMPLATEPATH.'/shop-side.php')) {require(TEMPLATEPATH.'/shop-side.php');}; 
			} ?>
			<div class="c_box">
			<?php woocommerce_content(); ?>
			</div>
		</div>
	</div>



<?php if (file_exists(TEMPLATEPATH.'/bottom.php')) {require(TEMPLATEPATH.'/bottom.php');}; ?>

<?php get_footer(); ?>