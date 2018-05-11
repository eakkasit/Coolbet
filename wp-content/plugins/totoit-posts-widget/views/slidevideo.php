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

function wpdocs_custom_excerpt_length( $length ) {
    return 40;
}

add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length',999 );

// function new_excerpt_more( $more ) {
// 	return '';
// }
// add_filter('excerpt_more', 'new_excerpt_more');



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
								<?php 
										$coming_soon  = get_post_meta($post->ID, '_coming_soon', true);
										if ( ! empty ( $coming_soon ) ): 
											?>
											<div class="content-video-cover col-md-9">
												<img src="<?php echo includes_url(); ?>/images/coming_soon_cover.jpg" alt="<?php the_title(); ?>" >
											</div>
											<div class="content-video-detail col-md-3">
												<p><?php the_title(); ?></p>
											</div>
											</div>
											<?php  else: ?>
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
													<?php 
														$excerpt_content =  get_the_excerpt() ;
														echo  str_replace('[...]','',$excerpt_content);
													?>
													<br/>
													<a class="btn btn-secondary  read-more" href="<?php echo get_permalink( $id ) ?>">Read More</a>
												</div>
												</div>
										<?php endif; ?>
								
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
							<li>
								<div class="image-slide"> 
									<?php 
										$coming_soon  = get_post_meta($post->ID, '_coming_soon', true);
										if ( ! empty ( $coming_soon ) ): 
											?>
											<img src="<?php echo includes_url(); ?>/images/coming_soon_cover.jpg" alt="<?php the_title(); ?>" >
											<div class="text-to-image-slide">
												<p>Coming soon</p>	
											</div>
											<?php
										else:
									?>
										<?php echo the_post_thumbnail(); ?>	
										<div class="text-to-image-slide">
											<p><?php the_title(); ?></p>	
										</div>
										<?php endif; ?>
								</div>
								
							</li>
						<?php $i++;endwhile; ?>
						</ul>	
				</div>
			</div>
		</div>

	</div>
<?php	
endif; // End have_posts()
	
echo $after_widget;
