<?php
get_header();

$size = 'large';

?>

<?php if (have_posts()) : ?>

	<div class="entry">

	<?php while (have_posts()) : the_post();
		  $postData = get_post(get_the_ID());
		  $meta = get_post_meta(get_the_ID());
		  $link = get_the_permalink();
		  $category = get_the_terms(get_the_ID(),'dh-project-filter');
		  $gallery = get_post_gallery( get_the_ID(), false );
		   ?>

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
					} else {
						$orientation = 'portrait';
						$active = ' active';
						$textAlign = 'left';
					}

					$title = explode('-',$postData->post_title);

					echo '<div class="projectSlide" data-project="'.get_the_ID().'" data-id="'.$key.'">
							<div class="projectSlideFrame" style="text-align:'.$textAlign.'">

							<img alt="'.get_the_title().'" src="'.$imgSrc.'">

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

			 } ?>

             </div>

             <div id="project_toggle_<?php echo get_the_ID();?>" class="projectToggle <?php echo $active;?>">
				<a href="javascript:;"><i class="fa fa-eye"></i></a>
		   	</div>


             <?php } else { ?>

           	<?php


			if($postData->post_type == 'attachment') {

				$image = $postData;

				$thisImg = wp_get_attachment_image_src($image->ID, $size);

				$parentImage = get_post($image->post_parent);


			} else {


				$image = getCorrectFeaturedImageData(get_the_ID(),$large);

				$thisImg = wp_get_attachment_image_src($image[0]->meta_value, $size);


			}


			 if(count($image) > 0) {

					$imgSrc = $thisImg[0];
					$width = $thisImg[1];
					$height = $thisImg[2];

					if($width > $height) {
						$orientation = 'landscape';
						$active = ' inactive';
						$textAlign = 'center';
						//$icon = '';
						$pub = ' inactive';
					} else {
						$orientation = 'portrait';
						$active = ' active';
						$textAlign = 'left';
						//$icon = ' disabled';
						$pub = ' active';
					}



					$title = explode('-',$postData->post_title);

					$caption = $thisImgData['caption'].'<br/>';

					if($postData->post_type == 'attachment') {

						$imgTitle = $parentImage->post_title;

						if(stristr($parentImage->post_title,'_')) {
							$imgTitle = str_replace('_','-',$parentImage->post_title);
						}

						$title = explode('-',$imgTitle);
						// The link to rulle them all
						$link = '<a href="javascript:;"><i class="fa fa-eye"></i></a>';
						$caption = get_the_excerpt();

					}

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
							$link = '<a href="'.$stripA['href'].'" target="_blank"><i class="fa fa-eye"></i></a><br>';
							$active = ' active';
						}

					}

					echo '<div class="projectSlide" data-project="'.get_the_ID().'" data-id="'.$key.'">
							<div class="projectSlideFrame" style="text-align:'.$textAlign.'">

							<img alt="'.get_the_title().'" src="'.$imgSrc.'">

							<div class="projectCaptionFrame'.$pub.'">
								<div class="projectCaption">

								<h2>'.trim($title[0]).'</h2>
								<h1>'.trim($title[1]).'</h1>
								'.$caption.'<br>
								<span class="date">'.get_the_date('Y').'</span>
								</div>
							</div>

						</div>
					</div>';?>




				<?php } ?>

             </div>

                   <?php if($link) { ?>
                   <div id="project_toggle_<?php echo get_the_ID();?>" class="projectToggle <?php echo $icon;?>">
                        <?php echo $link;?>
                   </div>
                   <?php } ?>

             <?php } ?>




	<?php endwhile; ?>

<?php else : ?>

	<div class="entry topSpacer">
		<div class="pageContent">
        <p align="center"><img src="<?php bloginfo('template_directory');?>/images/dh-interiors-logo-full.png" /></p>
		<?php if ( is_category() ) { // If this is a category archive
            printf("<h2 class='center'>Sorry, but there aren't any posts in this %s category yet.</h2>", single_cat_title('',false));
        } else if ( is_date() ) { // If this is a date archive
            echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
        } else if ( is_author() ) { // If this is a category archive
            $userdata = get_userdatabylogin(get_query_var('author_name'));
            printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
        } else {
            echo("<h2 class='center'>No items under this filter found.</h2>");
        }
    ?>
    </div>

<?php endif;?>
<?php get_footer(); ?>
