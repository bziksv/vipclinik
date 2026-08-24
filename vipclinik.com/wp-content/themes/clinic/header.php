<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="yandex-verification" content="3994d057c28ae9fc" />

	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title><?php wp_title('&mdash;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	
	<script src="<?php bloginfo('template_directory'); ?>/js/jquery-1.11.1.min.js?ver=1.11.1"></script>
	
	<?php wp_head(); ?>
	<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet">


</head>
<body>
<div class="bg"></div>
<div class="h_modal h_modal-nav">
	<div class="m_close"></div>
	<div class="m_title">Меню</div>
	<nav class="m_nav">
		<?php wp_nav_menu('menu_class=top_menu&theme_location=tnav&container=false'); ?>
	</nav>
</div>

<div class="wrapper">

<?php if (file_exists(TEMPLATEPATH.'/ny-motnya.php')) {require(TEMPLATEPATH.'/ny-motnya.php');}; ?>

<?php ob_start();
	global $woocommerce;
	$viewing_cart = __('Перейти в корзину', 'your-theme-slug');
	$start_shopping = __('Продолжить покупки', 'your-theme-slug');
	$cart_url = $woocommerce->cart->get_cart_url();
	$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
	$cart_contents_count = $woocommerce->cart->cart_contents_count;
	$cart_contents = sprintf(_n('%d товар добавлен', '%d товаров добавлено', $cart_contents_count, 'your-theme-slug'), $cart_contents_count);
	$cart_total = $woocommerce->cart->get_cart_total();
	// Раскомментируйте строку ниже для того, чтобы скрыть иконку корзины в меню, когда нет добавленных товаров в корзине.
	$menu_item = "";
	 if ( $cart_contents_count > 0 ) {
	 	$menu_item = '<div class="h_tovar">';
		if ($cart_contents_count == 0) {
			$menu_item .= '<a class="wcmenucart-contents" href="'. $shop_page_url .'" title="'. $start_shopping .'">';
		} else {
			$menu_item .= '<a class="wcmenucart-contents" href="'. $cart_url .'" title="'. $viewing_cart .'">';
		}

		$menu_item .= '<i class="fa fa-shopping-cart"></i> ';

		$menu_item .= $cart_contents.'<br>Перейти в корзину';
		$menu_item .= '</a></div>';
	// Раскомментируйте строку ниже для того, чтобы скрыть иконку корзины в меню, когда нет добавленных товаров в корзине.
	 }
	echo $menu_item;
	$social = ob_get_clean();
 ?>

<?php if ( is_front_page() ) { ?>
	<header class="header">
		<div class="ins h_top">

			<div class="top_logo">
				<a href="/">
					<img src="<?=get_template_directory_uri()."/i/logo.png";?>">
				</a>
			</div>


			<a href="#" class="h_top-nav"><span></span><span></span></a>

			<div class="h_top-right">
				<div class="row">
					<div class="f_soc">
<!--						<a class="fb" href="https://www.facebook.com/cvk.vrn/?ref=aymt_homepage_panel" target="_blank"></a> -->
						<a class="tw" href="https://vk.com/baybarina_clinic" target="_blank"></a>
<!--						<a class="in" href="https://www.instagram.com/baybarina_clinic/" target="_blank"></a> -->
						<a class="yt" href="https://www.youtube.com/channel/UC5jzxjV43T4cbFxOgeZ-qEw?view_as=public"target="_blank"></a>
					</div>

					<div class="h_top-phone">
						<div>+7 (473) 251-51-85</div>
						<div>+7 (473) 220-82-31</div>
						
					</div>
				</div>
				<div class="clear"></div>
			</div>

		</div>
		<div class="ins h_mid">
			<img class="h_mid-bg" src="<?= get_template_directory_uri(); ?>/i/bg-head-mid.jpg" alt="" aria-hidden="true" width="1120" height="660">
		</div>
		<div class="ins h_bot">
		<img class="h_bot-bg" src="<?= get_template_directory_uri(); ?>/i/bg-hbot.jpg" alt="" aria-hidden="true" width="479" height="469">
		<?php $recent = new WP_Query("page_id=58"); while($recent->have_posts()) : $recent->the_post();?>
			<div class="h_bot-title"><?php the_title(); ?></div>
			<div class="h_bot-txt"><?php the_content(); ?></div>
		<?php endwhile; ?>
		</div>
	</header><!-- .header-->
	
<?php $imgban = get_post_meta($post->ID, 'wpcf-banner-img', 1); 
if( $imgban ) {
?>
	<div class="h_bann"></div>
<?php } ?>

<?php } else { ?>
	<header class="header">
		<div class="ins h_top">

			<div class="top_logo">
				<a href="/">
					<img src="<?=get_template_directory_uri()."/i/logo.png";?>">
				</a>
			</div>

			<a href="#" class="h_top-nav"><span></span><span></span></a>

			<div class="h_top-right">
				<div class="row">
					<div class="f_soc">
						<a class="fb" href="https://www.facebook.com/cvk.vrn/?ref=aymt_homepage_panel" target="_blank"></a>
						<a class="tw" href="https://vk.com/baybarina_clinic" target="_blank"></a>
						<a class="in" href="https://www.instagram.com/baybarina_clinic/" target="_blank"></a>
						<a class="yt" href="https://www.youtube.com/channel/UC5jzxjV43T4cbFxOgeZ-qEw?view_as=public"target="_blank"></a>
					</div>

					<div class="h_top-phone">
						<div>+7 (473) 251-51-85</div>
						<div>+7 (473) 220-82-31</div>
						
					</div>
				</div>
				<div class="clear"></div>
			</div>

		</div>

		<div class="ins h_mid h_mid-page">
			<img class="h_mid-bg" src="<?= get_template_directory_uri(); ?>/i/bg-head-mid-page.jpg" alt="" aria-hidden="true" width="1120" height="380">
		</div>
	</header><!-- .header-->
<?php } ?>

	<main class="content<?php if(!is_front_page()){ ?> page<?php } ?>">