jQuery(document).ready(function(e){e(".categorypicker").length>0&&e(".course-layout-switcher").length>0&&e(".categorypicker").append(e(".course-layout-switcher")),e("#frontpage-available-course-list").length>0&&e(".course-layout-switcher").length>0&&e("#frontpage-available-course-list").prepend(e(".course-layout-switcher")),e("#frontpage-course-list").length>0&&e(".course-layout-switcher").length>0&&e("#frontpage-course-list").prepend(e(".course-layout-switcher")),function(){var a="courses_layout",t=e(".course-layout-switcher"),s=t.find(">a"),o={expires:3,path:"/"};if(!e(".course-layout-switcher").length)return;"grid"===Cookies.get(a)?(e("body").addClass("course-layout-grid"),s.removeClass("active"),t.find(".grid-layout").addClass("active")):"list"===Cookies.get(a)&&(e("body").removeClass("course-layout-grid"),s.removeClass("active"),t.find(".list-layout").addClass("active"));s.click(function(t){t.preventDefault(),e(this).hasClass("grid-layout")&&!e("body").hasClass("course-layout-grid")?(e("body").addClass("course-layout-grid"),s.removeClass("active"),e(this).addClass("active"),Cookies.remove(a),Cookies.set(a,"grid",o)):e(this).hasClass("list-layout")&&e("body").hasClass("course-layout-grid")&&(e("body").removeClass("course-layout-grid"),s.removeClass("active"),e(this).addClass("active"),Cookies.remove(a),Cookies.set(a,"list",o))})}(),e("body").hasClass("pagelayout-login")&&e("#login").append(e(".potentialidps")),e(".potentialidp a").each(function(){var a=e(this).attr("title");e(this).attr("class",""),e(this).addClass("btn btn-"+a.toLowerCase())});var a="layout_sidebars",t={expires:3,path:"/"},s=e(".theme-hide-sidebar"),o=s.data("showtext"),l=s.data("hidetext");"hidden"===Cookies.get(a)?(e("body").addClass("hide-sidebars"),s.text(o)):"shown"===Cookies.get(a)&&(e("body").removeClass("hide-sidebars"),s.text(l)),s.click(function(s){e("body").hasClass("editing")||(e("body").hasClass("hide-sidebars")?(e("body").removeClass("hide-sidebars"),e(this).text(l),Cookies.remove(a),Cookies.set(a,"shown",t)):(e("body").addClass("hide-sidebars"),e(this).text(o),Cookies.remove(a),Cookies.set(a,"hidden",t))),s.preventDefault()}),e(".row-fluid").each(function(){e(this).addClass("row");var a=e(this).find(">div"),t=0;a.each(function(){for(t=0;t<=12;t++)a.hasClass("span"+t)&&(a.removeClass("span"+t),a.addClass("col-sm-"+t))})}),e(".theme-slider,.mb2-pb-content-list.owl-carousel").each(function(){slider=e(this),function(a){isItems=a.data("items"),isMargin=a.data("margin"),isLoop=0!=a.data("loop"),isNav=0!=a.data("nav"),isDots=0!=a.data("dots"),isAutoplay=0!=a.data("autoplay"),isPauseTime=a.data("pausetime"),isAnimTime=a.data("animtime");var t=isItems>2?2:isItems,s=isItems>3?3:isItems,o=isItems>5?5:isItems;isRes={0:{items:1},600:{items:t},780:{items:s},1000:{items:o}};var i=e("body").hasClass("dir-rtl"),l=!1,n=['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'];i&&(l=!0,n=['<i class="fa fa-angle-right"></i>','<i class="fa fa-angle-left"></i>']);(function e(){if("function"!=typeof a.owlCarousel)return setTimeout(e,100),!1;return!0})()&&a.owlCarousel({items:isItems,margin:isMargin,loop:isLoop,nav:isNav,rtl:l,dots:isDots,autoplay:isAutoplay,responsive:isRes,autoplayHoverPause:!0,autoplayTimeout:isPauseTime,smartSpeed:isAnimTime,navText:n})}(slider)});var n=e(".theme-scrolltt"),r=n.data("scrollspeed");function d(){e(".theme-table-wrap").each(function(){e(this).find(">table").width()>e(this).width()?e(this).addClass("wider"):e(this).removeClass("wider")})}e(window).on("scroll",function(){e(this).scrollTop()>500?n.addClass("active"):n.removeClass("active")}),n.click(function(a){a.preventDefault(),e("html, body").stop().animate({scrollTop:0},r)}),e("body").hasClass("path-admin-setting")&&e(".mb2tmpl-acc-title").each(function(){e(this).click(function(a){e(this).toggleClass("active"),e(this).parent().find("> div").slideToggle(150)})}),e("table").wrap('<div class="theme-table-wrap"></div>'),e(".generaltable, .forumheaderlist, table.userenrolment").addClass("table table-striped"),e("table.collection").addClass("table table-bordered"),e("table.preference-table").addClass("table table-bordered"),e("table.rolecap").addClass("table table-bordered"),e("#categoryquestions").addClass("table table-striped"),d(),e(window).on("resize",function(){d()}),e(".embed-video-bg").each(function(){var a=e(this);a.parent().find(">i").on("click",function(t){a.parent().find("iframe").attr("src",a.data("videourl")),e(this).fadeOut(350),a.fadeOut(350),t.preventDefault()})}),e(".alert-error").addClass("alert-danger"),e(".box.notifyproblem").addClass("alert"),e(".box.notifyproblem").addClass("alert-danger"),e(".box.notifyproblem").removeClass("notifyproblem"),e(".nav-tabs .nav-link").each(function(){e(this).hasClass("active")&&e(this).parent().addClass("active")}),e(".block-region").each(function(){var a='<span class="region-name">'+e(this).data("blockregion")+"</span>";e("body").hasClass("editing")&&e(this).append(a)}),e(".theme-ddmenu").each(function(){var a=e(this),t=a.data("animtype"),s=a.data("animspeed"),o=a.find(".mobile-arrow");function i(e){(window.innerWidth||document.documentElement.clientWidth||document.body.clientWidth)<=768?(e.removeClass("sf-js-enabled"),e.removeClass("desk-menu"),e.addClass("mobile-menu")):(e.addClass("sf-js-enabled"),e.removeClass("mobile-menu"),e.addClass("desk-menu"),e.find(".mobile-arrow").removeClass("active"),e.find(".mobile-arrow").parent().siblings("ul").hide())}(function e(){return"function"==typeof a.superfish||(setTimeout(e,100),!1)})()&&a.superfish({popUpSelector:"ul",hoverClass:"mb2ctm-hover",animation:2==t?{height:"show"}:{opacity:"show"},speed:s,speedOut:"fast",cssArrows:!1}),i(a),e(window).on("resize",function(){i(a)}),o.click(function(a){a.preventDefault(),e(this).parent().siblings("ul").slideToggle(250),e(this).toggleClass("active")})}),e(document).on("click",".show-menu",function(a){a.preventDefault(),e(this).parent().parent().find(".theme-ddmenu").slideToggle(250)});var m=e(".theme-loginform").find(".usertext"),h=e(".theme-loginform").find(".welcome_userpicture").parent();function c(){var a=e(window),t=e(".sticky-nav-element-offset");if(0!=t.length&&e("body").hasClass("sticky-nav")){var s=e("#main-navigation"),o=(s.parent(),t.offset().top),i=s.outerHeight(!0);a.scrollTop()>o?(s.addClass("sticky-nav-element"),t.css({height:i})):(s.removeClass("sticky-nav-element"),t.css({height:0}))}}h.append(m),h.click(function(e){e.preventDefault()}),setTimeout(function(){c()},10),e(window).scroll(function(){c()}),e("input.mb2color").each(function(){e(this).spectrum({showInput:!0,showButtons:!1,preferredFormat:"rgb",allowEmpty:!0,color:"",showAlpha:!0})});var u=e("#theme-iconnav").height();function f(){e("#page-outer").css({"min-height":e(window).height()})}e("#theme-iconnav").css({"margin-top":Math.ceil(u/2*-1)}),e("#theme-iconnav li").each(function(){var a=e(this).find("a"),t=e(this).find("span.iconnavtext"),s=e("body").hasClass("dir-rtl");a.hover(function(){s?t.stop().animate({left:"100%"},300):t.stop().animate({right:"100%"},300)},function(){s?t.stop().animate({left:-500},150):t.stop().animate({right:-500},150)})}),f(),e(window).on("resize",function(){f()}),e('label[for="jump-to-activity"]').closest(".m-t-2").addClass("activity-nav"),e(".header-tools > a.header-tools-jslink").click(function(a){a.preventDefault(),e(this).hasClass("tool-links")?(e(".theme-loginform").hide(),e(".theme-searchform").hide(),e(".theme-links").show(),e(".tool-search").removeClass("active"),e(".tool-login").removeClass("active")):e(this).hasClass("tool-login")?(e(".theme-loginform").show(),e(".theme-searchform").hide(),e(".theme-links").hide(),e(".tool-links").removeClass("active"),e(".tool-search").removeClass("active")):(e(".theme-loginform").hide(),e(".theme-searchform").show(),e(".theme-links").hide(),e(".tool-links").removeClass("active"),e(".tool-login").removeClass("active")),function(){var a=e(".sliding-panel");a.hasClass("closed")&&(v(),a.stop().animate({"margin-top":0},350),a.removeClass("closed"),a.addClass("open"))}();var t=e(".sliding-panel");t.hasClass("open")&&e(this).hasClass("active")&&p(),t.hasClass("open")&&e(this).addClass("active")});var b=e(window).width();function v(){var a=e(".sliding-panel");a.find("btn");a.css({"margin-top":Math.ceil(-1*(a.height()+1))})}function p(){var a=e(".sliding-panel");a.hasClass("open")&&(a.stop().animate({"margin-top":Math.ceil(-1*(e(".sliding-panel").height()+1))},350),a.removeClass("open"),a.addClass("closed"),e(".header-tools a").removeClass("active"))}v(),e(window).on("resize",function(){b!=e(window).width()&&(p(),v()),delete b}),e(".sectionname").each(function(){var a=e(this).find(">span>a").text();e("body").hasClass("editing")||" "!==a||e(this).hide()}),e("#theme-bookmarks-form").submit(function(a){var t=e(this),s=t.find("#mb2bkcreateurl").val();e.ajax({type:"GET",url:s,data:t.serialize(),beforeSend:function(){e("#theme-bookmarks-modal").find(".loading-bg").fadeIn(250),e("#theme-bookmarks-modal").find(".theme-bookmarks-save").attr("disabled","disabled")},error:function(a,t,s){setTimeout(function(){e("#theme-bookmarks-modal").find(".loading-bg").fadeOut(250),e("#theme-bookmarks-modal").find(".theme-bookmarks-save").removeAttr("disabled"),alert(a.responseText)},800)},success:function(a){if(e.isArray(a)){var t=function(a){var t="",s=[];for(i=0;i<a.length;i++){var o=a[i].split(";"),l=e("#theme-bookmarks-form").data("rooturl"),n=e("#theme-bookmarks-form").data("pageurl"),r=e("#theme-bookmarks-form").data("pagetitle"),d=e("#theme-bookmarks-form").data("bookmarkthispage"),m=e("#theme-bookmarks-form").data("unbookmarkthispage");o[0]&&(t+='<li data-url="'+o[0]+'">',t+='<a class="bookmark-link" href="'+l+o[0]+'">'+o[1]+"</a>",t+='<span class="theme-bookmarks-action">',t+='<a href="#" class="theme-bookmarks-form bookmark-edit" data-url="'+o[0]+'" data-mb2bktitle="'+o[1]+'" data-toggle="modal" data-target="#theme-bookmarks-modal"><i class="fa fa-pencil"></i></a>',t+='<a href="#" class="theme-bookmarks-form bookmark-delete" data-url="'+o[0]+'" data-mb2bktitle="'+o[1]+'"><i class="fa fa-times"></i></a>',t+="</span>",t+="</li>",s[i]=o[0])}var h=e.inArray(n,s),c="",u=' data-toggle="modal" data-target="#theme-bookmarks-modal"',f=d;h>-1&&(c=" bookmark-delete",f=m,u="");return t+='<li class="theme-bookmarks-add">',t+='<a href="#" class="theme-bookmarks-form'+c+'" data-url="'+n+'" data-mb2bktitle="'+r+'"'+u+">",t+=f,t+="</a>",t+="</li>"}(a);e("ul.theme-bookmarks").html(t)}else alert(a);setTimeout(function(){e("#theme-bookmarks-modal").find(".loading-bg").fadeOut(250),e("#theme-bookmarks-modal").find(".theme-bookmarks-save").removeAttr("disabled")},800)}}),a.preventDefault()}),e(document).on("click",".theme-bookmarks-save",function(a){e("#theme-bookmarks-form").submit(),a.preventDefault()}),e(document).on("click",".theme-bookmarks-form",function(a){e("#mb2bkurl").val(e(this).data("url")),e("#mb2bktitle").val(e(this).data("mb2bktitle"));var t=e('li[data-url="'+e(this).data("url")+'"]');e(this).hasClass("bookmark-delete")?(e("#bkupdate").val(0),e("#bkdelete").val(1),e("#theme-bookmarks-form").submit()):e(this).hasClass("bookmark-edit")?(e("#bkdelete").val(0),e("#bkupdate").val(1)):t.length>0?(e("#bkdelete").val(0),e("#bkupdate").val(1),e("#mb2bktitle").val(t.find(">a").html())):(e("#bkdelete").val(0),e("#bkupdate").val(0)),a.preventDefault()})}),function(e){e(window).on("load",function(){var a=e(".loading-scr");setTimeout(function(){a.fadeOut(150)},a.data("hideafter"))})}(jQuery);
