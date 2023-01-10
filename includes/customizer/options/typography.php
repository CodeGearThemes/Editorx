<?php
/**
 * Typography Customizer options
 *
 * @package Editorx
 */
$wp_customize->add_panel(
	'editorx_typography_panel',
	array(
		'title'         => esc_html__( 'Typography', 'editorx'),
		'priority'      => 10,
	)
);

/*--------------------------------------------
	Heading
---------------------------------------------*/
$wp_customize->add_section(
	'editorx_heading_section',
	array(
		'title'      => esc_html__( 'Headings', 'editorx'),
		'panel'      => 'editorx_typography_panel',
	)
);

$wp_customize->add_setting( 'editorx_heading_font',
    array(
        'default'           => '{"font":"System default","regularweight":"regular","italicweight":"italic","boldweight":"bold","category":"sans-serif"}',
        'sanitize_callback' => 'editorx_google_fonts_sanitize',
        'transport'	 		=> 'postMessage'
    )
);

$wp_customize->add_control( new Editorx_Control_Typography( $wp_customize, 'editorx_heading_font',
    array(
        'label' => esc_html__( 'Heading font', 'editorx' ),
        'section' => 'editorx_heading_section',
        'settings' => array (
			'family' => 'editorx_heading_font',
		),
        'input_attrs' => array(
			'font_count'    => 'all',
			'orderby'       => 'alpha',
			'disableRegular' => false,
		),
    )
));

$wp_customize->add_setting( 'editorx_heading_font_style', array(
	'sanitize_callback' => 'editorx_sanitize_select',
	'default' 			=> 'normal',
	'transport'	 		=> 'postMessage'
) );

$wp_customize->add_control( 'editorx_heading_font_style', array(
	'type' 		=> 'select',
	'section' 	=> 'editorx_heading_section',
	'label' 	=> esc_html__( 'Font style', 'editorx' ),
	'choices' => array(
		'normal' 	=> esc_html__( 'Normal', 'editorx' ),
		'italic' 	=> esc_html__( 'Italic', 'editorx' ),
		'oblique' 	=> esc_html__( 'Oblique', 'editorx' ),
	),
) );

$wp_customize->add_setting( 'editorx_heading_line_height', array(
	'default'   		=> 1.4,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'editorx_range',
) );

$wp_customize->add_control( new Editorx_Control_Slider( $wp_customize, 'editorx_heading_line_height',
	array(
		'label' 		=> esc_html__( 'Line height', 'editorx' ),
		'section' 		=> 'editorx_heading_section',
		'responsive'	=> false,
		'settings' 		=> array (
			'size_desktop' 		=> 'editorx_heading_line_height',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 5,
			'step'  => 0.01,
			'unit'  => 'em'
		)
	)
) );

$wp_customize->add_setting( 'editorx_heading_letter_spacing', array(
	'default'   		=> 0,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'editorx_range',
) );

$wp_customize->add_control( new Editorx_Control_Slider( $wp_customize, 'editorx_heading_letter_spacing',
	array(
		'label' 		=> esc_html__( 'Letter spacing', 'editorx' ),
		'section' 		=> 'editorx_heading_section',
		'responsive'	=> false,
		'settings' 		=> array (
			'size_desktop' 		=> 'editorx_heading_letter_spacing',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 5,
			'step'  => 0.1,
			'unit'  => 'px'
		)
	)
) );


$wp_customize->add_setting( 'editorx_heading_text_transform',
	array(
		'default' 			=> 'none',
		'sanitize_callback' => 'editorx_sanitize_text',
		'transport'			=> 'postMessage',
	)
);
$wp_customize->add_control( new Editorx_Control_RadioButtons( $wp_customize, 'editorx_heading_text_transform',
	array(
		'label'   => esc_html__( 'Text transform', 'editorx' ),
		'section' => 'editorx_heading_section',
		'choices' => array(
			'none' 			=> '-',
			'capitalize' 	=> 'Aa',
			'lowercase' 	=> 'aa',
			'uppercase' 	=> 'AA',
		)
	)
) );

$wp_customize->add_setting( 'editorx_heading_typography_divider',
	array(
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_Divider( $wp_customize, 'editorx_heading_typography_divider',
		array(
			'section' 		=> 'editorx_heading_section',
		)
	)
);


$wp_customize->add_setting( 'editorx_heading_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_Heading( $wp_customize, 'editorx_heading_title',
		array(
			'label'			=> esc_html__( 'Heading', 'editorx' ),
			'description'	=> esc_html__( '(H1 - h6) heading font size.', 'editorx' ),
			'section' 		=> 'editorx_heading_section',
		)
	)
);

$wp_customize->add_setting( 'editorx_heading_h1_font_size_desktop', array(
	'default'   		=> 40,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'editorx_heading_h1_font_size_tablet', array(
	'default'   		=> 36,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'editorx_heading_h1_font_size_mobile', array(
	'default'   		=> 28,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Editorx_Control_Slider( $wp_customize, 'editorx_heading_h1_font_size',
	array(
		'label' 		=> esc_html__( 'H1 font size', 'editorx' ),
		'section' 		=> 'editorx_heading_section',
		'responsive'	=> true,
		'settings' 		=> array (
			'size_desktop' 		=> 'editorx_heading_h1_font_size_desktop',
			'size_tablet' 		=> 'editorx_heading_h1_font_size_tablet',
			'size_mobile' 		=> 'editorx_heading_h1_font_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 10,
			'max'	=> 72,
			'step'  => 1,
			'unit'  => 'px'
		)
	)
) );

$wp_customize->add_setting( 'editorx_heading_h2_font_size_desktop', array(
	'default'   		=> 32,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'editorx_heading_h2_font_size_tablet', array(
	'default'   		=> 28,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'editorx_heading_h2_font_size_mobile', array(
	'default'   		=> 22,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Editorx_Control_Slider( $wp_customize, 'editorx_heading_h2_font_size',
	array(
		'label' 		=> esc_html__( 'H2 font size', 'editorx' ),
		'section' 		=> 'editorx_heading_section',
		'responsive'	=> true,
		'settings' 		=> array (
			'size_desktop' 		=> 'editorx_heading_h2_font_size_desktop',
			'size_tablet' 		=> 'editorx_heading_h2_font_size_tablet',
			'size_mobile' 		=> 'editorx_heading_h2_font_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 10,
			'max'	=> 72,
			'step'  => 1,
			'unit'  => 'px'
		)
	)
) );

$wp_customize->add_setting( 'editorx_heading_h3_font_size_desktop', array(
	'default'   		=> 28,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'editorx_heading_h3_font_size_tablet', array(
	'default'   		=> 24,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'editorx_heading_h3_font_size_mobile', array(
	'default'   		=> 18,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Editorx_Control_Slider( $wp_customize, 'editorx_heading_h3_font_size',
	array(
		'label' 		=> esc_html__( 'H3 font size', 'editorx' ),
		'section' 		=> 'editorx_heading_section',
		'responsive'	=> true,
		'settings' 		=> array (
			'size_desktop' 		=> 'editorx_heading_h3_font_size_desktop',
			'size_tablet' 		=> 'editorx_heading_h3_font_size_tablet',
			'size_mobile' 		=> 'editorx_heading_h3_font_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 10,
			'max'	=> 72,
			'step'  => 1,
			'unit'  => 'px'
		)
	)
) );

$wp_customize->add_setting( 'editorx_heading_h4_font_size_desktop', array(
	'default'   		=> 24,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'editorx_heading_h4_font_size_tablet', array(
	'default'   		=> 20,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'editorx_heading_h4_font_size_mobile', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Editorx_Control_Slider( $wp_customize, 'editorx_heading_h4_font_size',
	array(
		'label' 		=> esc_html__( 'H4 font size', 'editorx' ),
		'section' 		=> 'editorx_heading_section',
		'responsive'	=> true,
		'settings' 		=> array (
			'size_desktop' 		=> 'editorx_heading_h4_font_size_desktop',
			'size_tablet' 		=> 'editorx_heading_h4_font_size_tablet',
			'size_mobile' 		=> 'editorx_heading_h4_font_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 10,
			'max'	=> 72,
			'step'  => 1,
			'unit'  => 'px'
		)
	)
) );

$wp_customize->add_setting( 'editorx_heading_h5_font_size_desktop', array(
	'default'   		=> 20,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'editorx_heading_h5_font_size_tablet', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'editorx_heading_h5_font_size_mobile', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Editorx_Control_Slider( $wp_customize, 'editorx_heading_h5_font_size',
	array(
		'label' 		=> esc_html__( 'H5 font size', 'editorx' ),
		'section' 		=> 'editorx_heading_section',
		'responsive'	=> true,
		'settings' 		=> array (
			'size_desktop' 		=> 'editorx_heading_h5_font_size_desktop',
			'size_tablet' 		=> 'editorx_heading_h5_font_size_tablet',
			'size_mobile' 		=> 'editorx_heading_h5_font_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 10,
			'max'	=> 72,
			'step'  => 1,
			'unit'  => 'px'
		)
	)
) );

$wp_customize->add_setting( 'editorx_heading_h6_font_size_desktop', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'editorx_heading_h6_font_size_tablet', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'editorx_heading_h6_font_size_mobile', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Editorx_Control_Slider( $wp_customize, 'editorx_heading_h6_font_size',
	array(
		'label' 		=> esc_html__( 'H6 font size', 'editorx' ),
		'section' 		=> 'editorx_heading_section',
		'responsive'	=> true,
		'settings' 		=> array (
			'size_desktop' 		=> 'editorx_heading_h6_font_size_desktop',
			'size_tablet' 		=> 'editorx_heading_h6_font_size_tablet',
			'size_mobile' 		=> 'editorx_heading_h6_font_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 10,
			'max'	=> 72,
			'step'  => 1,
			'unit'  => 'px'
		)
	)
) );


/*--------------------------------------------
	Base
---------------------------------------------*/
$wp_customize->add_section(
	'editorx_base_section',
	array(
		'title'         => esc_html__( 'Body', 'editorx'),
		'panel'         => 'editorx_typography_panel',
	)
);

$wp_customize->add_setting( 'editorx_base_font',
    array(
        'default'           => '{"font":"System default","regularweight":"regular","italicweight":"italic","boldweight":"bold","category":"sans-serif"}',
        'sanitize_callback' => 'editorx_google_fonts_sanitize',
        'transport'	 		=> 'postMessage'
    )
);

$wp_customize->add_control( new Editorx_Control_Typography( $wp_customize, 'editorx_base_font',
    array(
        'label' => esc_html__( 'Body font', 'editorx' ),
        'section' => 'editorx_base_section',
        'settings' => array (
			'family' => 'editorx_base_font',
		),
        'input_attrs' => array(
			'font_count'    => 'all',
			'orderby'       => 'alpha',
			'disableRegular' => false,
		),
    )
));

$wp_customize->add_setting( 'editorx_base_font_style', array(
	'sanitize_callback' => 'editorx_sanitize_select',
	'default' 			=> 'normal',
	'transport'	 		=> 'postMessage'
) );

$wp_customize->add_control( 'editorx_base_font_style', array(
	'type' 		=> 'select',
	'section' 	=> 'editorx_base_section',
	'label' 	=> esc_html__( 'Font style', 'editorx' ),
	'choices' => array(
		'normal' 	=> esc_html__( 'Normal', 'editorx' ),
		'italic' 	=> esc_html__( 'Italic', 'editorx' ),
		'oblique' 	=> esc_html__( 'Oblique', 'editorx' ),
	),
) );

$wp_customize->add_setting( 'editorx_base_line_height', array(
	'default'   		=> 1.68,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'editorx_sanitize_text',
) );

$wp_customize->add_control( new Editorx_Control_Slider( $wp_customize, 'editorx_base_line_height',
	array(
		'label' 		=> esc_html__( 'Line height', 'editorx' ),
		'section' 		=> 'editorx_base_section',
		'responsive'	=> false,
		'settings' 		=> array (
			'size_desktop' 		=> 'editorx_base_line_height',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 5,
			'step'  => 0.01,
			'unit'  => 'em'
		)
	)
) );

$wp_customize->add_setting( 'editorx_base_letter_spacing', array(
	'default'   		=> 0,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'editorx_sanitize_text',
) );

$wp_customize->add_control( new Editorx_Control_Slider( $wp_customize, 'editorx_base_letter_spacing',
	array(
		'label' 		=> esc_html__( 'Letter spacing', 'editorx' ),
		'section' 		=> 'editorx_base_section',
		'responsive'	=> false,
		'settings' 		=> array (
			'size_desktop' 		=> 'editorx_base_letter_spacing',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 5,
			'step'  => 0.1,
			'unit'  => 'px'
		)
	)
) );


$wp_customize->add_setting( 'editorx_base_text_transform',
	array(
		'default' 			=> 'none',
		'sanitize_callback' => 'editorx_sanitize_text',
		'transport'			=> 'postMessage',
	)
);
$wp_customize->add_control( new Editorx_Control_RadioButtons( $wp_customize, 'editorx_base_text_transform',
	array(
		'label'   => esc_html__( 'Text transform', 'editorx' ),
		'section' => 'editorx_base_section',
		'choices' => array(
			'none' 			=> '-',
			'capitalize' 	=> 'Aa',
			'lowercase' 	=> 'aa',
			'uppercase' 	=> 'AA',
		)
	)
) );

$wp_customize->add_setting( 'editorx_base_typography_divider',
	array(
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_Divider( $wp_customize, 'editorx_base_typography_divider',
		array(
			'section' 		=> 'editorx_base_section',
		)
	)
);


$wp_customize->add_setting( 'editorx_base_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_Heading( $wp_customize, 'editorx_base_title',
		array(
			'label'			=> esc_html__( 'Body', 'editorx' ),
			'section' 		=> 'editorx_base_section',
		)
	)
);

$wp_customize->add_setting( 'editorx_base_font_size_desktop', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'editorx_base_font_size_tablet', array(
	'default'   		=> 14,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'editorx_base_font_size_mobile', array(
	'default'   		=> 14,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Editorx_Control_Slider( $wp_customize, 'editorx_base_font_size',
	array(
		'label' 		=> esc_html__( 'Font size', 'editorx' ),
		'section' 		=> 'editorx_base_section',
		'responsive'	=> true,
		'settings' 		=> array (
			'size_desktop' 		=> 'editorx_base_font_size_desktop',
			'size_tablet' 		=> 'editorx_base_font_size_tablet',
			'size_mobile' 		=> 'editorx_base_font_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 10,
			'max'	=> 72,
			'step'  => 1,
			'unit'  => 'px'
		)
	)
) );
