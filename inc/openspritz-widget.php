<?php

class DX_OpenSpritz_Widget extends WP_Widget {

	/**
	 * Register the widget
	 */
	public function __construct() {
		$this->WP_Widget(
				'dx_openspritz_widget',
				__("DX OpenSpritz Widget", 'dxosz'),
				array( 'classname' => 'dx_openspritz_single', 'description' => __( "Display a text with DX OpenSpritz", 'dxosz' ) ),
				array( ) 
		);
	}

	/**
	 * Output of widget
	 *
	 * The $args array holds a number of arguments passed to the widget
	 */
	public function widget ( $args, $instance ) {
		extract( $args );

		// Get widget field values
		$title = apply_filters( 'widget_title', $instance[ 'title' ] );
		
		wp_enqueue_script( 'openspritz-js' );
		wp_enqueue_style( 'openspritz-css', DXOSZ_ASSETS_URL . 'css/style.css' );

		// Start sample widget body creation with output code (get arguments from options and output something)

		$out = '<p>Widget body<p>';
		// End sample widget body creation

		if ( !empty( $out ) ) {
			echo $before_widget;
			if ( $title ) {
				echo $before_title . $title . $after_title;
			}
			?>
        		<div id="spritz_container">
	        		<div id="spritz_result">
		            </div>
		            
        			<?php echo $out; ?>
        			
        			<button type="button" id="spritz_toggle">Play</button>
        		</div>
        	<?php
        		echo $after_widget;
        		
        	$prespritz_text = str_replace("\n", '', $instance['speedy_text'] );
        	$prespritz_text = str_replace("\r", '', $prespritz_text );
        	$prespritz_text = esc_html( $prespritz_text );
        	$prespritz_text = esc_attr( $prespritz_text );
        }
        
        ?>
        <script type="text/javascript">
			jQuery(document).ready(function( $ ) {
				var data = "<?php echo $prespritz_text; ?>";
				var speed = "<?php echo $instance['spritz_wpm']; ?>";
				var spritzContainer = document.getElementById("spritz_container");

	            $('#spritz_toggle').one( 'click', function() {
	            	spritz( speed, data );
		        });
	            
			});

        </script>
        <?php 
    }

    /**
     * Updates the new instance when widget is updated in admin
     *
     * @return array $instance new instance after update
     */
    public function update ( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['speedy_text'] = strip_tags($new_instance['speedy_text']);
		$instance['spritz_wpm'] = strip_tags($new_instance['spritz_wpm']);
        
        return $instance;
    }

    /**
     * Widget Form
     */
    public function form ( $instance ) {
		$instance_defaults = array(
				'title' => 'Instance title',
				'speedy_text' => '',
				'spritz_wpm' => '',
		);

		$instance = wp_parse_args( $instance, $instance_defaults );

        $title = esc_attr( $instance[ 'title' ] );
        $speedy_text = esc_attr( $instance[ 'speedy_text' ] );
		$spritz_wpm = esc_attr( $instance[ 'spritz_wpm' ] );
        
        ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( "Title:", 'dxbase'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('speedy_text'); ?>"><?php _e( "Text to ospritz:", 'dxbase'); ?></label> 
			<textarea class="widefat" id="<?php echo $this->get_field_id('speedy_text'); ?>" name="<?php echo $this->get_field_name('speedy_text'); ?>" type="text"><?php echo $speedy_text; ?></textarea>
		</p>
		<label for="<?php echo $this->get_field_id('spritz_wpm'); ?>"><?php _e( "Words per minute:", 'dxbase'); ?></label>
		
		<?php $wpm_options = $this->get_wpm_options_array(); ?>
		
		<select id="<?php echo $this->get_field_id('spritz_wpm'); ?>" name="<?php echo $this->get_field_name('spritz_wpm'); ?>">
			<?php foreach ( $wpm_options as $value => $label ) {
				$selected = selected( $spritz_wpm, $value, false );
			?>
			<option value="<?php echo $value; ?>" <?php echo $selected; ?> ><?php echo $label; ?></option>
			<?php 
			} ?>
		</select>
	<?php
    }
    
    public function get_wpm_options_array() {
    	$wpm_options = array(
			0 => 'Select WPM',
			200 => '200wpm',
			300 => '300wpm',
			350 => '350wpm',
			400 => '400wpm',
			450 => '450wpm',
			500 => '500wpm',
			550 => '550wpm',
			600 => '600wpm',
			650 => '650wpm',
			700 => '700wpm',
			750 => '750wpm',
			800 => '800wpm',
			850 => '850wpm',
			900 => '900wpm',
			950 => '950wpm',
		);

		return apply_filters( 'dxosz_wpm_options', $wpm_options ); 
    }
}
