<?php
/**
 * Customizer Control: Slider
 *
 * @package     Editorx
 * @author      CodeGearThemes
 * @copyright   Copyright (c) 2020, Editorx
 * @link        https://codegearthemes.com/
 * @since       1.0.0
 */
class Editorx_Control_Slider extends WP_Customize_Control {

    /**
	 * The type of control being rendered
	 */
	public $type = 'editorx-slider';
    public $responsive;

	/**
	 * Render the control in the customizer
	 */
	public function render_content() {

        $step = 1;
		if ( isset( $this->input_attrs['step'] ) ) {
			$step = $this->input_attrs['step'];
		}

        $responsive_class = 'non-responsive';
		if ( $this->responsive ) {
			$responsive_class = 'responsive';
		}

		?>
			<div class="range-slider range--slider-wrapper slider-range">
				<div class="control-heading">
					<div class="customize-control-title"><?php echo esc_html( $this->label ); ?></div>
					<?php if ( $this->responsive ) : ?>
					<ul class="devices-preview">
						<li class="desktop"><button type="button" class="preview-desktop active" data-device="desktop"><i class="dashicons dashicons-desktop"></i></button></li>
						<li class="tablet"><button type="button" class="preview-tablet" data-device="tablet"><i class="dashicons dashicons-tablet"></i></button></li>
						<li class="mobile"><button type="button" class="preview-mobile" data-device="mobile"><i class="dashicons dashicons-smartphone"></i></button></li>
					</ul>
					<?php endif; ?>
				</div>
				<div class="range-slider-inner range--slider-desktop desktop active <?php echo esc_attr( $responsive_class ); ?>">
					<input class="range--slider-range" type="range" value="<?php echo esc_attr( $this->value( 'size_desktop' ) ); ?>" <?php $this->link( 'size_desktop' ); ?> min="<?php echo absint( $this->input_attrs['min'] ); ?>" max="<?php echo absint( $this->input_attrs['max'] ); ?>" step="<?php echo esc_attr( $step ); ?>">
					<input class="range--slider-value" type="number" value="<?php echo esc_attr( $this->value( 'size_desktop' ) ); ?>" <?php $this->link( 'size_desktop' ); ?> min="<?php echo absint( $this->input_attrs['min'] ); ?>" max="<?php echo absint( $this->input_attrs['max'] ); ?>" step="<?php echo esc_attr( $step ); ?>">
					<?php if( isset( $this->input_attrs['unit'] ) ): ?>
					<span><?php echo esc_html( $this->input_attrs['unit'] ); ?></span>
					<?php endif; ?>
				</div>
				<?php if ( $this->responsive ) : ?>
                    <div class="range-slider-inner range--slider-tablet tablet">
                        <input class="range--slider-range" type="range" value="<?php echo esc_attr( $this->value( 'size_tablet' ) ); ?>" <?php $this->link( 'size_tablet' ); ?> min="<?php echo absint( $this->input_attrs['min'] ); ?>" max="<?php echo absint( $this->input_attrs['max'] ); ?>" step="<?php echo esc_attr( $step ); ?>">
                        <input class="range--slider-value" type="number" value="<?php echo esc_attr( $this->value( 'size_tablet' ) ); ?>" <?php $this->link( 'size_tablet' ); ?> min="<?php echo absint( $this->input_attrs['min'] ); ?>" max="<?php echo absint( $this->input_attrs['max'] ); ?>" step="<?php echo esc_attr( $step ); ?>">
						<?php if( isset( $this->input_attrs['unit'] ) ): ?>
						<span><?php echo esc_html( $this->input_attrs['unit'] ); ?></span>
						<?php endif; ?>
					</div>
                    <div class="range-slider-inner range--slider-mobile mobile">
                        <input class="range--slider-range" type="range" value="<?php echo esc_attr( $this->value( 'size_mobile' ) ); ?>" <?php $this->link( 'size_mobile' ); ?> min="<?php echo absint( $this->input_attrs['min'] ); ?>" max="<?php echo absint( $this->input_attrs['max'] ); ?>" step="<?php echo esc_attr( $step ); ?>">
                        <input class="range--slider-value" type="number" value="<?php echo esc_attr( $this->value( 'size_mobile' ) ); ?>" <?php $this->link( 'size_mobile' ); ?> min="<?php echo absint( $this->input_attrs['min'] ); ?>" max="<?php echo absint( $this->input_attrs['max'] ); ?>" step="<?php echo esc_attr( $step ); ?>">
						<?php if( isset( $this->input_attrs['unit'] ) ): ?>
						<span><?php echo esc_html( $this->input_attrs['unit'] ); ?></span>
						<?php endif; ?>
                    </div>
				<?php endif; ?>
			</div>
		<?php
	}
}
