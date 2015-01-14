<?php
/**
 * The Template for displaying all single posts.
 *
 * @package classPlus
 */
get_header(); the_post();?>

<div id="content_single" class="site-content clearfix">
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
		<main id="main-content">
			<div class="main-content-inner clearfix">
				<article <?php post_class( 'single-post' ); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<!-- END .entry-title -->
						<div class="entry-meta clearfix">
							<span class="categories-links">
								<?php classplus_the_category($post->ID); ?>
							</span>
							<span class="author vcard">
								<?php 
									printf(__('Author: <a class="url fn n" href="%1$s">%2$s</a>', 'twenty-theme'), 
										esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
										esc_html( get_the_author() )); 
								?>
							</span>
							<span class="sep">/</span>
							<?php  
								printf(__('<time class="entry-date published" datetime="%1$s">Posted on: %2$s</time>', 'twenty-theme'),
										esc_attr( get_the_date( 'c' ) ),
										esc_html( get_the_date() )
									);
							?>
							<span class="sep">/</span>
							<span class="post-comments"><?php comments_popup_link( __( 'No Comments yet', 'twenty-theme' ), __( '1 comment', 'twenty-theme' ), __( '% comments', 'twenty-theme' ) ); ?></span>
							
							<span class="entry-actions">
								<a href="#" class="read-mod" rel="alternate" title="<?php _e('Read Mod', 'twenty-theme'); ?>" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i></a>
								<a href="#" class="font-size-minus">A-</a>
								<a href="#" class="font-size-plus">A+</a>
							</span>
							<!-- END .entry-actions -->
						</div>
						<!-- END .entry-meta -->
					</header>
					<!-- END .entry-header -->
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array(
							'before' =>  '<div class="post-pagination"><span>' . __( 'Pages:', 'twenty-theme' ) . '</span>',
							'after'  => '</div>'
							)
						); ?> 
					</div>
					<!-- END .entry-content -->
					<footer class="entry-footer clearfix">
						<div class="entry-tags">
							<div class="tag-action">
								<?php  
									the_tags( __('<strong>Tags: </strong><span class="tags-links">', 'twenty-theme'), ', ', '</span>' );
								?>
							</div>
							<!-- END .tag-action -->
						</div>
						<!-- END .entry-tags -->
						<?php classPlus_post_nav(); ?>
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
		</main>
		<!-- END #main-content -->
	</section>
	<!-- END #primary -->
	<div id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-default' ); ?>
	</div>
	<!-- END #secondary -->
</div>
<!-- END .site-content -->

<?php get_footer(); ?>