<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_sidebar( 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="site-info">
						<div class="footer-logo">
						<?php 
							if ( has_custom_logo() ) {
									the_custom_logo();
							} 
						?>
						</div>
							<p class="footer-text">@ DEN SISTE BOOKMARKER</p>
						<!-- <p class="footer-text text-bold">KONTAKT:</p>
						<p class="footer-text">KNELKANEL@MEDIAFUSION.COM  TLF:</p> -->
					</div>

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

