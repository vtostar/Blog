<?php
/**
 * The Header for our theme.
 *
 * @package classPlus
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<title><?php wp_title( '|', true, 'right' );?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>
<!-- END head -->
<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<?php do_action( 'before' ); ?>
		<header id="masthead" class="site-header" role="banner">
			<div class="nav-inner">
				<nav id="site-navigation" class="main-navigation clearfix" role="navigation">
					<?php wp_nav_menu( array(
						'theme_location'  => 'primary',
						'container'       => false, 
						'menu_class'      => 'site-nav' ) ); ?>
				</nav>
				<!-- END #site-navigation -->
				<div class="site-search">
					<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<input type="text" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" id="s">
						<span class="search-icon"><i class="fa fa-search"></i></span>
						<input type="submit" id="searchsubmit" value="">
					</form>
				</div>
				<!-- END .search-form -->
			</div>
			<!-- END .nav-inner -->
		</header>