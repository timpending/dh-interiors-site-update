<?php
/*
Template Name: Lander
*/
get_header();

global $post;
$thisPostData = get_post($post->ID);
$thisPostMeta = get_post_meta($post->ID);

$size = 'large';

if($thisPostMeta['lander_type'][0] != '') {
	$landerPostsArgs = array(
		   'post_type' => $thisPostMeta['lander_type'][0],
		   'posts_per_page' => -1,
		   'orderby' => 'menu_order, date'
		   );
	$landerPostQuery = new WP_Query($landerPostsArgs);
}
 ?>

<div class="entry">

<?php if ($landerPostQuery->have_posts()) : while ($landerPostQuery->have_posts()) : $landerPostQuery->the_post();
		   $postData = get_post(get_the_ID());
		   $meta = get_post_meta(get_the_ID());
		   $link = get_the_permalink();
		   $category = get_the_terms(get_the_ID(),'dh-project-filter');
		   $gallery = get_post_gallery( get_the_ID(), false ); ?>

           <div id="project_<?php echo get_the_ID();?>" class="postEntry">

           	<?php if(is_array($gallery)) { ?>

           	<?php $images = explode(',',$gallery['ids']);

			 if(count($images) > 0) {

			 	foreach($images as $key => $img) {
					$thisImg = wp_get_attachment_image_src($img, $size);

					$thisImgData = wp_prepare_attachment_for_js($img);

					$imgSrc = $thisImg[0];
					$width = $thisImg[1];
					$height = $thisImg[2];

					if($width > $height) {
						$orientation = 'landscape';
						$active = ' inactive';
						$textAlign = 'center';
						$mobileLandscape = ' mobileLandscape';
					} else {
						$orientation = 'portrait';
						$active = ' active';
						$textAlign = 'left';
						$mobileLandscape = '';
					}


					$title = explode('-',$postData->post_title);

					echo '<div class="projectSlide" data-project="'.get_the_ID().'" data-id="'.$key.'">
							<div class="projectSlideFrame" style="text-align:'.$textAlign.'">

							<img alt="'.get_the_title().'" src="'.$imgSrc.'">

							<div class="projectCaptionFrame'.$active.'">
								<div class="projectCaption'.$mobileLandscape.'">
								<h2>'.trim($title[0]).'</h2>
								<h1>'.trim($title[1]).'</h1>
								'.$thisImgData['caption'].'<br>
								<span class="date">'.get_the_date('Y').'</span>
								</div>
							</div>

						</div>
					</div>';

				}

			 } ?>

           </div>

           <div id="project_toggle_<?php echo get_the_ID();?>" class="projectToggle <?php echo $active;?>">
				<a href="javascript:;"><i class="fa fa-eye"></i></a>
		   </div>

           <?php } else { ?>

           	<?php
			$image = getCorrectFeaturedImageData(get_the_ID(),$large);

			 if(count($image) > 0) {

					$thisImg = wp_get_attachment_image_src($image[0]->meta_value, $size);

					$imgSrc = $thisImg[0];
					$width = $thisImg[1];
					$height = $thisImg[2];

					if($width > $height) {
						$orientation = 'landscape';
						$active = ' inactive';
						$textAlign = 'center';
						$mobileLandscape = ' mobileLandscape';
					} else {
						$orientation = 'portrait';
						$active = ' active';
						$textAlign = 'left';
						$mobileLandscape = '';
					}

					$title = explode('-',$postData->post_title);

					if($postData->post_type == 'dh-publication') {

						$capContent = get_the_content();

						//all publications are active
						$active = ' active';
						$icon = ' inactive';
						$pub = ' pub active';

						$link = '<a href="javascript:;"><i class="fa fa-eye"></i></a>';

						if(stristr($capContent,'<a')) {
							$stripA = new SimpleXMLElement($capContent);
							$caption = '';
							$link = '<a href="'.$stripA['href'].'" target="_blank"><i class="fa fa-eye"></i></a><br>';
						} else {
							//$link = '';
							$active = ' inactive';
							$icon = ' inactive';
						}

					} else {
						$caption = $thisImgData['caption'].'<br/>';
					}

					echo '<div class="projectSlide" data-project="'.get_the_ID().'" data-id="'.$key.'">
							<div class="projectSlideFrame" style="text-align:'.$textAlign.'">

							<img alt="'.get_the_title().'" src="'.$imgSrc.'">

							<div class="projectCaptionFrame'.$pub.'">
								<div class="projectCaption'.$mobileLandscape.'">
								<h2>'.trim($title[0]).'</h2>
								<h1>'.trim($title[1]).'</h1>
								'.$caption.'
								<span class="date">'.get_the_date('Y').'</span>
								</div>
							</div>

						</div>
					</div>';

				}

			 ?>

           </div>

           <?php if($link) { ?>
           <div id="project_toggle_<?php echo get_the_ID();?>" class="projectToggle <?php echo $icon;?>">
				<?php echo $link;?>
		   </div>
           <?php } ?>

           <?php } ?>

     <?php endwhile; endif; ?>

</div>

<?php get_footer(); ?>
