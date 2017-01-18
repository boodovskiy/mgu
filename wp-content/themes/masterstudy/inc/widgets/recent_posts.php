<?php

class Stm_Recent_Posts extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'stm_recent_posts', // Base ID
			__('STM Recent posts', 'stm_domain'), // Name
			array( 'description' => __( 'Theme recent posts widget', 'stm_domain' ), ) // Args
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
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$output = apply_filters( 'widget_output', $instance['output'] );
		
		if(empty($output) or !isset($output)) {
			$output = 3;
		};

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
		}
		
		$query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $output ) );
		
		if($query->have_posts()): ?>
			<?php while($query->have_posts()): $query->the_post(); ?>
				<div class="widget_media clearfix">
					<a href="<?php the_permalink() ?>">
						<?php if(has_post_thumbnail()): ?>
							<?php the_post_thumbnail('img-63-50', array('class'=>'img-responsive')); ?>
						<?php endif; ?>
						<span class="h6"><?php the_title(); ?></span>
					</a>
					<?php $cats = get_the_category( get_the_id() ); ?>
					<?php if(!empty($cats)): ?>
						<div class="cats_w">
							<?php foreach($cats as $cat): ?>
								<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"><?php echo $cat->name; ?></a><span class="comma">,</span>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>				
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		<?php endif;
	
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$title = '';
		$output = '';

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}else {
			$title = __( 'Recent posts', 'stm_domain' );
		}
		
		if ( isset( $instance[ 'output' ] ) ) {
			$output = $instance[ 'output' ];
		}else {
			$output = __( '3', 'stm_domain' );
		}

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'stm_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'output' ) ); ?>"><?php _e( 'Output number:', 'stm_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'output' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'output' ) ); ?>" type="number" value="<?php echo esc_attr( $output ); ?>">
		</p>
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
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? esc_attr( $new_instance['title'] ) : '';
		$instance['output'] = ( ! empty( $new_instance['output'] ) ) ? esc_attr( $new_instance['output'] ) : '';

		return $instance;
	}

}

function register_stm_recent_posts_widget() {
	register_widget( 'Stm_Recent_Posts' );
}
add_action( 'widgets_init', 'register_stm_recent_posts_widget' );