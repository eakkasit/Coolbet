<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<script type="text/javascript">
		var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
	</script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="hfeed site" id="page">
<!-- Sidebar -->
<nav id="sidebar">
	<div id="dismiss">
	<i class="fa fa-times"></i>
                </div>

                <div class="sidebar-header">
                    <?php the_custom_logo();?>
                </div>

        <!-- The WordPress Menu goes here -->
		<?php 
		wp_nav_menu(
			array(
				'theme_location'  => 'primary'
			)
		); 
		
		?>

		<div class="social mt-3 mb-3 text-center">
						<?php if(get_theme_mod('Facebook_social')) :?>
						<a href="<?php echo get_theme_mod('Facebook_social', '#'); ?>"><img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo_facebook.png"></a>
						<?php endif; ?>
						<?php if(get_theme_mod('Twitter_social')) :?>
						<a href="<?php echo get_theme_mod('Twitter_social', '#'); ?>"><img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo_twister.png" ></a>
						<?php endif; ?>
						<?php if(get_theme_mod('Linkedin_social')) :?>
						<a href="<?php echo get_theme_mod('Linkedin_social', '#'); ?>"><img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-linked.png" ></a>
						<?php endif; ?>
						<?php if(get_theme_mod('Instagram_social')) :?>
						<a href="<?php echo get_theme_mod('Instagram_social', '#'); ?>"><img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo_instragram.png" ></a>
						<?php endif; ?>
					</div> 		
	</nav>
	<div class="overlay"></div>
	 <div id="main-content">	
	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">

		<a class="skip-link screen-reader-text sr-only" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

		<nav class="navbar navbar-expand-md navbar-dark title-head p-0 pt-2 pb-2">

			<div class="container" >

				<button id="sidebarCollapse" class="navbar-toggler" type="button" >
					<span ><img  src="<?php echo includes_url(); ?>/images/toggler-menu.png"></span>
				</button>
					<!-- Your site title as branding in the menu -->
					<?php if ( ! has_custom_logo() ) { ?>

						<?php if ( is_front_page() && is_home() ) : ?>

							<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
							
						<?php else : ?>

							<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>
						
						<?php endif; ?>
						
					
					<?php } else {
						the_custom_logo();
					} ?><!-- end custom logo -->

					<div class="logo-text"><img class="img-fluid" src="<?php echo includes_url(); ?>/images/logo_text.png" ></div>

			</div><!-- .container -->
	

		</nav><!-- .site-navigation -->
		<nav class="navbar navbar-expand-md navbar-white pl-3 pr-3 p-md-0 pt-md-2 pb-md-2 d-none d-md-block">
			<div class="container" >
				<!-- The WordPress Menu goes here -->
				<?php wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'navbarNavDropdown',
						'menu_class'      => 'navbar-nav',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'walker'          => new understrap_WP_Bootstrap_Navwalker(),
					)
				); ?>
				<div class="title-social">
						<?php if(get_theme_mod('Facebook_social')) :?>
						<a href="<?php echo get_theme_mod('Facebook_social', '#'); ?>"><img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo_facebook.png"></a>
						<?php endif; ?>
						<?php if(get_theme_mod('Twitter_social')) :?>
						<a href="<?php echo get_theme_mod('Twitter_social', '#'); ?>"><img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo_twister.png" ></a>
						<?php endif; ?>
						<?php if(get_theme_mod('Linkedin_social')) :?>
						<a href="<?php echo get_theme_mod('Linkedin_social', '#'); ?>"><img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-linked.png" ></a>
						<?php endif; ?>
						<?php if(get_theme_mod('Instagram_social')) :?>
						<a href="<?php echo get_theme_mod('Instagram_social', '#'); ?>"><img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo_instragram.png" ></a>
						<?php endif; ?>
				</div>
				<!-- <form role="search" method="get" class="form-inline my-12 my-lg-0" action="<?php echo home_url( '/' ); ?>">
					<div class="row">	
						<div class="input-group col-md-12">
							<input class="form-control py-2 border-right-0 border"  name="s"  type="search" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" id="example-search-input">
							<span class="input-group-append">
								<button class="btn btn-outline-secondary border-left-0 border" type="submit">
									<i class="fa fa-search"></i>
								</button>
							</span>
						</div>	
					</div>
				</form> -->

			</div><!-- .container -->
	

		</nav><!-- .site-navigation -->

	</div><!-- #wrapper-navbar end -->
