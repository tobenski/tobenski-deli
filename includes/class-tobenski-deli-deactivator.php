<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://github.com/tobenski/
 * @since      1.0.0
 *
 * @package    Tobenski_Deli
 * @subpackage Tobenski_Deli/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Tobenski_Deli
 * @subpackage Tobenski_Deli/includes
 * @author     Knud Rishøj <tirdyr@tobenski.dk>
 */
class Tobenski_Deli_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		self::recreate_pages();
	}

	/**
	 * Reset state of pages to before activation.
	 * 
	 * Delete the page created upon activation.
	 * Recreate pages backed up upon activation it they still exist.
	 *
	 * @since 1.0.0
	 */
	public static function recreate_pages()
	{
		// Delete the Take away page created on activation
		$take_away_page = get_page_by_path( '/deli/', OBJECT, 'page' );
		wp_delete_post($take_away_page->ID); // Jeg tror det er sådan.
		
		// Recreate the Backup Page created if it existet on activation
		$page_exists = get_page_by_path( '/deli-old/', ARRAY_A, 'page' );

        if( !$page_exists == null ) {
			$page_exists['post_name'] = 'deli';
			$page_exists['post_status'] = 'publish';
			$page_exists['post_title'] = 'TE’ Å TA’ MÆ’';
			wp_update_post($page_exists);
        }
	}

}
