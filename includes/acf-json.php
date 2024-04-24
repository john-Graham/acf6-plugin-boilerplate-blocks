<?php
/**
 * ACF Set custom load and save JSON points.
 *
 * @link https://www.advancedcustomfields.com/resources/local-json/
 */

 // setting where to load the json files
 // This can be changed to make sure the json files are also saved in the plugin folder

 // setting where to save the json files
 // Generic location for all ACF JSON files.
add_filter( 'acf/json/load_paths', 'acf_plugin_json_load_paths' );
// add_filter( 'acf/settings/save_json/type=acf-field-group', 'acf_plugin_json_save_path_for_field_groups' );
// Update the key to match the field group key.
add_filter( 'acf/settings/save_json/key=group_111111111111', 'acf_plugin_json_save_path_for_field_groups' );

// add_filter( 'acf/settings/save_json/type=acf-ui-options-page', 'acf_plugin_json_save_path_for_option_pages' );
// add_filter( 'acf/settings/save_json/type=acf-post-type', 'acf_plugin_json_save_path_for_post_types' );

// Update the key to match the post type key.
add_filter( 'acf/settings/save_json/key=post_type_11111111111', 'acf_plugin_json_save_path_for_post_types' );
// add_filter( 'acf/settings/save_json/type=acf-taxonomy', 'acf_plugin_json_save_path_for_taxonomies' );
add_filter( 'acf/json/save_file_name', 'acf_plugin_json_filename', 10, 3 );

// add_filter('acf/settings/save_json/type=acf-taxonomy', 'acf_plugin_json_save_path_for_taxonomies');

// moved to acf-taxonomies.php
add_filter( 'acf/settings/save_json/key=taxonomy_111111111', 'acf_plugin_json_save_path_for_taxonomies' );


/**
 * Set a custom ACF JSON load path.
 *
 * @link https://www.advancedcustomfields.com/resources/local-json/#loading-explained
 *
 * @param array $paths Existing, incoming paths.
 *
 * @return array $paths New, outgoing paths.
 *
 * @since 0.1.1
 */
function acf_plugin_json_load_paths( $paths ) {
	$paths[] = acf_plugin_PLUGIN_DIR . '/acf-json/field-groups';
	$paths[] = acf_plugin_PLUGIN_DIR . '/acf-json/options-pages';
	$paths[] = acf_plugin_PLUGIN_DIR . '/acf-json/post-types';
	$paths[] = acf_plugin_PLUGIN_DIR . '/acf-json/taxonomies';

	return $paths;
}

/**
 * Set custom ACF JSON save point for
 * ACF generated post types.
 *
 * @link https://www.advancedcustomfields.com/resources/local-json/#saving-explained
 *
 * @return string $path New, outgoing path.
 *
 * @since 0.1.1
 */
function acf_plugin_json_save_path_for_post_types() {
	return acf_plugin_PLUGIN_DIR . '/acf-json/post-types';
}

/**
 * Set custom ACF JSON save point for
 * ACF generated field groups.
 *
 * @link https://www.advancedcustomfields.com/resources/local-json/#saving-explained
 *
 * @return string $path New, outgoing path.
 *
 * @since 0.1.1
 */
function acf_plugin_json_save_path_for_field_groups() {
	return acf_plugin_PLUGIN_DIR . '/acf-json/field-groups';
}

/**
 * Set custom ACF JSON save point for
 * ACF generated taxonomies.
 *
 * @link https://www.advancedcustomfields.com/resources/local-json/#saving-explained
 *
 * @return string $path New, outgoing path.
 *
 * @since 0.1.1
 */
function acf_plugin_json_save_path_for_taxonomies() {
	return acf_plugin_PLUGIN_DIR . '/acf-json/taxonomies';
}

/**
 * Set custom ACF JSON save point for
 * ACF generated Options Pages.
 *
 * @link https://www.advancedcustomfields.com/resources/local-json/#saving-explained
 *
 * @return string $path New, outgoing path.
 *
 * @since 0.1.1
 */
function acf_plugin_json_save_path_for_option_pages() {
	return acf_plugin_PLUGIN_DIR . '/acf-json/options-pages';
}

/**
 * Customize the file names for each file.
 *
 * @link https://www.advancedcustomfields.com/resources/local-json/#saving-explained
 *
 * @param string $filename  The default filename.
 * @param array  $post      The main post array for the item being saved.
 *
 * @return string $filename
 *
 * @since  0.1.1
 */
function acf_plugin_json_filename( $filename, $post ) {
	$filename = str_replace(
		array(
			' ',
			'_',
		),
		array(
			'-',
			'-',
		),
		$post['title']
	);

	$filename = strtolower( $filename ) . '.json';

	return $filename;
}
