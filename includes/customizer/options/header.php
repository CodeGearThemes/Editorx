<?php
/**
 * Header Customizer options
 *
 * @package Editorx
 */

$wp_customize->add_panel( 'editorx_header_panel',
	array(
		'title'         => esc_html__( 'Header', 'editorx'),
		'priority'      => 10,
	)
);

/**
 * Site identity
 */
$wp_customize->add_setting( 'editorx_logo_size_desktop', array(
	'default'   		=> 250,
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'editorx_logo_size_tablet', array(
	'default'   		=> 175,
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'editorx_logo_size_mobile', array(
	'default'   		=> 125,
	'sanitize_callback' => 'absint',
) );


$wp_customize->add_control( new Editorx_Control_Slider( $wp_customize, 'editorx_logo_size',
	array(
		'label' 		=> esc_html__( 'Logo width', 'editorx' ),
		'section' 		=> 'title_tagline',
		'responsive'	=> true,
		'settings' 		=> array (
			'size_desktop' 		=> 'editorx_logo_size_desktop',
			'size_tablet' 		=> 'editorx_logo_size_tablet',
			'size_mobile' 		=> 'editorx_logo_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 10,
			'max'	=> 500,
            'step'  => 1,
            'unit'  => 'px'
		)
	)
) );

$wp_customize->add_setting(
	'editorx_enable_site_title',
	array(
		'default'           => 1,
		'sanitize_callback' => 'editorx_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Editorx_Control_Switch(
		$wp_customize,
		'editorx_enable_site_title',
		array(
			'label'         	=> esc_html__( 'Enable site title', 'editorx' ),
			'section'       	=> 'title_tagline',
			'settings'      	=> 'editorx_enable_site_title',
		)
	)
);

$wp_customize->add_setting(
	'editorx_enable_site_tagline',
	array(
		'default'           => 0,
		'sanitize_callback' => 'editorx_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Editorx_Control_Switch(
		$wp_customize,
		'editorx_enable_site_tagline',
		array(
			'label'         	=> esc_html__( 'Enable site tagline', 'editorx' ),
			'section'       	=> 'title_tagline',
			'settings'      	=> 'editorx_enable_site_tagline',
		)
	)
);


/**
 * Main header
 */
$wp_customize->add_section(
	'editorx_main_header',
	array(
		'title'         => esc_html__( 'Header Settings', 'editorx' ),
		'priority'      => 10,
		'panel'			=> 'editorx_header_panel'
	)
);

//Layout
$wp_customize->add_setting(
	'editorx_main_header_layout',
	array(
		'default'           => 'default',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Editorx_Control_RadioImage(
		$wp_customize,
		'editorx_main_header_layout',
		array(
			'label'    		=> esc_html__( 'Main Header layout', 'editorx' ),
			'section'  => 'editorx_main_header',
			'columns'  => 'one-whole',
			'choices'  => array(
				'default' => array(
					'label' => esc_html__( 'Default', 'editorx' ),
					'url'   => '%s/assets/admin/src/header/header-default.svg'
				)
			),
			'priority' 			=> 10,
		)
	)
);

$wp_customize->add_setting(
	'editorx_enable_header_search',
	array(
		'default'           => 1,
		'sanitize_callback' => 'editorx_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Editorx_Control_Switch(
		$wp_customize,
		'editorx_enable_header_search',
		array(
			'label'         	=> esc_html__( 'Enable Header Search', 'editorx' ),
			'section'       	=> 'editorx_main_header',
			'settings'      	=> 'editorx_enable_header_search',
		)
	)
);


$wp_customize->add_setting(
	'editorx_enable_social_icons',
	array(
		'default'           => 1,
		'sanitize_callback' => 'editorx_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Editorx_Control_Switch(
		$wp_customize,
		'editorx_enable_social_icons',
		array(
			'label'         	=> esc_html__( 'Enable Social icons', 'editorx' ),
			'section'       	=> 'editorx_main_header',
			'settings'      	=> 'editorx_enable_social_icons',
		)
	)
);

if ( class_exists( 'WooCommerce' ) ) {
	$wp_customize->add_setting(
		'editorx_enable_header_account',
		array(
			'default'           => 0,
			'sanitize_callback' => 'editorx_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		new Editorx_Control_Switch(
			$wp_customize,
			'editorx_enable_header_account',
			array(
				'label'         	=> esc_html__( 'Enable Account', 'editorx' ),
				'section'       	=> 'editorx_main_header',
				'settings'      	=> 'editorx_enable_header_account',
			)
		)
	);

	$wp_customize->add_setting(
		'editorx_enable_header_mincart',
		array(
			'default'           => 0,
			'sanitize_callback' => 'editorx_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		new Editorx_Control_Switch(
			$wp_customize,
			'editorx_enable_header_mincart',
			array(
				'label'         	=> esc_html__( 'Enable Mini Cart', 'editorx' ),
				'section'       	=> 'editorx_main_header',
				'settings'      	=> 'editorx_enable_header_mincart',
			)
		)
	);
}


