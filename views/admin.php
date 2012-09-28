<?php

defined( 'ABSPATH' ) or die( '-1' );
?>
<div class="wrap">
	<?php screen_icon() ?>
	<h2>SafeCode</h2><br />

	<?php if( isset( $_POST['updated'] ) && 1 == (int) $_POST['updated'] ) : ?>
		<p><?php _e( 'Settings saved.' ); ?></p>
	<?php endif; ?>

	<form action="" method="post" id="custom-functions">

		<?php wp_nonce_field( 'safecode_update' ); ?>

		<textarea cols="70" rows="25" style="font-family: Consolas,Monaco,monospace; font-size: 12px; width: 100%; background: #F9F9F9; outline: none; padding: 5px;" name="custom-functions" id="newcontent" dir="ltr" tabindex="1"><?php echo esc_html( get_option( 'safecode', "<?php \n\n" ) ) ?></textarea>
		<input type="hidden" name="scrollto" id="scrollto" value="<?php echo isset( $_REQUEST['scrollto'] ) ? (int) $_REQUEST['scrollto'] : 0; ?>" />

		<?php submit_button() ?>
	</form>
</div><!-- .wrap -->

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#custom-functions').submit(function(){ $('#scrollto').val( $('#newcontent').scrollTop() ); });
	$('#newcontent').scrollTop( $('#scrollto').val() );
});
/* ]]> */
</script>