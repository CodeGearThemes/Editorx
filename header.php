<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Editorx
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Mobile Specific Metas -->
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="640">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<?php
	$editorx_website_layout 		= get_theme_mod( 'editorx_website_container', 'container' );
	$editorx_container_class = 'container';
	if(  $editorx_website_layout === 'container-fluid' ){
		$editorx_container_class = 'container-fluid';
	}
	$editorx_header_is_transparent	=	get_theme_mod( 'editorx_enable_header_transparent', 0 );
	$editorx_transparent_class	=	'';
	if( $editorx_header_is_transparent ){
		$editorx_transparent_class	= 'transparent-header';
	}
	$editorx_header_layout		= get_theme_mod( 'editorx_main_header_layout', 'default' );
?>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'editorx' ); ?></a>
    <div class="wrapper">
		<header id="masthead" class="site-header <?php echo esc_attr( $editorx_transparent_class ); ?>">
			<div class="<?php echo esc_attr( $editorx_container_class ); ?>">
				<?php get_template_part( 'template-parts/header/layout', $editorx_header_layout ); ?>
			</div>
		</header><!-- #masthead -->

		<div id="content" class="site-content">
