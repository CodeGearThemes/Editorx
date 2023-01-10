<?php
/**
 * Radio Image Customizer Control.
 *
 * @author      CodeGearThemes
 * @category    WordPress
 * @package     Editorx
 * @subpackage  Controls
 * @since       1.0.0
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( class_exists( 'WP_Customize_Control' ) ) {
  class Editorx_Control_RadioImage extends WP_Customize_Control {

        public $type = 'editorx-radio-image';

        public $columns;
		/**
		 * Render the control's content.
		 */
		public function render_content() {
            if ( empty( $this->choices ) )
				return;

            $name = '_customize-radio-'.$this->id;
			?>
			<label>
                <?php if ( ! empty( $this->label ) && isset( $this->label ) ) : ?>
				    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php endif; ?>
                <?php if ( ! empty( $this->description ) && isset( $this->description ) ) : ?>
				    <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php endif; ?>
			</label>

            <div id="<?php echo esc_attr( "input_{$this->id}" ); ?>" class="buttonset-setting radio-image <?php echo esc_attr( "radio-image-{$this->columns}" ); ?>">
                <?php foreach ( $this->choices as $value => $args ) : ?>
                <div class="image-item">
                    <input style = "display:none" class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( "{$this->id}-{$value}" ); ?>" <?php $this->link();  checked( $this->value(), $value ); ?>/>
                    <label for="<?php echo esc_attr( "{$this->id}-{$value}" ); ?>">
                        <img src="<?php echo esc_url( sprintf( $args['url'], get_template_directory_uri(), get_stylesheet_directory_uri() ) ); ?>" alt="<?php if(isset( $value )) echo esc_html( $value ); ?>">
                        <?php if(isset( $value )): ?>
                            <span class="label"><?php echo esc_html( $value ); ?></span>
                        <?php endif; ?>
                    </label>
                </div>
                <?php endforeach; ?>
            </div>
			<?php
		}
	}

}
