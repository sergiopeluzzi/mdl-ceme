// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package		Mb2 Slider
 * @author		Mariusz Boloz (http://mb2extensions.com)
 * @copyright	Copyright (C) 2017 Mariusz Boloz (http://mb2extensions.com). All rights reserved
 * @license		Commercial (http://codecanyon.net/licenses)
**/



jQuery(document).ready(function($){


	var timerClick;



	var prevSlide = null;

	$('.mb2slider').each(function(){

		var module = $(this);
		var slideList = $(this).find('.mb2slider-slide-list');
		var slideItem = slideList.find('.mb2slider-slide-item');
		var captionDiv = slideItem.find('.mb2slider-caption');
		var slideLstItem = slideList.find('>li');
		var nextSlideLink = slideList.find('.mb2slider-nextslide');
		var prevSlideLink = slideList.find('.mb2slider-prevslide');

		var slidesCount = slideList.data('slidescount');
		var modId = slideList.data('modid');
		var slideMode = slideList.data('mode');
		var slideAuto = slideList.data('auto')==1 ? true : false;
		var slideSpeed = slideList.data('aspeed');
		var slideItems = slideList.data('items');
		var slideMargin = slideList.data('margin');
		var slideItemsMove = slideList.data('moveitems')>slideItems ? slideItems : slideList.data('moveitems');
		var slidePause = slideList.data('apause');
		var slideKeyPress = slideList.data('kpress')==1 ? true : false;
		var slideLoop = slideList.data('loop')==1 ? true : false;
		var slideAheight = slideList.data('aheight')==1 ? true : false;
		var slidePager = slideList.data('pager')==1 ? true : false;
		var slideControls = slideList.data('control')==1 ? true : false;


		var isRtl = $('body').hasClass('dir-rtl') ? true : false;
		var prevClass = isRtl ? 'mb2slider_icon-right-open' : 'mb2slider_icon-left-open';
		var nextClass = isRtl ? 'mb2slider_icon-left-open' : 'mb2slider_icon-right-open';


		var resTabletItems = slideItems>2 ? 2 : slideItems;
		var res = slideItems>1 ? [{breakpoint:768,settings:{item:resTabletItems,slideMove:1}},{breakpoint:480,settings:{item:1,slideMove:1}}] : [];


		function waitForLightSliderMb2()
		{
			if (typeof slideList.lightSliderMb2 !== 'function')
			{
				setTimeout( waitForLightSliderMb2, 100);
				return false;
			}

			return true;
		}

		var is_lightslider = waitForLightSliderMb2();


		if (is_lightslider && slidesCount > 1)
		{
			slideList.lightSliderMb2({

				slidesVisible: false,

				item: slideItems,
				autoWidth: false,
				slideMove: slideItemsMove, // slidemove will be 1 if loop is true
				slideMargin: slideMargin,

				addClass: '',
				mode: slideMode,
				useCSS: true,
				cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',//
				easing: 'linear', //'for jquery animation',////

				speed: slideSpeed, //ms'
				auto: slideAuto,
				loop: slideLoop,
				slideEndAnimation: true,
				pause: slidePause,

				keyPress: slideKeyPress,
				controls: slideControls,
				prevHtml: '<span class="'+prevClass+'"></span>',
				nextHtml: '<span class="'+nextClass+'"></span>',

				rtl: isRtl,
				adaptiveHeight:slideAheight,

				vertical:false,
				verticalHeight:500,
				vThumbWidth:100,
				pauseOnHover:true,

				thumbItem:10,
				pager: slidePager,
				gallery: false,
				galleryMargin: 5,
				thumbMargin: 5,
				currentPagerPosition: 'middle',

				enableTouch:true,
				enableDrag:true,
				freeMove:true,
				swipeThreshold: 40,

				responsive : res,

				onBeforeStart: function (el) {},
				onSliderLoad: function (el) {canim()},
				onAfterSlide: function (el) {canim()},
				onBeforeSlide: function (el) {creanim()},
				onBeforeNextSlide: function (el) {},
				onBeforePrevSlide: function (el) {},
				onAfterReset: function(el){canim()}

			});

			nextSlideLink.click(function(e){
				e.preventDefault();
				slideList.goToNextSlide();
			});


			prevSlideLink.click(function(e){
				e.preventDefault();
				slideList.goToPrevSlide();
			});

		}


		function canim () {



			var li = $('.mb2slider' + modId + ' .lslide.active');
			var caption = li.find('.mb2slider-caption');



			if (!li.hasClass('active'))
			{

				caption.stop().animate({top:15,bottom:-15,opacity:0},0);


			}
			else
			{
				if (caption.hasClass('anim1'))
				{

					caption.stop().animate({top:0,bottom:0,opacity:1},350);


				}
			}


		}


		function creanim() {
			var caption = $('.mb2slider' + modId + ' .mb2slider-caption');

			if (caption.hasClass('anim1'))
			{
				caption.stop().animate({top:15,bottom:-15,opacity:0},150);
			}
		}








		deviceClass(module);
		$(window).on('resize',function(){
			deviceClass(module);
		});


		function deviceClass(slider) {



			var ww = $(window).width();

			if (ww<=768)
			{
				slider.addClass('mb2slider-mobile');
				slider.removeClass('mb2slider-desktop');
			}
			else
			{
				slider.removeClass('mb2slider-mobile');
				slider.addClass('mb2slider-desktop');
			}


		}



	});










});
