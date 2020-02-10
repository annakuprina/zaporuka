(function(e){e.fn.hoverIntent=function(t,n,r){var i={interval:100,sensitivity:7,timeout:0};if(typeof t==="object"){i=e.extend(i,t)}else if(e.isFunction(n)){i=e.extend(i,{over:t,out:n,selector:r})}else{i=e.extend(i,{over:t,out:t,selector:n})}var s,o,u,a;var f=function(e){s=e.pageX;o=e.pageY};var l=function(t,n){n.hoverIntent_t=clearTimeout(n.hoverIntent_t);if(Math.abs(u-s)+Math.abs(a-o)<i.sensitivity){e(n).off("mousemove.hoverIntent",f);n.hoverIntent_s=1;return i.over.apply(n,[t])}else{u=s;a=o;n.hoverIntent_t=setTimeout(function(){l(t,n)},i.interval)}};var c=function(e,t){t.hoverIntent_t=clearTimeout(t.hoverIntent_t);t.hoverIntent_s=0;return i.out.apply(t,[e])};var h=function(t){var n=jQuery.extend({},t);var r=this;if(r.hoverIntent_t){r.hoverIntent_t=clearTimeout(r.hoverIntent_t)}if(t.type=="mouseenter"){u=n.pageX;a=n.pageY;e(r).on("mousemove.hoverIntent",f);if(r.hoverIntent_s!=1){r.hoverIntent_t=setTimeout(function(){l(n,r)},i.interval)}}else{e(r).off("mousemove.hoverIntent",f);if(r.hoverIntent_s==1){r.hoverIntent_t=setTimeout(function(){c(n,r)},i.timeout)}}};return this.on({"mouseenter.hoverIntent":h,"mouseleave.hoverIntent":h},i.selector)}})(jQuery);;(function(e){var t=function(){var t={bcClass:"sf-breadcrumb",menuClass:"sf-js-enabled",anchorClass:"sf-with-ul",menuArrowClass:"sf-arrows"},n=/iPhone|iPad|iPod/i.test(navigator.userAgent),r=function(){var e=document.documentElement.style;return"behavior"in e&&"fill"in e&&/iemobile/i.test(navigator.userAgent)}(),i=function(){if(n){e(window).load(function(){e("body").children().on("click",e.noop)})}}(),s=function(e,n){var r=t.menuClass;if(n.cssArrows){r+=" "+t.menuArrowClass}e.toggleClass(r)},o=function(n,r){return n.find("li."+r.pathClass).slice(0,r.pathLevels).addClass(r.hoverClass+" "+t.bcClass).filter(function(){return e(this).children("ul").hide().show().length}).removeClass(r.pathClass)},u=function(e){e.children("a").toggleClass(t.anchorClass)},a=function(e){var t=e.css("ms-touch-action");t=t==="pan-y"?"auto":"pan-y";e.css("ms-touch-action",t)},f=function(t,i){var s="li:has(ul)";if(e.fn.hoverIntent&&!i.disableHI){t.hoverIntent(c,h,s)}else{t.on("mouseenter.superfish",s,c).on("mouseleave.superfish",s,h)}var o="MSPointerDown.superfish";if(!n){o+=" touchend.superfish"}if(r){o+=" mousedown.superfish"}t.on("focusin.superfish","li",c).on("focusout.superfish","li",h).on(o,"a",l)},l=function(t){var n=e(this),r=n.siblings("ul");if(r.length>0&&r.is(":hidden")){n.one("click.superfish",false);if(t.type==="MSPointerDown"){n.trigger("focus")}else{e.proxy(c,n.parent("li"))()}}},c=function(){var t=e(this),n=v(t);clearTimeout(n.sfTimer);t.siblings().superfish("hide").end().superfish("show")},h=function(){var t=e(this),r=v(t);if(n){e.proxy(p,t,r)()}else{clearTimeout(r.sfTimer);r.sfTimer=setTimeout(e.proxy(p,t,r),r.delay)}},p=function(t){t.retainPath=e.inArray(this[0],t.$path)>-1;this.superfish("hide");if(!this.parents("."+t.hoverClass).length){t.onIdle.call(d(this));if(t.$path.length){e.proxy(c,t.$path)()}}},d=function(e){return e.closest("."+t.menuClass)},v=function(e){return d(e).data("sf-options")};return{hide:function(t){if(this.length){var n=this,r=v(n);if(!r){return this}var i=r.retainPath===true?r.$path:"",s=n.find("li."+r.hoverClass).add(this).not(i).removeClass(r.hoverClass).children("ul"),o=r.speedOut;if(t){s.show();o=0}r.retainPath=false;r.onBeforeHide.call(s);s.stop(true,true).animate(r.animationOut,o,function(){var t=e(this);r.onHide.call(t)})}return this},show:function(){var e=v(this);if(!e){return this}var t=this.addClass(e.hoverClass),n=t.children("ul");e.onBeforeShow.call(n);n.stop(true,true).animate(e.animation,e.speed,function(){e.onShow.call(n)});return this},destroy:function(){return this.each(function(){var n=e(this),r=n.data("sf-options"),i=n.find("li:has(ul)");if(!r){return false}clearTimeout(r.sfTimer);s(n,r);u(i);a(n);n.off(".superfish").off(".hoverIntent");i.children("ul").attr("style",function(e,t){return t.replace(/display[^;]+;?/g,"")});r.$path.removeClass(r.hoverClass+" "+t.bcClass).addClass(r.pathClass);n.find("."+r.hoverClass).removeClass(r.hoverClass);r.onDestroy.call(n);n.removeData("sf-options")})},init:function(n){return this.each(function(){var r=e(this);if(r.data("sf-options")){return false}var i=e.extend({},e.fn.superfish.defaults,n),l=r.find("li:has(ul)");i.$path=o(r,i);r.data("sf-options",i);s(r,i);u(l);a(r);f(r,i);l.not("."+t.bcClass).superfish("hide",true);i.onInit.call(this)})}}}();e.fn.superfish=function(n,r){if(t[n]){return t[n].apply(this,Array.prototype.slice.call(arguments,1))}else if(typeof n==="object"||!n){return t.init.apply(this,arguments)}else{return e.error("Method "+n+" does not exist on jQuery.fn.superfish")}};e.fn.superfish.defaults={hoverClass:"sfHover",pathClass:"overrideThisToUse",pathLevels:1,delay:800,animation:{opacity:"show"},animationOut:{opacity:"hide"},speed:"normal",speedOut:"fast",cssArrows:true,disableHI:false,onInit:e.noop,onBeforeShow:e.noop,onShow:e.noop,onBeforeHide:e.noop,onHide:e.noop,onIdle:e.noop,onDestroy:e.noop};e.fn.extend({hideSuperfishUl:t.hide,showSuperfishUl:t.show})})(jQuery);;(function(e){e.fn.supersubs=function(t){var n=e.extend({},e.fn.supersubs.defaults,t);return this.each(function(){var t=e(this);var r=e.meta?e.extend({},n,t.data()):n;$ULs=t.find("ul").show();var i=e('<li id="menu-fontsize">&#8212;</li>').css({padding:0,position:"absolute",top:"-999em",width:"auto"}).appendTo(t)[0].clientWidth;e("#menu-fontsize").remove();$ULs.each(function(t){var n=e(this);var s=n.children();var u=s.children("a");var a=s.css("white-space","nowrap").css("float");n.add(s).add(u).css({"float":"none",width:"auto"});var f=n[0].clientWidth/i;f+=r.extraWidth;if(f>r.maxWidth){f=r.maxWidth}else if(f<r.minWidth){f=r.minWidth}f+="em";n.css("width",f);s.css({"float":a,width:"100%","white-space":"normal"}).each(function(){var t=e(this).children("ul");var n=t.css("left")!==undefined?"left":"right";t.css(n,"100%")})}).hide()})};e.fn.supersubs.defaults={minWidth:9,maxWidth:25,extraWidth:0}})(jQuery);