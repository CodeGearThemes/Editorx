<?php
/**
 * Layout Customizer options
 *
 * @package Editorx
 */
/*--------------------------------------------
	Layout Panel
---------------------------------------------*/
$wp_customize->add_panel( 'editorx_layout_panel',
    array(
        'title'          => esc_html__( 'Layout', 'editorx' ),
        'capability'     => 'edit_theme_options',
        'priority'       => 20,
    )
);

/*--------------------------------------------
	Archive Section
---------------------------------------------*/
$wp_customize->add_section( 'editorx_archive_section',
	array(
		'title'         => esc_html__( 'Archive layout', 'editorx'),
		'panel'         => 'editorx_layout_panel',
        'priority'      => 10,
	)
);

$wp_customize->add_setting('editorx_archive_tabs',
	array(
		'default'           => '',
		'sanitize_callback'	=> 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_Tabs ( $wp_customize, 'editorx_archive_tabs',
		array(
			'label' 				=> esc_html__( 'Archive tabs', 'editorx'),
			'section'       		=> 'editorx_archive_section',
			'controls_general'		=> json_encode( array( '#customize-control-editorx_archive_layout', '#customize-control-editorx_archive_layout_divider', '#customize-control-editorx_archive_sidebar', '#customize-control-editorx_archive_sidebar_divider', '#customize-control-editorx_archives_grid_columns' ) ),
			'controls_design'		=> json_encode( array( '#customize-control-editorx_archive_title_size', '#customize-control-editorx_archive_meta_size' ) ),
		)
	)
);

/*--------------------------------------------
	Archive General
---------------------------------------------*/
$wp_customize->add_setting( 'editorx_archive_layout',
	array(
		'default'           => 'grid',
		'sanitize_callback' => 'sanitize_key',
	)
);

$wp_customize->add_control( new Editorx_Control_RadioImage( $wp_customize, 'editorx_archive_layout',
		array(
			'label'    => esc_html__( 'Layout', 'editorx' ),
			'section'  => 'editorx_archive_section',
			'columns'  => 'one-half',
			'choices'  => array(
				'simple' => array(
					'label' => esc_html__( 'Simple', 'editorx' ),
					'url'   => '%s/assets/admin/src/layout/simple.svg'
				),
				'grid' => array(
					'label' => esc_html__( 'Grid', 'editorx' ),
					'url'   => '%s/assets/admin/src/layout/grid.svg'
				)
			)
		)
	)
);

$wp_customize->add_setting( 'editorx_archive_layout_divider',
	array(
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_Divider( $wp_customize, 'editorx_archive_layout_divider',
		array(
			'section' 		=> 'editorx_archive_section',
		)
	)
);

$wp_customize->add_setting( 'editorx_archive_sidebar',
	array(
		'default'           => 'none',
		'sanitize_callback' => 'sanitize_key',
	)
);

$wp_customize->add_control( new Editorx_Control_RadioImage( $wp_customize, 'editorx_archive_sidebar',
		array(
			'label'    => esc_html__( 'Sidebar', 'editorx' ),
			'section'  => 'editorx_archive_section',
			'columns'  => 'one-half',
			'choices'  => array(
				'left' => array(
					'label' => esc_html__( 'Left Sidebar', 'editorx' ),
					'url'   => '%s/assets/admin/src/layout/left-sidebar@2x.png'
				),
				'none' => array(
					'label' => esc_html__( 'No Sidebar', 'editorx' ),
					'url'   => '%s/assets/admin/src/layout/fullwidth@2x.png'
                ),
                'right' => array(
					'label' => esc_html__( 'Right Sidebar', 'editorx' ),
					'url'   => '%s/assets/admin/src/layout/right-sidebar@2x.png'
				)
			)
		)
	)
);

$wp_customize->add_setting( 'editorx_archive_sidebar_divider',
	array(
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_Divider( $wp_customize, 'editorx_archive_sidebar_divider',
		array(
			'section' 		=> 'editorx_archive_section',
			'active_callback' 	=> 'editorx_archives_callback_grid'
		)
	)
);

$wp_customize->add_setting( 'editorx_archives_grid_columns',
	array(
		'default' 			=> '2',
		'sanitize_callback' => 'editorx_sanitize_text',

	)
);
$wp_customize->add_control( new Editorx_Control_RadioButtons( $wp_customize, 'editorx_archives_grid_columns',
	array(
		'label' 	=> esc_html__( 'Columns', 'editorx' ),
		'section' 	=> 'editorx_archive_section',
		'choices' 	=> array(
			'2' 		=> esc_html__( '2', 'editorx' ),
			'3' 		=> esc_html__( '3', 'editorx' ),
			'4' 		=> esc_html__( '4', 'editorx' ),
		),
		'active_callback' 	=> 'editorx_archives_callback_grid'
	)
) );

/*--------------------------------------------
	Archive Styling
---------------------------------------------*/
$wp_customize->add_setting( 'editorx_archive_title_size_desktop', array(
	'default'   		=> 18,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'editorx_archive_title_size_tablet', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'editorx_archive_title_size_mobile', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );


$wp_customize->add_control( new Editorx_Control_Slider( $wp_customize, 'editorx_archive_title_size',
	array(
		'label' 		=> esc_html__( 'Title size', 'editorx' ),
		'section' 		=> 'editorx_archive_section',
		'responsive'	=> true,
		'settings' 		=> array (
			'size_desktop' 		=> 'editorx_archive_title_size_desktop',
			'size_tablet' 		=> 'editorx_archive_title_size_tablet',
			'size_mobile' 		=> 'editorx_archive_title_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 14,
			'max'	=> 100,
            'step'  => 1,
            'unit'  => 'px'
		)
	)
) );

$wp_customize->add_setting( 'editorx_archive_meta_size', array(
	'default'   		=> 12,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );


$wp_customize->add_control( new Editorx_Control_Slider( $wp_customize, 'editorx_archive_meta_size',
	array(
		'label' 		=> esc_html__( 'Meta size', 'editorx' ),
		'section' 		=> 'editorx_archive_section',
		'responsive'	=> false,
		'settings' 		=> array (
			'size_desktop' 		=> 'editorx_archive_meta_size',
		),
		'input_attrs' => array (
			'min'	=> 8,
			'max'	=> 72,
            'step'  => 1,
            'unit'  => 'px'
		)
	)
) );


/*--------------------------------------------
	Posts Section
---------------------------------------------*/
$wp_customize->add_section( 'editorx_posts_section',
	array(
		'title'         => esc_html__( 'Posts layout', 'editorx'),
		'panel'         => 'editorx_layout_panel',
        'priority'      => 15,
	)
);

$wp_customize->add_setting( 'editorx_posts_sidebar',
	array(
		'default'           => 'right',
		'sanitize_callback' => 'sanitize_key',
	)
);

$wp_customize->add_control( new Editorx_Control_RadioImage( $wp_customize, 'editorx_posts_sidebar',
		array(
			'label'    => esc_html__( 'Sidebar', 'editorx' ),
			'section'  => 'editorx_posts_section',
			'columns'  => 'one-half',
			'choices'  => array(
				'left' => array(
					'label' => esc_html__( 'Left Sidebar', 'editorx' ),
					'url'   => '%s/assets/admin/src/layout/left-sidebar@2x.png'
				),
				'none' => array(
					'label' => esc_html__( 'No Sidebar', 'editorx' ),
					'url'   => '%s/assets/admin/src/layout/fullwidth@2x.png'
                ),
                'right' => array(
					'label' => esc_html__( 'Right Sidebar', 'editorx' ),
					'url'   => '%s/assets/admin/src/layout/right-sidebar@2x.png'
				)
			)
		)
	)
);

/*--------------------------------------------
	Page Section
---------------------------------------------*/
$wp_customize->add_section( 'editorx_page_section',
	array(
		'title'         => esc_html__( 'Page layout', 'editorx'),
		'panel'         => 'editorx_layout_panel',
        'priority'      => 20,
	)
);

$wp_customize->add_setting( 'editorx_page_sidebar',
	array(
		'default'           => 'none',
		'sanitize_callback' => 'sanitize_key',
	)
);

$wp_customize->add_control( new Editorx_Control_RadioImage( $wp_customize, 'editorx_page_sidebar',
		array(
			'label'    => esc_html__( 'Sidebar', 'editorx' ),
			'section'  => 'editorx_page_section',
			'columns'  => 'one-half',
			'choices'  => array(
				'left' => array(
					'label' => esc_html__( 'Left Sidebar', 'editorx' ),
					'url'   => '%s/assets/admin/src/layout/left-sidebar@2x.png'
				),
				'none' => array(
					'label' => esc_html__( 'No Sidebar', 'editorx' ),
					'url'   => '%s/assets/admin/src/layout/fullwidth@2x.png'
                ),
                'right' => array(
					'label' => esc_html__( 'Right Sidebar', 'editorx' ),
					'url'   => '%s/assets/admin/src/layout/right-sidebar@2x.png'
				)
			)
		)
	)
);

$wp_customize->add_setting(
	'editorx_enable_page_header',
	array(
		'default'           => 0,
		'sanitize_callback' => 'editorx_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Editorx_Control_Switch(
		$wp_customize,
		'editorx_enable_page_header',
		array(
			'label'         	=> esc_html__( 'Enable page heading', 'editorx' ),
			'section'       	=> 'editorx_main_header',
			'settings'      	=> 'editorx_enable_page_header',
		)
	)
);

$wp_customize->add_setting(
	'editorx_enable_page_breadcrumb',
	array(
		'default'           => 0,
		'sanitize_callback' => 'editorx_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Editorx_Control_Switch(
		$wp_customize,
		'editorx_enable_page_breadcrumb',
		array(
			'label'         	=> esc_html__( 'Enable page breadcrumb', 'editorx' ),
			'section'       	=> 'editorx_main_header',
			'settings'      	=> 'editorx_enable_page_breadcrumb',
		)
	)
);

/*--------------------------------------------
	Single Section
---------------------------------------------*/
$wp_customize->add_section( 'editorx_single_section',
	array(
		'title'         => esc_html__( 'Single layout', 'editorx'),
		'panel'         => 'editorx_layout_panel',
        'priority'      => 25,
	)
);

$wp_customize->add_setting( 'editorx_single_sidebar',
	array(
		'default'           => 'none',
		'sanitize_callback' => 'sanitize_key',
	)
);

$wp_customize->add_control( new Editorx_Control_RadioImage( $wp_customize, 'editorx_single_sidebar',
		array(
			'label'    => esc_html__( 'Sidebar', 'editorx' ),
			'section'  => 'editorx_single_section',
			'columns'  => 'one-half',
			'choices'  => array(
				'left' => array(
					'label' => esc_html__( 'Left Sidebar', 'editorx' ),
					'url'   => '%s/assets/admin/src/layout/left-sidebar@2x.png'
				),
				'none' => array(
					'label' => esc_html__( 'No Sidebar', 'editorx' ),
					'url'   => '%s/assets/admin/src/layout/fullwidth@2x.png'
                ),
                'right' => array(
					'label' => esc_html__( 'Right Sidebar', 'editorx' ),
					'url'   => '%s/assets/admin/src/layout/right-sidebar@2x.png'
				)
			),
			'priority'  => 60
		)
	)
);

$wp_customize->add_setting( 'editorx_single_heading_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_Heading( $wp_customize, 'editorx_single_heading_title',
		array(
			'label'			=> esc_html__( 'Heading', 'editorx' ),
			'section' 		=> 'editorx_single_section',
			'priority'  => 65
		)
	)
);

$wp_customize->add_setting( 'editorx_single_heading_alignment',
	array(
		'default' 			=> 'left',
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_RadioButtons( $wp_customize, 'editorx_single_heading_alignment',
	array(
		'label' 	=> esc_html__( 'Title alignment', 'editorx' ),
		'section' 	=> 'editorx_single_section',
		'choices' 	=> array(
			'left' 		=> esc_html__( 'Left', 'editorx' ),
			'center' 	=> esc_html__( 'Center', 'editorx' ),
			'right' 	=> esc_html__( 'Right', 'editorx' ),
		),
		'priority'  => 70
	)
) );

$wp_customize->add_setting( 'editorx_single_meta_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_Heading( $wp_customize, 'editorx_single_meta_title',
		array(
			'label'			=> esc_html__( 'Meta', 'editorx' ),
			'section' 		=> 'editorx_single_section',
			'priority'  => 75
		)
	)
);

$wp_customize->add_setting( 'editorx_single_meta_alignment',
	array(
		'default' 			=> 'left',
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_RadioButtons( $wp_customize, 'editorx_single_meta_alignment',
	array(
		'label' 	=> esc_html__( 'Meta alignment', 'editorx' ),
		'section' 	=> 'editorx_single_section',
		'choices' 	=> array(
			'left' 		=> esc_html__( 'Left', 'editorx' ),
			'center' 	=> esc_html__( 'Center', 'editorx' ),
			'right' 	=> esc_html__( 'Right', 'editorx' ),
		),
		'priority'  => 80
	)
) );

$wp_customize->add_setting(
	'editorx_enable_single_meta_date',
	array(
		'default'           => 1,
		'sanitize_callback' => 'editorx_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Editorx_Control_Switch(
		$wp_customize,
		'editorx_enable_single_meta_date',
		array(
			'label'         	=> esc_html__( 'Enable date', 'editorx' ),
			'section'       	=> 'editorx_single_section',
			'settings'      	=> 'editorx_enable_single_meta_date',
			'priority'  => 85
		)
	)
);

$wp_customize->add_setting(
	'editorx_enable_single_meta_author',
	array(
		'default'           => 1,
		'sanitize_callback' => 'editorx_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Editorx_Control_Switch(
		$wp_customize,
		'editorx_enable_single_meta_author',
		array(
			'label'         	=> esc_html__( 'Enable author', 'editorx' ),
			'section'       	=> 'editorx_single_section',
			'settings'      	=> 'editorx_enable_single_meta_author',
			'priority'  => 90
		)
	)
);

$wp_customize->add_setting(
	'editorx_enable_single_meta_comment',
	array(
		'default'           => 0,
		'sanitize_callback' => 'editorx_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Editorx_Control_Switch(
		$wp_customize,
		'editorx_enable_single_meta_comment',
		array(
			'label'         	=> esc_html__( 'Enable comment count', 'editorx' ),
			'section'       	=> 'editorx_single_section',
			'settings'      	=> 'editorx_enable_single_meta_comment',
			'priority'  => 95
		)
	)
);

$wp_customize->add_setting( 'editorx_single_elements_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'editorx_sanitize_text'
	)
);

$wp_customize->add_control( new Editorx_Control_Heading( $wp_customize, 'editorx_single_elements_title',
		array(
			'label'			=> esc_html__( 'Elements', 'editorx' ),
			'section' 		=> 'editorx_single_section',
			'priority'  => 100
		)
	)
);

$wp_customize->add_setting(
	'editorx_single_post_sharing',
	array(
		'default'           => 0,
		'sanitize_callback' => 'editorx_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Editorx_Control_Switch(
		$wp_customize,
		'editorx_single_post_sharing',
		array(
			'label'         	=> esc_html__( 'Enable social share', 'editorx' ),
			'section'       	=> 'editorx_single_section',
			'settings'      	=> 'editorx_single_post_sharing',
			'priority'  => 105
		)
	)
);


