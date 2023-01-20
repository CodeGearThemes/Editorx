<?php
/**
 * Performance Customizer options
 *
 * @package Editorx
 */
/*--------------------------------------------
	Performance Panel
---------------------------------------------*/
$wp_customize->add_panel('editorx_performance_panel',
	array(
		'title'         => esc_html__( 'Performance', 'editorx'),
		'priority'      => 45,
	)
);

$wp_customize->add_section( 'editorx_performance_section',
	array(
		'title'      => esc_html__( 'Google fonts', 'editorx'),
		'panel'      => 'editorx_performance_panel',
	)
);

$wp_customize->add_setting(
	'editorx_load_google_fonts_locally',
	array(
		'default'           => 0,
		'sanitize_callback' => 'editorx_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Editorx_Control_Switch(
		$wp_customize,
		'editorx_load_google_fonts_locally',
		array(
			'label'         	=> esc_html__( 'Local load google font', 'editorx' ),
			'section'       	=> 'editorx_performance_section',
			'settings'      	=> 'editorx_load_google_fonts_locally',
			'priority'  => 5
		)
	)
);


