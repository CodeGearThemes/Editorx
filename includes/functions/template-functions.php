<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Editorx
 */
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function editorx_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'editorx_content_width', 640 );
}
add_action( 'after_setup_theme', 'editorx_content_width', 0 );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function editorx_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'editorx_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function editorx_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'editorx_pingback_header' );

function editorx_archive_grid(){
	$editorx_archive_layout	= get_theme_mod( 'editorx_archive_layout', 'grid' );
	$editorx_archive_grid_columns = get_theme_mod( 'editorx_archives_grid_columns', '2' );
	if( $editorx_archive_layout == 'simple' ) {
		$editorx_content_class[] 		= 'one-whole';
	}else{
		switch( $editorx_archive_grid_columns ){
			case '2':
				$editorx_content_class[]   = 'large--one-half medium--one-half small--one-whole';
				break;
			case '3':
				$editorx_content_class[]   = 'large--one-third medium--one-third small--one-whole';
				break;
			case '4':
				$editorx_content_class[]   = 'large--one-quarter medium--one-quarter small--one-whole';
				break;
			default:
				$editorx_content_class[]   = 'large--one-half medium--one-half small--one-whole';
		}

	}
	return $editorx_content_class;
}

function editorx_social_profiles() {
	$editorx_facebook_link = get_theme_mod( 'editorx_facebook_url', '' );
	$editorx_twitter_link = get_theme_mod( 'editorx_twitter_url', '' );
	$editorx_linkedin_link = get_theme_mod( 'editorx_linkedin_url', '' );
	$editorx_instagram_link = get_theme_mod( 'editorx_instagram_url', '' );
	$editorx_pinterest_link = get_theme_mod( 'editorx_pinterest_url', '' );
	$editorx_youtube_link = get_theme_mod( 'editorx_youtube_url', '' );
	$classes = 'round-border-icon';
	?>
	<div class="block-social">
		<ul class="social-icons clearfix <?php echo esc_attr( $classes ); ?>">
			<?php
			if( ! empty( $editorx_facebook_link ) ): ?>
				<li class="text-center">
					<a href="<?php echo esc_url( $editorx_facebook_link ); ?>" title="<?php echo esc_attr( sprintf( __( '%1$s on %2$s', 'editorx' ), bloginfo( 'name' ), __( 'Facebook', 'editorx' )  )); ?>" target="_blank">
						<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-facebook">
							<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
						</svg>
					</a>
				</li>
				<?php
			endif;
			if( ! empty( $editorx_twitter_link ) ): ?>
				<li class="text-center">
					<a href="<?php echo esc_url( $editorx_twitter_link ); ?>" title="<?php echo esc_attr( sprintf( __( '%1$s on %2$s', 'editorx' ), bloginfo( 'name' ), __( 'Twitter', 'editorx' )  )); ?>" target="_blank">
						<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-twitter">
							<path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
						</svg>
					</a>
				</li>
				<?php
			endif;
			if( ! empty( $editorx_linkedin_link ) ): ?>
				<li class="text-center">
					<a href="<?php echo esc_url( $editorx_linkedin_link ); ?>" title="<?php echo esc_attr( sprintf( __( '%1$s on %2$s', 'editorx' ), bloginfo( 'name' ), __( 'LinkedIn', 'editorx' )  )); ?>" target="_blank">
						<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-linkedin">
							<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
							<rect x="2" y="9" width="4" height="12"></rect>
							<circle cx="4" cy="4" r="2"></circle>
						</svg>
					</a>
				</li>
				<?php
			endif;
			if( ! empty( $editorx_instagram_link ) ): ?>
				<li class="text-center">
					<a href="<?php echo esc_url( $editorx_instagram_link ); ?>" title="<?php echo esc_attr( sprintf( __( '%1$s on %2$s', 'editorx' ), bloginfo( 'name' ), __( 'Instagram', 'editorx' )  )); ?>" target="_blank">
						<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-instagram">
							<rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
							<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
							<line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
						</svg>
					</a>
				</li>
				<?php
			endif;
			if( ! empty( $editorx_youtube_link ) ): ?>
				<li class="text-center">
					<a href="<?php echo esc_url( $editorx_youtube_link ); ?>" title="<?php echo esc_attr( sprintf( __( '%1$s on %2$s', 'editorx' ), bloginfo( 'name' ), __( 'Youtube', 'editorx' )  )); ?>" target="_blank">
						<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-youtube">
							<path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
							<polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
						</svg>
					</a>
				</li>
				<?php
			endif;
			?>
		</ul>
	</div>
<?php
}
