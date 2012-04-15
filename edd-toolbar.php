<?php 
/**
 * Main plugin file. This plugin adds useful admin links and resources for the Easy Digital Downloads plugin to the WordPress Toolbar / Admin Bar.
 *
 * @package   Easy Digital Downloads Toolbar
 * @author    David Decker
 * @link      http://twitter.com/#!/deckerweb
 * @copyright Copyright 2012, David Decker - DECKERWEB
 *
 * Plugin Name: Easy Digital Downloads Toolbar
 * Plugin URI: http://genesisthemes.de/en/wp-plugins/edd-toolbar/
 * Description: This plugin adds useful admin links and resources for the Easy Digital Downloads plugin to the WordPress Toolbar / Admin Bar.
 * Version: 1.0
 * Author: David Decker - DECKERWEB
 * Author URI: http://deckerweb.de/
 * License: GPLv2
 * Text Domain: edd-toolbar
 * Domain Path: /languages/
 */

/**
 * Setting constants & some variables
 *
 * @since 1.0
 */
/** Plugin directory */
define( 'EDDTB_PLUGIN_DIR', dirname( __FILE__ ) );

/** Plugin base directory */
define( 'EDDTB_PLUGIN_BASEDIR', dirname( plugin_basename( __FILE__ ) ) );


add_action( 'init', 'ddw_eddtb_init' );
/**
 * Load the text domain for translation of the plugin
 * 
 * @since 1.0
 */
function ddw_eddtb_init() {

	/** First look in WordPress' "languages" folder = custom & update-secure! */
	load_plugin_textdomain( 'edd-toolbar', false, EDDTB_PLUGIN_BASEDIR . '/../../languages/edd-toolbar/' );

	/** Then look in plugin's "languages" folder = default */
	load_plugin_textdomain( 'edd-toolbar', false, EDDTB_PLUGIN_BASEDIR . '/languages/' );
}


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
}


add_action( 'admin_bar_menu', 'ddw_eddtb_toolbar_menu', 98 );
/**
 * Add new menu items to the WordPress Toolbar / Admin Bar.
 * 
 * @since 1.0
 *
 * @global mixed $wp_admin_bar
 */
function ddw_eddtb_toolbar_menu() {

	global $wp_admin_bar;

	/**
	 * Allows for filtering the general user role/capability to display main & sub-level items
	 *
	 * Default capability: 'edit_posts' (we need this for the "Downloads" post type set by EDD itself!)
	 *
	 * @since 1.0
	 */
	$eddtb_filter_capability = apply_filters( 'eddtb_filter_capability_all', 'edit_posts' );

	/**
	 * Required WordPress cabability to display new toolbar / admin bar entry
	 * Only showing items if toolbar / admin bar is activated and user is logged in!
	 *
	 * @since 1.0
	 */
	if ( ! is_user_logged_in() || 
		! is_admin_bar_showing() || 
		! current_user_can( $eddtb_filter_capability ) ||  // allows for custom filtering the required role/capability
		defined( 'EDDTB_DISPLAY' )  // allows for custom disabling
	)
		return;


	/** Set unique prefix */
	$prefix = 'ddw-edd-';
	
	/** Create parent menu item references */
	$eddbar = $prefix . 'admin-bar';				// root level
		$eddsupport = $prefix . 'eddsupport';				// sub level: edd support
		$edddocs = $prefix . 'edddocs';					// sub level: edd docs
		$eddsites = $prefix . 'eddsites';				// sub level: edd sites
			$eddfeatures = $prefix . 'eddfeatures';				// third level: edd features
		$edddownloads = $prefix . 'edddownloads';			// sub level: edd downloads
		$eddsettings = $prefix . 'eddsettings';				// sub level: edd settings
		$eddgroup = $prefix . 'eddgroup';				// sub level: edd group (resources)


	/** Make the "EDD" name filterable within menu items */
	$eddtb_edd_name = apply_filters( 'eddtb_filter_edd_name', __( 'EDD', 'edd-toolbar' ) );

	/** Make the "Easy Digital Downloads" name's tooltip filterable within menu items */
	$eddtb_edd_name_tooltip = apply_filters( 'eddtb_filter_edd_name_tooltip', _x( 'Easy Digital Downloads', 'Translators: For the tooltip', 'edd-toolbar' ) );


	/** "Sub Forum" string */
	$eddtb_sub_forum = __( 'Sub Forum', 'edd-toolbar' ) . ': ';

	/** For the Documentation search */
	$eddtb_search_docs = __( 'Search Docs', 'edd-toolbar' );
	$eddtb_go_button = '<input type="submit" value="' . __( 'GO', 'edd-toolbar' ) . '" class="eddtb-search-go"  /></form>';


	/** Display these items also when Easy Digital Downloads plugin is not installed */
	if ( ! defined( 'EDDTB_RESOURCES_DISPLAY' ) ) {
		$eddgroup_menu_items = array(

			// Support menu items
			'eddsupport' => array(
				'parent' => $eddgroup,
				'title'  => __( 'Support Forum', 'edd-toolbar' ),
				'href'   => 'http://easydigitaldownloads.com/forums/',
				'meta'   => array( 'title' => $eddtb_edd_name_tooltip . ' ' . __( 'Support Forum', 'edd-toolbar' ) )
			),
			'eddsupport-sub-faq' => array(
				'parent' => $eddsupport,
				'title'  => __( 'Frequently Asked Questions', 'edd-toolbar' ),
				'href'   => 'http://easydigitaldownloads.com/forums/forum/frequently-asked-questions/',
				'meta'   => array( 'title' => $eddtb_sub_forum . _x( 'Frequently Asked Questions', 'Translators: For the tooltip', 'edd-toolbar' ) )
			),
			'eddsupport-sub-devapi' => array(
				'parent' => $eddsupport,
				'title'  => __( 'Developer\'s API', 'edd-toolbar' ),
				'href'   => 'http://easydigitaldownloads.com/forums/forum/developers-api/',
				'meta'   => array( 'title' => $eddtb_sub_forum . _x( 'Developer\'s API', 'Translators: For the tooltip', 'edd-toolbar' ) )
			),
			'eddsupport-sub-addons' => array(
				'parent' => $eddsupport,
				'title'  => __( 'Add-On Plugins', 'edd-toolbar' ),
				'href'   => 'http://easydigitaldownloads.com/forums/forum/add-on-plugins/',
				'meta'   => array( 'title' => $eddtb_sub_forum . _x( 'Add-On Plugins', 'Translators: For the tooltip', 'edd-toolbar' ) )
			),
			'eddsupport-sub-requests' => array(
				'parent' => $eddsupport,
				'title'  => __( 'Feature Requests', 'edd-toolbar' ),
				'href'   => 'http://easydigitaldownloads.com/forums/forum/feature-requests/',
				'meta'   => array( 'title' => $eddtb_sub_forum . _x( 'Feature Requests', 'Translators: For the tooltip', 'edd-toolbar' ) )
			),
			'eddsupport-sub-tconflicts' => array(
				'parent' => $eddsupport,
				'title'  => __( 'Theme Conflicts', 'edd-toolbar' ),
				'href'   => 'http://easydigitaldownloads.com/forums/forum/theme-conflicts/',
				'meta'   => array( 'title' => $eddtb_sub_forum . _x( 'Theme Conflicts', 'Translators: For the tooltip', 'edd-toolbar' ) )
			),
			'eddsupport-sub-pconflicts' => array(
				'parent' => $eddsupport,
				'title'  => __( 'Plugin Conflicts', 'edd-toolbar' ),
				'href'   => 'http://easydigitaldownloads.com/forums/forum/plugin-conflicts/',
				'meta'   => array( 'title' => $eddtb_sub_forum . _x( 'Plugin Conflicts', 'Translators: For the tooltip', 'edd-toolbar' ) )
			),
			'eddsupport-sub-general' => array(
				'parent' => $eddsupport,
				'title'  => __( 'General Support', 'edd-toolbar' ),
				'href'   => 'http://easydigitaldownloads.com/forums/forum/general-support/',
				'meta'   => array( 'title' => $eddtb_sub_forum . _x( 'General Support', 'Translators: For the tooltip', 'edd-toolbar' ) )
			),
			'eddsupport-premium' => array(
				'parent' => $eddsupport,
				'title'  => __( 'Premium Support', 'edd-toolbar' ),
				'href'   => 'http://easydigitaldownloads.com/support/register/',
				'meta'   => array( 'title' => _x( 'Register for Premium Support Account', 'Translators: For the tooltip', 'edd-toolbar' ) )
			),
			'eddsupport-bugsgithub' => array(
				'parent' => $eddsupport,
				'title'  => __( 'Bug Tracker at GitHub', 'edd-toolbar' ),
				'href'   => 'https://github.com/pippinsplugins/Easy-Digital-Downloads/issues',
				'meta'   => array( 'title' => __( 'Bug Tracker at GitHub', 'edd-toolbar' ) )
			),

			// Documentation menu items
			'edddocs' => array(
				'parent' => $eddgroup,
				'title'  => __( 'Documentation', 'edd-toolbar' ),
				'href'   => 'http://easydigitaldownloads.com/documentation/',
				'meta'   => array( 'title' => __( 'Documentation', 'edd-toolbar' ) )
			),
			'edddocs-faq' => array(
				'parent' => $edddocs,
				'title'  => __( 'Frequently Asked Questions', 'edd-toolbar' ),
				'href'   => 'http://easydigitaldownloads.com/documentation/faqs/',
				'meta'   => array( 'title' => __( 'Frequently Asked Questions', 'edd-toolbar' ) )
			),
			'edddocs-install' => array(
				'parent' => $edddocs,
				'title'  => __( 'Installation', 'edd-toolbar' ),
				'href'   => 'http://easydigitaldownloads.com/docs/installation/',
				'meta'   => array( 'title' => __( 'Installation', 'edd-toolbar' ) )
			),
			'edddocs-basicconfig' => array(
				'parent' => $edddocs,
				'title'  => __( 'Basic Config', 'edd-toolbar' ),
				'href'   => 'http://easydigitaldownloads.com/docs/basic-config/',
				'meta'   => array( 'title' => __( 'Basic Config', 'edd-toolbar' ) )
			),
			'edddocs-createdownloads' => array(
				'parent' => $edddocs,
				'title'  => __( 'Create Downloads', 'edd-toolbar' ),
				'href'   => 'http://easydigitaldownloads.com/docs/create-your-first-download/',
				'meta'   => array( 'title' => __( 'Create Downloads', 'edd-toolbar' ) )
			),
			'edddocs-cartsetup' => array(
				'parent' => $edddocs,
				'title'  => __( 'Shopping Cart Setup', 'edd-toolbar' ),
				'href'   => 'http://easydigitaldownloads.com/docs/setting-up-the-shopping-cart/',
				'meta'   => array( 'title' => __( 'Shopping Cart Setup', 'edd-toolbar' ) )
			),

			// Docs search form
			'edddocs-searchform' => array(
				'parent' => $eddgroup,
				'title' => '<form method="get" action="http://easydigitaldownloads.com/" class=" " target="_blank">
				<input type="hidden" name="post_type" value="page" />
				<input type="text" placeholder="' . $eddtb_search_docs . '" onblur="this.value=(this.value==\'\') ? \'' . $eddtb_search_docs . '\' : this.value;" onfocus="this.value=(this.value==\'' . $eddtb_search_docs . '\') ? \'\' : this.value;" value="' . $eddtb_search_docs . '" name="s" value="' . esc_attr( 'Search Docs', 'edd-toolbar' ) . '" class="text eddtb-search-input" />' . $eddtb_go_button,
				'href'   => false,
				'meta'   => array( 'target' => '', 'title' => _x( 'Search Docs', 'Translators: For the tooltip', 'edd-toolbar' ) )
			),

			// Easy Digital Downloads HQ menu items
			'eddsites' => array(
				'parent' => $eddgroup,
				'title'  => $eddtb_edd_name . ' ' . __( 'Plugin HQ', 'edd-toolbar' ),
				'href'   => 'http://easydigitaldownloads.com/',
				'meta'   => array( 'title' => $eddtb_edd_name_tooltip . ' ' . __( 'Plugin HQ', 'edd-toolbar' ) )
			),
			'eddsites-dev' => array(
				'parent' => $eddsites,
				'title'  => __( 'GitHub Repository Developer Center', 'edd-toolbar' ),
				'href'   => 'https://github.com/pippinsplugins/Easy-Digital-Downloads',
				'meta'   => array( 'title' => __( 'GitHub Repository Developer Center', 'edd-toolbar' ) )
			),
			'eddsites-blog' => array(
				'parent' => $eddsites,
				'title'  => __( 'Official Blog', 'edd-toolbar' ),
				'href'   => 'http://easydigitaldownloads.com/blog/',
				'meta'   => array( 'title' => __( 'Official Blog', 'edd-toolbar' ) )
			),
			'eddfeatures' => array(
				'parent' => $eddsites,
				'title'  => __( 'Features', 'edd-toolbar' ),
				'href'   => 'http://easydigitaldownloads.com/features/',
				'meta'   => array( 'title' => __( 'Features', 'edd-toolbar' ) )
			),
			'eddfeatures-screens' => array(
				'parent' => $eddfeatures,
				'title'  => __( 'Screenshots', 'edd-toolbar' ),
				'href'   => 'http://easydigitaldownloads.com/screenshots/',
				'meta'   => array( 'title' => __( 'Screenshots', 'edd-toolbar' ) )
			),
			'eddsites-extensions' => array(
				'parent' => $eddsites,
				'title'  => __( 'Extensions', 'edd-toolbar' ),
				'href'   => 'http://easydigitaldownloads.com/extensions/',
				'meta'   => array( 'title' => __( 'Extensions', 'edd-toolbar' ) )
			),
			'eddsites-pplugins' => array(
				'parent' => $eddsites,
				'title'  => __( 'Pippins Plugins', 'edd-toolbar' ),
				'href'   => 'http://pippinsplugins.com/',
				'meta'   => array( 'title' => __( 'Pippins Plugins', 'edd-toolbar' ) )
			),
		);

	}  // end-if constant check for displaying resources


	/** Display language specific links only for these locales: de_DE, de_AT, de_CH, de_LU */
	if ( ! defined( 'EDDTB_DE_DISPLAY' ) && ( get_locale() == 'de_DE' || get_locale() == 'de_AT' || get_locale() == 'de_CH' || get_locale() == 'de_LU' ) ) {
		// German EDD language packs
		$eddgroup_menu_items['languages-de'] = array(
			'parent' => $eddgroup,
			'title'  => __( 'German language files', 'edd-toolbar' ),
			'href'   => 'http://deckerweb.de/material/sprachdateien/easy-digital-downloads-plugin/',
			'meta'   => array( 'title' => __( 'German language files for Easy Digital Downloads Plugin and more EDD extensions', 'edd-toolbar' ) )
		);
	}  // end-if German locales


	/** Show these items only if Easy Digital Downloads plugin is actually installed */
	if ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'easy-digital-downloads/easy-digital-downloads.php' ) ) || defined( 'EDD_PLUGIN_FILE' ) ) {

		/** EDD main downloads section */
		if ( current_user_can( 'edit_posts' ) ) {
			$menu_items['edddownloads'] = array(
				'parent' => $eddbar,
				'title'  => __( 'All Downloads', 'edd-toolbar' ),
				'href'   => admin_url( 'edit.php?post_type=download' ),
				'meta'   => array( 'target' => '', 'title' => __( 'All Downloads', 'edd-toolbar' ) )
			);
			$menu_items['edddownloads-add'] = array(
				'parent' => $edddownloads,
				'title'  => __( 'Add new Download', 'edd-toolbar' ),
				'href'   => admin_url( 'post-new.php?post_type=download' ),
				'meta'   => array( 'target' => '', 'title' => __( 'Add new Download', 'edd-toolbar' ) )
			);
			$menu_items['edddownloads-categories'] = array(
				'parent' => $edddownloads,
				'title'  => __( 'Categories', 'edd-toolbar' ),
				'href'   => admin_url( 'edit-tags.php?taxonomy=download_category&post_type=download' ),
				'meta'   => array( 'target' => '', 'title' => __( 'Download Categories', 'edd-toolbar' ) )
			);
			$menu_items['edddownloads-tags'] = array(
				'parent' => $edddownloads,
				'title'  => __( 'Tags', 'edd-toolbar' ),
				'href'   => admin_url( 'edit-tags.php?taxonomy=download_tag&post_type=download' ),
				'meta'   => array( 'target' => '', 'title' => __( 'Download Tags', 'edd-toolbar' ) )
			);
		} // end-if cap check

		/** EDD admin settings sections */
		if ( current_user_can( 'manage_options' ) ) {

			/** Payment History */
			$menu_items['eddpayments'] = array(
				'parent' => $eddbar,
				'title'  => __( 'Payment History', 'edd-toolbar' ),
				'href'   => admin_url( 'edit.php?post_type=download&page=edd-payment-history' ),
				'meta'   => array( 'target' => '', 'title' => __( 'Payment History', 'edd-toolbar' ) )
			);

			/** Discount Codes */
			$menu_items['edddiscounts'] = array(
				'parent' => $eddbar,
				'title'  => __( 'Discount Codes', 'edd-toolbar' ),
				'href'   => admin_url( 'edit.php?post_type=download&page=edd-discounts' ),
				'meta'   => array( 'target' => '', 'title' => __( 'Discount Codes', 'edd-toolbar' ) )
			);

			/** Reports */
			$menu_items['eddreports'] = array(
				'parent' => $eddbar,
				'title'  => __( 'Reports', 'edd-toolbar' ),
				'href'   => admin_url( 'edit.php?post_type=download&page=edd-reports' ),
				'meta'   => array( 'target' => '', 'title' => __( 'Reports', 'edd-toolbar' ) )
			);

			/** Settings */
			$menu_items['eddsettings'] = array(
				'parent' => $eddbar,
				'title'  => __( 'Settings', 'edd-toolbar' ),
				'href'   => admin_url( 'edit.php?post_type=download&page=edd-settings' ),
				'meta'   => array( 'target' => '', 'title' => _x( 'General Settings', 'Translators: For the tooltip', 'edd-toolbar' ) )
			);
			$menu_items['eddsettings-general'] = array(
				'parent' => $eddsettings,
				'title'  => __( 'General', 'edd-toolbar' ),
				'href'   => admin_url( 'edit.php?post_type=download&page=edd-settings&tab=general' ),
				'meta'   => array( 'target' => '', 'title' => _x( 'General Settings', 'Translators: For the tooltip', 'edd-toolbar' ) )
			);
			$menu_items['eddsettings-paymentgateways'] = array(
				'parent' => $eddsettings,
				'title'  => __( 'Payment Gateways', 'edd-toolbar' ),
				'href'   => admin_url( 'edit.php?post_type=download&page=edd-settings&tab=gateways' ),
				'meta'   => array( 'target' => '', 'title' => __( 'Payment Gateways', 'edd-toolbar' ) )
			);
			$menu_items['eddsettings-emails'] = array(
				'parent' => $eddsettings,
				'title'  => __( 'Emails', 'edd-toolbar' ),
				'href'   => admin_url( 'edit.php?post_type=download&page=edd-settings&tab=emails' ),
				'meta'   => array( 'target' => '', 'title' => __( 'Emails', 'edd-toolbar' ) )
			);
			$menu_items['eddsettings-other'] = array(
				'parent' => $eddsettings,
				'title'  => __( 'Misc.', 'edd-toolbar' ),
				'href'   => admin_url( 'edit.php?post_type=download&page=edd-settings&tab=misc' ),
				'meta'   => array( 'target' => '', 'title' => __( 'Misc.', 'edd-toolbar' ) )
			);

		} // end-if cap check

	} else {

		// If Easy Digital Downloads is not active, to avoid PHP notices
		$menu_items = $eddgroup_menu_items;

		// If Easy Digital Downloads is not active and no icon filter is active, then display no icon
		if ( ! has_filter( 'eddtb_filter_main_icon' ) ) {
			add_filter( 'eddtb_filter_main_item_icon_display', '__eddtb_no_icon_display' );
		}

	}  // end-if EDD conditional


	/** Allow menu items to be filtered, but pass in parent menu item IDs */
	$menu_items = (array) apply_filters( 'ddw_eddtb_menu_items', $menu_items, $eddgroup_menu_items, $prefix, $eddbar, 
						$eddsupport, $edddocs, $eddsites, $eddfeatures, $eddsettings, $eddgroup );


	/**
	 * Add the Easy Digital Downloads top-level menu item
	 *
	 * @since 1.0
	 *
	 * @param $eddtb_main_item_title
	 * @param $eddtb_main_item_title_tooltip
	 * @param $eddtb_main_item_icon_display
	 */
		/** Filter the main item name */
		$eddtb_main_item_title = apply_filters( 'eddtb_filter_main_item', __( 'Downloads', 'edd-toolbar' ) );

		/** Filter the main item name's tooltip */
		$eddtb_main_item_title_tooltip = apply_filters( 'eddtb_filter_main_item_tooltip', _x( 'Easy Digital Downloads', 'Translators: For the tooltip', 'edd-toolbar' ) );

		/** Filter the main item icon's class/display */
		$eddtb_main_item_icon_display = apply_filters( 'eddtb_filter_main_item_icon_display', 'icon-edd' );

		$wp_admin_bar->add_menu( array(
			'id'    => $eddbar,
			'title' => $eddtb_main_item_title,
			'href'  => admin_url( 'edit.php?post_type=download' ),
			'meta'  => array( 'class' => $eddtb_main_item_icon_display, 'title' => $eddtb_main_item_title_tooltip )
		) );


	/** Loop through the menu items */
	foreach ( $menu_items as $id => $menu_item ) {
		
		// Add in the item ID
		$menu_item['id'] = $prefix . $id;

		// Add meta target to each item where it's not already set, so links open in new window/tab
		if ( ! isset( $menu_item['meta']['target'] ) )		
			$menu_item['meta']['target'] = '_blank';

		// Add class to links that open up in a new window/tab
		if ( '_blank' === $menu_item['meta']['target'] ) {
			if ( ! isset( $menu_item['meta']['class'] ) )
				$menu_item['meta']['class'] = '';
			$menu_item['meta']['class'] .= $prefix . 'eddtb-new-tab';
		}

		// Add item
		$wp_admin_bar->add_menu( $menu_item );

	}  // end foreach menu items


	/** EDD Group: Main Entry */
	$wp_admin_bar->add_group( array(
		'parent' => $eddbar,
		'id'     => $eddgroup,
		'meta'   => array( 'class' => 'ab-sub-secondary' )
	) );


	/** EDD Group: Loop through the group menu items */
	foreach ( $eddgroup_menu_items as $id => $eddgroup_menu_item ) {
		
		// EDD Group: Add in the item ID
		$eddgroup_menu_item['id'] = $prefix . $id;

		// EDD Group: Add meta target to each item where it's not already set, so links open in new window/tab
		if ( ! isset( $eddgroup_menu_item['meta']['target'] ) )		
			$eddgroup_menu_item['meta']['target'] = '_blank';

		// EDD Group: Add class to links that open up in a new window/tab
		if ( '_blank' === $eddgroup_menu_item['meta']['target'] ) {
			if ( ! isset( $eddgroup_menu_item['meta']['class'] ) )
				$eddgroup_menu_item['meta']['class'] = '';
			$eddgroup_menu_item['meta']['class'] .= $prefix . 'eddtb-new-tab';
		}

		// EDD Group: Add item
		$wp_admin_bar->add_menu( $eddgroup_menu_item );

	}  // end foreach EDD Group

}  // end of main function


add_action( 'wp_head', 'ddw_eddtb_admin_style' );
add_action( 'admin_head', 'ddw_eddtb_admin_style' );
/**
 * Add the styles for new WordPress Toolbar / Admin Bar entry
 * 
 * @since 1.0
 *
 * @param $eddtb_main_icon
 */
function ddw_eddtb_admin_style() {

	/** No styles if admin bar is disabled or user is not logged in */
	if ( ! is_admin_bar_showing() || ! is_user_logged_in() )
		return;

	/** Add CSS styles to wp_head/admin_head */
	$eddtb_main_icon = apply_filters( 'eddtb_filter_main_icon', plugins_url( 'edd-toolbar/images/icon-eddtb.png',
dirname( __FILE__ ) ) );

	?>
	<style type="text/css">
		#wpadminbar.nojs .ab-top-menu > li.menupop.icon-edd:hover > .ab-item,
		#wpadminbar .ab-top-menu > li.menupop.icon-edd.hover > .ab-item,
		#wpadminbar.nojs .ab-top-menu > li.menupop.icon-edd > .ab-item,
		#wpadminbar .ab-top-menu > li.menupop.icon-edd > .ab-item {
      			background-image: url(<?php echo $eddtb_main_icon; ?>);
			background-repeat: no-repeat;
			background-position: 0.85em 50%;
			padding-left: 30px;
		}
		#wp-admin-bar-ddw-edd-languages-de > .ab-item:before {
			color: #ff9900;
			content: '• ';
		}
		#wpadminbar .eddtb-search-input {
			width: 140px;
		}
		#wpadminbar .eddtb-search-input,
		#wpadminbar .eddtb-search-go {
			color: #21759b;
			text-shadow: none;
		}
		#wpadminbar .eddtb-search-input,
		#wpadminbar .eddtb-search-go {
			background-color: #fff;
			height: 18px;
			line-height: 18px;
			padding: 1px 4px;
		}
		#wpadminbar .eddtb-search-go {
			-webkit-border-radius: 11px;
			   -moz-border-radius: 11px;
			        border-radius: 11px;
			font-size: 0.67em;
			margin: 0 0 0 2px;
		}
	</style>
	<?php

}  // end of function ddw_eddtb_admin_style


/**
 * Helper functions for custom branding of the plugin
 *
 * @since 1.0
 */
	/** Include plugin file with special custom stuff */
	require_once( EDDTB_PLUGIN_DIR . '/includes/eddtb-branding.php' );
