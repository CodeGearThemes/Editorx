<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Editorx
 */

$editorx_page_layout 			= get_theme_mod( 'editorx_page_sidebar', 'none' );
$editorx_website_layout 			= get_theme_mod( 'editorx_website_container', 'container' );

$editorx_page_header = get_theme_mod( 'editorx_enable_page_header', 0 );
$editorx_page_breadcrumb = get_theme_mod( 'editorx_enable_page_breadcrumb', 0 );

/*Main container class*/
$editorx_main_class[] = 'main-container';
if ( $editorx_page_layout == 'none' ) {
	$editorx_main_class[] = 'no-sidebar';
} else {
	$editorx_main_class[] = $editorx_page_layout . '-sidebar has-sidebar';
}

$editorx_content_class   = array();
if( $editorx_page_layout == 'none' ) {
	$editorx_content_class[] 		= 'one-whole';
}else{
	$editorx_content_class[] = 'large--three-quarters medium-down--one-whole';
}

$editorx_container_class = 'container';
if(  $editorx_website_layout === 'container-fluid' ){
	$editorx_container_class = 'container-fluid';
}

get_header();
?>

<div class="section-page section--page-template">
	<?php if( $editorx_page_header ): ?>
		<?php if( !is_front_page()  ): ?>
			<div class="page-header-wrapper">
				<div class="<?php echo esc_attr( $editorx_container_class ); ?>">
					<div class="page-header entry-header">
						<?php
							the_title( '<h1 class="entry-title">', '</h1>' );
							if( $editorx_page_breadcrumb ):
								editorx_breadcrumb();
							endif;
						?>
					</div>
				</div>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<div class="main-content <?php echo esc_attr( implode( ' ', $editorx_main_class ) ); ?>">
		<div class="<?php echo esc_attr( $editorx_container_class ); ?>">
			<div class="grid">
				<div id="primary" class="grid__item <?php echo esc_attr( implode( ' ', $editorx_content_class ) ); ?> content-area">
					<main id="main" class="site-main">

						<?php
							while ( have_posts() ) :
								the_post();

								get_template_part( 'template-parts/content', 'page' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

							endwhile; // End of the loop.
						?>

					</main><!-- #main -->
				</div>
				<?php
					if( $editorx_page_layout == 'left' || $editorx_page_layout == 'right' ):
						get_sidebar();
					endif;
				?>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
