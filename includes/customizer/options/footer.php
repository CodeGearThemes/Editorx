<?php
/**
 * Footer Customizer options
 *
 * @package Editorx
 */

/*--------------------------------------------
	Footer Panel
---------------------------------------------*/
$wp_customize->add_panel( 'editorx_footer_panel',
	array(
		'title'         => esc_html__( 'Footer', 'editorx'),
		'priority'      => 40,
	)
);

/*--------------------------------------------
	Footer Section
---------------------------------------------*/
$wp_customize->add_section( 'editorx_footer_section',
	array(
		'title'      => esc_html__( 'Footer widgets', 'editorx'),
		'panel'      => 'editorx_footer_panel',
	)
);

$wp_customize->add_setting( 'editorx_footer_tabs',
	array(
		'default'           => '',
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_Tabs( $wp_customize, 'editorx_footer_tabs',
		array(
			'label' 				=> esc_html__( 'Footer credit tabs', 'editorx' ),
			'section'       		=> 'editorx_footer_section',
			'controls_general'		=> json_encode( array( '#customize-control-footer_section_layout' ) ),
			'controls_design'		=> json_encode( array( '#customize-control-editorx_footer_section_heading_color', '#customize-control-editorx_footer_section_text_color', '#customize-control-editorx_footer_section_background' ) ),
		)
	)
);

$wp_customize->add_setting( 'footer_section_layout',
	array(
		'default'           => 'simple',
		'sanitize_callback' => 'sanitize_key',
	)
);

$wp_customize->add_control( new Editorx_Control_RadioImage( $wp_customize, 'footer_section_layout',
		array(
			'label'    => esc_html__( 'Footer layout', 'editorx' ),
			'section'  => 'editorx_footer_section',
			'columns'  => 'one-half',
			'choices'  => array(
				'disabled' => array(
					'label' => esc_html__( 'Disabled', 'editorx' ),
					'url'   => '%s/assets/admin/src/layout/disabled.svg'
				),
				'simple' => array(
					'label' => esc_html__( 'Simple', 'editorx' ),
					'url'   => '%s/assets/admin/src/layout/footer-simple.svg'
				)
			)
		)
	)
);

$wp_customize->add_setting( 'editorx_footer_section_heading_color',
	array(
		'default'           => '#222222',
		'sanitize_callback' => 'editorx_sanitize_hex_rgba',
		'transport'         => 'refresh'
	)
);
$wp_customize->add_control( new Editorx_Control_AlphaColor( $wp_customize, 'editorx_footer_section_heading_color',
		array(
			'label'         	=> esc_html__( 'Heading color', 'editorx' ),
			'section'       	=> 'editorx_footer_section',
			'priority' 			=> 100
		)
	)
);

$wp_customize->add_setting( 'editorx_footer_section_text_color',
	array(
		'default'           => '#333333',
		'sanitize_callback' => 'editorx_sanitize_hex_rgba',
		'transport'         => 'refresh'
	)
);

$wp_customize->add_control( new Editorx_Control_AlphaColor( $wp_customize, 'editorx_footer_section_text_color',
		array(
			'label'         	=> esc_html__( 'Text color', 'editorx' ),
			'section'       	=> 'editorx_footer_section',
			'priority' 			=> 110
		)
	)
);

$wp_customize->add_setting( 'editorx_footer_section_background',
	array(
		'default'           => '#f8f8f8',
		'sanitize_callback' => 'editorx_sanitize_hex_rgba',
		'transport'         => 'refresh'
	)
);

$wp_customize->add_control( new Editorx_Control_AlphaColor( $wp_customize, 'editorx_footer_section_background',
		array(
			'label'         	=> esc_html__( 'Background color', 'editorx' ),
			'section'       	=> 'editorx_footer_section',
			'priority' 			=> 110
		)
	)
);

/*--------------------------------------------
	Footer Credits
---------------------------------------------*/
$wp_customize->add_section('editorx_footer_credits',
	array(
		'title'      => esc_html__( 'Copyright', 'editorx'),
		'panel'      => 'editorx_footer_panel',
	)
);

$wp_customize->add_setting( 'editorx_footer_credits_tabs',
	array(
		'default'           => '',
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_Tabs( $wp_customize, 'editorx_footer_credits_tabs',
		array(
			'label' 				=> esc_html__( 'Footer credit tabs', 'editorx' ),
			'section'       		=> 'editorx_footer_credits',
			'controls_general'		=> json_encode( array( '#customize-control-footer_copyright_layout', '#customize-control-editorx_footer_credits' ) ),
			'controls_design'		=> json_encode( array( '#customize-control-editorx_footer_credits_background', '#customize-control-editorx_footer_credits_color', '#customize-control-editorx_footer_credits_style_divider', '#customize-control-editorx_footer_credits_link_color', '#customize-control-editorx_footer_credits_link_hover_color' ) ),
		)
	)
);

/*--------------------------------------------
	Footer Credits General
---------------------------------------------*/
$wp_customize->add_setting('editorx_footer_credits',
	array(
		'sanitize_callback' => 'editorx_sanitize_text',
		'default'           => sprintf( esc_html__( '%1$1s. Proudly powered by %2$2s', 'editorx' ), '{copyright} {year} {site_title}', '{theme_author}' ),// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
		'transport' 		=> 'refresh'
	)
);
$wp_customize->add_control( 'editorx_footer_credits',
	array(
		'label'       	  => esc_html__( 'Footer credits', 'editorx' ),
		'description' 	  => esc_html__( 'You can use the following tags: {copyright}, {year}, {site_title}', 'editorx' ),
		'type'        	  => 'textarea',
		'section'         => 'editorx_footer_credits',
		'priority'    	  => 10
	)
);


/*--------------------------------------------
	Footer Credits Styling
---------------------------------------------*/
$wp_customize->add_setting( 'editorx_footer_credits_color',
	array(
		'default'           => '#333333',
		'sanitize_callback' => 'editorx_sanitize_hex_rgba',
		'transport'         => 'refresh'
	)
);

$wp_customize->add_control( new Editorx_Control_AlphaColor( $wp_customize, 'editorx_footer_credits_color',
		array(
			'label'         	=> esc_html__( 'Text color', 'editorx' ),
			'section'       	=> 'editorx_footer_credits',
			'priority' 			=> 100
		)
	)
);

$wp_customize->add_setting( 'editorx_footer_credits_background',
	array(
		'default'           => '#f8f8f8',
		'sanitize_callback' => 'editorx_sanitize_hex_rgba',
		'transport'         => 'refresh'
	)
);

$wp_customize->add_control( new Editorx_Control_AlphaColor( $wp_customize, 'editorx_footer_credits_background',
		array(
			'label'         	=> esc_html__( 'Background color', 'editorx' ),
			'section'       	=> 'editorx_footer_credits',
			'priority' 			=> 110
		)
	)
);

$wp_customize->add_setting( 'editorx_footer_credits_style_divider',
	array(
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_Divider( $wp_customize, 'editorx_footer_credits_style_divider',
		array(
			'section' 		=> 'editorx_footer_credits',
			'priority' 			=> 115
		)
	)
);

$wp_customize->add_setting( 'editorx_footer_credits_link_color',
	array(
		'default'           => '#7e7e7e',
		'sanitize_callback' => 'editorx_sanitize_hex_rgba',
		'transport'         => 'refresh'
	)
);
$wp_customize->add_control( new Editorx_Control_AlphaColor( $wp_customize, 'editorx_footer_credits_link_color',
		array(
			'label'         	=> esc_html__( 'Link color', 'editorx' ),
			'section'       	=> 'editorx_footer_credits',
			'priority' 			=> 120
		)
	)
);

$wp_customize->add_setting( 'editorx_footer_credits_link_hover_color',
	array(
		'default'           => '#222222',
		'sanitize_callback' => 'editorx_sanitize_hex_rgba',
		'transport'         => 'refresh'
	)
);
$wp_customize->add_control( new Editorx_Control_AlphaColor( $wp_customize, 'editorx_footer_credits_link_hover_color',
		array(
			'label'         	=> esc_html__( 'Link hover color', 'editorx' ),
			'section'       	=> 'editorx_footer_credits',
			'priority' 			=> 130
		)
	)
);
