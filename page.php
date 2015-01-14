<?php
/**
 * The template for displaying all pages.
 *
 * @package classPlus
 */
get_header(); the_post();?>

<div id="content_page" class="site-content clearfix">
	<div id="primary" class="content-area">
		<div id="side-content">
			<?php  
				wp_nav_menu( array(
					'theme_location'  => 'side-nav',
					'container'       => false, 
					'menu_class'      => 'list-categories clearfix') );
			?>
		</div>
		<!-- END #side-content -->
		<div id="main-content">
			<div class="main-content-inner clearfix">
				<article <?php post_class( 'single-post' ); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h2>
						<!-- END .entry-title -->
					</header>
					<!-- END .entry-header -->
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
					<!-- END .entry-content -->
					<footer class="entry-footer">
					</footer>
					<!-- END .entry-footer -->
				</article>
				<!-- END .post-list -->
				<?php
				// If enable comments and have one comment at least
				if ( comments_open() || '0' != get_comments_number() )
				    comments_template( '', true );
				?>
			</div>
		</div>
		<!-- END #main-content -->
	</div>
	<!-- END #primary -->
	<div id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-default' ); ?>
	</div>
	<!-- END #secondary -->
</div>
<!-- END .site-content -->

<?php get_footer(); ?>