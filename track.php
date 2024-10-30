<?php

/*
Plugin Name: INSPIRING Shipment Tracking
Plugin URI: http://inspiringitsolutions.co.uk/
Description: INSPIRING Shipment Tracking
Version: 1.0
Author: inspiring
Author URI: http://inspiringitsolutions.co.uk/our-team/
*/
if ( ! defined('ABSPATH')) {
    exit;
}
define('INSP_TRACK_PLUGIN_FILE', __FILE__);
define('INSP_TRACK_PLUGIN_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ));
define('INSP_TRACK_PLUGIN_URL', untrailingslashit( plugin_dir_url( __FILE__ )));

require( INSP_TRACK_PLUGIN_DIR . '/admin/order.php' );
require( INSP_TRACK_PLUGIN_DIR . '/shortcode.php' );

