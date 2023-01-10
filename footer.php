<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Editorx
 */
 $editorx_footer_layout		= get_theme_mod( 'footer_section_layout' , 'simple' );
 $editorx_website_layout 		= get_theme_mod( 'editorx_website_container', 'container' );

/*Main container class*/
$editorx_container_class = 'container';
if(  $editorx_website_layout === 'container-fluid' ){
	$editorx_container_class = 'container-fluid';
}

?>
	</div><!--wrapper-->
</div><!-- #page -->
<footer id="colophon" class="site-footer">
		<?php
			if( $editorx_footer_layout === 'simple' ){?>
			<div class="<?php echo esc_attr( $editorx_container_class ); ?>">
				<?php get_template_part( 'template-parts/footer/footer', 'column' ); ?>
			</div>
			<?php
			}
		?>
		<div class="footer-bottom">
			<div class="<?php echo esc_attr( $editorx_container_class ); ?>">
				<div class="wrapper">
					<?php
						get_template_part( 'template-parts/footer/footer', 'copyright' );
					?>
				</div>

			</div>
		</div>
	</div>
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
