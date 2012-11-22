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
 * @link       http://twitter.com/deckerweb
 *
 * @since 1.0.0
 */

/**
 * Setting internal plugin helper links constants
 *
 * @since 1.4.0
 */
define( 'EDDTB_URL_TRANSLATE',		'http://translate.wpautobahn.com/projects/wordpress-plugins-deckerweb/edd-toolbar' );
define( 'EDDTB_URL_WPORG_FAQ',		'http://wordpress.org/extend/plugins/edd-toolbar/faq/' );
define( 'EDDTB_URL_WPORG_FORUM',	'http://wordpress.org/support/plugin/edd-toolbar' );
define( 'EDDTB_URL_WPORG_PROFILE',	'http://profiles.wordpress.org/daveshine/' );
define( 'EDDTB_URL_SUGGESTIONS',	'http://twitter.com/deckerweb' );
define( 'EDDTB_URL_SNIPPETS',		'https://gist.github.com/2392882' );
define( 'EDDTB_PLUGIN_LICENSE', 	'GPLv2+' );
if ( get_locale() == 'de_DE' || get_locale() == 'de_AT' || get_locale() == 'de_CH' || get_locale() == 'de_LU' ) {
	define( 'EDDTB_URL_DONATE', 	'http://genesisthemes.de/spenden/' );
	define( 'EDDTB_URL_PLUGIN',	'http://genesisthemes.de/plugins/edd-toolbar/' );
	define( 'EDDTB_URL_WEBSITE',	'http://genesisthemes.de/' );
} else {
	define( 'EDDTB_URL_DONATE', 	'http://genesisthemes.de/en/donate/' );
	define( 'EDDTB_URL_PLUGIN', 	'http://genesisthemes.de/en/wp-plugins/edd-toolbar/' );
	define( 'EDDTB_URL_WEBSITE',	'http://genesisthemes.de/en/' );
}


add_filter( 'edd_settings_misc', 'ddw_eddtb_add_settings' );
/**
 * Adds the settings to the "Easy Digital Downloads > Settings > Misc" section
 *
 * @since 1.1.0
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
 * @since 1.2.0
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
 * @since 1.0.0
 *
 * @param  $eddtb_links
 * @param  $eddtb_file
 *
 * @return strings plugin links
 */
function ddw_eddtb_plugin_links( $eddtb_links, $eddtb_file ) {

	/** Capability check */
	if ( ! current_user_can( 'install_plugins' ) ) {

		return $eddtb_links;

	}

	/** List additional links only for this plugin */
	if ( $eddtb_file == EDDTB_PLUGIN_BASEDIR . '/edd-toolbar.php' ) {
		$eddtb_links[] = '<a href="' . esc_url_raw( EDDTB_URL_WPORG_FAQ ) . '" target="_new" title="' . __( 'FAQ', 'edd-toolbar' ) . '">' . __( 'FAQ', 'edd-toolbar' ) . '</a>';
		$eddtb_links[] = '<a href="' . esc_url_raw( EDDTB_URL_WPORG_FORUM ) . '" target="_new" title="' . __( 'Support', 'edd-toolbar' ) . '">' . __( 'Support', 'edd-toolbar' ) . '</a>';
		$eddtb_links[] = '<a href="' . esc_url_raw( EDDTB_URL_TRANSLATE ) . '" target="_new" title="' . __( 'Translations', 'edd-toolbar' ) . '">' . __( 'Translations', 'edd-toolbar' ) . '</a>';
		$eddtb_links[] = '<a href="' . esc_url_raw( EDDTB_URL_DONATE ) . '" target="_new" title="' . __( 'Donate', 'edd-toolbar' ) . '"><strong>' . __( 'Donate', 'edd-toolbar' ) . '</strong></a>';
	}

	/** Output the links */
	return $eddtb_links;

}  // end of function ddw_eddtb_plugin_links


add_action( 'admin_init', 'ddw_eddtb_edd_load_help' );
/**
 * Load plugin help tab on EDD admin pages.
 *
 * @since 1.4.0
 *
 * @global mixed $edd_settings_page, $edd_discounts_page, $edd_payments_page, $edd_reports_page, $edd_add_ons_page
 */
function ddw_eddtb_edd_load_help() {

	global $edd_settings_page, $edd_discounts_page, $edd_payments_page, $edd_reports_page, $edd_add_ons_page;

	/** Only add help if EDD backend is active */

	add_action( 'load-' . $edd_settings_page, 'ddw_eddtb_edd_help', 15 );
	add_action( 'load-' . $edd_discounts_page, 'ddw_eddtb_edd_help', 15 );
	add_action( 'load-' . $edd_payments_page, 'ddw_eddtb_edd_help', 15 );
	add_action( 'load-' . $edd_reports_page, 'ddw_eddtb_edd_help', 15 );
	add_action( 'load-' . $edd_add_ons_page, 'ddw_eddtb_edd_help', 15 );

}  // end of function ddw_eddtb_edd_load_help


add_action( 'load-edit.php', 'ddw_eddtb_edd_cpt_load_help', 15 );
add_action( 'load-post.php', 'ddw_eddtb_edd_cpt_load_help', 15 );
add_action( 'load-post-new.php', 'ddw_eddtb_edd_cpt_load_help', 15 );
/**
 * Load plugin help tab on EDD's 'Download' CPT pages.
 *
 * @since 1.4.0
 *
 * @global mixed $eddtb_edd_screen, $post
 */
function ddw_eddtb_edd_cpt_load_help() {

	global $eddtb_edd_screen, $post;

	$eddtb_edd_screen = get_current_screen();

	/** Add the help tab */
	if ( ( 'edit' == $eddtb_edd_screen->base || 'post' == $eddtb_edd_screen->base || 'post-new' == $eddtb_edd_screen->base ) && 'download' == $eddtb_edd_screen->post_type ) {
		$eddtb_edd_screen->add_help_tab( array(
			'id'      => 'edd-toolbar-help',
			'title'   => __( 'EDD Toolbar', 'edd-toolbar' ),
			'callback' => 'ddw_eddtb_help_tab_content',
		) );
	}

	/** Add help sidebar */
	if ( 'edit' == $eddtb_edd_screen->base && 'download' == $eddtb_edd_screen->post_type ) {
		$eddtb_edd_screen->set_help_sidebar( ddw_eddtb_help_sidebar_content() );
	}

}  // end of function ddw_eddtb_edd_cpt_load_help


/**
 * Setup plugin help tab.
 *
 * @since 1.4.0
 *
 * @global mixed $eddtb_edd_screen
 */
function ddw_eddtb_edd_help() {

	global $eddtb_edd_screen;

	$eddtb_edd_screen = get_current_screen();

	/** Display help tabs only for WordPress 3.3 or higher */
	if ( ! class_exists( 'WP_Screen' )
		|| ! $eddtb_edd_screen
		|| ! defined( 'EDD_PLUGIN_DIR' )
		|| ! EDDTB_DISPLAY
	) {
		return;
	}

	/** Add the help tab */
	$eddtb_edd_screen->add_help_tab( array(
		'id'      => 'edd-toolbar-help',
		'title'   => __( 'EDD Toolbar', 'edd-toolbar' ),
		'callback' => 'ddw_eddtb_help_tab_content',
	) );

	/** Add help sidebar */
	if ( 'edd-discounts' != $_GET['page'] ) {

		$eddtb_edd_screen->set_help_sidebar( ddw_eddtb_help_sidebar_content() );

	}  // end-if page hook check

}  // end of function ddw_eddtb_edd_help


/**
 * Create and display plugin help tab content.
 *
 * @since 1.4.0
 */
function ddw_eddtb_help_tab_content() {

	echo '<h3>' . __( 'Plugin', 'edd-toolbar' ) . ': ' . __( 'Easy Digital Downloads Toolbar', 'edd-toolbar' ) . ' <small>v' . esc_attr( ddw_eddtb_plugin_get_data( 'Version' ) ) . '</small></h3>' .		
		'<ul>' . 
			'<li><a href="' . esc_url_raw( EDDTB_URL_SUGGESTIONS ) . '" target="_new" title="' . __( 'Suggest new resource items, themes or plugins for support', 'edd-toolbar' ) . '">' . __( 'Suggest new resource items, themes or plugins for support', 'edd-toolbar' ) . '</a></li>' .
			'<li><a href="' . esc_url_raw( EDDTB_URL_SNIPPETS ) . '" target="_new" title="' . __( 'Code snippets for customizing &amp; branding', 'edd-toolbar' ) . '">' . __( 'Code snippets for customizing &amp; branding', 'edd-toolbar' ) . '</a></li>';

		echo '<li><em>' . __( 'Other, recommended EDD plugins', 'edd-toolbar' ) . '</em>:';

			/** Optional: recommended plugins */
			if ( ! defined( 'EDDSW_PLUGIN_BASEDIR' ) ) {

				echo '<br />&raquo; <a href="http://wordpress.org/extend/plugins/edd-search-widget/" target="_new" title="Easy Digital Downloads Search Widget">Easy Digital Downloads Search Widget</a> &mdash; ' . __( 'search functionality for the Download post type, independent from regular WordPress search', 'edd-toolbar' );

			}  // end-if plugin check

			if ( ! function_exists( 'edd_widgets_pack_init' ) ) {

				echo '<br />&raquo; <a href="http://deckerweb.de/go/edd-widgets-pack/" target="_new" title="Easy Digital Downloads Widgets Pack">Easy Digital Downloads Widgets Pack</a> &mdash; ' . __( '8 more nice little widgets for Easy Digital Downloads', 'edd-toolbar' );

			}  // end-if plugin check

		echo '<br />&raquo; <a href="http://deckerweb.de/go/edd-extensions/" target="_new" title="' . __( 'Get even more EDD extensions', 'edd-toolbar' ) . ' &hellip;">' . __( 'Get even more EDD extensions', 'edd-toolbar' ) . ' &hellip;</a></li>';

	echo '</ul>' .
		'<p><strong>' . __( 'Important plugin links:', 'edd-toolbar' ) . '</strong>' . 
		'<br /><a href="' . esc_url_raw( EDDTB_URL_PLUGIN ) . '" target="_new" title="' . __( 'Plugin website', 'edd-toolbar' ) . '">' . __( 'Plugin website', 'edd-toolbar' ) . '</a> | <a href="' . esc_url_raw( EDDTB_URL_WPORG_FAQ ) . '" target="_new" title="' . __( 'FAQ', 'edd-toolbar' ) . '">' . __( 'FAQ', 'edd-toolbar' ) . '</a> | <a href="' . esc_url_raw( EDDTB_URL_WPORG_FORUM ) . '" target="_new" title="' . __( 'Support', 'edd-toolbar' ) . '">' . __( 'Support', 'edd-toolbar' ) . '</a> | <a href="' . esc_url_raw( EDDTB_URL_TRANSLATE ) . '" target="_new" title="' . __( 'Translations', 'edd-toolbar' ) . '">' . __( 'Translations', 'edd-toolbar' ) . '</a> | <a href="' . esc_url_raw( EDDTB_URL_DONATE ) . '" target="_new" title="' . __( 'Donate', 'edd-toolbar' ) . '"><strong>' . __( 'Donate', 'edd-toolbar' ) . '</strong></a></p>' .
		'<p><a href="http://www.opensource.org/licenses/gpl-license.php" target="_new" title="' . esc_attr( EDDTB_PLUGIN_LICENSE ). '">' . esc_attr( EDDTB_PLUGIN_LICENSE ). '</a> &copy; ' . date( 'Y' ) . ' <a href="' . esc_url_raw( ddw_eddtb_plugin_get_data( 'AuthorURI' ) ) . '" target="_new" title="' . esc_attr__( ddw_eddtb_plugin_get_data( 'Author' ) ) . '">' . esc_attr__( ddw_eddtb_plugin_get_data( 'Author' ) ) . '</a></p>';

}  // end of function ddw_eddtb_help_tab_content


/**
 * Helper function for returning the Help Sidebar content.
 *
 * @since 1.4.0
 */
function ddw_eddtb_help_sidebar_content() {

	$eddtb_help_sidebar = '<p><strong>' . __( 'More about the plugin author', 'edd-toolbar' ) . '</strong></p>' .
					'<p>' . __( 'Social:', 'edd-toolbar' ) . '<br /><a href="http://twitter.com/deckerweb" target="_blank" title="@ Twitter">Twitter</a> | <a href="http://www.facebook.com/deckerweb.service" target="_blank" title="@ Facebook">Facebook</a> | <a href="http://deckerweb.de/gplus" target="_blank" title="@ Google+">Google+</a> | <a href="' . esc_url_raw( ddw_eddtb_plugin_get_data( 'AuthorURI' ) ) . '" target="_blank" title="@ deckerweb.de">deckerweb</a></p>' .
					'<p><a href="' . esc_url_raw( EDDTB_URL_WPORG_PROFILE ) . '" target="_blank" title="@ WordPress.org">@ WordPress.org</a></p>';

	return $eddtb_help_sidebar;

}  // end of function ddw_eddtb_help_sidebar_content
