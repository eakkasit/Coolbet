<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */
$id = get_the_ID();
$video_data = get_post_meta($id,'');
$data_ex = explode('/',$video_data['_meta_info'][0]);
$id_video = end($data_ex);
$post_type = get_post_type(get_the_ID());
?>
<?php if($post_type=='post') :?>
<article <?php post_class("author-content pb-3"); ?> id="post-<?php the_ID(); ?>">


	<div class="entry-content container article">
			<?php if(!empty($id_video)) : ?>
			<div class="pb-3">
				<div  class="embed-container">
						<iframe src="https://player.vimeo.com/video/<?php echo $id_video ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
				</div>
			</div>
			<?php endif;?>
			<h1 class="pt-3 pb-3"><?php the_title();?></h1>
			<?php the_content(); ?>
		</div>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
<?php echo do_shortcode( '[widget id="dpe_fp_widget-2"]' ); ?>

<?php elseif($post_type=='teams') :?>
<article <?php post_class("author-content pb-3"); ?> id="post-<?php the_ID(); ?>">


	<div class="entry-content container article">
			<div class="row bg-white m-0 mb-4">
				<div class="col col-12 col-md-4 m-0 p-0 text-center">
				<?php
								$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
								
							?>
							<img src="<?php echo $featured_img_url;?>" alt="<?php the_title(); ?>" >
				</div>
				<div class="col col-12 col-md-8">
					<h1 class="pt-3 pb-3"><?php the_title();?></h1>
					<!-- <h3><?php //echo $GLOBALS['cgv']['position']?></h3> -->
					<?php echo get_field( "position", get_the_ID() );?>
				</div>
			</div>
			<div class="row">
				<div class="col col-12"><?php the_content(); ?></div>
			</div>
			
			
		</div>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
<?php echo do_shortcode( '[widget id="dpe_fp_widget-4"]' ); ?>
<?php endif;?>