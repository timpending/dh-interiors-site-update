// Site General JS Document

function formatCurrency(num, dec) {
		var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);

		var result2 = result.toFixed(2);

		return result2;
	}


function enableButtons() {

	 toggled = 0;

	 jQuery('#navMenu').click(function(){

		if(toggled == 0) {
			jQuery('#navigation').stop().animate({opacity: 1,marginLeft: '0', marginRight: '0', marginBottom: '0', marginTop: '0'},{duration:300, easing: 'easeInOutQuad'}, function(){
				toggled = 1;

			});

			jQuery('#menuOpen').fadeOut(300);

		}

 	 });

	 jQuery('#menuClose').click(function(){

			jQuery('#navigation').stop().animate({opacity: 1,marginLeft: '-310px', marginRight: '0', marginBottom: '0', marginTop: '0'},{duration:300, easing: 'easeInOutQuad'}, function(){
				toggled = 0;

			});

			jQuery('#menuOpen').fadeIn(300);
	 });

	jQuery('#homeIntro').click(function() {
		//outro();
		smoothScrollTo(jQuery('#homeContent'));
	});

	jQuery('#homeNextBtn').click(function() {
		//outro();
		smoothScrollTo(jQuery('#homeContent'));
	});

}

function blinkButton(element) {
    jQuery('#'+element).stop().animate({opacity: 0},{duration:200, complete: function() {
		setTimeout(function(){jQuery('#'+element).stop().animate({opacity: 1},{duration:150})},300);
	}});
}

function blinkArrow(element) {

	jQuery('#'+element).find('.owl-prev').stop().animate({opacity: 0},{duration:200, complete: function() {
		setTimeout(function(){jQuery('#'+element).find('.owl-prev').stop().animate({opacity: 1},{duration:150, complete: function() {
			jQuery('#'+element).find('.owl-next').stop().animate({opacity: 0},{duration:200, complete: function() {
			setTimeout(function(){jQuery('#'+element).find('.owl-next').stop().animate({opacity: 1},{duration:150})},100);
			}});
		}

		})},100);
	}});



	/*

	jQuery('#'+element).find('.owl-prev').addClass('hover');
	setTimeout(function(){jQuery('#'+element).find('.owl-prev').removeClass('hover')},1000);

	jQuery('#'+element).find('.owl-next').addClass('hover');
	setTimeout(function(){jQuery('#'+element).find('.owl-next').removeClass('hover')},1000);
	*/

}

function animateIntro() {
	jQuery('#homeIntro').stop().animate({opacity: 1,top: '22.5%'},{duration:2000,easing:'easeInOutQuad', complete: function() {
    	setInterval (function() { blinkButton('homeNextBtn')}, 1500 );
		}
	});
	jQuery('#homeNextBtn').stop().animate({opacity: 1},{duration:1000,easing:'easeInOutQuad'});
}

function updateSize(){
        var minHeight=parseInt(jQuery('.owl-item').eq(0).css('height'));
        jQuery('.owl-item').each(function () {
            var thisHeight = parseInt(jQuery(this).css('height'));
            minHeight=jQuery('.owl-wrapper-outer').css('maxHeight');
        });
        //jQuery('.owl-wrapper-outer').css('height',minHeight+'px');

        /*show the bottom part of the cropped images*/
        jQuery('.owl-carousel .owl-item img').each(function(){
            var thisHeight = parseInt(jQuery(this).css('height'));
            if(thisHeight>minHeight){
                jQuery(this).css('margin-top',-1*(thisHeight-minHeight)+'px');
            }
        });

}

function toggleWindow(element, currentID) {

	var elemClasses = jQuery(element).find('.projectCaptionFrame').attr('class').toString();
	var project = jQuery(element).find('.projectSlide').data('project');
	var slideID = jQuery(element).find(".projectSlide").data('id');

	console.log('current: '+currentID);

	if(elemClasses.indexOf('inactive') > -1) {

		if(slideID == currentID) {

			if(jQuery(element).find('.projectCaptionFrame').css('marginRight') == '0px') {
				jQuery(element).find('.projectCaptionFrame').stop().animate({opacity: 0,marginRight: '-100%'},{duration:200, easing: 'easeInOutQuad'});
				jQuery('#project_toggle_'+project).removeClass('active')
			} else {
				jQuery(element).find('.projectCaptionFrame').stop().animate({opacity: 1,marginRight: '0px'},{duration:200, easing: 'easeInOutQuad'});
				jQuery('#project_toggle_'+project).addClass('active')
			}

		}

	}

}

function goTo(url, target) {
	if(target) {
		window.open(url);
	} else {
		window.location.href = url;
	}
}

function toggleObj(objID) {

	var obj = document.getElementById(objID);

	if(obj.style.display == '' || obj.style.display == 'none') {
		jQuery(obj).stop().fadeIn(300);
	} else {
		jQuery(obj).stop().fadeOut(300);
	}

}

function initResizers() {

	//fitText();

  	// Resize Colorbox when resizing window or changing mobile device orientation
	jQuery(window).resize(resizeColorBox);
	jQuery(window).resize(resizeExperiences);
	//jQuery(window).resize(fitText);
	window.addEventListener("orientationchange", resizeColorBox, false);
	window.addEventListener("orientationchange", resizeExperiences, false);
	/* Colorbox resize function */
	var resizeTimer;
	function resizeColorBox() {
		if (resizeTimer){
			 clearTimeout(resizeTimer);
		}

		resizeTimer = setTimeout(function() {
				if (jQuery('#cboxOverlay').is(':visible')) {
						if(window.innerWidth < 550) {
							jQuery.colorbox.resize({width:'98%', height:'98%'});
						} else if(window.innerWidth < 1280) {
							jQuery.colorbox.resize({width:'80%', height:'90%'});
						} else {
							jQuery.colorbox.resize({width:'50%', height:'80%'});
						}
				}
		}, 300)
	}


	var resizeTimerEx;
	function resizeExperiences() {

		if (resizeTimerEx){
			 clearTimeout(resizeTimerEx);
		}

		resizeTimerEx = setTimeout(function() {
		  if(window.innerWidth > 767) {
			 jQuery("#mobile-nav").fadeOut(200);
			}

			//fitText();

		}, 300)

		}

	jQuery(document).ready(function($) {
		resizeExperiences();
	});


}

function smoothScrollTo(target) {
	jQuery('html,body').animate({ scrollTop: target.offset().top}, 1000);
}

function smoothScroll() {
		//smooth anchor scroll
		jQuery("html, body").animate({ scrollTop: 0 }, 300);

		//auto smooth anchor scroll;

		  jQuery('a[href*=#]:not([href=#])').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			  var target = jQuery(this.hash);
			  target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
			  if (target.length) {
				jQuery('html,body').animate({
				  scrollTop: target.offset().top
				}, 1000);
				return false;
			  }
			}
		  });

}



//sticky nav on scroll
function setNavScroll() {
    var pos = jQuery("#header").position();
    jQuery(window).scroll(function() {
		//if(window.innerWidth < 767) {
			var windowpos = jQuery(window).scrollTop();
			if (windowpos >= parseInt(pos.top)) {
				jQuery("#header").addClass("stick");
				jQuery("#content").addClass("stick");
			} else {
				jQuery("#header").removeClass("stick");
				jQuery("#content").removeClass("stick");
			}
			/*
		} else {
				jQuery("#header").removeClass("stick");
				jQuery("#content").removeClass("stick");
			}*/
    });
}


function parallaxBackground(element) {
	  var yPos = (jQuery(window).scrollTop())/100;
	  	 // if(window.innerWidth > 650) {
		 var coords = 22.5 + yPos + '%';
	 // } else {
		//  var coords = '50% 0';
	 // }
	  jQuery(element).css({ top: coords });
  }
//text sizer

function fitText() {
	if(window.innerWidth > 991) {
		jQuery('.projectCaption h1').fitText(1.2, { minFontSize: '55px', maxFontSize: '65px' });
		jQuery('.projectCaption h2').fitText(1.2, { minFontSize: '20px', maxFontSize: '40px' });
		jQuery('.projectCaption span').fitText(1.2, { minFontSize: '18px', maxFontSize: '35px' });
	}
}

(function( $ ){

  $.fn.fitText = function( kompressor, options ) {

    // Setup options
    var compressor = kompressor || 1,
        settings = $.extend({
          'minFontSize' : Number.NEGATIVE_INFINITY,
          'maxFontSize' : Number.POSITIVE_INFINITY
        }, options);

    return this.each(function(){

      // Store the object
      var $this = $(this);

      // Resizer() resizes items based on the object width divided by the compressor * 10
      var resizer = function () {
        $this.css('font-size', Math.max(Math.min($this.width() / (compressor*10), parseFloat(settings.maxFontSize)), parseFloat(settings.minFontSize)));
      };

      // Call once to set.
      resizer();

      // Call on resize. Opera debounces their resize by default.
      $(window).on('resize.fittext orientationchange.fittext', resizer);

    });

  };

})( jQuery );
