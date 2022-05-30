<?php

/**
 * Class to keep track of hooks and filters for performance.
 */

class PerformanceSettings
{
	function __construct()
	{
		add_action('wp_footer', array($this, 'disableWPEmbed'));
		$this->disableEmojis();
		add_action('wp_default_scripts', array($this, 'disableJQueryMigrate'));
	}

	/**
	 * Disable wp-embed
	 */
	function disableWPEmbed()
	{
		if(!get_field('use_wp_embed', 'option')){
			wp_deregister_script('wp-embed');
		}
	}

	/**
	 * Disable emojis
	 */
	function disableEmojis()
	{
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('wp_print_styles', 'print_emoji_styles');
	}

	/**
	 * Disable JQuery Migrate
	 function disableJQueryMigrate($scripts)
	 {	
	   if(!get_field('use_jquery_migrate', 'option')){
	   	  if (!is_admin() && !empty($scripts->registered['jquery'])) {
	   	  	$scripts->registered['jquery']->deps = array_diff(
	   			$scripts->registered['jquery']->deps,
	   			['jquery-migrate']
	   		);
	   	  }
	   }
     }
	*/
}
