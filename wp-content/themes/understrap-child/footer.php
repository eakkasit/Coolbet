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
<!-- Cxense script begin -->
<script type="text/javascript">
(function(a,b,c,d){
a='//tags.tiqcdn.com/utag/adnuntius/densistebookmakern/prod/utag.js';
b=document;c='script';d=b.createElement(c);d.src=a;d.type='text/java'+c;d.async=true;
a=b.getElementsByTagName(c)[0];a.parentNode.insertBefore(d,a);
})();
</script>

<!-- Cxense script end -->
<script type="text/javascript">
(function(p){
p.src = "//dmp.adform.net/dmp/profile/?pid=10559&sg=NO%20SB%2030";
})(document.createElement("img"));
</script>
<noscript>
<img src="//dmp.adform.net/dmp/profile/?pid=10559&sg=NO%20SB%2030" style="display:none !important">
</noscript>
</body>

</html>

