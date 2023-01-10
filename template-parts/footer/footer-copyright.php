<?php

/**
 *
 * Footer copyright
 *
 * @author      CodeGearThemes
 * @category    WordPress
 * @package     Editorx
 * @version     1.0.0
 *
 */
$editorx_has_social_links = editorx_has_social_links();

$editorx_classes = 'flex-center text-center';
if( $editorx_has_social_links ){
	$editorx_classes = 'flex-space';
}

?>
<div class="section-copyright <?php echo esc_attr( $editorx_classes ); ?> align--flex-center">

	<div class="site-info ">
		<p class="copyright no-margin">
			<?php do_action('editorx_footer_copyright'); ?>
		</p>
	</div>

	<?php do_action('editorx_social_profiles'); ?>
</div>
