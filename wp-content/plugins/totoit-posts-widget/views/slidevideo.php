<?php
/**
 * TOTOIT Posts Widget: Slide widget template
 * 
 * @since 3.4.0
 *
 * This template was added to overcome some often-requested changes
 * to the old default template (widget.php).
 */

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');

echo $before_widget;

if ( ! empty( $title ) )
	echo $before_title . $title . $after_title;
$i=0;
if ( $totoit_posts->have_posts() ):
?>
	<div class="video_slide">
		<div class="section-video pt-4">
			<div class="container">
				<div class="row">
				<ul class="content-video p-0"  >
				<?php while ( $totoit_posts->have_posts() ) : $totoit_posts->the_post(); global $post; ?>
							<li class="<?php echo $i == 0?'active':'' ?>">
								<div class="row p-0 m-0">
								<div class="content-video-cover col-md-9">
									<?php 
										$id = get_the_ID();
										$video_data = get_post_meta($id,'');
										$data_ex = explode('/',$video_data['_meta_info'][0]);
										$id_video = end($data_ex);
											if($id_video == ''):
												echo the_post_thumbnail();
											else :
										 ?>
										 <div  class="embed-container">
											 <iframe src="https://player.vimeo.com/video/<?php echo $id_video ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
										 </div>
										<?php 
											endif;
										?>

								</div>
								<div class="content-video-detail col-md-3">
									<p><?php the_title(); ?></p>
								</div>
								</div>
								
							</li>							
							<?php $i++;endwhile; ?>
						</ul>
				</div>
			</div>
		</div>
		<div class="section-slide">
			<div class="container">
				<div class="row  p-0 m-0">
						<ul class="amazingslider-slides" >
						<?php while ( $totoit_posts->have_posts() ) : $totoit_posts->the_post(); global $post; ?>
							<li><?php echo the_post_thumbnail(); ?></li>
						<?php $i++;endwhile; ?>
						</ul>	
				</div>
			</div>
		</div>

	</div>
<?php	
endif; // End have_posts()
	
echo $after_widget;
