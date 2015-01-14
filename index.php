<?php
/**
 * The main template file.
 *
 * @package classPlus
 */
get_header(); ?>
<div id="content" class="site-content clearfix">
	<section id="primary" class="content-area">
		<div id="side-content">
			<?php  
				wp_nav_menu( array(
					'theme_location'  => 'side-nav',
					'container'       => false, 
					'menu_class'      => 'list-categories clearfix') );
			?>
		</div>
		<!-- END #side-content -->
		<main id="main-content" role="main">
			<div class="main-content-inner clearfix">
			<?php if( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'loop' ); ?>

				<?php endwhile; ?>

				<?php wp_pagenavi(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>
			</div>
			<!-- END .main-content-inner -->
		</main>
		<!-- END #main-content -->
	</section>
	<!-- END #primary -->
	<div id="secondary" class="widget-area" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php dynamic_sidebar( 'sidebar-default' ); ?>
		<?php do_action( 'after_sidebar' ); ?>
	</div>
	<!-- END #secondary -->
</div>
<!-- END .site-content -->
<?php get_footer(); ?>
