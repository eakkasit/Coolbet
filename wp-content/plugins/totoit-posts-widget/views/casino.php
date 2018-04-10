<?php
/**
 * TOTOIT Posts Widget: casino template
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
	echo '<div class="yellow-bar m-0">'.$before_title . $title . $after_title.'</div>';

if ( $totoit_posts->have_posts() ):
?>
	<div id="CasinosControls">
		<div class="casino-inner">
		<?php while ( $totoit_posts->have_posts() ) : $totoit_posts->the_post(); global $post; ?>
			<?php
				$logo_game = get_field( "logo", get_the_ID() );
				$thumbnail = $logo_game['sizes']['thumbnail'];
				$spill_her = get_field( "spill_her", get_the_ID() );
				$star = get_field( "star", get_the_ID() );
			?>
				<div class="casino-item mb-md-1 mb-3" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="row m-0 header justify-content-between align-items-center">
						<div class="col col-12 col-sm-4 col-md-2 col-lg-2 text-center pt-md-0 pt-3"><img class="game-logo" src="<?php echo $thumbnail;?>" alt="<?php the_title(); ?>"/></div>
						<div class="col col-12 col-sm-4 col-md-6 col-lg-6 text-center text-md-left">
							<?php the_content(); ?>
						</div>
						<div class="col col-12 col-sm-4 col-md-2 col-lg-2 text-center p-0">
							<span class="star-rating">
								<span class="fa <?php echo $star>0?($star>0.5?'fa-star full':'fa-star-half-o half'):'fa-star-o';?>"></span>
								<span class="fa <?php echo $star>1?($star>1.5?'fa-star full':'fa-star-half-o half'):'fa-star-o';?>"></span>
								<span class="fa <?php echo $star>2?($star>2.5?'fa-star full':'fa-star-half-o half'):'fa-star-o';?>"></span>
								<span class="fa <?php echo $star>3?($star>3.5?'fa-star full':'fa-star-half-o half'):'fa-star-o';?>"></span>
								<span class="fa <?php echo $star>4?($star>4.5?'fa-star full':'fa-star-half-o half'):'fa-star-o';?>"></span>
							</span>
						</div>
						<div class="col col-12 col-sm-4 col-md-2 col-lg-2 text-center pb-md-0 pb-3">
							<a href="<?php echo $spill_her;?>" target="_blank" ><button type="button" class="btn btn-success">Spill her »</button></a>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
<?php	
endif; // End have_posts()
	
echo $after_widget;
