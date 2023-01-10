<?php
/**
 * The template for displaying 404 page (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @author      CodeGearThemes
 * @category    WordPress
 * @package     Editorx
 * @version     1.0.0
 *
 */

get_header();
?>
<div class="section-error section--error-template">
	<div class="container">
		<div class="grid">
			<div id="primary" class="grid__item one-whole content-area">
				<main id="main" class="site-main">
					<section class="error-404 not-found">
						<header class="page-header">
							<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'editorx' ); ?></h1>
						</header><!-- .page-header -->

						<div class="page-content">
							<div class="page-large-text">
								<h2 class="page-heading-large"><?php esc_html_e( '404', 'editorx' ); ?></h2>
							</div>
							<div class="page-content">
								<p class="content"><?php esc_html_e( 'Sorry! Page not Found', 'editorx' ); ?></p>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary"><?php esc_html_e( 'Return to Home', 'editorx' ); ?></a>
							</div><!-- .page-content -->
						</div>
						<?php get_search_form(); ?>
					</section><!-- .error-404 -->
				</main><!-- #main -->
			</div>
		</div>
	</div>
</div>
<?php
get_footer();
