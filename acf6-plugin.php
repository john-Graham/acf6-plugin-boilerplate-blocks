<?php
/*
 * @wordpress-plugin
 * Plugin Name:  ACF6 Gutenberg Blocks plugin
 * Plugin URI:    
 * Description:   Shell for creating ACF6 Gutenberg Blocks using block.json
 * Version:   .1
 * Author:   John Graham
 * Author URI:    https://github.com/johndgraham    
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Define our handy constants.
define( 'ACF_PLUGIN_VERSION', '0.1' );
define( 'ACF_PLUGIN_PLUGIN_DIR', __DIR__ );
define( 'ACF_PLUGIN_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'ACF_PLUGIN_PLUGIN_BLOCKS', ACF_PLUGIN_PLUGIN_DIR . '/blocks/' );



// Set custom load & save JSON points for ACF sync.
require 'includes/acf-json.php';
// Register blocks and other handy ACF Block helpers.
require 'includes/acf-blocks.php';
// Register a default "Site Settings" Options Page.
// require 'includes/acf-settings-page.php'; removed for now
// Restrict access to ACF Admin screens.
require 'includes/acf-restrict-access.php';
// Display and template helpers.
// require 'includes/template-tags.php';  removed
// Register taxonomies.
// require 'includes/acf-taxonomies.php';  moved to taxonomy_name.php

// If you want to switch from the json sync to PHP, you can include the following:
// advantages are this removes the need for the acf-json folder and the need to sync json files 
// Also removes the ability modify the fields in the admin
// require 'includes/field-groups/field_group_name.php';
// require 'includes/post-types/post_type_name.php';
// require 'includes/taxonomies/taxonomy_name.php';    
// require 'includes/acf-options-pages.php';