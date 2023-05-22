<?php
/*
 * @wordpress-plugin
 * Plugin Name:  ACF6 Gutenberg Blocks
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

// Include core functions file
require_once plugin_dir_path(__FILE__) . 'includes/functions.php';

function load_admin_files() {
    error_log('is admin');
    require_once plugin_dir_path(__FILE__) . 'admin/admin-menu.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-page.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-register.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-callback.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-validation.php';
}
add_action('admin_init', 'load_admin_files');



// Function to set default plugin options
function acf_plugin_options_default()
{
    return array(
        'custom_title'   => 'default variables if needed',
    );
}



// Section below will loop through all blocks in the blocks folder and register them
// Function to register blocks
function acf_plugin_register_blocks() {
    $plugin_path = plugin_dir_path(__FILE__);
    $blocks = acf_plugin_acf_get_blocks();
    foreach ($blocks as $block) {
        if (file_exists($plugin_path . 'blocks/' . $block . '/block.json')) {
            register_block_type($plugin_path . 'blocks/' . $block . '/block.json');
            if (file_exists($plugin_path . 'blocks/' . $block . '/init.php')) {
                include_once $plugin_path . 'blocks/' . $block . '/init.php';
            }
        }
    }
}
// Add action to register blocks on init
add_action('init', 'acf_plugin_register_blocks', 5);

// Function to enqueue styles
function acf_plugin_enqueue_styles() {
    $plugin_path = plugin_dir_path(__FILE__);
    $plugin_url = plugin_dir_url(__FILE__);
    $blocks = acf_plugin_acf_get_blocks();
    foreach ($blocks as $block) {
        wp_register_style('block-' . $block, $plugin_url . 'blocks/' . $block . '/style.css', null, null);
        wp_enqueue_style('block-' . $block);
    }
}
// Add action to enqueue styles in frontend and backend
add_action('wp_enqueue_scripts', 'acf_plugin_enqueue_styles');  // used in frontend
add_action('admin_enqueue_scripts', 'acf_plugin_enqueue_styles');  // used in backend

// Function to enqueue scripts
function acf_plugin_enqueue_scripts() {
    $plugin_path = plugin_dir_path(__FILE__);
    $plugin_url = plugin_dir_url(__FILE__);
    $blocks = acf_plugin_acf_get_blocks();
    foreach ($blocks as $block) {
        // Register and enqueue script for each block
        if (file_exists($plugin_path . 'blocks/' . $block . '/script.js')) {
            wp_register_script('block-script-' . $block, $plugin_url . 'blocks/' . $block . '/script.js', array('jquery'), '1.0', true);
            wp_enqueue_script('block-script-' . $block);
        }
        // Register and enqueue editor script for each block
        if (is_admin() && file_exists($plugin_path . 'blocks/' . $block . '/editorscript.js')) {
            wp_register_script('block-editor-script-' . $block, $plugin_url . 'blocks/' . $block . '/editorscript.js', array('jquery'), '1.0', true);
            wp_enqueue_script('block-editor-script-' . $block);
        }
    }
}
// Add action to enqueue scripts in frontend and backend
add_action('wp_enqueue_scripts', 'acf_plugin_enqueue_scripts');  // used in frontend
add_action('admin_enqueue_scripts', 'acf_plugin_enqueue_scripts');  // used in backend

// Function to load ACF field group
function acf_plugin_acf_load_acf_field_group($paths)
{
    $plugin_path = plugin_dir_path(__FILE__);
    $blocks = acf_plugin_acf_get_blocks();
    foreach ($blocks as $block) {
        $paths[] = $plugin_path . 'blocks/' . $block;
    }
     // Add the root of the plugin to the paths array so ACF can get the JSON files for the admin pages
     $paths[] = $plugin_path;
    return $paths;
}
// Add filter to load ACF field group
add_filter('acf/settings/load_json', 'acf_plugin_acf_load_acf_field_group');

// Function to get blocks
function acf_plugin_acf_get_blocks()
{
    $blocks = scandir(plugin_dir_path(__FILE__) . '/blocks/');
    $blocks = array_values(array_diff($blocks, array('..', '.', '.DS_Store', '_base-block')));
    return $blocks;
}


// Tried to move this to admin-menu.php but it didn't work
function add_acf_options_pages() {
    if( function_exists('acf_add_options_page') ) {
        error_log('admin-menu.php: acf_add_options_page');

        acf_add_options_page(array(
            'page_title'    => 'ACF6 Plugin Settings',
            'menu_title'    => 'ACF6 Plugin Settings',
            'menu_slug'     => 'acf6-settings',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ));

        acf_add_options_sub_page(array(
            'page_title'    => 'submenu page1',
            'menu_title'    => 'Submenu page1',
            'parent_slug'   => 'acf6-settings',
        ));

        acf_add_options_sub_page(array(
            'page_title'    => 'Submenu page2',
            'menu_title'    => 'Submenu page2',
            'parent_slug'   => 'acf6-settings',
        ));
    }
}
add_action('acf/init', 'add_acf_options_pages');
