<?php
/**
 * Helper functions for the admin - plugin links and help tabs.
 *
 * @package    Easy Digital Downloads Toolbar
 * @subpackage Admin
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright 2012, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://genesisthemes.de/en/wp-plugins/edd-toolbar/
 * @link       http://twitter.com/#!/deckerweb
 *
 * @since 1.0
 * @version 1.1
 */

add_filter( 'edd_settings_misc', 'ddw_eddtb_add_settings' );
/**
 * Adds the settings to the "Easy Digital Downloads > Settings > Misc" section
 *
 * @since 1.1
 */
function ddw_eddtb_add_settings( $settings ) {

	$eddtb_settings = array(
		array(
			'id' => 'eddtb_settings',
			'name' => '<strong id="edd-toolbar">' . __( 'Extension: Toolbar Settings', 'edd-toolbar' ) . '</strong>',
			'desc' => __( 'Remove or add some sections', 'edd-toolbar' ),
			'type' => 'header'
		),
		array(
			'id' => 'eddtb_remove_resources',
			'name' => __( 'Display of Resources section', 'edd-toolbar' ),
			'desc' => __( 'Disable the Resources links section. (Default display: enabled)', 'edd-toolbar' ),
			'type' => 'checkbox'
		),
		array(
			'id' => 'eddtb_remove_translation_resources',
			'name' => __( 'Display of Translations Resources section', 'edd-toolbar' ),
			'desc' => __( 'Disable the Translations Resources links section. (Default display: enabled for all Non-English locales)', 'edd-toolbar' ),
			'type' => 'checkbox'
		)
	);

	return array_merge( $settings, $eddtb_settings );

}  // end of function ddw_eddtb_add_settings


/**
 * Add "Misc Settings Page" link to plugin page
 *
 * @since 1.2
 *
 * @param  $eddtb_links
 * @param  $eddtb_settings_link
 * @return strings settings link
 */
function ddw_eddtb_settings_page_link( $eddtb_links ) {

	$eddtb_settings_link = sprintf( '<a href="%s" title="%s">%s</a>' , admin_url( 'edit.php?post_type=download&page=edd-settings&tab=misc#edd-toolbar' ) , __( 'Go to the Misc settings page', 'edd-toolbar' ) , __( 'Settings', 'edd-toolbar' ) );
	
	array_unshift( $eddtb_links, $eddtb_settings_link );

	return $eddtb_links;

}  // end of function ddw_eddtb_settings_page_link


add_filter( 'plugin_row_meta', 'ddw_eddtb_plugin_links', 10, 2 );
/**
 * Add various support links to plugin page
 *
 * @since 1.0
 *
 * @param  $eddtb_links
 * @param  $eddtb_file
 * @return strings plugin links
 */
function ddw_eddtb_plugin_links( $eddtb_links, $eddtb_file ) {

	if ( ! current_user_can( 'install_plugins' ) )
		return $eddtb_links;

	if ( $eddtb_file == EDDTB_PLUGIN_BASEDIR . '/edd-toolbar.php' ) {
		$eddtb_links[] = '<a href="http://wordpress.org/extend/plugins/edd-toolbar/faq/" target="_new" title="' . __( 'FAQ', 'edd-toolbar' ) . '">' . __( 'FAQ', 'edd-toolbar' ) . '</a>';
		$eddtb_links[] = '<a href="http://wordpress.org/tags/edd-toolbar?forum_id=10" target="_new" title="' . __( 'Support', 'edd-toolbar' ) . '">' . __( 'Support', 'edd-toolbar' ) . '</a>';
		$eddtb_links[] = '<a href="' . __( 'http://genesisthemes.de/en/donate/', 'edd-toolbar' ) . '" target="_new" title="' . __( 'Donate', 'edd-toolbar' ) . '">' . __( 'Donate', 'edd-toolbar' ) . '</a>';
	}

	return $eddtb_links;

}  // end of function ddw_eddtb_plugin_links
