<?php
/**
 * TOTOIT Posts Widget: blog widget template
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
echo '<div class="grey-bar m-0">'.$before_title . $title . $after_title.'</div>';

if ( $totoit_posts->have_posts() ):
	$numOfCols = 1;
    $rowCount = 0;
    $bootstrapColWidth = 12 / $numOfCols;
?>
	<div id="blogControls">
		<div class="blog-inner container p-3 pt-5 pb-5">
		<div class="row ">
		<?php while ( $totoit_posts->have_posts() ) : $totoit_posts->the_post(); global $post; ?>
			<?php
				$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
			?>
				<div id="post-<?php the_ID(); ?>" <?php post_class('blog-item col-md-'.$bootstrapColWidth); ?>>
					<div class="row p-0 m-0">
						<div class="col col-12 col-md-6 pl-md-0">
							<img src="<?php echo $featured_img_url;?>" alt="<?php the_title(); ?>" class="mr-3">
						</div>
						<div class="col col-12 col-md-6 pr-0">
							<h2 class="mt-0 mb-4 mt-3 mt-md-0"><?php the_title(); ?></h2>
							<h5 class="mt-0 mb-4"><?php echo excerpt(20);?></h5>
							<p><?php echo wp_trim_words( get_the_content(), 70, '...' ); ?></p>
							<a class="readmore align-text-bottom" href="<?php echo the_permalink(); ?>"><button type="button" class="btn btn-warning btn-lg btn-block">LES MER!</button></a>
						</div>
					</div>
				</div>
			<?php 
					$rowCount++;
					if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
				endwhile; 
			?>
		</div>
	</div>
<?php	
endif; // End have_posts()
	
echo $after_widget;
