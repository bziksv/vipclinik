<?php /*
Template name: Услуги
*/ get_header(); ?>


	<div class="c_page serv_page">
		<div class="ins">
			<ul class="serv_link">
				<li><a href="<?php bloginfo('url'); ?>/services/apparatnaja/ultrazvukovoj-smas-lifting-ulthera/">Ультразвуковой SMAS-лифтинг ULTHERA</a></li>
				<li><a href="<?php bloginfo('url'); ?>/services/apparatnaja/gollivudskaya-chistka-i-uxod-hydra-facial/">Голливудская чистка и уход HYDRA FACIAL</a></li>
			</ul>
			<div class="serv_box-allwidth">
				<a href="<?php bloginfo('url'); ?>/services/programma-kompleksnogo-preobrazheniya-yu-life/" class="serv_title">ПРОГРАММА КОМПЛЕКСНОГО ПРЕОБРАЖЕНИЯ YU-LIFE</a>
				<nav class="serv_nav"><?php wp_nav_menu('menu_class=side_menu&theme_location=plastnav&container=false'); ?></nav>
			</div>
			<div class="serv_box-bot">
				<div class="serv_box vrach">
					<a href="<?php bloginfo('url'); ?>/services/vrachebnaja/" class="serv_title">ВРАЧЕБНАЯ КОСМЕТОЛОГИЯ</a>
					<nav class="serv_nav"><?php wp_nav_menu('menu_class=side_menu&theme_location=vrachnav&container=false'); ?></nav>
				</div>

				<div class="serv_box estet">
					<a href="<?php bloginfo('url'); ?>/services/jesteticheskaja/" class="serv_title">ЭСТЕТИЧЕСКАЯ КОСМЕТОЛОГИЯ</a>
					<nav class="serv_nav"><?php wp_nav_menu('menu_class=side_menu&theme_location=estetnav&container=false'); ?></nav>
				</div>

				<div class="serv_box aparat">
					<a href="<?php bloginfo('url'); ?>/services/apparatnaja/" class="serv_title">АППАРАТНАЯ КОСМЕТОЛОГИЯ</a>
					<nav class="serv_nav"><?php wp_nav_menu('menu_class=side_menu&theme_location=aparatnav&container=false'); ?></nav>
				</div>
			</div>

			<div class="serv_box-bot">
				<div class="serv_box2 korekt">
					<a href="<?php bloginfo('url'); ?>/services/korrekciya-figury/" class="serv_title">КОРРЕКЦИЯ <br>ФИГУРЫ</a>
					<nav class="serv_nav"><?php wp_nav_menu('menu_class=side_menu&theme_location=korektnav&container=false'); ?></nav>
				</div>

				<div class="serv_box2 omolozh">
					<a href="<?php bloginfo('url'); ?>/services/obshhee-omolozhenie/" class="serv_title">ОБЩЕЕ <br>ОМОЛОЖЕНИЕ</a>
					<nav class="serv_nav"><?php wp_nav_menu('menu_class=side_menu&theme_location=omolozhnav&container=false'); ?></nav>
				</div>
                                <div class="serv_box2 omolozh">
					<a href="<?php bloginfo('url'); ?>/services/psixologicheskaya-podderzhka//" class="serv_title">ПСИХОЛОГИЧЕСКАЯ <br>ПОДДЕРЖКА</a>
					<nav class="serv_nav"><?php wp_nav_menu('menu_class=side_menu&theme_location=podderzhka&container=false'); ?></nav>
				</div>
			</div>


		</div>
	</div>



<?php if (file_exists(TEMPLATEPATH.'/bottom.php')) {require(TEMPLATEPATH.'/bottom.php');}; ?>

<?php get_footer(); ?>