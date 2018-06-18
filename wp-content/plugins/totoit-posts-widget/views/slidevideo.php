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
$useragent=$_SERVER['HTTP_USER_AGENT'];
$is_mobile = false;
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))$is_mobile=true;


if ( !defined('ABSPATH') )
	die('-1');

echo $before_widget;

if ( ! empty( $title ) )
	echo $before_title . $title . $after_title;

if ( $totoit_posts->have_posts() ):
?>
	<div class="video_slide">
		<div class="section-video pt-4">
			<div class="container">
				<div class="row">
				<ul class="content-video p-0"  >
				<?php
				$i=0;
				while ( $totoit_posts->have_posts() ) : $totoit_posts->the_post(); global $post; ?>
				<?php
					$id = get_the_ID();
					$video_data = get_post_meta($id,'');
					$data_ex = explode('/',$video_data['_meta_info'][0]);
					$id_video = end($data_ex);
					$show_slide  = get_post_meta($post->ID, 'show_in_slide', true);
					if($id_video != '' && $show_slide):
				?>
							<li class="<?php echo $i == 0?'active':'' ?>">
								<div class="row p-0 m-0">
								<?php
										$coming_soon  = get_post_meta($post->ID, '_coming_soon', true);
										if ( ! empty ( $coming_soon ) ):
											?>
											<div class="content-video-cover col-md-9">
												<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/coming_soon.gif" alt="<?php the_title(); ?>" >
											</div>
											<div class="content-video-detail col-md-3">
												<p><?php the_title(); ?></p>
											</div>
											</div>
											<?php  else: ?>
												<div class="content-video-cover col-md-9">
													<?php
															if($id_video == ''):
																echo the_post_thumbnail();
															else :
														?>
														<div  class="embed-container">
														<?php
															if($i == 0){
																// $muted = 0;
																$auto_play = 1;
																if($is_mobile){
																	// $muted = 1;
																	$auto_play = 0;
																}
																?>
																<iframe src="https://player.vimeo.com/video/<?php echo $id_video ?>?autoplay=<?php echo $auto_play ?>&loop=1&autopause=0&playsinline=1"  frameborder="0" allow="autoplay" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
																<?php
															}else{
																?>
																<iframe src="https://player.vimeo.com/video/<?php echo $id_video ?>"  frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
																<?php
															}
														?>

														</div>
														<?php
															endif;
														?>

												</div>
												<div class="content-video-detail col-md-3">

													<p><a href="<?php echo get_permalink( $id ) ?>"><?php the_title(); ?></p></a>
													<p class="content-excerpt">
													<?php
														// $excerpt_content =  get_the_excerpt() ;
														// echo  str_replace('[...]','',$excerpt_content);
														echo  excerpt(40);
													?>
													</p>
													<a class="btn btn-secondary  read-more" href="<?php echo get_permalink( $id ) ?>">Les mer</a>
												</div>
												</div>
										<?php endif; ?>

							</li>
							<?php $i++;
							endif;
						endwhile; ?>
						</ul>
				</div>
			</div>
		</div>
		<div class="section-slide">
			<div class="container">
				<div class="row  p-0 m-0">
						<ul class="amazingslider-slides" >
						<?php 
						$i=0; 
						while ( $totoit_posts->have_posts() ) : $totoit_posts->the_post(); global $post; ?>
						<?php 
							$id = get_the_ID();
							$video_data = get_post_meta($id,'');
							$data_ex = explode('/',$video_data['_meta_info'][0]);
							$id_video = end($data_ex);
							$show_slide  = get_post_meta($post->ID, 'show_in_slide', true);
							if($id_video != '' && $show_slide):
						?>
							<li>
								<div class="image-slide"> 
									<?php 
										$coming_soon  = get_post_meta($post->ID, '_coming_soon', true);
										$play_button = get_post_meta($post->ID, 'play_button', true);
										if ( ! empty ( $coming_soon ) ): 
											?>
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/coming_soon.gif" alt="<?php the_title(); ?>" >
											<div class="text-to-image-slide">
											<?php 
											$short_title  = get_post_meta($post->ID, 'short_title', true);
											if($short_title){
												?>
												<p><?php echo $short_title ?></p>
												<?php
											}else{
												?>
												<p>Coming soon</p>
												<?php
											}
											?>
											</div>
											<?php
										else:
									?>
										<a href="#" class="cover-slide<?php echo (! empty ( $play_button ))?'-play':''; ?>"><?php echo the_post_thumbnail(); ?>	</a>
										<div class="text-to-image-slide">
										<?php 
											$short_title  = get_post_meta($post->ID, 'short_title', true);
											if($short_title){
												?>
												<p><?php echo $short_title ?></p>
												<?php
											}else{
												?>
												<p><?php the_title(); ?></p>
												<?php
											}
										?>
											
										</div>
										<?php endif; ?>
								</div>
								
							</li>
							
						<?php $i++;endif;endwhile; ?>
						<?php 
						if($is_mobile){
							if($i < 2){
								for($li =0;$li<(2-$i);$li++){
									echo  "<li></li>";
								}
							}
						}else{
							if($i < 4){
								for($li =0;$li<(4-$i);$li++){
									echo  "<li></li>";
								}
							}
						}
							
						?>
						</ul>	
				</div>
			</div>
		</div>

	</div>
<?php	
endif; // End have_posts()
	
echo $after_widget;
