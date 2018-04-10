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
?>
	<!-- <ul class="dpe-flexible-posts"> -->
		<div class="template-6-content">
			<div class="container">
				<div class="row">
				<?php while( $totoit_posts->have_posts() ) : $totoit_posts->the_post(); global $post; ?>
					<div class="col-md-4">
						<div class="cover">
						<a href="<?php echo the_permalink(); ?>">
							<?php
								if( $thumbnail == true ) {
									// If the post has a feature image, show it
									if( has_post_thumbnail() ) {
										the_post_thumbnail($thumbsize);
									// Else if the post has a mime type that starts with "image/" then show the image directly.
									} elseif( 'image/' == substr( $post->post_mime_type, 0, 6 ) ) {
										echo wp_get_attachment_image( $post->ID, $thumbsize );
									}else{}
								}
							?>
							
						</a>
						</div>
						<div class="title-content">
						<p><?php the_title(); ?></p>
						</div>
						
					</div>
				<?php endwhile; ?>
				</div>
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
