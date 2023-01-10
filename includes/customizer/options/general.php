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
