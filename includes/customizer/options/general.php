<?php
/**
 * General Customizer options
 *
 * @package Editorx
 */
/*--------------------------------------------
	General Panel
---------------------------------------------*/
$wp_customize->add_panel('editorx_general_panel',
	array(
		'title'         => esc_html__( 'General', 'editorx'),
		'priority'      => 5,
	)
);

$wp_customize->add_section( 'editorx_container_section',
	array(
		'title'      => esc_html__( 'Container', 'editorx'),
		'panel'      => 'editorx_general_panel',
	)
);

$wp_customize->add_setting( 'editorx_website_container',
	array(
		'default' 			=> 'container',
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_RadioButtons( $wp_customize, 'editorx_website_container',
	array(
		'label' 		=> esc_html__( 'Container', 'editorx' ),
		'section' 		=> 'editorx_container_section',
		'choices' => array(
			'container' 		=> esc_html__( 'Fixed', 'editorx' ),
			'container-fluid' 	=> esc_html__( 'Full Width', 'editorx' ),
		),
		'priority'		  => 10
	)
) );

$wp_customize->add_section( 'editorx_button_section',
	array(
		'title'      => esc_html__( 'Button', 'editorx'),
		'panel'      => 'editorx_general_panel',
	)
);

$wp_customize->add_setting( 'editorx_button_style_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_Heading( $wp_customize, 'editorx_button_style_title',
		array(
			'label'			=> esc_html__( 'Button Style', 'editorx' ),
			'section' 		=> 'editorx_button_section',
            'priority' 			=> 5
		)
	)
);

// Button Font Size
$wp_customize->add_setting('editorx_button_font_size_desktop', array(
	'default'           => 14,
	'sanitize_callback' => 'absint',
));

$wp_customize->add_setting('editorx_button_font_size_tablet', array(
	'default'           => 14,
	'sanitize_callback' => 'absint',
));

$wp_customize->add_setting('editorx_button_font_size_mobile', array(
	'default'           => 14,
	'sanitize_callback' => 'absint',
));
$wp_customize->add_control(new Editorx_Control_Slider(
	$wp_customize,
	'button_font_size',
	array(
		'label'         => esc_html__('Font size', 'editorx'),
		'section'       => 'editorx_button_section',
		'responsive' 	=> true,
		'settings'      => array(
			'size_desktop' => 'editorx_button_font_size_desktop',
			'size_tablet'  => 'editorx_button_font_size_tablet',
			'size_mobile'  => 'editorx_button_font_size_mobile',
		),
		'input_attrs' => array(
			'min'	=> 0,
			'max'	=> 50
		)
	)
));

// Button Text Transform
$wp_customize->add_setting( 'editorx_button_text_transform',
	array(
		'default' 			=> 'none',
		'sanitize_callback' => 'editorx_sanitize_text',
	)
);
$wp_customize->add_control( new Editorx_Control_RadioButtons(
	$wp_customize,
	'editorx_button_text_transform',
	array(
		'label'   => esc_html__( 'Text transform', 'editorx' ),
		'section' => 'editorx_button_section',
		'choices' => array(
			'none' 			=> '-',
			'capitalize' 	=> 'Aa',
			'lowercase' 	=> 'aa',
			'uppercase' 	=> 'AA',
		)
	)
) );

// Button Letter Spacing
$wp_customize->add_setting('editorx_button_letter_spacing', array(
	'default'           => 0,
	'sanitize_callback' => 'editorx_sanitize_text',
));
$wp_customize->add_control(new Editorx_Control_Slider(
	$wp_customize,
	'editorx_button_letter_spacing',
	array(
		'label'         => esc_html__('Letter spacing', 'editorx'),
		'section'       => 'editorx_button_section',
		'responsive' => false,
		'settings'      => array(
			'size_desktop' => 'editorx_button_letter_spacing',
		),
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 5,
			'step' => 0.5,
		)
	)
));

// Button Top and Bottom Padding
$wp_customize->add_setting('editorx_button_top_bottom_padding_desktop', array(
	'default'           => 18,
	'sanitize_callback' => 'absint',
));

$wp_customize->add_setting('editorx_button_top_bottom_padding_tablet', array(
	'default'           => 16,
	'sanitize_callback' => 'absint',
));

$wp_customize->add_setting('editorx_button_top_bottom_padding_mobile', array(
	'default'           => 15,
	'sanitize_callback' => 'absint',
));
$wp_customize->add_control(new Editorx_Control_Slider(
	$wp_customize,
	'editorx_button_top_bottom_padding',
	array(
		'label' 		=> esc_html__('Button padding', 'editorx'),
		'section' 		=> 'editorx_button_section',
		'responsive'	=> true,
		'settings' 		=> array(
			'size_desktop' 		=> 'editorx_button_top_bottom_padding_desktop',
			'size_tablet' 		=> 'editorx_button_top_bottom_padding_tablet',
			'size_mobile' 		=> 'editorx_button_top_bottom_padding_mobile',
		),
		'input_attrs' => array(
			'min'	=> 0,
			'max'	=> 50
		)
	)
));

// Button Border Radius
$wp_customize->add_setting('editorx_button_border_radius', array(
	'default'           => 4,
	'sanitize_callback' => 'absint',
));

$wp_customize->add_control(new Editorx_Control_Slider(
	$wp_customize,
	'editorx_button_border_radius',
	array(
		'label' 		=> esc_html__('Button radius', 'editorx'),
		'section' 		=> 'editorx_button_section',
		'responsive'	=> true,
		'settings' 		=> array(
			'size_desktop' 		=> 'editorx_button_border_radius',
		),
		'input_attrs' => array(
			'min'	=> 0,
			'max'	=> 100
		),
	)
));

$wp_customize->add_setting( 'editorx_hamburger_button_style_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_Heading( $wp_customize, 'editorx_hamburger_button_style_title',
		array(
			'label'			=> esc_html__( 'Hamburger Button', 'editorx' ),
			'section' 		=> 'editorx_button_section'
		)
	)
);

$wp_customize->add_setting( 'editorx_hamburger_button_color',
	array(
		'default'           => '#000000',
		'sanitize_callback' => 'editorx_sanitize_hex_rgba',
		'transport'         => 'refresh'
	)
);

$wp_customize->add_control( new Editorx_Control_AlphaColor( $wp_customize, 'editorx_hamburger_button_color',
		array(
			'label'         	=> esc_html__( 'Color', 'editorx' ),
			'section'       	=> 'editorx_button_section'
		)
	)
);

$wp_customize->add_setting( 'editorx_hamburger_button_background',
	array(
		'default'           => '#FFFFFF',
		'sanitize_callback' => 'editorx_sanitize_hex_rgba',
		'transport'         => 'refresh'
	)
);

$wp_customize->add_control( new Editorx_Control_AlphaColor( $wp_customize, 'editorx_hamburger_button_background',
		array(
			'label'         	=> esc_html__( 'Background', 'editorx' ),
			'section'       	=> 'editorx_button_section'
		)
	)
);

