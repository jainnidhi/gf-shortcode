<?php
/*
Plugin Name: Gravity Form Shortcode
Plugin URI: http://ideaboxcreations.com/
Description: Provide shortcode for the Gravity Form
Version: 1.0.0
Author: IdeaBox Creations
Author URI: http://ideaboxcreations.com/
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
    exit;
}

/**
 * Class GF_Shortcode
 *
 * Handles the logic to display shortcode column in Gravity Forms list
 */
class GF_Shortcode
{

	/**
	 * class constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct()
	{
		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Initialize the hooks and filters
	 *
	 * @since 1.0.0
	 */
	public function init()
	{
		if ( is_admin() && class_exists( 'GFForms' ) )
		{
			add_filter( 'gform_form_list_columns', array( $this, 'gfsc_custom_column' ), 10, 1 );
			add_action( 'gform_form_list_column_shortcode', array( $this, 'gfsc_custom_column_shortcode' ), 10, 1 );
		}
	}

	/**
	 * Add Shortcode coulmn to Gravity Forms list
	 *
	 * @since 1.0.0
	 *
	 * @param array $columns Default columns of Gravity Forms list.
	 * @return array $column Custom column along with default columns.
	 */
	public function gfsc_custom_column( $columns )
	{
	    $new_column = array( 'shortcode' => esc_html__( 'Shortcode', 'gfsc' ) );
		$column = array_merge( $columns, $new_column );

		return $column;
	}

	/**
	 * Print data in Shortcode coulmn
	 *
	 * @since 1.0.0
	 *
	 * @param object $item Contains column data
	 * @return void
	 */
	public function gfsc_custom_column_shortcode( $item )
	{
		echo '[gravityform id="'.$item->id.'"]';
	}
}

$gfsc = new GF_Shortcode();
