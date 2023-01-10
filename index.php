<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Editorx
 */

$editorx_post_layout 			= get_theme_mod( 'editorx_posts_sidebar', 'right' );
$editorx_website_layout 		= get_theme_mod( 'editorx_website_container', 'container' );

/*Main container class*/
$editorx_main_class[] = 'main-container';
if ( $editorx_post_layout == 'full' ) {
	$editorx_main_class[] = 'no-sidebar';
} else {
	$editorx_main_class[] = $editorx_post_layout . '-sidebar has-sidebar';
}

$editorx_content_class   = array();
if( $editorx_post_layout == 'full' ) {
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
<div class="section-index section--index-template">
	<?php if ( is_home() && ! is_front_page() && ! empty( single_post_title( '', false ) ) ) : ?>
	<div class="page-header">
		<div class="<?php echo esc_attr( $editorx_container_class ); ?>">
			<div class="grid">
				<div class="grid__item one-whole">
					<h1 class="page-title"><?php single_post_title(); ?></h1>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div class="main-content <?php echo esc_attr( implode( ' ', $editorx_main_class ) ); ?>">
		<div class="<?php echo esc_attr( $editorx_container_class ); ?>">
			<div class="grid">
				<div id="primary" class="grid__item <?php echo esc_attr( implode( ' ', $editorx_content_class ) ); ?> content-area">
					<main id="main" class="site-main">

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
					if( $editorx_post_layout == 'left' || $editorx_post_layout == 'right' ):
						get_sidebar();
					endif;
				?>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();
