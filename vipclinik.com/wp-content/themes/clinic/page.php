<?php get_header(); ?>


	<div class="c_page">
		<div class="ins">
			<?php if( is_page( array('checkout', 'cart', 'o-nas', 'zapisatsya-na-proceduru','sertifikacionnyj-centr', 'partnery', 'kontakty','zapisatsya-na-proceduru-po-akcii') )
				or is_post_type_archive('akt') or in_category('akt') ) { 
			 } else {
				 get_sidebar(); 
			 } ?>
			<div class="c_box<?php if( is_page( array('checkout', 'cart', 'o-nas', 'zapisatsya-na-proceduru', 'sertifikacionnyj-centr', 'partnery', 'kontakty','zapisatsya-na-proceduru-po-akcii') )
				or is_post_type_archive('akt') or in_category('akt') ) { echo " c_cart"; } ?>">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				<h1><?php the_title(); ?></h1>
				<?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
				<div class="c_bread"></div>
				<div class="c_txt"><?php the_content(); ?></div>
			<?php endwhile; else : endif; ?>
			</div>
			<!--<div class="ins"><div class="c_infobox">Узнать более полную информацию или записаться на прием к специалисту Центра Врачебной Косметологии вы можете прямо сейчас! Для этого воспользуйтесь онлайн-записью, с Вами оперативно свяжется наш консультант.</div></div>-->
		</div>
	</div>


<?php if (file_exists(TEMPLATEPATH.'/bottom.php')) {require(TEMPLATEPATH.'/bottom.php');}; ?>

<?php get_footer(); ?>