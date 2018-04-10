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
	<div id="carouselGamesControls" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
		<?php while ( $totoit_posts->have_posts() ) : $totoit_posts->the_post(); global $post; ?>
			<?php
				$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
				$logo_game = get_field( "logo", get_the_ID() );
				$thumbnail = $logo_game['sizes']['thumbnail'];
				$percentageAvg  = get_field( "popular",  get_the_ID()  );
				$spill_her = get_field( "spill_her", get_the_ID() );
			?>
				<div class="carousel-item <?php echo $i==0?'active':''?>" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
					<div class="row m-0 header justify-content-between ">
						<div class="col col-12 col-md-12 col-lg-6 m-0 p-0">
							<div class="row m-0 p-0 box-left">
								<div class="col col-4 col-sm-4 col-md-4 col-lg-3 p-0 icon"><a href="<?php echo the_permalink(); ?>"><img class="game-logo" src="<?php echo $thumbnail;?>" alt="<?php the_title(); ?>"/></a></div>
								<div class="col col-sm-8 col-md-8 col-lg-9 content p-2 align-self-center">
									<a href="<?php echo the_permalink(); ?>">
										<h3 class="title">
											<?php the_title(); ?>
										</h3>
									</a>
									<div class="star"><?php gameRating($percentageAvg);?></div>
									<div class="excerpt d-none d-md-block d-lg-none"><?php echo excerpt(40);?></div>
								</div>
							</div>
							<div class="row m-0 p-0 justify-content-between d-block d-md-none d-lg-block d-xl-block">	
								<div class="col col-12 p-3 excerpt">
									<?php echo excerpt(40);?>
								</div>
							</div>
							<div class="row m-0 p-0  box-right">
								<div class="col col-12 bg-dark m-0 p-0">
									<div class="row align-items-center percentage m-0 p-0 text-center">
										<div class="col col-4 col-sm-4 col-md-12 col-lg-6 m-0 p-0 left">
											<span class="upto">VINNERSJANSE<br>OPP TIL:</span>
										</div>
										<div class="col col-8 col-sm-8 col-md-12 col-lg-6 m-0 p-0 right"><span class="number"><?php echo number_format($percentageAvg,1,",",".")?>%</span></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col col-12 col-md-12 col-lg-6 m-0 p-0">
							<a href="<?php echo the_permalink(); ?>">
								<img class="d-block" src="<?php echo $featured_img_url;?>" alt="<?php the_title(); ?>">
							</a>
						</div>
					</div>
				<div class="grey-bar m-0">
					<div class="row justify-content-around">
						<div class="col-12 col-sm-6">
							<a href="<?php echo $spill_her;?>" target="_blank" ><button type="button" class="btn btn-warning btn-lg btn-block">Spill her »</button></a>
						</div>
						<div class="col-12 col-sm-6 pt-3 pt-sm-0">
							<a href="<?php echo the_permalink(); ?>"><button type="button" class="btn btn-info btn-lg btn-block">LES MER!</button></a>
						</div>
					</div>
				</div>	


				</div>
				
			<?php $i++;endwhile; ?>
		</div>
		<a class="carousel-control-prev" href="#carouselGamesControls" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselGamesControls" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
<?php	
endif; // End have_posts()
	
echo $after_widget;
