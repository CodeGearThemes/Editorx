<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Editorx
 */
$editorx_archive_layout	= get_theme_mod( 'editorx_archive_layout', 'simple' );
$editorx_archive_sidebar_layout 			= get_theme_mod( 'editorx_archive_sidebar', 'none' );
$editorx_website_layout 			= get_theme_mod( 'editorx_website_container', 'container' );

/*Main container class*/
$editorx_main_class[] = 'main-container';
if ( $editorx_archive_sidebar_layout  == 'full' ) {
	$editorx_main_class[] = 'no-sidebar';
} else {
	$editorx_main_class[] = $editorx_archive_sidebar_layout  . '-sidebar has-sidebar';
}

$editorx_content_class   = array();
if( $editorx_archive_sidebar_layout == 'none' ) {
	$editorx_content_class[] 		= 'one-whole';
}else{
	$editorx_content_class[] = 'large--two-thirds medium--three-fifths small--one-whole';
}
$editorx_container_class = 'container';
if(  $editorx_website_layout === 'container-fluid' ){
	$editorx_container_class = 'container-fluid';
}

get_header();
?>
<div class="section-archive section--archive-template">
	<?php if ( have_posts() ) : ?>
	<div class="page-header">
		<div class="<?php echo esc_attr( $editorx_container_class ); ?>">
			<div class="grid">
				<div class="grid__item one-whole">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div class="main-content <?php echo esc_attr( implode( ' ', $editorx_main_class ) ); ?>">
		<div class="<?php echo esc_attr( $editorx_container_class ); ?>">
			<div class="grid">
				<div id="primary" class="grid__item <?php echo esc_attr( implode( ' ', $editorx_content_class ) ); ?> content-area">
					<main id="main" class="site-main grid">

						<?php
							if ( have_posts() ) :

								/* Start the Loop */
								while ( have_posts() ) :
									the_post();

									/*
									* Include the Post-Type-specific template for the content.
									* If you want to override this in a child theme, then include a file
									* called content-___.php (where ___ is the Post Type name) and that will be used instead.
									*/
									get_template_part( 'template-parts/content', get_post_type() );

								endwhile;

								editorx_post_navigation();

							else :

								get_template_part( 'template-parts/content', 'none' );

							endif;
						?>

					</main><!-- #main -->
				</div>
				<?php
					if( $editorx_archive_sidebar_layout == 'left' || $editorx_archive_sidebar_layout == 'right' ):
						get_sidebar();
					endif;
				?>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();
