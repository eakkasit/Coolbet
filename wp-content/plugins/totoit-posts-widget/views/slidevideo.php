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
		<div class="section-video">
			<div class="container">
				<div class="row">
				<ul class="content-video p-0"  >
				<?php while ( $totoit_posts->have_posts() ) : $totoit_posts->the_post(); global $post; ?>
							<li class="<?php echo $i == 0?'active':'' ?>">
								<div class="row">
								<div class="content-video-cover col-md-9">
									<?php echo the_post_thumbnail(); ?>
								</div>
								<div class="content-video-detail col-md-3">
									<p><?php the_title(); ?><?php echo $i ?></p>
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
				<div class="row">
						<ul class="amazingslider-slides" >
						<?php while ( $totoit_posts->have_posts() ) : $totoit_posts->the_post(); global $post; ?>
							<li><?php echo the_post_thumbnail(); ?></li>
						<?php $i++;endwhile; ?>
						</ul>
					
					<!-- <script src="https://amazingslider.com/wp-content/uploads/amazingslider/12/sliderengine/initslider.js"></script> -->
				</div>
			</div>
		</div>

	</div>
<?php	
endif; // End have_posts()
	
echo $after_widget;
