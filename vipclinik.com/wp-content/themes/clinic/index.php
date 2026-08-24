<?php get_header(); ?>



	<div class="ind_work">
		<div class="ins">
			<div id="slider-wrap">
				<div id="slider">
				<?php $args = array( 'post_type' => 'newes', 'post_status' => 'publish' ); 
					$query = new WP_Query( $args );
					if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); ?>
						<div class="slide ind_work-box ind_work-box1">
							<div class="ind_work-title"><?php the_title(); ?></div>
							<div class="ind_work-txt"><?php the_content(); ?></div>
							<div class="ind_work-thumbs"><?php the_post_thumbnail(); ?></div>
						</div>
					<?php } } else {
					// Постов не найдено
					} wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>





	<div class="ind_serv">
		<div class="ins ind_serv-top">
			<div class="ind_serv-title">ПОЛНЫЙ СПЕКТР КОСМЕТОЛОГИЧЕСКИХ УСЛУГ</div>
			<div class="ind_serv-desc">ПО УХОДУ ЗА ЛИЦОМ, ТЕЛОМ, ВОЛОСАМИ</div>
		</div>
		<div class="ins ind_serv-tabs">

			<ul class="ind_serv-tabs__caption">

				<li class="active">ВРАЧЕБНАЯ КОСМЕТОЛОГИЯ</li>
				<li>ЭСТЕТИЧЕСКАЯ КОСМЕТОЛОГИЯ</li>
				<li>АППАРАТНАЯ КОСМЕТОЛОГИЯ</li>
                
                <li>КОРРЕКЦИЯ ФИГУРЫ</li>
				<li>ОБЩЕЕ ОМОЛОЖЕНИЕ</li>
			</ul>



			<div class="ind_serv-tabs__content active">

				

				<div class="ind_serv-tabs-carousel ind_serv-tabs-carousel1">

					<ul>

<?php $args = array( 'posts_per_page' => 50, 'post_parent' => '15', 'post_type' => 'page' ); 

$query = new WP_Query( $args );

if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); ?>

						<li><a href="<?php the_permalink(); ?>">

							<span class="ind_serv-tabs-thumbs"><img src="<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');

								echo get_img_theme($large_image_url[0], 205, 333); ?>" alt="<?php the_title(); ?>"></span>

							<span class="ind_serv-tabs-name"><?php the_title(); ?></span>

						</a></li>

<?php } } else {

// Постов не найдено

} wp_reset_postdata(); ?>

					</ul>

				</div>

				<div class="ind_serv-tabs-next ind_serv-tabs-next1"></div>

				<div class="ind_serv-tabs-prev ind_serv-tabs-prev1"></div>



			</div>



			<div class="ind_serv-tabs__content">



				<div class="ind_serv-tabs-carousel ind_serv-tabs-carousel2">

					<ul>

<?php $args = array( 'posts_per_page' => 50, 'post_parent' => '30', 'post_type' => 'page' ); 

$query = new WP_Query( $args );

if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); ?>

						<li><a href="<?php the_permalink(); ?>">

							<span class="ind_serv-tabs-thumbs"><img src="<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');

								echo get_img_theme($large_image_url[0], 205, 333); ?>" alt="<?php the_title(); ?>"></span>

							<span class="ind_serv-tabs-name"><?php the_title(); ?></span>

						</a></li>

<?php } } else {

// Постов не найдено

} wp_reset_postdata(); ?>

					</ul>

				</div>

				<div class="ind_serv-tabs-next ind_serv-tabs-next2"></div>

				<div class="ind_serv-tabs-prev ind_serv-tabs-prev2"></div>



			</div>



			<div class="ind_serv-tabs__content">
				<div class="ind_serv-tabs-carousel ind_serv-tabs-carousel3">
					<ul>
<?php $args = array( 'posts_per_page' => 50, 'post_parent' => '46', 'post_type' => 'page' ); 
$query = new WP_Query( $args );
if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); ?>
						<li><a href="<?php the_permalink(); ?>">
							<span class="ind_serv-tabs-thumbs"><img src="<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
								echo get_img_theme($large_image_url[0], 205, 333); ?>" alt="<?php the_title(); ?>"></span>
							<span class="ind_serv-tabs-name"><?php the_title(); ?></span>
						</a></li>
<?php } } else {
// Постов не найдено
} wp_reset_postdata(); ?>
					</ul>
				</div>
				<div class="ind_serv-tabs-next ind_serv-tabs-next3"></div>
				<div class="ind_serv-tabs-prev ind_serv-tabs-prev3"></div>
			</div>
			
			
			
			
			
			





			<div class="ind_serv-tabs__content">
				<div class="ind_serv-tabs-carousel ind_serv-tabs-carousel4">
					<ul>
<?php $args = array( 'posts_per_page' => 50, 'post_parent' => '462', 'post_type' => 'page' ); 
$query = new WP_Query( $args );
if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); ?>
						<li><a href="<?php the_permalink(); ?>">
							<span class="ind_serv-tabs-thumbs"><img src="<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
								echo get_img_theme($large_image_url[0], 205, 333); ?>" alt="<?php the_title(); ?>"></span>
							<span class="ind_serv-tabs-name"><?php the_title(); ?></span>
						</a></li>
<?php } } else {
// Постов не найдено
} wp_reset_postdata(); ?>
					</ul>
				</div>
				<div class="ind_serv-tabs-next ind_serv-tabs-next4"></div>
				<div class="ind_serv-tabs-prev ind_serv-tabs-prev4"></div>
			</div>


			<div class="ind_serv-tabs__content">
				<div class="ind_serv-tabs-carousel ind_serv-tabs-carousel5">
					<ul>
<?php $args = array( 'posts_per_page' => 50, 'post_parent' => '480', 'post_type' => 'page' ); 
$query = new WP_Query( $args );
if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); ?>
						<li><a href="<?php the_permalink(); ?>">
							<span class="ind_serv-tabs-thumbs"><img src="<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
								echo get_img_theme($large_image_url[0], 205, 333); ?>" alt="<?php the_title(); ?>"></span>
							<span class="ind_serv-tabs-name"><?php the_title(); ?></span>
						</a></li>
<?php } } else {
// Постов не найдено
} wp_reset_postdata(); ?>
					</ul>
				</div>
				<div class="ind_serv-tabs-next ind_serv-tabs-next5"></div>
				<div class="ind_serv-tabs-prev ind_serv-tabs-prev5"></div>
			</div>

			


		</div><!-- .tabs-->

	</div>







	<!--div class="ind_best">

		<div class="ins">

			<div class="ind_best-info">

				<div class="ind_best-title">БЕСТСЕЛЛЕРЫ</div>

				<div class="ind_best-desc">ЛУЧШАЯ НАТУРАЛЬНАЯ КОСМЕТИКА МИРОВЫХ БРЕНДОВ</div>

				<a href="<?php bloginfo('url'); ?>/shop/" class="ind_best-btn">Перейти в каталог</a>

			</div>

			<div class="c_list">

<?php global $product; $args = array( 'posts_per_page' => 3, 'post_type' => 'product', 'meta_key' => '_featured', 'meta_value' => 'yes', 'post_status' => 'publish' );

$query = new WP_Query( $args );

if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); ?>

				<div class="c_list-box">

					<div class="c_list-thumbs"><img src="<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');

echo get_img_theme($large_image_url[0], 164, 150); ?>" alt="<?php the_title(); ?>"></div>

					<div class="c_list-info">

						<a href="<?php the_permalink(); ?>" class="c_list-more"><?php the_title(); ?></a>

						<?php echo $product->get_categories( ', ', '<div class="c_list-cat">' . _n( '', '', '', 'woocommerce' ) . '', '</div>' ); ?>

					</div>

					<div class="c_list-bot">

						<div class="c_list-cost"><?php echo woocommerce_template_single_price(); ?></div>

						<?php echo woocommerce_template_single_add_to_cart(); ?>

					</div>

				</div>

<?php } } else {

// Постов не найдено

} wp_reset_postdata(); ?>

			</div>

		</div>

	</div-->





<?php if (file_exists(TEMPLATEPATH.'/bottom.php')) {require(TEMPLATEPATH.'/bottom.php');}; ?>



<?php get_footer(); ?>