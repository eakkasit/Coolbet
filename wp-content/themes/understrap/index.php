<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
?>

<?php if ( is_front_page() && is_home() ) : ?>
	<?php //get_template_part( 'global-templates/hero' ); ?>
<?php endif; ?>

<div class="wrapper p-0" id="index-wrapper">

	<!-- <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1"> -->

		<!-- <div class="row"> -->

			<!-- Do the left sidebar check and opens the primary div -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<!-- <main class="site-main" id="main">
				
				<div class="wrapper" id="wrapper-static-hero"> -->

						<!-- <div class="<?php echo esc_attr( $container ); ?>" id="wrapper-static-content" tabindex="-1">

							<div class="row"> -->

								<?php dynamic_sidebar( 'statichero' ); ?>

							<!-- </div>

						</div> -->

				<!-- </div> -->
				<!-- #wrapper-static-hero -->

			<!-- </main> -->
			<!-- #main -->

			<!-- The pagination component -->
			<?php //understrap_pagination(); ?>

		<!-- </div>#primary -->

		<!-- Do the right sidebar check -->
		<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>
		

	<!-- </div>.row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
