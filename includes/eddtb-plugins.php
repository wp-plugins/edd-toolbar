<?php
/**
 * Display links to active EDD plugins/extensions settings' pages
 *
 * @package    Easy Digital Downloads Toolbar
 * @subpackage Plugin/Extension Support
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright 2012, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://genesisthemes.de/en/wp-plugins/edd-toolbar/
 * @link       http://twitter.com/deckerweb
 *
 * @since 1.4.0
 */

/**
 * Add-On: Software Licenses (premium, by Pippin Williamson)
 *
 * @since 1.4.0
 */
if ( defined( 'EDD_SL_PLUGIN_URL' ) && current_user_can( 'manage_options' ) ) {

	/** Entry at "Add-Ons" section */
	$menu_items['eddao-softwarelicenses'] = array(
		'parent' => $eddaddons,
		'title'  => __( 'Software Licenses', 'edd-toolbar' ),
		'href'   => admin_url( 'edit.php?post_type=' . $eddtb_download_cpt . '&page=edd-licenses' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Software Licenses', 'edd-toolbar' ) )
	);

}  // end-if Software Licenses


/**
 * Add-On: Commissions (premium, by Pippin Williamson)
 *
 * @since 1.4.0
 */
if ( defined( 'EDDC_PLUGIN_URL' ) && current_user_can( 'manage_options' ) ) {

	/** Entry at "Add-Ons" section */
	$menu_items['eddao-commissions'] = array(
		'parent' => $eddaddons,
		'title'  => __( 'Commissions', 'edd-toolbar' ),
		'href'   => admin_url( 'edit.php?post_type=' . $eddtb_download_cpt . '&page=edd-commissions' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Commissions', 'edd-toolbar' ) )
	);

}  // end-if Commissions


/**
 * Add-On: Manual Purchases (premium, by Pippin Williamson)
 *
 * @since 1.4.0
 */
if ( class_exists( 'EDD_Manual_Purchases' ) && current_user_can( 'manage_options' ) ) {

	/** Entry at "Add-Ons" section */
	$menu_items['eddao-manualpayment'] = array(
		'parent' => $eddpayments,
		'title'  => __( 'Create Payment', 'edd-toolbar' ),
		'href'   => admin_url( 'options.php?page=edd-manual-purchase' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Create Payment - via Manual Purchases Add-On', 'edd-toolbar' ) )
	);

}  // end-if Manual Purchases


/**
 * Add-On: EDD Slider (premium, by Captain Theme)
 *
 * @since 1.4.0
 */
if ( defined( 'EDDSLIDER_PLUGIN_DIR' ) && ( current_user_can( 'manage_options' ) || current_user_can( 'administrator' ) ) ) {

	/** Entry at "Add-Ons" section */
	$menu_items['eddao-eddslider'] = array(
		'parent' => $eddaddons,
		'title'  => __( 'EDD Slider', 'edd-toolbar' ),
		'href'   => admin_url( 'edit.php?post_type=' . $eddtb_download_cpt . '&page=eddslider_options' ),
		'meta'   => array( 'target' => '', 'title' => __( 'EDD Slider', 'edd-toolbar' ) )
	);

}  // end-if EDD Slider
