<?php  
/**
 * The template part for displaying loop of posts.
 *
 * @package classPlus
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-list clearfix'); ?>>
	<div class="entry-thumbnail hover-thumb">
		<a href="<?php the_permalink(); ?>" rel="bookmark">
			<?php the_post_thumbnail(); ?>
		</a>
	</div>
	<!-- END .entry-thumbnail -->
	<div class="entry-body">
		<header class="entry-header">
			<div class="entry-meta">
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
					printf(__('<time class="entry-date published" datetime="%1$s">Posted on %2$s</time>', 'twenty-theme'),
							esc_attr( get_the_date( 'c' ) ),
							esc_html( get_the_date() )
						);
				?>
				<span class="sep">/</span>
				<span class="post-comments"><?php comments_popup_link( __( 'No Comments yet', 'twenty-theme' ), __( '1 comment', 'twenty-theme' ), __( '% comments', 'twenty-theme' ) ); ?></span>
			</div>
			<!-- END .entry-meta -->
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<!-- END .entry-title -->
		</header>
		<!-- END .entry-header -->
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
		<!-- END .entry-summary -->
	</div>
	<!-- END .entry-body -->
</article>
<!-- END .post-list -->