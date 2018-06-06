<?php
/**
 * Flexible Posts Widget: Old Default widget template
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
	$numOfCols = 3;
    $rowCount = 0;
	$bootstrapColWidth = 12 / $numOfCols;
	$idNow = get_the_ID();
	$isHome = (!is_home() && ! is_front_page())?false:true;	
	$isCategory = is_category();
?>
	<!-- <ul class="dpe-flexible-posts"> -->
		<div class="template-6-content">
			<div class="container">
				<div class="row">
				<?php while( $totoit_posts->have_posts() ) : $totoit_posts->the_post(); global $post; ?>
				<?php if( ! $isHome && !$isCategory):
						if($idNow != get_the_ID()):
					?>
					<div <?php post_class('mb-3 col-sm-12 col-md-'.$bootstrapColWidth); ?>>					
						<div class="cover">
						<?php 
						$coming_soon  = get_post_meta($post->ID, '_coming_soon', true);
						$play_button = get_post_meta($post->ID, 'play_button', true);
						if ( ! empty ( $coming_soon ) ): 
							?>
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/coming_soon.gif" alt="<?php the_title(); ?>" >
							<?php
						else:
					?>
						<a class="video<?php echo (!empty($play_button))?'-play':''; ?>" href="<?php echo the_permalink(); ?>">
						<?php
								$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
								if($featured_img_url){
									?>
									<img src="<?php echo $featured_img_url;?>" alt="<?php the_title(); ?>" >
									<?php
								}else{
									?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/no-picture.jpg" alt="<?php the_title(); ?>" >
									<?php

								}							
							?>
						</a>
						<?php endif; ?>
						</div>
						<div class="title-content">
						<?php if ( ! empty ( $coming_soon ) ):  ?>
						<h3><?php the_title(); ?></h3>
						<?php else: ?>
						<a href="<?php echo the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>							
						<?php endif; ?>
						</div>
						<?php ?>
					</div>
				<?php 					
						$rowCount++;
						if($rowCount % $numOfCols == 0): echo '</div><div class="row">';
						endif;
							endif;
						else:
							?>
							<div <?php post_class('mb-3 col-sm-12 col-md-'.$bootstrapColWidth); ?>>					
						<div class="cover">
						<?php 
						$coming_soon  = get_post_meta($post->ID, '_coming_soon', true);
						$play_button = get_post_meta($post->ID, 'play_button', true);
						if ( ! empty ( $coming_soon ) ): 
							?>
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/coming_soon.gif" alt="<?php the_title(); ?>" >
							<?php
						else:
					?>
						<a class="video<?php echo (!empty($play_button))?'-play':''; ?>" href="<?php echo the_permalink(); ?>">
							<?php
								$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
								if($featured_img_url){
									?>
									<img src="<?php echo $featured_img_url;?>" alt="<?php the_title(); ?>" >
									<?php
								}else{
									?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/no-picture.jpg" alt="<?php the_title(); ?>" >
									<?php

								}							
							?>
							
						</a>
						<?php endif; ?>
						</div>
						<div class="title-content">
						<?php if ( ! empty ( $coming_soon ) ):  ?>
						<h3><?php the_title(); ?></h3>
						<?php else: ?>
						<a href="<?php echo the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>							
						<?php endif; ?>
						</div>
						<?php ?>
					</div>
				<?php 					
						$rowCount++;
						if($rowCount % $numOfCols == 0): echo '</div><div class="row">';
						endif;

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
