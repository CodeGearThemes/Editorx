<?php
/**
* Plugins Activation
*
* @author      CodeGearThemes
* @category    WordPress
* @package     Editorx
* @version     1.0.13
*/
function editorx_register_required_plugins() {

  $plugins = array(
        array(
            'name'      => __( 'Designer', 'editorx' ),
            'slug'      => 'designer',
            'required'  => false,
			'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'      => __( 'Elementor', 'editorx' ),
            'slug'      => 'elementor',
            'required'  => false,
            'force_activation'   => false,
            'force_deactivation' => false,
        )
    );
    $config = array(
        'id'           => 'editorx',
        'default_path' => '',
        'menu'         => 'install-plugins',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => true,
        'message'      => '',
    );

    tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'editorx_register_required_plugins' );
