<?php

class DX_OpenSpritz_Shortcode {
	
	public static function display( $atts = array(), $content = '' ) {
		
		$defaults = array(
			'speed' => '500',
		);
		$atts = wp_parse_args( $atts, $defaults );
		extract( $atts );
		
		wp_enqueue_script( 'openspritz-js' );
		wp_enqueue_style( 'openspritz-css', DXOSZ_ASSETS_URL . 'css/style.css' );
		
		$content = DX_OpenSpritz_Core::escape_text_contents( $content );

		$out = '';
		ob_start();
		?>
		<div id="spritz_container">
	        <div id="spritz_result"></div>
		            
        	<button type="button" id="spritz_toggle">Play</button>
        </div>
        <?php 
        
		DX_OpenSpritz_Core::generate_spritz_js( $content, $speed );		
		
		$out = ob_get_clean();
		
		return $out;
	}
	
}