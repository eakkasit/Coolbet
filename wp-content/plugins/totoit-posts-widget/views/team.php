<?php
/**
 * Flexible Posts Widget: Team template
 * 
 * @since 1.0.0
 *
 * This is the ORIGINAL default template used by the plugin.
 * There is a new default template (default.php) that will be 
 * used by default if no template was specified in a widget.
 */

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');

echo $before_widget;

if ( !empty($title) )
	echo $before_title . $title . $after_title;

if( $totoit_posts->have_posts() ):
	$numOfCols = 4;
    $rowCount = 0;
	$bootstrapColWidth = 12 / $numOfCols;
	$idNow = get_the_ID();
?>
	<!-- <ul class="dpe-flexible-posts"> -->
		<div class="team-widget">
			<div class="container">
				<div class="row">
				<?php while( $totoit_posts->have_posts() ) : $totoit_posts->the_post(); global $post; ?>
				<?php if($idNow != get_the_ID()): ?>
					<div <?php post_class('col p-2 p-md-2  mb-0 mb-lg-3 col-6 col-md-'.$bootstrapColWidth); ?>>
						<div class="cover">
						<a class="team" href="<?php echo the_permalink(); ?>">
							<?php
								$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
								
							?>
							<img src="<?php echo $featured_img_url;?>" alt="<?php the_title(); ?>" >
						</a>
						</div>
						<div class="title-content text-center">
						<h5 class="pt-3 pl-2 pr-2 mb-1"><?php the_title(); ?></h5>
						<h3 class="pl-0 pl-2 pr-2 pt-0"><?php echo get_field( "job_title", get_the_ID() );?></h3>
						<div class="content-video-detail pl-2 pr-2 pb-2">
							<a class="btn btn-secondary read-more" style="width:100%" href="<?php echo get_permalink( get_the_ID() ) ?>">Les mer</a>
						</div>
						<!-- <p class="m-0 p-0"><?php //echo wp_trim_words( get_the_content(), 15, '...' ); ?></p> -->
						</div>
						
					</div>
				<?php 
						$rowCount++;
						if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
					endif;
					endwhile; 
				?>
	
			</div>
		</div>
	
	<!-- </ul>.dpe-flexible-posts -->
<?php else: // We have no posts ?>
	<div class="dpe-flexible-posts no-posts">
		<p><?php _e( 'No post found', 'flexible-posts-widget' ); ?></p>
	</div>
<?php	
endif; // End have_posts()
	
echo $after_widget;
