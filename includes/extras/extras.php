<?php
/**
 * Enqueue admin scripts and styles.
 *
 * @author      CodeGearThemes
 * @category    WordPress
 * @package     Editorx
 * @version     1.0.0
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function editorx_public_scripts(){

	$defaults = json_encode(
		array(
			'font' 			=> 'System default',
			'regularweight' => 'regular',
			'category' 		=> 'sans-serif'
		)
	);


    $editorx_site_width 				= '1170px';

	$editorx_primary_color				= get_theme_mod( 'editorx_website_primary_color', '#003D2B' );
	$editorx_secondary_color			= get_theme_mod( 'editorx_website_secondary_color', '#4E7661' );


	$font_body 						= json_decode( get_theme_mod( 'editorx_base_font', $defaults ), true );
	if ( 'System default' === $font_body['font'] ) {
		$editorx_base_fonts			= '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif';
	}else{
		$editorx_base_fonts			= $font_body['font'];
	}

	$editorx_desktop_logo_size = get_theme_mod( 'editorx_logo_size_desktop' , '250'). 'px';
	$editorx_tablet_logo_size = get_theme_mod( 'editorx_logo_size_tablet' , '175'). 'px';
	$editorx_mobile_logo_size = get_theme_mod( 'editorx_logo_size_mobile' , '125'). 'px';


	$editorx_base_font_size			= get_theme_mod('editorx_base_font_size_desktop', '16' ).'px';
	$editorx_base_tablet_font_size	= get_theme_mod('editorx_base_font_size_tablet', '14' ).'px';
	$editorx_base_mobile_font_size	= get_theme_mod('editorx_base_font_size_mobile', '14' ).'px';

	$editorx_base_font_weight = 'normal';
	if( isset( $font_body['regularweight'] ) ){
		$editorx_base_font_weight		= $font_body['regularweight'];
	}

	$editorx_base_font_style		= get_theme_mod('editorx_base_font_style', 'normal');
	$editorx_base_line_height 		= get_theme_mod( 'editorx_base_line_height', '1.4' );
	$editorx_base_letter_spacing 	= get_theme_mod( 'editorx_base_letter_spacing', '0' );
	$editorx_base_text_transform 	= get_theme_mod( 'seditorx_base_text_transform', 'none' );


	$font_heading = json_decode( get_theme_mod( 'editorx_heading_font', $defaults ), true  );
	if ( 'System default' === $font_heading['font'] ) {
		$editorx_heading_fonts			= '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif';
	}else{
		$editorx_heading_fonts			= $font_heading['font'];
	}

	$editorx_heading_font_weight = 'bold';
	if( isset( $font_heading['boldweight'] ) ){
		$editorx_heading_font_weight		= $font_heading['boldweight'];
	}

	$editorx_heading_font_style			= get_theme_mod( 'editorx_heading_font_style', 'normal');
	$editorx_heading_line_height 		= get_theme_mod( 'editorx_heading_line_height', '1.4' );
	$editorx_heading_letter_spacing 	= get_theme_mod( 'editorx_heading_letter_spacing', '0' );
	$editorx_heading_text_transform 	= get_theme_mod( 'editorx_heading_text_transform', 'none' );

	$editorx_heading_fontsizeh1 		= get_theme_mod( 'editorx_heading_h1_font_size_desktop' , '40' );
	$editorx_heading_fontsizeh2			= get_theme_mod( 'editorx_heading_h2_font_size_desktop' , '32' );
	$editorx_heading_fontsizeh3			= get_theme_mod( 'editorx_heading_h3_font_size_desktop' , '28' );
	$editorx_heading_fontsizeh4			= get_theme_mod( 'editorx_heading_h4_font_size_desktop' , '24' );
	$editorx_heading_fontsizeh5			= get_theme_mod( 'editorx_heading_h5_font_size_desktop' , '20' );
	$editorx_heading_fontsizeh6			= get_theme_mod( 'editorx_heading_h6_font_size_desktop' , '16' );

	$editorx_heading_tablet_fontsizeh1 	= get_theme_mod( 'editorx_heading_h1_font_size_tablet' , '36' );
	$editorx_heading_tablet_fontsizeh2		= get_theme_mod( 'editorx_heading_h2_font_size_tablet' , '28' );
	$editorx_heading_tablet_fontsizeh3		= get_theme_mod( 'editorx_heading_h3_font_size_tablet' , '24' );
	$editorx_heading_tablet_fontsizeh4		= get_theme_mod( 'editorx_heading_h4_font_size_tablet' , '20' );
	$editorx_heading_tablet_fontsizeh5		= get_theme_mod( 'editorx_heading_h5_font_size_tablet' , '16' );
	$editorx_heading_tablet_fontsizeh6		= get_theme_mod( 'editorx_heading_h6_font_size_tablet' , '16' );


	$editorx_heading_mobile_fontsizeh1 	= get_theme_mod( 'editorx_heading_h1_font_size_mobile' , '28' );
	$editorx_heading_mobile_fontsizeh2		= get_theme_mod( 'editorx_heading_h2_font_size_mobile' , '22' );
	$editorx_heading_mobile_fontsizeh3		= get_theme_mod( 'editorx_heading_h3_font_size_mobile' , '18' );
	$editorx_heading_mobile_fontsizeh4		= get_theme_mod( 'editorx_heading_h4_font_size_mobile' , '16' );
	$editorx_heading_mobile_fontsizeh5		= get_theme_mod( 'editorx_heading_h5_font_size_mobile' , '16' );
	$editorx_heading_mobile_fontsizeh6		= get_theme_mod( 'editorx_heading_h6_font_size_mobile' , '16' );

	$editorx_form_border_color 			= get_theme_mod( 'editorx_border_color', '#cccccc' );
	$editorx_form_field_background			= get_theme_mod( 'editorx_form_field_background', '#ffffff' );

	$editorx_button_text_color				= get_theme_mod( 'editorx_button_text_color', '#ffffff' );
	$editorx_button_hover_text_color		= get_theme_mod( 'editorx_button_hover_color', '#ffffff' );
	$editorx_button_desktop_font_size		= get_theme_mod( 'editorx_button_font_size_desktop', 14 ).'px';
	$editorx_button_tablet_font_size		= get_theme_mod( 'editorx_button_font_size_tablet', 14 ).'px';
	$editorx_button_mobile_font_size		= get_theme_mod( 'editorx_button_font_size_mobile', 14 ).'px';
	$editorx_button_text_transform			= get_theme_mod( 'editorx_button_text_transform', 'none' );
	$editorx_button_letter_spacing			= get_theme_mod( 'editorx_button_letter_spacing', 0 );

	$editorx_button_desktop_top_bottom_padding	= get_theme_mod( 'editorx_button_top_bottom_padding_desktop', 18 ).'px';
	$editorx_button_tablet_top_bottom_padding	= get_theme_mod( 'editorx_button_top_bottom_padding_desktop', 16 ).'px';
	$editorx_button_mobile_top_bottom_padding	= get_theme_mod( 'editorx_button_top_bottom_padding_desktop', 14 ).'px';
	$editorx_button_border_radius				= get_theme_mod( 'editorx_button_border_radius', 4 ).'px';

	$editorx_button_hamburger_color 		=	get_theme_mod( 'editorx_hamburger_button_color', '#000000' );
	$editorx_button_hamburger_background 	=	get_theme_mod( 'editorx_hamburger_button_background', '#FFFFFF' );


	$editorx_footer_text_color				=  get_theme_mod( 'editorx_footer_section_text_color', '#333333' );
	$editorx_footer_heading_color			=  get_theme_mod( 'editorx_footer_section_heading_color', '#222222' );
	$editorx_footer_background				=  get_theme_mod( 'editorx_footer_section_background', '#f8f8f8' );

	$editorx_footer_credit_color 			= get_theme_mod( 'editorx_footer_credits_color', '#333333' );
	$editorx_footer_credit_background 		= get_theme_mod( 'editorx_footer_credits_background', '#f8f8f8' );
	$editorx_footer_credit_link_color 		= get_theme_mod( 'editorx_footer_credits_link_color', '#7e7e7e' );
	$editorx_footer_credit_link_hover_color = get_theme_mod( 'editorx_footer_credits_link_hover_color', '#222222' );


    $editorx_custom_styles = "
		:root{
			--theme--site-width: $editorx_site_width;

			--theme--primary-color:		". esc_attr ( $editorx_primary_color ) .";
			--theme--secondary-color:	". esc_attr( $editorx_secondary_color ) .";

			--theme--website-base-font-size:		". absint( $editorx_base_font_size ) ."px;
			--theme--website-base-tablet-font-size: ". absint( $editorx_base_tablet_font_size ) ."px;
			--theme--website-base-mobile-font-size: ". absint( $editorx_base_mobile_font_size ) ."px;
			--theme--website-base-font-family:		". esc_attr ( $editorx_base_fonts ) .";
			--theme--website-base-font-weight:		". esc_attr ( $editorx_base_font_weight ) .";
			--theme--website-base-font-style:		". esc_attr ( $editorx_base_font_style ) .";
			--theme--website-base-line-height:		". esc_attr ( $editorx_base_line_height ) .";
			--theme--website-base-letter-spacing:	". esc_attr ( $editorx_base_letter_spacing ) ."px;
			--theme--website-base-text-transform:	". esc_attr ( $editorx_base_text_transform ) .";

			--theme--desktop-logo-size:	". absint( $editorx_desktop_logo_size ) ."px;
			--theme--tablet-logo-size:  ". absint( $editorx_tablet_logo_size ) ."px;
			--theme--mobile-logo-size:	". absint( $editorx_mobile_logo_size ) ."px;

			--theme--heading-size1:	". absint( $editorx_heading_fontsizeh1 ) ."px;
			--theme--heading-size2: ". absint( $editorx_heading_fontsizeh2 ) ."px;
			--theme--heading-size3: ". absint( $editorx_heading_fontsizeh3 ) ."px;
			--theme--heading-size4: ". absint( $editorx_heading_fontsizeh4 ) ."px;
			--theme--heading-size5: ". absint( $editorx_heading_fontsizeh5 ) ."px;
			--theme--heading-size6: ". absint( $editorx_heading_fontsizeh6 ) ."px;

			--theme--heading-tablet-size1: ". absint( $editorx_heading_tablet_fontsizeh1 ) ."px;
			--theme--heading-tablet-size2: ". absint( $editorx_heading_tablet_fontsizeh2 ) ."px;
			--theme--heading-tablet-size3: ". absint( $editorx_heading_tablet_fontsizeh3 ) ."px;
			--theme--heading-tablet-size4: ". absint( $editorx_heading_tablet_fontsizeh4 ) ."px;
			--theme--heading-tablet-size5: ". absint( $editorx_heading_tablet_fontsizeh5 ) ."px;
			--theme--heading-tablet-size6: ". absint( $editorx_heading_tablet_fontsizeh6 ) ."px;

			--theme--heading-mobile-size1: ". absint( $editorx_heading_mobile_fontsizeh1 ) ."px;
			--theme--heading-mobile-size2: ". absint( $editorx_heading_mobile_fontsizeh2 ) ."px;
			--theme--heading-mobile-size3: ". absint( $editorx_heading_mobile_fontsizeh3 ) ."px;
			--theme--heading-mobile-size4: ". absint( $editorx_heading_mobile_fontsizeh4 ) ."px;
			--theme--heading-mobile-size5: ". absint( $editorx_heading_mobile_fontsizeh5 ) ."px;
			--theme--heading-mobile-size6: ". absint( $editorx_heading_mobile_fontsizeh6 ) ."px;

			--theme--website-heading-font-weight: ". esc_attr ( $editorx_heading_font_weight ) .";
			--theme--website-heading-font-style: ". esc_attr ( $editorx_heading_font_style ) .";
			--theme--website-heading-font-family: ". esc_attr ( $editorx_heading_fonts ) .";
			--theme--website-heading-line-height: ". esc_attr ( $editorx_heading_line_height ) .";
			--theme--website-heading-letter-spacing: ". esc_attr ( $editorx_heading_letter_spacing ) ."px;
			--theme--website-heading-text-transform: ". esc_attr ( $editorx_heading_text_transform ) .";

			--theme--form-border-color: ". esc_attr ( $editorx_form_border_color ) .";
			--theme--form-background-color: ". esc_attr ( $editorx_form_field_background ) .";

			--theme--button-text-color: ". esc_attr ( $editorx_button_text_color ) .";
			--theme--button-text-hover-color: ". esc_attr ( $editorx_button_hover_text_color ) .";
			--theme--button-desktop-font-size: " . esc_attr ( $editorx_button_desktop_font_size ) .";
			--theme--button-tablet-font-size: " . esc_attr ( $editorx_button_tablet_font_size ) .";
			--theme--button-mobile-font-size: " . esc_attr ( $editorx_button_mobile_font_size ) .";
			--theme--button-text-transform: " . esc_attr ( $editorx_button_text_transform ) .";
			--theme--button-letter-spacing: " . esc_attr ( $editorx_button_letter_spacing ) ."px;

			--theme--button-desktop-top-bottom-padding: " . esc_attr ( $editorx_button_desktop_top_bottom_padding ) .";
			--theme--button-tablet-top-bottom-padding: " . esc_attr ( $editorx_button_tablet_top_bottom_padding ) .";
			--theme--button-mobile-top-bottom-padding: " . esc_attr ( $editorx_button_mobile_top_bottom_padding ) .";

			--theme--button-border-radius: " . esc_attr ( $editorx_button_border_radius ) .";

			--theme--button-hanburger-color: " . esc_attr ( $editorx_button_hamburger_color ) .";
			--theme--button-hanburger-background: " . esc_attr ( $editorx_button_hamburger_background ) .";

			--theme--footer-color: ". esc_attr ( $editorx_footer_text_color ) .";
			--theme--footer-heading-color: ". esc_attr ( $editorx_footer_heading_color ) .";
			--theme--footer-background: ". esc_attr ( $editorx_footer_background ) .";

			--theme--credit-color: ". esc_attr ( $editorx_footer_credit_color ) .";
			--theme--credit-link-color: ". esc_attr ( $editorx_footer_credit_link_color ) .";
			--theme--credit-link-hover-color: ". esc_attr ( $editorx_footer_credit_link_hover_color ) .";
			--theme--credit-background: ". esc_attr ( $editorx_footer_credit_background ) .";
		}";

	wp_enqueue_style( 'editorx-google-fonts', editorx_google_fonts_url(), array(), editorx_google_fonts_version() );
    wp_enqueue_style( 'editorx-theme-style', EDITORX_THEME_URI . '/assets/public/css/theme.css', array(), EDITORX_THEME_VERSION );
    wp_add_inline_style( 'editorx-theme-style', $editorx_custom_styles );


	wp_enqueue_script( 'navigation', EDITORX_THEME_URI . '/assets/lib/navigation/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'skip-link-focus-fix', EDITORX_THEME_URI . '/assets/lib/automattic/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'editorx-theme-script', EDITORX_THEME_URI . '/assets/public/js/theme.js', array(), 'EDITORX_THEME_VERSION', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'editorx_public_scripts' );
