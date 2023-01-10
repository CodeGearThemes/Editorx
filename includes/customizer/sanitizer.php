<?php

/**
 * Sanitize text
 */
function editorx_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Sanitize URLs
 */
function editorx_sanitize_urls( $input ) {
    if ( strpos( $input, ',' ) !== false) {
        $input = explode( ',', $input );
    }
    if ( is_array( $input ) ) {
        foreach ($input as $key => $value) {
            $input[$key] = esc_url_raw( $value );
        }
        $input = implode( ',', $input );
    }
    else {
        $input = esc_url_raw( $input );
    }
    return $input;
}

/**
 * Sanitize hex and rgba
 */
function editorx_sanitize_hex_rgba( $input, $setting ) {
    if ( empty( $input ) || is_array( $input ) ) {
        return $setting->default;
    }

    if ( false === strpos( $input, 'rgb' ) ) {
        $input = sanitize_hex_color( $input );
    } else {
        if ( false === strpos( $input, 'rgba' ) ) {
            // Sanitize as RGB color
            $input = str_replace( ' ', '', $input );
            sscanf( $input, 'rgb(%d,%d,%d)', $red, $green, $blue );
            $input = 'rgb(' . editorx_range( $red, 0, 255 ) . ',' . editorx_range( $green, 0, 255 ) . ',' . editorx_range( $blue, 0, 255 ) . ')';
        }
        else {
            // Sanitize as RGBa color
            $input = str_replace( ' ', '', $input );
            sscanf( $input, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
            $input = 'rgba(' . editorx_range( $red, 0, 255 ) . ',' . editorx_range( $green, 0, 255 ) . ',' . editorx_range( $blue, 0, 255 ) . ',' . editorx_range( $alpha, 0, 1 ) . ')';
        }
    }
    return $input;
}

/**
 * Helper function to check if value is in range
 */
function editorx_range( $input, $min, $max ){
    if ( $input < $min ) {
        $input = $min;
    }
    if ( $input > $max ) {
        $input = $max;
    }
    return $input;
}

/**
 * Sanitize checkboxes
 */
function editorx_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

/**
 * Sanitize fonts
 */
function editorx_google_fonts_sanitize( $input ) {
    $val =  json_decode( $input, true );
    if( is_array( $val ) ) {
        foreach ( $val as $key => $value ) {
            $val[$key] = sanitize_text_field( $value );
        }
        $input = json_encode( $val );
    }
    else {
        $input = json_encode( sanitize_text_field( $val ) );
    }
    return $input;
}
