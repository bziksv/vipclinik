<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="c_side">
	<div class="c_side-nav">
		<nav class="s_nav"><?php wp_nav_menu('menu_class=side_menu&theme_location=buynav&container=false'); ?></nav>
	</div>
</div>
<div class="c_box">
