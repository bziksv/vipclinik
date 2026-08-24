<div class="c_side">
<?php $fam = get_post_meta($post->ID, 'wpcf-spec-fam', 1); 
if ($fam) { ?>
	<div class="c_side-spec">
		<div class="c_side-spec-head">ПРИЕМ ПРОВОДИТ</div>
		<div class="c_side-spec-info">
			<div class="c_side-spec-icon"><img src="<?php echo get_post_meta($post->ID, 'wpcf-spec-photo', 1); ?>" alt="spec"></div>
			<div class="c_side-spec-txt">
				<div class="c_side-spec-fam"><?php echo $fam; ?></div>
				<div class="c_side-spec-name"><?php echo get_post_meta($post->ID, 'wpcf-spec-name', 1); ?></div>
				<div class="c_side-spec-dol"><?php echo get_post_meta($post->ID, 'wpcf-spec-dol', 1); ?></div>
			</div>
			<div class="cl"></div>
		</div>
	</div>
<?php } ?>
	<div class="c_side-nav">
		<nav class="s_nav"><?php wp_nav_menu('menu_class=side_menu&theme_location=snav&container=false'); ?></nav>
	</div>
</div>