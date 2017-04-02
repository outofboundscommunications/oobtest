<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
		<div id="branding-top" class="header">
			<div class="container-fluid">
				<div class="row">
					<div class="branding-top-left col-xs-2 col-sm-2 col-md-2 col-lg-2">
						<hgroup>
							<?php
							// $oob_logo_data = getimagesize(oob_logo_url());
							list($width, $height, $type, $attr) = getimagesize(oob_logo_url());
							?>
							<h1 class="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
									<img class="img-responsive" src="<?php echo oob_logo_url();?>" <?php echo $attr;?> alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
								</a>
							</h1>
							<h2 class="site-description" style="display:none;"><?php bloginfo( 'description' ); ?></h2>
						</hgroup>
					</div>
					<div class="branding-top-right col-sm-10 text-right">
						<?php
						wp_nav_menu( array(
							'theme_location'  => 'primary',
							'menu_id'         => 'primary_menu_source',
							'menu_class'      => 'nav-menu hidden',
							'container_class' => 'menu-primary-menu-container hidden',
						) );
						?>
						<nav id="site-navigation" class="main-navigation" role="navigation">
							<div id="primary_menu"></div>
						</nav><!-- #site-navigation -->
					</div>
				</div>
			</div>
		</div>
		
		<?php get_template_part( 'content/banner' ); ?>
		
	</header><!-- #masthead -->

	<div id="main" class="wrapper">