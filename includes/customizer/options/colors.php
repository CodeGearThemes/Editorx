<?php
/**
 * Colors Customizer options
 *
 * @package Editorx
 */
/*--------------------------------------------
	General
---------------------------------------------*/
$wp_customize->add_setting( 'editorx_general_color_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_Heading( $wp_customize, 'editorx_general_color_title',
		array(
			'label'			=> esc_html__( 'General', 'editorx' ),
			'section' 		=> 'colors',
            'priority' 			=> 5
		)
	)
);

$wp_customize->add_setting( 'editorx_website_primary_color',
	array(
		'default'           => '#000000',
		'sanitize_callback' => 'editorx_sanitize_hex_rgba',
		'transport'         => 'refresh'
	)
);

$wp_customize->add_control( new Editorx_Control_AlphaColor( $wp_customize, 'editorx_website_primary_color',
		array(
			'label'         	=> esc_html__( 'Primary color', 'editorx' ),
			'section'       	=> 'colors',
            'priority' 			=> 5
		)
	)
);

$wp_customize->add_setting( 'editorx_website_secondary_color',
	array(
		'default'           => '#4E7661',
		'sanitize_callback' => 'editorx_sanitize_hex_rgba',
		'transport'         => 'refresh'
	)
);

$wp_customize->add_control( new Editorx_Control_AlphaColor( $wp_customize, 'editorx_website_secondary_color',
		array(
			'label'         	=> esc_html__( 'Secondary color', 'editorx' ),
			'section'       	=> 'colors',
            'priority' 			=> 5
		)
	)
);

$wp_customize->add_setting( 'editorx_colors_general_divider',
	array(
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_Divider( $wp_customize, 'editorx_colors_general_divider',
		array(
			'section' 		=> 'colors',
            'priority' 			=> 6
		)
	)
);

$wp_customize->add_setting( 'editorx_header_color_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_Heading( $wp_customize, 'editorx_header_color_title',
		array(
			'label'			=> esc_html__( 'Website', 'editorx' ),
			'section' 		=> 'colors',
            'priority' 			=> 6
		)
	)
);

$wp_customize->add_setting( 'editorx_colors_website_divider',
	array(
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_Divider( $wp_customize, 'editorx_colors_website_divider',
		array(
			'section' 		=> 'colors',
            'priority' 			=> 10
		)
	)
);


$wp_customize->add_setting( 'editorx_form_color_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_Heading( $wp_customize, 'editorx_form_color_title',
		array(
			'label'			=> esc_html__( 'Form', 'editorx' ),
			'section' 		=> 'colors',
            'priority' 			=> 15
		)
	)
);

$wp_customize->add_setting( 'editorx_form_field_background',
	array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'editorx_sanitize_hex_rgba',
		'transport'         => 'refresh'
	)
);

$wp_customize->add_control( new Editorx_Control_AlphaColor( $wp_customize, 'editorx_form_field_background',
		array(
			'label'         	=> esc_html__( 'Form field background', 'editorx' ),
			'section'       	=> 'colors',
            'priority' 			=> 20
		)
	)
);

$wp_customize->add_setting( 'editorx_border_color',
	array(
		'default'           => '#cccccc',
		'sanitize_callback' => 'editorx_sanitize_hex_rgba',
		'transport'         => 'refresh'
	)
);

$wp_customize->add_control( new Editorx_Control_AlphaColor( $wp_customize, 'editorx_border_color',
		array(
			'label'         	=> esc_html__( 'Border color', 'editorx' ),
			'section'       	=> 'colors',
            'priority' 			=> 25
		)
	)
);

$wp_customize->add_setting( 'editorx_colors_website_divider',
	array(
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_Divider( $wp_customize, 'editorx_colors_website_divider',
		array(
			'section' 		=> 'colors',
            'priority' 			=> 30
		)
	)
);

$wp_customize->add_setting( 'editorx_button_text_color',
	array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'editorx_sanitize_hex_rgba',
		'transport'         => 'refresh'
	)
);

$wp_customize->add_control( new Editorx_Control_AlphaColor( $wp_customize, 'editorx_button_text_color',
		array(
			'label'         	=> esc_html__( 'Button Text Color', 'editorx' ),
			'section'       	=> 'colors',
            'priority' 			=> 35
		)
	)
);

$wp_customize->add_setting( 'editorx_button_hover_color',
	array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'editorx_sanitize_hex_rgba',
		'transport'         => 'refresh'
	)
);

$wp_customize->add_control( new Editorx_Control_AlphaColor( $wp_customize, 'editorx_button_hover_color',
		array(
			'label'         	=> esc_html__( 'Button Hover Color', 'editorx' ),
			'section'       	=> 'colors',
            'priority' 			=> 40
		)
	)
);
