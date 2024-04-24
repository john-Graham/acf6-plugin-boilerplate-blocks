<?php

// To update this uninstall.php file, you need to update the following:
// 1. Update the function calls for your CPT name
// 2. Update the function calls for your taxonomy name
// 3. Update the function calls for your ACF field group key
// Need to add same for ACF options pages




// Exit if accessed directly
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Function to delete all posts of a given custom post type
function delete_custom_post_type_entries($post_type) {
    // error_log('Deleting entries for post type: ' . $post_type);
    $args = array(
        'post_type' => $post_type,  // Use the passed post type name
        'posts_per_page' => -1,
        'fields' => 'ids', // Retrieve only the IDs for better performance
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        foreach ($query->posts as $post_id) {
            wp_delete_post($post_id, true); // True to bypass trash
        }
    }
}

// Function to delete all terms of a custom taxonomy
function delete_custom_taxonomy_terms($taxonomy) {
    $terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'fields' => 'ids', // Fetch only the IDs for efficiency
        'hide_empty' => false, // Get all terms, even if they're not assigned to any posts
    ));

    if (!is_wp_error($terms)) {
        foreach ($terms as $term_id) {
            wp_delete_term($term_id, $taxonomy);
        }
    }
}

// Function to delete an ACF field group by key
function delete_acf_field_group_by_key($field_group_key) {
    // error_log('function delete_acf_field_group_by_key() called');
    if (function_exists('acf_delete_field_group')) {
        $field_group = acf_get_field_group($field_group_key);
        if ($field_group) {
            acf_delete_field_group($field_group_key);
        }
    }
}

// Deleting the field group for acf meta fields
// I often have a field group for meta fields that I use in my custom post types thus you'll see two examples below
//EXAMPLE delete_acf_field_group_by_key('group_6536d2eba9z6H');
delete_acf_field_group_by_key('YOUR_FIELD_GROUP_KEY');

// Deleting the field group for acf blocks
delete_acf_field_group_by_key('YOUR_FIELD_GROUP_KEY');

// Call the function to delete custom post type entries
delete_custom_post_type_entries('YOUR_CUSTOM_POST_TYPE_NAME');

// call the function to delete the custom taxonomy for board members called 'board'
delete_custom_taxonomy_terms('YOUR_CUSTOM_TAXONOMY_NAME');


// Clear any cached data that has been removed
wp_cache_flush();
 

