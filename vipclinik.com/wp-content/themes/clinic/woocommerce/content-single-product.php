<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product;
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 //do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<?php echo woocommerce_breadcrumb(); ?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" class="c_txt" <?php post_class(); ?>>

	<?php
		/**
		 * woocommerce_before_single_product_summary hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>
	<div class="c_item-right">
		<div class="c_item-info">
			<?php echo woocommerce_template_single_title(); ?>
			<?php echo $product->get_categories( ', ', '<div class="c_list-cat">' . _n( '', '', '', 'woocommerce' ) . '', '</div>' ); ?>
		</div>
		<div class="c_item-cost-price">
			<div class="c_item-cost"><?php echo woocommerce_template_single_price(); ?></div>
			<div class="c_item-add"><?php echo woocommerce_template_single_add_to_cart(); ?></div>
		</div>
	</div>

	<div class="summary entry-summary tabs">

			<ul class="tabs_tovar">
				<li class="active">О продукте</li>
				<li>Применение</li>
				<li>Подлинность</li>
			</ul>

			<div class="tabs_tovar-content active">
				<?php echo apply_filters('the_content', get_post_meta($post->ID, 'wpcf-tovar-prod', 1) ); ?>
			</div>

			<div class="tabs_tovar-content">
				<?php echo apply_filters('the_content', get_post_meta($post->ID, 'wpcf-tovar-prim', 1) ); ?>
			</div>

			<div class="tabs_tovar-content">
				<?php echo apply_filters('the_content', get_post_meta($post->ID, 'wpcf-tovar-podlin', 1) ); ?>
			</div>

	</div><!-- .summary -->

	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		//do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php //echo woocommerce_output_related_products(); ?>

<?php //do_action( 'woocommerce_after_single_product' ); ?>
