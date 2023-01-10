<?php
class Editorx_Control_Typography extends WP_Customize_Control {
	/**
	 * The type of control being rendered
	 */
	public $type = 'editorx-google-fonts';
	/**
	 * The list of Google Fonts
	 */
	private $fontList = false;
	/**
	 * The saved font values decoded from json
	 */
	private $fontValues = [];
	/**
	 * The index of the saved font within the list of Google fonts
	 */
	private $fontListIndex = 0;
	/**
	 * The number of fonts to display from the json file. Either positive integer or 'all'. Default = 'all'
	 */
	private $fontCount = 'all';
	/**
	 * The font list sort order. Either 'alpha' or 'popular'. Default = 'alpha'
	 */
	private $fontOrderBy = 'alpha';
	/**
	 * Get our list of fonts from the json file
	 */
	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		parent::__construct( $manager, $id, $args );
		// Get the font sort order
		if ( isset( $this->input_attrs['orderby'] ) && strtolower( $this->input_attrs['orderby'] ) === 'popular' ) {
			$this->fontOrderBy = 'popular';
		}
		// Get the list of Google fonts
		if ( isset( $this->input_attrs['font_count'] ) ) {
			if ( 'all' != strtolower( $this->input_attrs['font_count'] ) ) {
				$this->fontCount = ( abs( (int) $this->input_attrs['font_count'] ) > 0 ? abs( (int) $this->input_attrs['font_count'] ) : 'all' );
			}
		}
		$this->fontList = $this->get_google_fonts( 'all' );
		// Decode the default json font value
		$this->fontValues = json_decode( $this->value( 'family' ) );

		// Find the index of our default font within our list of Google fonts
		$this->fontListIndex = $this->get_font_index( $this->fontList, $this->fontValues->font );
	}

	/**
	 * Enqueue our scripts and styles
	 */
	public function enqueue() {
		wp_enqueue_script( 'select2', EDITORX_THEME_URI . 'includes/customizer/controls/typography/js/select2.full.min.js', array( 'jquery' ), '4.0.13', true );
		wp_enqueue_style( 'select2', EDITORX_THEME_URI . 'includes/customizer/controls/typography/css/select2.min.css', array(), '4.0.13', 'all' );
	}

	/**
	 * Export our List of Google Fonts to JavaScript
	 */
	public function to_json() {
		parent::to_json();
		$this->json['fontslist'] = $this->fontList;
	}
	/**
	 * Render the control in the customizer
	 */
	public function render_content() {
		$fontCounter = 0;
		$isFontInList = false;
		$fontListStr = '';

		if( !empty($this->fontList) ) {
			?>
			<div class="google_fonts_select_control">
				<?php if( !empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value('family') ); ?>" class="customize-control-google-font-selection" <?php $this->link('family'); ?> />
				<div class="google-fonts">
					<select class="google-fonts-list" control-name="<?php echo esc_attr( $this->id ); ?>">
						<?php
							foreach( $this->fontList as $key => $value ) {
								$fontCounter++;
								$fontListStr .= '<option value="' . $value->family . '" ' . selected( $this->fontValues->font, $value->family, false ) . '>' . $value->family . '</option>';
								if ( $this->fontValues->font === $value->family ) {
									$isFontInList = true;
								}
								if ( is_int( $this->fontCount ) && $fontCounter === $this->fontCount ) {
									break;
								}
							}
							if ( !$isFontInList && $this->fontListIndex ) {
								// If the default or saved font value isn't in the list of displayed fonts, add it to the top of the list as the default font
								$fontListStr = '<option value="' . $this->fontList[$this->fontListIndex]->family . '" ' . selected( $this->fontValues->font, $this->fontList[$this->fontListIndex]->family, false ) . '>' . $this->fontList[$this->fontListIndex]->family . ' (default)</option>' . $fontListStr;
							}
							// Display our list of font options
							echo $fontListStr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
					</select>
				</div>

				<div class="font--weight-regular" style="margin: 0 -1%;">
					<?php if ( $this->input_attrs['disableRegular'] == false ) : ?>
					<div class="font-weight">
						<div class="font-control-title"><?php esc_html_e( 'Font weight', 'editorx' ) ?></div>
						<div class="weight-style">
							<select class="google-fonts-regularweight-style">
								<?php
									foreach( $this->fontList[$this->fontListIndex]->variants as $key => $value ) {
										echo '<option value="' . esc_attr( $value ) . '" ' . selected( $this->fontValues->regularweight, $value, false ) . '>' . esc_html( $value ) . '</option>';
									}
								?>
							</select>
						</div>
					</div>
					<?php endif; ?>
				</div>

				<div class="font--weight-medium" style="margin: 0 -1%;">
					<div class="font-weight">
						<div class="font-control-title"><?php esc_html_e( 'Font weight medium', 'editorx' ) ?></div>
						<div class="weight-style">
							<select class="google-fonts-mediumweight-style">
								<?php
									foreach( $this->fontList[$this->fontListIndex]->variants as $key => $value ) {
										echo '<option value="' . esc_attr( $value ) . '" ' . selected( $this->fontValues->mediumweight, $value, false ) . '>' . esc_html( $value ) . '</option>';
									}
								?>
							</select>
						</div>
					</div>
				</div>

				<div class="font--weight-bold" style="margin: 0 -1%;">

					<div class="font-weight">
						<div class="font-control-title"><?php esc_html_e( 'Font weight bold', 'editorx' ) ?></div>
						<div class="weight-style">
							<select class="google-fonts-boldweight-style">
								<?php
									foreach( $this->fontList[$this->fontListIndex]->variants as $key => $value ) {
										echo '<option value="' . esc_attr( $value ) . '" ' . selected( $this->fontValues->boldweight, $value, false ) . '>' . esc_html( $value ) . '</option>';
									}
								?>
							</select>
						</div>
					</div>
				</div>

				<input type="hidden" class="google-fonts-category" value="<?php echo esc_html( $this->fontValues->category ); ?>">
			</div>
			<?php
		}
	}

	/**
	 * Find the index of the saved font in our multidimensional array of Google Fonts
	 */
	public function get_font_index( $haystack, $needle ) {
		foreach( $haystack as $key => $value ) {
			if( $value->family == $needle ) {
				return $key;
			}
		}
		return false;
	}

	/**
	 * Return the list of Google Fonts from our json file. Unless otherwise specfied, list will be limited to 30 fonts.
	 */
	public function get_google_fonts( $count = 30 ) {
		$fontFile = EDITORX_THEME_URI. 'includes/customizer/controls/typography/google-fonts-alphabetical.json';

		$request = wp_remote_get( $fontFile );
		if( is_wp_error( $request ) ) {
			return "";
		}

		$body = wp_remote_retrieve_body( $request );
		$content = json_decode( $body );
		return $content->items;

	}
}
