<?php
/**
*
* Excerpt Length
* @since 1.0.0
*
*/
if ( ! function_exists( 'editorx_excerpt_length' ) ) :
	function editorx_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}
	    return 20;
	}
	add_filter( 'excerpt_length', 'editorx_excerpt_length', 100 );
endif;

if ( ! function_exists( 'editorx_excerpts_auto' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a option from customizer
	 *
	 * @return string option from customizer prepended with an ellipsis.
	 */
	function editorx_excerpts_auto( $link ) {
		if ( is_admin() ) {
			return $link;
		}
	    return sprintf( '<a class="read-more more-link" aria-label="%3$s" href="%1$s">%2$s<span class="screen-reader-text">%3$s</span></a>',
	        get_permalink( get_the_ID() ),
	        __( 'Read More', 'editorx' ),
			get_the_title()
	    );
	}
endif;
add_filter( 'excerpt_more', 'editorx_excerpts_auto' );

if ( ! function_exists( 'editorx_breadcrumb' ) ) :
    function editorx_breadcrumb() {
        $breadcrumb_args = array(
            'container'   => 'nav',
            'show_browse' => false,
        );
        editorx_breadcrumb_trail( $breadcrumb_args );
    }
endif;


if ( ! function_exists( 'editorx_excerpt_more' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a option from customizer
	 *
	 * @return string option from customizer prepended with an ellipsis.
	 */
	function editorx_excerpt_more( $excerpt ) {
		if ( has_excerpt() && ! is_attachment() ) {
		    $link = sprintf( '<a class="read-more more-link" aria-label="%3$s" href="%1$s">%2$s<span class="screen-reader-text">%3$s</span></a>',
		        get_permalink( get_the_ID() ),
		        __( 'Read More', 'editorx' ),
				get_the_title(),
		    );
			$excerpt .= $link;
		}
		return $excerpt;
	}
endif;
add_filter( 'get_the_excerpt', 'editorx_excerpt_more' );

/**
 * Google Fonts URL
 */
function editorx_google_fonts_url() {
	$fonts_url 	= '';
	$subsets 	= 'latin';

	$defaults = json_encode(
		array(
			'font' 			=> 'System default',
			'regularweight' => 'regular',
			'mediumweight' => '500',
			'boldweight' => '700',
			'category' 		=> 'sans-serif'
		)
	);

	//Get and decode options
	$body_font		= get_theme_mod( 'editorx_base_font', $defaults );
	$headings_font 	= get_theme_mod( 'editorx_heading_font', $defaults );

	$body_font 		= json_decode( $body_font, true );
	$headings_font 	= json_decode( $headings_font, true );

	if ( 'System default' === $body_font['font'] && 'System default' === $headings_font['font'] ) {
		return; //return early if defaults are active
	}

	$font_families = array();

	$font_families[] = $headings_font['font'] . ':' . $headings_font['regularweight'];
	$font_families[] = $body_font['font'] . ':' . $body_font['regularweight'];

	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( $subsets ),
		'display' => urlencode( 'swap' ),
	);

	$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );

	return esc_url_raw( $fonts_url );
}


/**
 * Google fonts preconnect
 */
function editorx_preconnect_google_fonts() {

	$defaults = json_encode(
		array(
			'font' 			=> 'System default',
			'regularweight' => 'regular',
			'category' 		=> 'sans-serif'
		)
	);

	$editorx_body_fonts		= get_theme_mod( 'editorx-base-website-font', $defaults );
	$editorx_heading_fonts 	= get_theme_mod( 'editorx-heading-website-font', $defaults );

	$editorx_body_fonts 		= json_decode( $editorx_body_fonts, true );
	$editorx_heading_fonts 	= json_decode( $editorx_heading_fonts, true );

	if ( 'System default' === $editorx_body_fonts['font'] && 'System default' === $editorx_heading_fonts['font'] ) {
		return;
	}

	echo '<link rel="preconnect" href="//fonts.googleapis.com">';
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}
add_action( 'wp_head', 'editorx_preconnect_google_fonts', 1);


function editorx_copyright_cb(){

	/* translators: %1$1s, %2$2s theme copyright tags*/
	$credits 	= get_theme_mod( 'editorx_footer_credits', sprintf( __( '%1$1s. <small class="credit">Proudly powered by %2$2s</small>', 'editorx' ), '{copyright} {year} {site_title}', '{theme_author}' ) );

	$tags 		= array( '{theme_author}', '{site_title}', '{copyright}', '{year}' );
	$replace 	= array( '<a rel="nofollow" target="_blank" href="https://codegearthemes.com/products/editorx/">' . esc_html__( 'Editorx', 'editorx' ) . '</a>', get_bloginfo( 'name' ), '&copy;', date('Y') );

	$credits 	= str_replace( $tags, $replace, $credits );

	echo wp_kses_post( $credits );
}
add_action( 'editorx_footer_copyright', 'editorx_copyright_cb' );

function editorx_has_social_links(){

	$editorx_facebook_link 		= get_theme_mod('editorx_facebook_url', '');
	$editorx_twitter_link 			= get_theme_mod('editorx_twitter_url', '');
	$editorx_linkedin_link 		= get_theme_mod('editorx_linkedin_url', '');
	$editorx_instagram_link 		= get_theme_mod('editorx_instagram_url', '');
	$editorx_pinterest_link 		= get_theme_mod('editorx_pinterest_url', '');
	$editorx_youtube_link 			= get_theme_mod('editorx_youtube_url', '');
	if(	empty($editorx_facebook_link) && empty($editorx_twitter_link) && empty($editorx_linkedin_link) && empty($editorx_instagram_link) && empty($editorx_pinterest_link) && empty($editorx_youtube_link) ){
		return false;
	}

	return true;
}

function editorx_post_navigation(){

	global $wp_query;

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
		return;
	}

	if ( ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) ) {
		// Support infinite scroll plugins.
		the_posts_navigation();
	} else {
		editorx_pagination();
	}

}


/*
 * Add numeric pagination to blog listing pages
 */
function editorx_pagination() {

	if( is_singular() )
		return;

	global $wp_query;

	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	if ( $paged >= 1 )
		$links[] = $paged;

	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	} ?>

	<nav class="grid navigation posts-navigation" role="navigation">
		<div class="pagination-inner grid__item one-whole">
			<ul class="block--pagination-nav">
				<?php
					if ( get_previous_posts_link() )
						printf( '<li class="prev-post-link">%s</li>', get_previous_posts_link() );

					if ( ! in_array( 1, $links ) ) {
						$class = 1 == $paged ? ' class="active"' : '';

						printf( '<li%s><a href="%s">%s</a></li>', $class, esc_url( get_pagenum_link( 1 ) ), '1' );

						if ( ! in_array( 2, $links ) )
							echo '<li>...</li>';
					}

					sort( $links );
					foreach ( (array) $links as $link ) {
						$class = $paged == $link ? ' class="active"' : '';
						printf( '<li%s><a href="%s">%s</a></li>', $class, esc_url( get_pagenum_link( $link ) ), $link );
					}

					if ( ! in_array( $max, $links ) ) {
						if ( ! in_array( $max - 1, $links ) )
							echo '<li>...</li>';

						$class = $paged == $max ? ' class="active"' : '';
						printf( '<li%s><a href="%s">%s</a></li>', $class, esc_url( get_pagenum_link( $max ) ), $max );
					}

					if ( get_next_posts_link() )
						printf( '<li class="next-post-link">%s</li>', get_next_posts_link() );
				?>
			</ul>
		</div>
	</nav>
<?php
}
