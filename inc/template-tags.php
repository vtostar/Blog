<?php  

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function classPlus_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'classPlus_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function classPlus_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}
	
	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'twenty-theme' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'classPlus_wp_title', 10, 2 );

/**
 * favicon
 */
function classplus_favicon() {
	$favicon = get_theme_mod( 'classplus_favicon' );
	if( empty($favicon) ) {
		$favicon = get_template_directory_uri().'/images/favicon.ico';
	}
	$html = sprintf('<link id="site-favicon" href="%s" rel="shortcut icon" type="image/x-icon">', $favicon );
	echo $html;
}
add_action( 'wp_head', 'classplus_favicon' );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function classPlus_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'classPlus_setup_author' );

/**
 * Post Comments
 * @param  string $comment    
 * @param  string $args     
 * @param  string $depth     
 * @return string           
 */
function classPlus_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
    ?>
    <!-- commment -->
    <li>
    	<?php 
          $avatar_size = 64;
        ?>
    	<div class="media comment-body">
    		<a class="pull-left" href="#">
				<?php echo get_avatar($comment,$avatar_size); ?>
			</a>
	    	<div class="media-body">
	    		<div class="comment-author vcard">
					<strong class="media-heading"><?php comment_author(); ?></strong>
					<span class="sep"> / </span>
					<time class="comment-meta commentmetadata"><?php echo get_comment_time(); ?></time>
				</div>
	      		<div class="comment-content">
			    	<?php if ($comment->comment_approved == '0') : ?>
		            <div class="alert alert-info"><?php _e('Your comment is awaiting moderation.','twenty-theme');?></div>
		        	<?php endif; ?>
		          	<?php comment_text(); ?>
				</div>
				<!-- END .comment-content -->
				<div class="reply">
					<?php comment_reply_link(array_merge($args,array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?><span>&darr;</span>
				</div>
				<!-- END .reply -->
	    	</div>
	    	<!-- END .media-body -->
	    </div>
	    <!-- END .comment-body -->
    </li>
    <!-- End commment -->
    <?php
}

/**
 * Custom categories link output.
 */
function classplus_the_category($post_id) {
	$categories = wp_get_post_terms( $post_id, 'category', array('orderby' => 'term_group') );
	$separator = ' ';
	$output = '';
	if($categories){
		foreach($categories as $category) {
			$output .= '<a href="'.get_category_link( $category->term_id ).'" rel="category" >'.$category->name.'</a>'.$separator;
		}
	echo trim($output, $separator);
	}
}
/**
 * head meta
 */
function classplus_headmeta() {
	if(is_single() || is_page()) : if(have_posts()) : while(have_posts()) : the_post(); ?>
	<meta name="description" content="<?php the_excerpt_rss(); ?>" />
	<meta name="keywords" content="<?php $posttags = get_the_tags();
		if ($posttags) {
		  foreach($posttags as $tag) {
		    echo $tag->name . ', '; 
		  }
		} ?>" />
	<?php endwhile;endif;
	elseif(is_home()) : ?>
	<meta name="description" content="<?php bloginfo('description'); ?>" />
	<?php endif; ?>
	<!-- Mobile Specific Meta -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<?php
}
add_action( 'wp_head', 'classplus_headmeta' );

if ( ! function_exists( 'classPlus_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function classPlus_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<div class="nav-links clearfix">
			<?php
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'classPlus' ) );
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'classPlus' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;
function some_core_but_not_needed() {
	posts_nav_link();
}
// custom excerpt length
function custom_excerpt_length(){
  return 100;
 }
add_filter( 'excerpt_length', 'custom_excerpt_length' );
// custom excerpt more
function custom_excerpt_more( $more ) {
  return '...';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );

/**
 * dark color
 */
function ColorDarken($color, $dif=20){
 
    $color = str_replace('#', '', $color);
    if (strlen($color) != 6){ return '000000'; }
    $rgb = '';
 
    for ($x=0;$x<3;$x++){
        $c = hexdec(substr($color,(2*$x),2)) - $dif;
        $c = ($c < 0) ? 0 : dechex($c);
        $rgb .= (strlen($c) < 2) ? '0'.$c : $c;
    }
 
    return '#'.$rgb;
}
?>