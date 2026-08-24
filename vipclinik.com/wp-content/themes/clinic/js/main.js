(function($) {
$(function() {
	
	$('input[name="time"]').wickedpicker({
        title: 'Время звонка', //The Wickedpicker's title,
        twentyFour : true,
    });
	
	window.onscroll = function() {
		$('.wickedpicker__close').click();
		return false;
	}


	$('input[type="tel"]').mask("9(999) 999-99-99");


/* Всплывающее меню и заказ процедуры  */
	$('.h_top-nav').click(function(event) {
		$('.h_modal-nav, .bg').addClass('active');
		event.preventDefault();
	});

	$('.send_proc').click(function(event) {
		$('.send_modal, .bg').addClass('active');
		updateCf7ConsentLabels();
		event.preventDefault();
	});

	$('.m_close, .bg').click(function(event) {
		$('.h_modal, .bg').removeClass('active');
		event.preventDefault();
	});

/*	$('.pop-up').hide();
	if (!$.cookie('was')) {
		$('.pop-up').fadeIn(1000);
		$('.bg').addClass('active');
		$('.close-button, .bg').click(function(e) {
			$('.pop-up').fadeOut(700);
			$('.bg').removeClass('active');
			$('.pop-up').hide();
			e.preventDefault();
		});
	}

	// Запомним в куках, что посетитель к нам уже заходил
	$.cookie('was', true, {
		expires: 1, path: '/'
	});
*/

/* Выбор выпадающего списка в форме заказа   */
	$('.wpcf7-form-control-wrap.napr select').change(function(){
         var naprSelect = $('.wpcf7-form-control-wrap.napr select :selected').val();
         if( naprSelect == "ВРАЧЕБНАЯ КОСМЕТОЛОГИЯ" ) {
         	$('.wpcf7-form-control-wrap.proced').html( $('.send_modal-sel-15') );
         } else if( naprSelect == "ЭСТЕТИЧЕСКАЯ КОСМЕТОЛОГИЯ" ) {
         	$('.wpcf7-form-control-wrap.proced').html( $('.send_modal-sel-30') );
         } else if( naprSelect == "АППАРАТНАЯ КОСМЕТОЛОГИЯ" ) {
         	$('.wpcf7-form-control-wrap.proced').html( $('.send_modal-sel-46') );
         } else if( naprSelect == "ПЛАСТИЧЕСКАЯ ХИРУРГИЯ" ) {
         	$('.wpcf7-form-control-wrap.proced').html( $('.send_modal-sel-3200') );
         } else {

         }
    });




	$('ul.ind_serv-tabs__caption').each(function() {
		$(this).find('li').each(function(i) {
			$(this).click(function(){
			$(this).addClass('active').siblings().removeClass('active')
				.closest('div.ind_serv-tabs').find('div.ind_serv-tabs__content').removeClass('active').eq(i).addClass('active');
			});
		});
	});


	$(".ind_serv-tabs-carousel1").jCarouselLite({ btnNext: ".ind_serv-tabs-prev1", btnPrev: ".ind_serv-tabs-next1", auto: 5000, speed: 600 });
	$(".ind_serv-tabs-carousel2").jCarouselLite({ btnNext: ".ind_serv-tabs-prev2", btnPrev: ".ind_serv-tabs-next2", auto: 5000, speed: 600 });
	$(".ind_serv-tabs-carousel3").jCarouselLite({ btnNext: ".ind_serv-tabs-prev3", btnPrev: ".ind_serv-tabs-next3", auto: 5000, speed: 600 });
	$(".ind_serv-tabs-carousel4").jCarouselLite({ btnNext: ".ind_serv-tabs-prev4", btnPrev: ".ind_serv-tabs-next4", auto: 5000, speed: 600 });
	$(".ind_serv-tabs-carousel5").jCarouselLite({ btnNext: ".ind_serv-tabs-prev5", btnPrev: ".ind_serv-tabs-next5", auto: 5000, speed: 600 });
	$(".ind_serv-tabs-carousel6").jCarouselLite({ btnNext: ".ind_serv-tabs-prev6", btnPrev: ".ind_serv-tabs-next6", auto: 5000, speed: 600 });

// страница товара
	$('.minus').click(function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $('.plus').click(function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });

	$('ul.tabs_tovar').each(function() {
		$(this).find('li').each(function(i) {
			$(this).click(function(){
				$(this).addClass('active').siblings().removeClass('active')
					.closest('div.tabs').find('div.tabs_tovar-content').removeClass('active').eq(i).addClass('active');
			});
		});
	});


 /*   $('.s_nav > ul > li').hover(function() {
    	$(this).children('.sub-menu').show('slow');
    }, function() {
    	$(this).children('.sub-menu').hide('slow');
    });
*/

	$('.s_nav > ul > li.current-menu-item ul.sub-menu, .s_nav > ul > li.current-menu-ancestor ul.sub-menu').show().addClass('active');

 
/*    $('.s_nav > ul > li').on({
        mouseenter: function () {
            $(this).find('.sub-menu').finish().slideDown();
        },
        mouseleave: function () {
            $(this).find('.sub-menu').finish().slideUp();
        }
    });
*/


    $(window).scroll(function () {
        if ($(this).scrollTop() > 400) {
            $('.totop').fadeIn();
        } else {
            $('.totop').fadeOut();
        }
    });
    $('.totop').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 600);
        return false;
    });


});
})(jQuery);


// одинаковая высота колонок
function setEqualHeight(columns){
	var tallestcolumn = 0;
	columns.each(
	function(){
		currentHeight = $(this).height();
		if(currentHeight > tallestcolumn) {
			tallestcolumn = currentHeight;
		}
	});
	columns.height(tallestcolumn);
}


var hwSlideSpeed = 800;
var hwTimeOut = 9000;
var hwNeedLinks = true;

function updateCf7ConsentLabels() {
	var docs = window.clinicLegalDocs || {};
	var consentUrl = docs.consent || '/wp-content/documents/consent.pdf';
	var policyUrl = docs.policy || '/wp-content/documents/personal-data.pdf';
	var consentLabel = 'Нажимая на кнопку, вы даете <a href="' + consentUrl + '" target="_blank">согласие на обработку ваших персональных данных</a> и подтверждаете, что ознакомлены с <a target="_blank" href="' + policyUrl + '">политикой обработки персональных данных</a>.';
	jQuery('.wpcf7-checkbox input[type="checkbox"]').prop('checked', false).removeAttr('checked');
	jQuery('.wpcf7-checkbox .wpcf7-list-item-label').html(consentLabel);
}

jQuery(document).ready(function($) {

	updateCf7ConsentLabels();
	//$('#billing_new_fild11').attr('checked', 'checked');//

	var cont_top;
	$('.send_proc').on('click', function(){
		/*cont_top = window.pageYOffset ? window.pageYOffset : document.body.scrollTop;
		$('.h_modal').css('top', cont_top);*/
		$("html").animate({"scrollTop":0},"slow");
	});

	/*$( window ).scroll(function() {
	 	cont_top = window.pageYOffset ? window.pageYOffset : document.body.scrollTop;
	 	$('.h_modal').css('top', cont_top);
	});*/

	$('.slide').css(
		{"position" : "absolute",
		 "top":'0', "left": '0'}).hide().eq(0).show();
	var slideNum = 0;
	var slideTime;
	slideCount = $("#slider .slide").size();
	var animSlide = function(arrow){
		clearTimeout(slideTime);
		$('.slide').eq(slideNum).fadeOut(hwSlideSpeed);
		if(arrow == "next"){
			if(slideNum == (slideCount-1) ) {slideNum=0;}
			else{slideNum++}
		} else if(arrow == "prew") {
			if(slideNum == 0){slideNum=slideCount-1;}
			else{slideNum-=1}
		} else {
			slideNum = arrow;
		}
		$('.slide').eq(slideNum).fadeIn(hwSlideSpeed, rotator);
		$(".control-slide.active").removeClass("active");
		$('.control-slide').eq(slideNum).addClass('active');
		
	}
if(hwNeedLinks){
var $linkArrow = $('<a id="prewbutton" href="#">&lt;</a><a id="nextbutton" href="#">&gt;</a>')
	.prependTo('#slider');		
	$('#nextbutton').click(function(){
		animSlide("next");
		return false;
		})
	$('#prewbutton').click(function(){
		animSlide("prew");
		return false;
		})
}
	var $adderSpan = '';
	$('.slide').each(function(index) {
		var indexNum = index+1;
		$adderSpan += '<span class = "control-slide">Новинка 0' + indexNum + '</span>';

	});
	$('<div class ="sli-links">' + $adderSpan +'</div>').appendTo('#slider-wrap');
	$(".control-slide:first").addClass("active");
	$('.control-slide').click(function(){
	var goToNum = parseFloat($(this).text());
	animSlide(goToNum);
	});

	//$('<div class="slide-num">' + numslideNum + '/' + slideCount +'</div>').appendTo('#slider-wrap');
	var pause = false;
	var rotator = function(){
			if(!pause){slideTime = setTimeout(function(){animSlide('next')}, hwTimeOut);}
			}
	$('#slider-wrap').hover(	
		function(){clearTimeout(slideTime); pause = true;},
		function(){pause = false; rotator();
		});
	rotator();


// одинаковая высота колонок
	setEqualHeight($(".serv_box"));
	setEqualHeight($(".serv_box2"));
});


	document.addEventListener( 'wpcf7submit', function( event ) {
		var inputs = event.detail.inputs;
		$.each( inputs, function( i, val ) {
			if(val.name == "email"){
				$.post("/wp-content/themes/clinic/vendor/sendpulse-rest-api-php/", { email: val.value});
				return false;
			}
		});
		
	}, false );




