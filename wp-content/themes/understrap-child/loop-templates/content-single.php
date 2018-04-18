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
?>
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