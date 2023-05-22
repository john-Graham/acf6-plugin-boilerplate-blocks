<?php 
// acf plugin 
if (!defined('ABSPATH')) exit;

error_log('admin-menu.php');

// function add_acf_options_pages() {
//     if( function_exists('acf_add_options_page') ) {
//         error_log('admin-menu.php: acf_add_options_page');

//         acf_add_options_page(array(
//             'page_title'    => 'ACF6 Plugin Settings',
//             'menu_title'    => 'ACF6 Plugin Settings',
//             'menu_slug'     => 'acf6-settings',
//             'capability'    => 'edit_posts',
//             'redirect'      => false
//         ));

//         acf_add_options_sub_page(array(
//             'page_title'    => 'submenu page1',
//             'menu_title'    => 'Submenu page1',
//             'parent_slug'   => 'acf6-settings',
//         ));

//         acf_add_options_sub_page(array(
//             'page_title'    => 'Submenu page2',
//             'menu_title'    => 'Submenu page2',
//             'parent_slug'   => 'acf6-settings',
//         ));
//     }
// }
// add_action('acf/init', 'add_acf_options_pages');
