<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Editorx
 */

get_header();

$editorx_single_layout 			= get_theme_mod( 'editorx_single_sidebar', 'none' );
$editorx_website_layout 			= get_theme_mod( 'editorx_website_container', 'container' );

/*Main container class*/
$editorx_main_class[] = 'main-container';
if ( $editorx_single_layout == 'none' ) {
	$editorx_main_class[] = 'no-sidebar';
} else {
	$editorx_main_class[] = $editorx_single_layout . '-sidebar has-sidebar';
}

$editorx_content_class   = array();
if( $editorx_single_layout == 'none' ) {
	$editorx_content_class[] 		= 'one-whole';
}elseif( $editorx_single_layout == 'centered' ){
	$editorx_content_class[] = 'large--two-thirds medium-down--one-whole';
}else{
	$editorx_content_class[] = 'large--two-thirds medium-down--one-whole';
	if( $editorx_single_layout === 'left' ){
		$editorx_content_class[] = 'omega';
	}else{
		$editorx_content_class[] = 'alpha';
	}
}

$editorx_container_class = 'container';
if(  $editorx_website_layout === 'container-fluid' ){
	$editorx_container_class = 'container-fluid';
}

?>
<div class="section-single section--single-template">
	<div class="main-content <?php echo esc_attr( implode( ' ', $editorx_main_class ) ); ?>">
		<div class="<?php echo esc_attr( $editorx_container_class ); ?>">
			<div class="grid">
				<div id="primary" class="grid__item <?php echo esc_attr( implode( ' ', $editorx_content_class ) ); ?> content-area">
					<main id="main" class="site-main">

						<?php
							while ( have_posts() ) :
								the_post();

								get_template_part( 'template-parts/single/content', get_post_type() );
								the_post_navigation(
									array(
										'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous', 'editorx' ) . '</span> <span class="nav-title">%title</span>',
										'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next', 'editorx' ) . '</span> <span class="nav-title">%title</span>',
									)
								);


								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

							endwhile; // End of the loop.
						?>

					</main><!-- #main -->
				</div>

				<?php
					if( $editorx_single_layout == 'left' || $editorx_single_layout == 'right' ):
						get_sidebar();
					endif;
				?>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();
