<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Wdunderscores
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wds_wdunderscores_body_classes( $classes ) {

	global $is_IE;

	// If it's IE, add a class.
	if ( $is_IE ) {
		$classes[] = 'ie';
	}

	// Give all pages a unique class.
	if ( is_page() ) {
		$classes[] = 'page-' . basename( get_permalink() );
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds "no-js" class. If JS is enabled, this will be replaced (by javascript) to "js".
	$classes[] = 'no-js';

	return $classes;
}
add_filter( 'body_class', 'wds_wdunderscores_body_classes' );

/**
 * Returns an array of contributors from Github.
 */
function wds_wdunderscores_get_contributors() {

	$transient_key = 'wds_wdunderscores_contributors';

	$contributors = get_transient( $transient_key );

	if ( false !== $contributors ) {
		return $contributors;
	}

	$response = wp_remote_get( 'https://api.github.com/repos/WebDevStudios/wd_s/contributors?per_page=100' );

	if ( is_wp_error( $response ) ) {
		return 'There was an error getting a response from Github';
	}

	$contributors = json_decode( wp_remote_retrieve_body( $response ) );

	if ( ! is_array( $contributors ) ) {
		return array();
	}

	set_transient( $transient_key, $contributors, HOUR_IN_SECONDS );

	return (array) $contributors;
}