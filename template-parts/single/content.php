<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Editorx
 */
$editorx_alignment_class = "text-left";
$editorx_single_post_thumb = 'no-thumbnails';
$editorx_single_title_align	= get_theme_mod( 'editorx_single_heading_alignment', 'left');

if( $editorx_single_title_align == 'left' ) {
	$editorx_alignment_class = "text-left";
}

if ( has_post_thumbnail() ) {
	$editorx_single_post_thumb = 'has-thumbnails';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('article-content'); ?>>
	<?php editorx_post_thumbnail(); ?>
	<header class="entry-header <?php echo esc_attr( $editorx_single_post_thumb ); ?>">
		<?php
			if ( 'post' === get_post_type() ) :
				editorx_single_postmeta();
			endif;

			if ( is_singular() ) :
				the_title( '<h1 class="entry-title '.esc_attr( $editorx_alignment_class ).'">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title '.esc_attr( $editorx_alignment_class ).'"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
		?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'editorx' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'editorx' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php editorx_entry_footer(); ?>
	</footer><!-- .entry-footer -->

	<?php
		get_template_part( 'template-parts/snippets/content', 'author' );
		get_template_part( 'template-parts/snippets/content', 'related' );

	?>

</article><!-- #post-<?php the_ID(); ?> -->
