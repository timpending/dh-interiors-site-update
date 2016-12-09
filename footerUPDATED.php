</div>
<?php $get_settings = get_option('custom_theme_options'); ?>

<script type="text/javascript">
<!--
jQuery(document).ready(function($){

  //add additional button functionality
  enableButtons();

  //box resizers
  initResizers();

  <?php if(is_front_page()){ ?>

	  $(window).scroll(function() {
		  parallaxBackground(jQuery('#homeIntro'));
	  });

  <?php } ?>



  if(window.innerWidth > 767) {
  	var autoheight = false;
  } else{

  	$('.projectSlideFrame a').each(function(e){
  		$(this).removeClass('cboxElement');  // remove colorbox for mobile click
  	});
	var autoheight = true;
  }

  $(".postEntry").owlCarousel({
	  dots: false,
	  navigation : true,
	  navigationText: ["",""],
	  slideSpeed : 1000,
	  autoPlay: false,
	  autoHeight: autoheight,
	  paginationSpeed : 400,
	  singleItem:true,
	  mouseDrag:false,
	  lazyLoad:false,
	  afterInit: function (elem) {

		  var current = this.currentItem;
		  var project = elem.find(".owl-item").eq(current).find(".projectSlide").data('project');
		  var ID = elem.find(".owl-item").eq(current).find(".projectSlide").data('id');
		  var elemClasses = elem.find(".owl-item").eq(current).find('.projectCaptionFrame').attr('class').toString();

		  /*if(window.innerWidth > 767) {*/

			  //updateSize();

			  if(elemClasses.indexOf('inactive') > -1) {
				   jQuery('#project_toggle_'+project).removeClass('active').removeClass('static');
			  } else {
				 jQuery('#project_toggle_'+project).addClass('active').addClass('static');
			  }

			  jQuery('#project_toggle_'+project).click(function(){
				toggleWindow(elem.find(".owl-item").eq(current), current);
			   });

		  /*} else {
			  if(elemClasses.indexOf('inactive') > -1) {
				   jQuery('#project_'+project).find('.inactive').removeClass('inactive').addClass('active');
				   toggleWindow(elem.find(".owl-item").eq(current),current);
			  }
		  }*/
      /* Checks for Publication specific class */
      if(elemClasses.indexOf('needPub') > -1) {
      	jQuery('#project_toggle_'+project).find('needPub').addClass('pub');
      } else {}

    	},
	  afterAction: function (elem) {

		  var current = this.currentItem;
		  var project = elem.find(".owl-item").eq(current).find(".projectSlide").data('project');
		  var ID = elem.find(".owl-item").eq(current).find(".projectSlide").data('id');
		  var elemClasses = elem.find(".owl-item").eq(current).find('.projectCaptionFrame').attr('class').toString();

		  /*if(window.innerWidth > 767) {*/

			  updateSize();

			  if(elemClasses.indexOf('inactive') > -1) {
				   jQuery('#project_toggle_'+project).removeClass('active').removeClass('static');
			  } else {
				 jQuery('#project_toggle_'+project).addClass('active').addClass('static');
			  }

			  jQuery('#project_toggle_'+project).click(function(){
				toggleWindow(elem.find(".owl-item").eq(current), current);
			   });

		  /*} else {
			  if(elemClasses.indexOf('inactive') > -1) {
				   jQuery('#project_'+project).find('.inactive').removeClass('inactive').addClass('active');
				   toggleWindow(elem.find(".owl-item").eq(current),current);
			  }
		  }*/

    	},
		onResize: function (elem) {

		  var current = this.currentItem;
		  var project = elem.find(".owl-item").eq(current).find(".projectSlide").data('project');
		  var ID = elem.find(".owl-item").eq(current).find(".projectSlide").data('id');
		  var elemClasses = elem.find(".owl-item").eq(current).find('.projectCaptionFrame').attr('class').toString();

		  /*if(window.innerWidth > 767) {*/

			  updateSize();

			  if(elemClasses.indexOf('inactive') > -1) {
				  jQuery('#project_toggle_'+project).removeClass('active').removeClass('static');
			  } else {
				 jQuery('#project_toggle_'+project).addClass('active').addClass('static');
			  }

			  jQuery('#project_toggle_'+project).click(function(){
				toggleWindow(elem.find(".owl-item").eq(current), current);
			   });

		  /*} else {
			  if(elemClasses.indexOf('inactive') > -1) {
				   jQuery('#project_'+project).find('.inactive').removeClass('inactive').addClass('active');
				   toggleWindow(elem.find(".owl-item").eq(current),current);
			  }
		  }*/

    	}

  });

  setWaypoints = jQuery('.postEntry');

	for(w=0;w<setWaypoints.length;w++) {
		var waypoint = new Waypoint({
		  element: setWaypoints[w],
		  handler: function(w) {
			//console.log(this.element)
			blinkArrow(this.element.id);
		  }
		});
	}


});
-->
</script>

<?php wp_footer(); ?>

</body>
</html>
