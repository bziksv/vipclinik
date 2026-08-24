	<div class="social-wigets">
	
	
		<h1 class="ind_vigod-title">Присоединяйтесь к нам в социальных сетях!</h1>
	
		<div class="vk">
			<script type="text/javascript" src="https://vk.com/js/api/openapi.js?159"></script>
			<!-- VK Widget -->
			<div id="vk_groups"></div>
			<script type="text/javascript">
			VK.Widgets.Group("vk_groups", {mode: 3, no_cover: 1, width: "250", color3: '3C699C'}, 17417505);
			</script>
		</div>
<!--		
		<div class="fb">
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.1';
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			<div class="fb-page" data-href="https://www.facebook.com/cvk.vrn/" data-width="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/cvk.vrn/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/cvk.vrn/">Центр Врачебной Косметологии</a></blockquote></div>
		</div>
		
		<div class="instagram">
			<iframe src="https://averin.pro/widget.php?l=baybarina_clinic&style=1&width=250&gallery=1&s=80&icc=3&icr=3&t=1&tt=Мы в Инстаграм&h=1&ttcolor=FFFFFF&th=c3c3c3&bw=f9f9f9&bscolor=FFFFFF&bs=00ccff&ts=Подписаться" allowtransparency="true" frameborder="0" scrolling="no" style="border:none;overflow:hidden;width:250px; height: 180px" ></iframe>
		</div>
-->	
	
	</div>

</main><!-- .content -->

	<footer class="footer" style="padding-top: 15px;">
		<div class="ins">
			<div style="margin-left: 38%;"><a href="/"><img src="https://vipclinik.com/wp-content/uploads/2019/02/logo_w.png"></a></div>
			<div class="f_copy">2019 Все права защищены. <a href="http://i-vanka.ru/" class="f_made" target="_blank">IVANKA</a></div>
<!--<div class="f_copy"><a href="/wp-content/uploads/2017/11/politics.pdf" target="_blank" style="font-size: 10px; color: #9E9D9D; text-decoration: none;">Политика конфиденциальности</a> | <a href="/wp-content/uploads/2017/11/compliance.pdf" target="_blank" style="font-size: 10px; color: #9E9D9D; text-decoration: none;">Согласие на обработку персональных данных</a></div>-->
			<br>
			<div style="color: #9E9D9D; font-size: 11px; line-height: 1.3;">
				Наш сайт использует <a style="color: #fff;" target="_blank" href="/wp-content/uploads/2026/02/cookies-vipclinic.pdf">cookies</a> для обеспечения работоспособности и сбора статистики. С их помощью мы анализируем пользовательскую активность, улучшаем работу сайта и делаем рекламу более релевантной. Оставаясь на сайте, вы даете согласие на обработку ваших персональных данных. Вы можете отключить сохранение cookies в настройках браузера в любой момент. На сайте также применяются <a style="color: #fff;" target="_blank" href="/wp-content/uploads/2026/03/rules-recommendation-vipclinic.pdf">рекомендательные технологии</a>. Подробнее об обработке персональных данных — в соответствующей <a style="color: #fff;" target="_blank" href="/wp-content/uploads/2026/03/personal-data-vipclinic.pdf">Политике</a>.
			</div>
			
		<div style="width: 17%; margin: 0 auto; margin-top: 10px;"><a href="https://prime-ltd.su/?from=https://vipclinik.com/" target="_blank" rel="nofollow"><img src="http://prime-ltd.su/logo/white.svg"></a></div>	
			
			<ul class="f_soc">
<!--				<li class="fb"><a href="https://www.facebook.com/cvk.vrn/?ref=aymt_homepage_panel" target="_blank"></a></li> -->
				<li class="tw"><a href="https://vk.com/baybarina_clinic" target="_blank"></a></li>
<!--				<li class="in"><a href="https://www.instagram.com/baybarina_clinic/" target="_blank"></a></li> -->
                                <li class="yt"><a href="https://www.youtube.com/channel/UC5jzxjV43T4cbFxOgeZ-qEw?view_as=public"target="_blank"></a></li>
			</ul>
		</div>
	</footer><!-- .footer -->

</div><!-- .wrapper -->

<a href="#" class="totop" rel="nofollow">Наверх</a>
<a href="#" class="send_proc" rel="nofollow">Записаться на процедуру</a>



<div class="h_modal send_modal">
	<div class="m_close"></div>
	<div class="m_title">ONLINE запись на процедуру</div>
	<div class="send_modal-form"><?php echo do_shortcode('[contact-form-7 id="4" title="Запись на процедуру"]'); ?></div>

<div class="send_modal-sel-box">
	<div class="send_modal-sel send_modal-sel-15">
		<select name="proced" class="wpcf7-form-control wpcf7-select">
			<?php  $the_page_id = wds_get_ID_by_page_name('PAGE_NAME');
$args = array( 'post_parent' => 15, 'post_type' => 'page', 'post_status' => 'publish' ); 
$query = new WP_Query( $args );
if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); ?>
			<option value="<?php the_title(); ?>"><?php the_title(); ?></option>
<?php } } else {
// Постов не найдено
} wp_reset_postdata(); ?>
		</select>
	</div>

	<div class="send_modal-sel send_modal-sel-30">
		<select name="proced" class="wpcf7-form-control wpcf7-select">
			<?php  $the_page_id = wds_get_ID_by_page_name('PAGE_NAME');
$args = array( 'post_parent' => 30, 'post_type' => 'page', 'post_status' => 'publish' ); 
$query = new WP_Query( $args );
if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); ?>
			<option value="<?php the_title(); ?>"><?php the_title(); ?></option>
<?php } } else {
// Постов не найдено
} wp_reset_postdata(); ?>
		</select>
	</div>

	<div class="send_modal-sel send_modal-sel-46">
		<select name="proced" class="wpcf7-form-control wpcf7-select">
			<?php  $the_page_id = wds_get_ID_by_page_name('PAGE_NAME');
$args = array( 'post_parent' => 46, 'post_type' => 'page', 'post_status' => 'publish' ); 
$query = new WP_Query( $args );
if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); ?>
			<option value="<?php the_title(); ?>"><?php the_title(); ?></option>
<?php } } else {
// Постов не найдено
} wp_reset_postdata(); ?>
		</select>
	</div>
</div>

</div>




<!--div class="pop-up">
	<div class="pop-up-box">
		<a href="#" class="close-button close-x">&#10006;</a>
		<h3>ДОРОГИЕ ДРУЗЬЯ!</h3>
		<div class="c_txt">
			<p>Сообщаем Вам - с 1 АПРЕЛЯ 2016 года, с связи с переездом ООО "Центр Врачебной Косметологии"- Елены Тимошенко, ранее расположенного по адресу ул Студенческая д.12а,офис 1 - изменился фактический адрес:</p>
			<p>Новые адреса: <br>г. Воронеж,ул. Алексеевского д.17 <br>Телефоны: <br>251-51-85 <br>255-52-07</p>

<p>г. Воронеж,ул Большая Стрелецкая,д.20б <br> Телефоны: <br>220-82-31 <br>220-82-32 </p>
			
			<a href="#" class="close-button close-btn">Закрыть</a>
		</div>
	</div>
</div-->
<? do_shortcode('[show_popup]'); ?>
<? do_shortcode('[show_popup_8]'); ?>

<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="//yandex.st/jquery/cookie/1.0/jquery.cookie.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.easing-1.3.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.mousewheel-3.1.12.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.maskedinput.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.jcarousellite.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/swfobject.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/newyear.js"></script> 

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/wickedpicker/wickedpicker.min.css"/>
<script src="<?php bloginfo('template_directory'); ?>/wickedpicker/wickedpicker.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/main.js"></script>







<?php wp_footer(); ?>





<!-- Yandex.Metrika counter от Prime -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter39503185 = new Ya.Metrika({
                    id:39503185,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/39503185" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<script type="text/javascript" src="https://w1124172.yclients.com/widgetJS" charset="UTF-8" async></script>

</body>
</html>