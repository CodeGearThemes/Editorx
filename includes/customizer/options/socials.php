<?php

/**
 * Social Customizer options
 *
 * @package Editorx
 */
/*--------------------------------------------
	#Social
---------------------------------------------*/
$wp_customize->add_panel(
    'editorx_social_panel',
    array(
        'title' => esc_html__('Social Profiles', 'editorx'),
        'description' => esc_html__('Social settings', 'editorx'),
        'priority' => 15,
    )
);

$wp_customize->add_section('editorx_social_section', array(
    'title'          => esc_html__('Social Links', 'editorx'),
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'panel'             => 'editorx_social_panel',
    'priority'       => 10,
));

$editorx_social_icons = array('facebook', 'twitter', 'linkedin', 'instagram', 'youtube');
foreach ($editorx_social_icons as $icon) {
    $label = ucfirst($icon);
    $wp_customize->add_setting('editorx_' . $icon . '_url', array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control('editorx_' . $icon . '_url', array(
        'label'         => esc_html($label),
        'type'          => 'url',
        'section'       => 'editorx_social_section',
    ));
}
