<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );

?>

<div class="wrapper" id="error-404-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main">

					<section class="error-404 not-found">
						<div class="container">
							<div class="row">
							<header class="page-header">

							<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.',
							'understrap' ); ?></h1>

							</header><!-- .page-header -->

							<div class="page-content">
							

							</div><!-- .page-content -->
							</div>
						</div>						

					</section><!-- .error-404 -->

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
