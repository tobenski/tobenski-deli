<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/tobenski/
 * @since      1.0.0
 *
 * @package    Tobenski_Deli
 * @subpackage Tobenski_Deli/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Tobenski_Deli
 * @subpackage Tobenski_Deli/includes
 * @author     Knud Rishøj <tirdyr@tobenski.dk>
 */
class Tobenski_Deli_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		self::create_page();
	}

	/**
	 * Create the page for showing deli.
	 * 
	 * Checks if a page with slug deli exists, if it does create a backup.
	 * Then create the page for delikatesse.
	 * 
	 * @since 1.0.0
	 */
	public static function create_page() {
		$page = array(
            'post_title' => 'TE’ Å TA’ MÆ’',
            'post_content' => '[tobenski-deli]',
            'post_status' => 'publish',
            'post_author' => 1,
            'post_type' => 'page',
			'post_name' => 'deli',
		);
		
		$page_exists = get_page_by_path(  '/' . $page['post_name'] . '/', ARRAY_A, 'page' );
		//$page_exists = get_page_by_path(  $page['post_name'], OBJECT, 'page' );

        if( $page_exists == null ) {
            // Page doesn't exist, so lets add it
            wp_insert_post( $page );
        } else {
			// Page exits - rename it, and add the page
			$page_exists['post_name'] = $page['post_name'] . '-old';
			$page_exists['post_status'] = 'draft';
			$page_exists['post_title'] = $page_exists['post_title'] . ' Backup';
			wp_update_post($page_exists);

			// Now add the new page.
			wp_insert_post( $page );
		}
	}

}
