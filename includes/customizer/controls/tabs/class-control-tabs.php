<?php
/**
 * Customizer Control: Tabs
 *
 * @package     Editorx
 * @author      CodeGearThemes
 * @copyright   Copyright (c) 2020, Editorx
 * @link        https://codegearthemes.com/
 * @since       1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Editorx_Control_Tabs extends WP_Customize_Control {

	/**
	 * The type of control being rendered
	 */
	public $type = 'editorx-tabs-control';

	public $controls_design;
	public $controls_general;


	/**
	 * Constructor
	 */
	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Render the control in the customizer
	 */
	public function render_content() { ?>
        <div class="control-tabs">
            <div class="control-tab control-tab-general active" data-connected="<?php echo esc_attr( $this->controls_general ); ?>"><?php echo esc_html__( 'General', 'editorx' ); ?></div>
            <div class="control-tab control-tab-design" data-connected="<?php echo esc_attr( $this->controls_design ); ?>"><?php echo esc_html__( 'Style', 'editorx' ); ?></div>
        </div>
	<?php
	}
}
