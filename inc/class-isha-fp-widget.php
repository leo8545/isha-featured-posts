<?php

class IshaFpWidget extends WP_Widget
{
	public function __construct() {
		// actual widget processes
		parent::__construct(
			'isha_fp_widget',
			__('Isha Featured Posts', 'isha_fp'),
			['description' => __('Shows featured posts...', 'isha_fp')]
		);
    }
 
    public function widget( $args, $instance ) {
		// outputs the content of the widget
		$dir = ISHA_FP_DIR . 'templates/';
		$atts = $instance;
		if($atts['layout'] === 'grid') {
			require $dir . 'isha-layout-grid.php';
		} else {
			require $dir . 'isha-layout-list.php';
		}
    }
 
    public function form( $instance ) {
		// outputs the options form in the admin
		// Field 1: Layout
		if ( isset( $instance[ 'layout' ] ) ) {
            $layout = $instance[ 'layout' ];
        }
        else {
            $layout = 'grid';
        }
		?>
		<style>.isha_fp_widget_wrapper label{display:block;margin:5px 10px}.isha_fp_widget_wrapper p{font-weight: 600;}</style>
		<div class="isha_fp_widget_wrapper">
			<p><?php _e('Layout') ?></p>
			<label for="<?php echo $this->get_field_id( $this->get_field_name('layout') . '_grid' ) ?>">
				<input type="radio" name="<?php echo $this->get_field_name('layout') ?>" id="<?php echo $this->get_field_id( $this->get_field_name('layout') . '_grid' ) ?>" value="grid" <?php checked($layout, 'grid') ?> >
				Grid
			</label>
			<label for="<?php echo $this->get_field_id( $this->get_field_name('layout') . '_list' ) ?>">
				<input type="radio" name="<?php echo $this->get_field_name('layout') ?>" id="<?php echo $this->get_field_id( $this->get_field_name('layout') . '_list' ) ?>" value="list" <?php checked($layout, 'list') ?> >
				List
			</label>
			<?php
			// Field 2: Show meta
			if ( isset( $instance[ 'show_meta' ] ) ) {
				$show_meta = $instance[ 'show_meta' ];
			}
			else {
				$show_meta = 'yes';
			}
			?>
			<p><?php _e('Show meta') ?></p>
			<label for="<?php echo $this->get_field_id( $this->get_field_name('show_meta') . '_yes' ) ?>">
				<input type="radio" name="<?php echo $this->get_field_name('show_meta') ?>" id="<?php echo $this->get_field_id( $this->get_field_name('show_meta') . '_yes' ) ?>" value="yes" <?php checked($show_meta, 'yes') ?> >
				Yes
			</label>
			<label for="<?php echo $this->get_field_id( $this->get_field_name('show_meta') . '_no' ) ?>">
				<input type="radio" name="<?php echo $this->get_field_name('show_meta') ?>" id="<?php echo $this->get_field_id( $this->get_field_name('show_meta') . '_no' ) ?>" value="no" <?php checked($show_meta, 'no') ?> >
				No
			</label>
			<?php
			// Field 3: Show read more
			if ( isset( $instance[ 'show_read_more' ] ) ) {
				$show_read_more = $instance[ 'show_read_more' ];
			}
			else {
				$show_read_more = 'yes';
			}
			?>
			<p><?php _e('Show Read More') ?></p>
			<label for="<?php echo $this->get_field_id( $this->get_field_name('show_read_more') . '_yes' ) ?>">
				<input type="radio" name="<?php echo $this->get_field_name('show_read_more') ?>" id="<?php echo $this->get_field_id( $this->get_field_name('show_read_more') . '_yes' ) ?>" value="yes" <?php checked($show_read_more, 'yes') ?> >
				Yes
			</label>
			<label for="<?php echo $this->get_field_id( $this->get_field_name('show_read_more') . '_no' ) ?>">
				<input type="radio" name="<?php echo $this->get_field_name('show_read_more') ?>" id="<?php echo $this->get_field_id( $this->get_field_name('show_read_more') . '_no' ) ?>" value="no" <?php checked($show_read_more, 'no') ?> >
				No
			</label>
			<?php
			// Field 3: Show read more
			if ( isset( $instance[ 'count' ] ) ) {
				$count = (int) $instance[ 'count' ];
			}
			else {
				$count = -1;
			}
			?>
			<label for="<?php echo $this->get_field_id( $this->get_field_name('count') ) ?>">
				<p>Number of posts to show (<i>-1 to show all</i>):</p>
				<input type="number" min="-1" name="<?php echo $this->get_field_name('count') ?>" id="<?php echo $this->get_field_id( $this->get_field_name('count') ) ?>" value="<?php echo $count ?>" />
			</label>
		</div>
		<?php
    }
 
    public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = [];
		$instance['layout'] = !empty($new_instance['layout']) ? $new_instance['layout'] : 'grid';
		$instance['show_meta'] = !empty($new_instance['show_meta']) ? $new_instance['show_meta'] : 'yes';
		$instance['show_read_more'] = !empty($new_instance['show_read_more']) ? $new_instance['show_read_more'] : 'yes';
		$instance['count'] = !empty($new_instance['count']) ? (int) $new_instance['count'] : -1;
		return $instance;
    }
}