<?php //Default Home Page
$get_settings = get_option('custom_theme_options');
$homeData = get_page_by_path('home');

//no share bar on this page
remove_filter( 'the_content', 'sharing_display',19 );
remove_filter( 'the_excerpt', 'sharing_display',19 );

$size = 'large';

get_header();
?>
<div id="homeIntro">
	<div class="entry">
        <a href="#"><img src="<?php bloginfo('template_directory');?>/images/dh-interiors-logo-full.png" alt="<?php wp_title('');?>" class="btnFade"/></a>
    </div>

    <div id="homeNextBtn" class="btnFade"></div>
</div>

<div id="homeContent">

<div class="entry">

     <?php $homePostsArgs = array(
		   'post_type' => 'dh-project',
		   'posts_per_page' => -1,
		   'orderby' => 'menu_order, date'
		   );

		   $homePostQuery = new WP_Query($homePostsArgs);

		   if ($homePostQuery->have_posts()) : while ($homePostQuery->have_posts()) : $homePostQuery->the_post();
		   $postData = get_post(get_the_ID());
		   $meta = get_post_meta(get_the_ID());
		   $link = get_the_permalink();
		   $category = get_the_terms(get_the_ID(),'dh-project-filter');
		   $gallery = get_post_gallery( get_the_ID(), false ); ?>

           <div id="project_<?php echo get_the_ID();?>" class="postEntry">

           	<?php

			$images = explode(',',$gallery['ids']);

			 if(count($images) > 0) {

			 	foreach($images as $key => $img) {

					$thisImg = wp_get_attachment_image_src($img, $size);

					$thisImgData = wp_prepare_attachment_for_js($img);

					//print_r($thisImgData);

					$imgSrc = $thisImg[0];
					$width = $thisImg[1];
					$height = $thisImg[2];

					if($width > $height) {
						$orientation = 'landscape';
						$active = ' inactive';
						$textAlign = 'center';
					} else {
						$orientation = 'portrait';
						$active = ' active';
						$textAlign = 'left';
					}

					$title = explode('-',$postData->post_title);

					echo '<div class="projectSlide" data-project="'.get_the_ID().'" data-id="'.$key.'">
							<div class="projectSlideFrame" style="text-align:'.$textAlign.'">

							<a href="'.$imgSrc.'"><img alt="'.get_the_title().'" src="'.$imgSrc.'"></a>

							<div class="projectCaptionFrame'.$active.'">
								<div class="projectCaption">

								<h2>'.trim($title[0]).'</h2>
								<h1>'.trim($title[1]).'</h1>
								'.$thisImgData['caption'].'<br>
								<span class="date">'.get_the_date('Y').'</span>
								</div>
							</div>

						</div>
					</div>';

				}

			 }

			 ?>



           </div>

           <div id="project_toggle_<?php echo get_the_ID();?>" class="projectToggle <?php echo $active;?>">
				<a href="javascript:;"><i class="fa fa-eye"></i></a>
		   </div>

     <?php endwhile; endif; ?>

    </div>

</div>
<?php get_footer(); ?>
