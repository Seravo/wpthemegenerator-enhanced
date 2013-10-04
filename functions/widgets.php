<?php
	add_action( 'widgets_init', 'twitter_load_widgets' );

	function twitter_load_widgets() {
		register_widget( 'Twitter_Widget' );
	}

class Twitter_Widget extends WP_Widget {

	/*** Widget setup.*/
	function Twitter_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'twitter', 'description' => __('Select the twitter account to show.', 'twitter') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'twitter-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'twitter-widget', __('Shock Twitter', 'twitter'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$name = $instance['name'];
		$tw_num = $instance['tweet_num'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		echo $before_title . $title . $after_title;

		printf(__('<ul id="twitter_update_list"><li>Twitter feed loading...</li></ul>'));
		printf(__('<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>'));
		printf(__('<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/'.$name.'.json?callback=twitterCallback2&count='.$tw_num.'"></script>'));

		/* After widget (defined by themes). */
		echo $after_widget;
	}
	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['tweet_num'] = $new_instance['tweet_num'];

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Twitter feed', 'twitter'), 'name' => __('Tweet name', 'twitter'), 'tweet_num' => '3');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>">
    <?php _e('Title:', 'hybrid'); ?>
  </label>
  <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'name' ); ?>">
    <?php _e('Twitter Name:', 'twitter'); ?>
  </label>
  <input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo $instance['name']; ?>" style="width:100%;" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'tweet_num' ); ?>">
    <?php _e('Number of tweets:', 'twitter'); ?>
  </label>
  <select id="<?php echo $this->get_field_id( 'tweet_num' ); ?>" name="<?php echo $this->get_field_name( 'tweet_num' ); ?>" class="widefat" style="width:100%;">
    <option <?php if ( '3' == $instance['tweet_num'] ) echo 'selected="selected"'; ?>>3</option>
    <option <?php if ( '4' == $instance['tweet_num'] ) echo 'selected="selected"'; ?>>4</option>
    <option <?php if ( '5' == $instance['tweet_num'] ) echo 'selected="selected"'; ?>>5</option>
    <option <?php if ( '6' == $instance['tweet_num'] ) echo 'selected="selected"'; ?>>6</option>
  </select>
</p>
<?php
	}
}

	add_action( 'widgets_init', 'facebook_load_widget' );

	function facebook_load_widget() {
		register_widget( 'Facebook_Widget' );
	}

class Facebook_Widget extends WP_Widget {

	function Facebook_Widget() {
		$widget_ops = array( 'classname' => 'facebook', 'description' => __('Select the facebook account to show.', 'facebook') );

		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'facebook-widget' );

		$this->WP_Widget( 'facebook-widget', __('Shock Facebook', 'facebook'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$name = $instance['name'];
		$face_height = $instance['height'];
		$face_width = $instance['width'];

		echo $before_widget;

		echo $before_title . $title . $after_title;
			
		printf(__('<div></div>'));

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['height'] = $new_instance['height'];
		$instance['width'] = $new_instance['width'];

		return $instance;
	}

	function form( $instance ) {

		$defaults = array( 'title' => __('Facebook Activity', 'facebook'), 'name' => __('facebook.com', 'facebook'), 'height' => '300', 'width' => '200');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

<!-- Title -->

<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>">
    <?php _e('Title:', 'hybrid'); ?>
  </label>
  <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'name' ); ?>">
    <?php _e('Facebook account:', 'facebook'); ?>
  </label>
  <input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo $instance['name']; ?>" style="width:100%;" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'height' ); ?>">
    <?php _e('Box height:', 'facebook'); ?>
  </label>
  <input id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" value="<?php echo $instance['height']; ?>" style="width:100%;" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'width' ); ?>">
    <?php _e('Box width(175px or 255px):', 'facebook'); ?>
  </label>
  <input id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo $instance['width']; ?>" style="width:100%;" />
</p>
<?php
	}
}
?>
