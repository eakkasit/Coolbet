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

	<div class="container">
		<div class="row m-0 p-0">
			<div class="col-md-12 text-center">					
									<?php wp_nav_menu(
						array(
							'theme_location'  => 'footer',
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => 'row justify-content-center m-0 ',
							'fallback_cb'     => '',
							'menu_id'         => 'footer-menu',
							'walker'          => new understrap_WP_Bootstrap_Navwalker(),
						)
					); ?>		
			</div>	
		</div>	
		<div class="row pt-2">

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
</div><!-- #main-content end -->
</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119135089-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-119135089-2');
</script>

</body>

</html>

