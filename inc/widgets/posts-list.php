<?php

class ClassPlus_Posts_List extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'classPlus_posts_list', // Base ID
			__('Class+ Latest Posts', 'twenty-theme'), // Name
			array( 'description' => __( 'show a list of recent posts with thumbnail.', 'twenty-theme' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	function widget( $args, $instance ) {
		//display settings
		extract( $args );
		$title   = apply_filters( 'widget_title', $instance['title'] );
		$num     = empty( $instance['num'] )     ? '6'    : $instance['num'];
		
		echo $before_widget;
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		$the_args = array(
			'posts_per_page' => $num
		);
		$the_query = new WP_Query($the_args);
		?>
		<div class="widget-content">
			<ul class="widget-posts-list">
		<?php
		if($the_query->have_posts()):while($the_query->have_posts()): $the_query->the_post();
		?>
				<li class="clearfix"> 
					<div class="widget-post-thumb">
						<?php the_post_thumbnail( '90x90' ); ?>
					</div>
					<header class="widget-post-header">
						<h4 class="widget-post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
						<div class="widget-post-excerpt">
							<?php echo wp_trim_words( get_the_excerpt(), 50, '...' ); ?>
						</div>
					</header>
				</li>
		<?php
			endwhile;endif;wp_reset_query();
		?>
			</ul>
		</div>
		<!-- END .rightnow-content -->
		<?php 
		echo $after_widget;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'exclude' => '' ) );
		$title    = esc_attr( $instance['title'] );
		$num      = isset($instance['num'])     ? $instance['num']                 : '6'    ;
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'twenty-theme' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'num' ); ?>"><?php _e( 'Posts Num:', 'twenty-theme' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" type="text" value="<?php echo $num; ?>" /></p>

	<?php
	}
	
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title']     = strip_tags( $new_instance['title'] );
		$instance['num']       = strip_tags( $new_instance['num'] );
		return $instance;
	}

}
?>