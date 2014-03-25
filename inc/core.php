<?php

class DX_OpenSpritz_Core {
	
	public static function escape_text_contents( $text ) {
		
		$prespritz_text = str_replace("\n", '', $text );
		$prespritz_text = str_replace("\r", '', $prespritz_text );
		$prespritz_text = strip_tags( $prespritz_text );
		$prespritz_text = esc_attr( $prespritz_text );
		
		return $prespritz_text;
	}
	
	public static function generate_spritz_js( $text, $speed ) {
		?>
        <script type="text/javascript">
			jQuery(document).ready(function( $ ) {
				var data = "<?php echo $text; ?>";
				var speed = "<?php echo $speed; ?>";
				var spritzContainer = document.getElementById("spritz_container");

	            $('#spritz_toggle').one( 'click', function() {
	            	spritz( speed, data );
		        });
			});
        </script>
        <?php
	}
	
}