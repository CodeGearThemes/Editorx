<?php
/**
 * Template Name: Builder
 *
 * @author      CodeGearThemes
 * @category    WordPress
 * @package     Editorx
 * @version     1.0.0
 *
 * This is the template that displays full width.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 */
get_header();
?>

<div class="section--builder-template">
	<main id="main" class="site-main">
		<?php
			while ( have_posts() ) :
				the_post();
				the_content();
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
		?>
	</main><!-- #main -->

</div>

<?php
get_footer();
