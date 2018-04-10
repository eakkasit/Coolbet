<?php
/**
 * TOTOIT Posts Widget: Most Popular widget template
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
echo '<div class="blue-bar m-0">'.$before_title . $title . $after_title.'</div>';

if ( $totoit_posts->have_posts() ):
	$numOfCols = 4;
    $rowCount = 0;
    $bootstrapColWidth = 12 / $numOfCols;
?>
	<div id="mostPopularControls">
		<div class="popular-inner container p-3 pt-4 pb-4">
		<div class="row ">
		<?php while ( $totoit_posts->have_posts() ) : $totoit_posts->the_post(); global $post; ?>
			<?php
				$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
				$logo_game = get_field( "logo", get_the_ID() );
				$thumbnail = $logo_game['sizes']['thumbnail'];
				$percentageAvg  = get_field( "popular",  get_the_ID()  );
			?>
				<div id="post-<?php the_ID(); ?>" <?php post_class('popular-item pt-4 pb-4 col-md-'.$bootstrapColWidth); ?>>
				<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $featured_img_url;?>" alt="<?php the_title(); ?>" class=""></a>
					<div class="star"><?php gameRating($percentageAvg);?></div>
					<h3><?php the_title(); ?></h3>
					<p><?php echo excerpt(18);?></p>
					<a href="<?php echo the_permalink(); ?>"><button type="button" class="btn btn-info">LES MER!</button></a>
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
