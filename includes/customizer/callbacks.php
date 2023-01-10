<?php
/**
 * Customizer callbacks
 *
 * @package Editorx
 */

/**
 * Archive Grid
 */
function editorx_archives_callback_grid() {
	$archive= get_theme_mod( 'editorx_archive_layout', 'simple' );

	if ( 'simple' !== $archive ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Top header active
 */
function editorx_top_header_active_callback() {
    $editorx_enable_top_header = get_theme_mod( 'editorx_enable_top_header' );

	if ( $editorx_enable_top_header ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Header centered Search
 */

 function editorx_header_search_active_callback(){
	$layout = get_theme_mod( 'editorx_main_header_layout', 'default' );

	if( 'default' !== $layout ){
		return true;
	} else {
		return false;
	}
 }


/**
 * Header button
 */
function editorx_header_button_active_callback() {
    $enable = get_theme_mod( 'editorx_enable_header_button', 1 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Header contact
 */
function editorx_header_contact_active_callback() {
    $enable = get_theme_mod( 'editorx_enable_header_contact', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}
}
