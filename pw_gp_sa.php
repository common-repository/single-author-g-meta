<?php
  /*
  Plugin Name: Single Author G+ META
  Text Domain: single-author-g-meta
  Domain Path: /languages
  Plugin URI: http://www.pattonwebz.com/wordpress-plugins/google-plus-author-meta
  Description: This Plugin adds the required Author Meta Tags to the header of all the pages on your WordPress site. It is designed to be as simple as possible.
  Author: William Patton
  Version: 1.1
  Author URI: http://www.pattonwebz.com
  License: GPL2

  */
	/**
	 * Hardcoded Google Plus Verification
	 * Adds the rel=author tag to every single page on the site
	 * Uses the wp_head hook to echo the meta-info
	 */
	add_action('wp_head', 'pw_add_google_rel_author');
	function pw_add_google_rel_author() {
		/**
		* Add improved checks here in future release
		*/
		$id=get_option('pw_gplusid');
		if(!($id == NULL))
		{
			echo '<link rel="author" href="'.$id.'" />';
		}
		
	}
	
	/** 
	 * Create Option Menu for the G+ code above
	 * Page named 'Google+ Author' added to the WordPress Settings
	 * menu for user to enter their G+ Profile URL
	 */
	add_action('admin_menu', 'pw_add_global_custom_options');
		function pw_add_global_custom_options()
	{
		add_options_page('Google+ Author', 'Google+ Author', 'manage_options', 'functions','pw_g_plus_author');
	}
	function pw_g_plus_author()
	{
	/* This is the entry form for the G+ Profile URL */
	?>
		<div class="wrap">
			<h2><?php _e('Google Plus Author ID', single-author-g-meta) ?></h2>
			<form method="post" action="options.php">
				<?php wp_nonce_field('update-options') ?>
				<p><strong><?php _e('Google+ Profile URL', 'single-author-g-meta') ?></strong> <?php _e('Enter the entire url including the https:// for example - https://plus.google.com/xxxxxxxxxxxxxxxxxxxxx/posts', 'single-author-g-meta') ?> :<br />
					<input type="text" name="pw_gplusid" size="45" value="<?php echo get_option('pw_gplusid'); ?>" />
				</strong></p>
				<p><input type="submit" name="Submit" value="<?php _e('Save your G+ Profile ID', 'single-author-g-meta') ?>" /></p>
				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="page_options" value="pw_gplusid" />
			</form>
		</div>
	<?php
	}
	
function pw_gp_sa_load_plugin_textdomain() {
    load_plugin_textdomain( 'my-plugin', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'pw_gp_sa_load_plugin_textdomain' );
	
	?>