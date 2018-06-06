<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

get_header();
$container   = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="page-wrapper">
	<div id="content" tabindex="-1">	

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php 
					$categories = get_the_category();
					if($categories[0]->slug == 'episode'){
						echo do_shortcode( '[widget id="dpe_fp_widget-2"]' );
					}else if($categories[0]->slug== 'bookmakerne'){
						echo do_shortcode( '[widget id="dpe_fp_widget-4"]' );
					}else{
					}
				?>

			</main><!-- #main -->

		</div><!-- #primary -->

		<!-- Do the right sidebar check -->
		<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>



</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
