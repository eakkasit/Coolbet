<?php
/**
 * TOTOIT Posts Widget: Games widget template
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

?>

<?php
if ( $totoit_posts->have_posts() ):

?>
	<div id="gamesControls">
		<div class="games-inner container p-3 pt-3 pb-4">
		<div class="row pl-3 pr-3 ">
				<div class="col">
					<div class="row pl-0 pr-0 pb-3 white-color align-items-center justify-content-around">
						<div class="text-center text-uppercase offset-md-1 col-md-2 dark-color">Filtrera : </div>
						<div class="text-center text-uppercase col-md-2 dark-color p-0 filter active" data-filter="popular"><span class="filter-icon popular-icon"></span>&nbsp;&nbsp;populära</div>
						<div class="text-center text-uppercase col-md-2 dark-color p-0 filter" data-filter="bonus"><span class="filter-icon bonus-icon"></span>&nbsp;&nbsp;bonus</div>
						<div class="text-center text-uppercase col-md-2 dark-color p-0 filter" data-filter="freespins"><span class="filter-icon freespins-icon"></span>&nbsp;&nbsp;freespins</div>
						<div class="text-center text-uppercase col-md-1 dark-color"> </div>
						
					</div>
				</div>
			</div>
			<div class="row pl-3 pr-3 ">
				<div class="col">
					<div class="row bg-dark list-header offer-header-column hidden-xs  pl-0 pr-0 pt-3 pb-3 white-color">
						<div class="text-center text-uppercase col-md-2">Games</div>
						<div class="col-md-3 text-center text-uppercase hidden-xs bonus-column-small">Bonus</div>
						<div class="text-center text-uppercase pros-column col-md-4">fördelar</div>
						<div class="text-center text-uppercase col-md-3">Review</div>
					</div>
				</div>
			</div>
		<div class="row pl-3 pr-3">
			<div class="col">
		<?php while ( $totoit_posts->have_posts() ) : $totoit_posts->the_post(); global $post; ?>
			<?php
				$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
				$logo_game = get_field( "logo", get_the_ID() );
				$thumbnail = $logo_game['sizes']['thumbnail'];
				$percentageAvg  = get_field( "popular",  get_the_ID()  );
				$other_bonus  = get_field( "other_bonus",  get_the_ID()  );
				$bonus  = get_field( "bonus",  get_the_ID()  );
				$freespins  = get_field( "freespins",  get_the_ID()  );
				$benefits  = get_field( "benefits",  get_the_ID()  );
				$spill_her = get_field( "spill_her", get_the_ID() );
			?>
				<div id="post-<?php the_ID(); ?>" <?php post_class('row pt-2 pb-2 border-bottom pl-0 pr-0 align-items-center'); ?>>
					<div class="col-md-2 text-center">
						<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $featured_img_url;?>" alt="<?php the_title(); ?>" class="img-responsive logo"></a>
					</div>
					<div class="col-md-3 text-center">
						<?php if(empty($other_bonus)) : ?>
						<?php if(!empty($bonus)) : ?>
							<div class="bonus-ammount">
									<span class="highlight-word text-primary"><?php echo $bonus;?><span>kr</span></span>
									<span class="emphasized-word text-uppercase"><span>bonus</span></span>
							</div>
						<?php endif;?>
						<?php if(!empty($freespins)) : ?>
							<div class="freespins-wrapper">
									<span class="highlight-word free-spins-number text-danger"><?php echo $freespins;?></span>
									<span class="emphasized-word text-uppercase"><span>freespins</span></span>
							</div>
						<?php endif;?>
						<?php else: ?>
							<div class="emphasized-word text-uppercase">
								<?php echo $other_bonus;?>
							</div>
						<?php endif;?>
					</div>
					<div class="usps-column col-md-4 hidden-xs">
							<?php echo $benefits;?>
					</div>
					<div class="review-column text-center col-md-3 text-center">
					<a class="spin pb-2" href="<?php echo $spill_her;?>" target="_blank" ><button type="button" class="btn btn-warning btn-block">Spill her »</button></a>
					<a class="review" href="<?php echo the_permalink(); ?>" ><button type="button" class="btn btn-outline-info btn-block"><div class="star pr-3"><?php gameRating($percentageAvg);?></div>LES MER!</button></a>
						
						
					</div>
				</div>
			<?php 
				endwhile; 
			?>
			</div>
			</div>
		</div>
	</div>
<?php	
endif; // End have_posts()
	
echo $after_widget;
