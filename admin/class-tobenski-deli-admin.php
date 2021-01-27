<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/tobenski/
 * @since      1.0.0
 *
 * @package    Tobenski_Deli
 * @subpackage Tobenski_Deli/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tobenski_Deli
 * @subpackage Tobenski_Deli/admin
 * @author     Knud Rishøj <tirdyr@tobenski.dk>
 */
class Tobenski_Deli_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the Deli CPT
	 *
	 * @since 1.0.0
	 */
	public function register_deli_cpt()
	{
		$labels = array(
			'name'                     => 'Deli Menuer',
			'menu_name'				   => 'Delikatesse',
			'singular_name'            => 'Deli Menu',
			'add_new'                  => 'Tilføj Ny',
			'add_new_item'             => 'Tilføj Ny Deli Menu',
			'edit_item'                => 'Rediger Deli Menu',
			'new_item'                 => 'Ny Deli Menu',
			'view_item'                => 'Vis Deli Menu',
			'view_items'               => 'Vis Deli Menuer',
			'search_items'             => 'Søg i Deli Menuer',
			'not_found'                => 'Ingen Deli Menuer',
			'not_found_in_trash'       => 'Ingen Deli Menuer i Papirkurv',
			'parent_item_colon'        => 'Parent Page:',
			'all_items'                => 'Alle Deli Menuer',
			'archives'                 => 'Deli Menu Arkiver',
			'attributes'               => 'Deli Menu Attributes',
			'insert_into_item'         => 'Insert into Deli Menu', 
			'uploaded_to_this_item'    => 'Uploaded til denne Deli Menu',
			'featured_image'           => 'Udvalgt billede',
			'set_featured_image'       => 'Vælg udvalgt billede',
			'remove_featured_image'    => 'Fjern udvalgt billede',
			'use_featured_image'       => 'Brug som udvalgt billede',
			'filter_items_list'        => 'Filtrer Deli Menu liste', 
			'items_list_navigation'    => 'Deli Menu liste navigation',
			'items_list'               => 'Deli Menu liste',
			'item_published'           => 'Deli Menu offentliggjort',
			'item_published_privately' => 'Deli Menu offentliggjort privat',
			'item_reverted_to_draft'   => 'Deli Menu lavet om til kladde',
			'item_scheduled'           => 'Deli Menu planlagt',
			'item_updated'             => 'Deli Menu opdateret',
		);

		$args = array(
			'rewrite' => array('slug' => 'deli'),
			'labels' => $labels,
			'description' => 'Menuer til Det Gamle Posthus, delikatesse.',
			'public' => true,
			'hierarchical' => false,
			'menu_position' => 22,
			'menu_icon' => 'dashicons-cart',
			'has_archive' => false,
			'supports' => array(
				'title', 'thumbnail'
			),
			
			
		);
		
		register_post_type( 'deli', $args);
	}

	/**
	 * Register the Deli Custom Fields
	 *
	 * @since 1.0.1
	 */
	public function register_custom_fields()
	{
		if( function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group(array(
				'key' => 'group_tob_xustrmr9ba',
				'title' => 'Deli Menu',
				'fields' => array(
					array(
						'key' => 'field_tob_bj0laibm3p',
						'label' => 'Menu',
						'name' => 'deli_menu',
						'type' => 'wysiwyg',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'tabs' => 'all',
						'toolbar' => 'full',
						'media_upload' => 1,
						'delay' => 0,
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'deli',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'seamless',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
			));
			
			endif;
	}

	/**
	 * Register Deli settings page
	 *
	 * @return void
	 */
	public function register_settings_page()
	{

		$option_page = acf_add_options_page(array(
            'page_title'    => __('Delikatesse Settings'),
			'menu_title'    => __('Settings'),		
			'menu_slug'     => 'tobenski-deli-settings',
			'parent_slug'	=> 'edit.php?post_type=deli',
            'capability'    => 'edit_posts',
			'redirect'      => false,
			'update_button' => __('Gem', 'acf'),
			'updated_message' => __("Instillinger er gemt", 'acf'),
		));
		
		// Settings
        acf_add_local_field_group(array(
            'key' => 'group_tob_akdyixi8qs',
            'title' => 'Delikatesse Settings',
            'fields' => array(
                array(
                    'key' => 'field_tob_d3ya1wizlr',
                    'label' => 'Beskrivelses Header',
                    'name' => 'tobenski_deli_description_header',
                    'type' => 'text',
                    'instructions' => 'Hvad der skal stå som overskrift til beskrivelsen.',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => 'TE’ Å TA’ MÆ’',
                    'placeholder' => '',
				),
				array(
                    'key' => 'field_tob_oggs4przkf',
                    'label' => 'Beskrivelse',
                    'name' => 'tobenski_deli_description',
                    'type' => 'wysiwyg',
                    'instructions' => 'Beskrivelsen til Take Away siden.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => "",
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                    'delay' => 0,
				),
				array(
					'key' => 'field_tob_ucv6tzeuhr',
					'label' => 'Top Image',
					'name' => 'tobenski_deli_image',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'url',
					'preview_size' => 'medium',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
				),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'tobenski-deli-settings',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'seamless',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
        ));
	}

}
