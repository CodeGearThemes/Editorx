<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Editorx
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function editorx_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 320,
			'single_image_width'    => 768,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'editorx_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function editorx_woocommerce_scripts() {
	wp_enqueue_style( 'editorx-woocommerce-style', get_template_directory_uri() . '/assets/public/css/woocommerce.css', array(), EDITORX_THEME_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'editorx-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'editorx_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function editorx_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'editorx_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function editorx_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 4,
		'columns'        => 4,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'editorx_woocommerce_related_products_args' );

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_after_shop_loop' , 'woocommerce_result_count', 20 );

function editorx_change_sale_content($content, $post, $product) {
	$content = '<span class="onsale">'.__( 'Sale', 'editorx' ).'</span>';
   return $content;
}
add_filter('woocommerce_sale_flash', 'editorx_change_sale_content', 10, 3);

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'editorx_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function editorx_woocommerce_wrapper_before() {
		?>
		<div class="section-woocommerce section--woocommerce-template">
			<div class="main-content main-container">
				<div class="container">
					<div class="grid">
						<div id="primary" class="grid__item one-whole content-area">
							<main id="main" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'editorx_woocommerce_wrapper_before' );

if ( ! function_exists( 'editorx_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function editorx_woocommerce_wrapper_after() {
		?>
							</main><!-- #main -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'editorx_woocommerce_wrapper_after' );

add_action( 'woocommerce_before_single_product_summary', 'editorx_single_product_wrapper_start', 0);
function editorx_single_product_wrapper_start(){ ?>
	<div class="single-product__gallery single-product__content">
		<div class="single-product__main">
<?php
}

add_action( 'woocommerce_before_single_product_summary', 'editorx_single_product_wrapper_end', 100);
function editorx_single_product_wrapper_end(){ ?>
	</div>
<?php
}


add_action( 'woocommerce_after_single_product_summary', 'editorx_single_product_wrapper_end', 0);
function editorx_single_product_after_summery(){ ?>
	</div>
<?php
}


add_action( 'woocommerce_checkout_before_order_review_heading', 'editorx_woocommerce_before_order_review', 5);
function editorx_woocommerce_before_order_review(){ ?>
	<div class="block-order__review">
	<?php
}

add_action( 'woocommerce_checkout_after_order_review', 'editorx_woocommerce_after_order_review', 100);
function editorx_woocommerce_after_order_review(){ ?>
	</div>
<?php
}

add_action( 'woocommerce_after_quantity_input_field', 'editorx_product_quantity_start', 10);
function editorx_product_quantity_start(){ ?>
	<button type="button" class="plus" >
		<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-plus">
			<line x1="12" y1="5" x2="12" y2="19"/>
			<line x1="5" y1="12" x2="19" y2="12"/>
		</svg>
	</button>
<?php
}

add_action( 'woocommerce_before_quantity_input_field', 'editorx_product_quantity_end', 10);
function editorx_product_quantity_end(){ ?>
	<button type="button" class="minus" >
		<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-minus">
			<line x1="5" y1="12" x2="19" y2="12"/>
		</svg>
	</button>
<?php
}

if ( ! function_exists( 'editorx_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function editorx_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		editorx_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'editorx_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'editorx_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function editorx_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'editorx' ); ?>">
			<?php
				$item_count_text = sprintf(
					/* translators: number of items in the mini cart. */
					_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'editorx' ),
					WC()->cart->get_cart_contents_count()
				);
			?>
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-shopping-bag">
				<path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
				<line x1="3" y1="6" x2="21" y2="6"/>
				<path d="M16 10a4 4 0 0 1-8 0"/>
			</svg>
			<span class="count"><?php echo absint ( WC()->cart->get_cart_contents_count() ); ?></span>
		</a>
		<?php
	}
}

if( ! function_exists('editorx_woocommerce_header_account') ){
	/**
	 * Display Header Account.
	 *
	 * @return void
	 */
	function editorx_woocommerce_header_account(){ ?>
		<div class="block-account">
			<a class="header--account-item wc-account-link" href=" <?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ) ?> " title=" <?php echo esc_html__( 'Account', 'editorx' ) ?> ">
				<svg width="21" height="21" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M8.29686 33.1524C11.0027 30.4302 14.1724 28.4421 17.8061 27.1881C15.912 25.8834 14.4023 24.1638 13.2767 22.029C12.1512 19.8943 11.5923 17.5948 11.6 15.1306C11.6079 12.5999 12.2646 10.2459 13.5702 8.06884C14.8757 5.89176 16.6294 4.15731 18.8312 2.86549C21.0997 1.57388 23.5243 0.932114 26.105 0.940188C28.6858 0.948262 31.0647 1.60506 33.2417 2.91058C35.4188 4.2161 37.1366 5.96973 38.3951 8.17148C39.72 10.44 40.3784 12.873 40.3703 15.4704C40.3627 17.9013 39.7728 20.1805 38.6007 22.3081C37.5287 24.336 36.0248 26.0629 34.0889 27.4888C37.5823 28.4987 40.7398 30.4233 43.5614 33.2627C45.9515 35.6678 47.7911 38.3958 49.0803 41.4468C50.3695 44.4978 51.0088 47.6883 50.9984 51.0183L47.0024 51.0058C47.0144 47.1763 46.0599 43.6102 44.1388 40.3075C42.2838 37.1715 39.7775 34.6661 36.6198 32.7914C33.3622 30.9164 29.8271 29.973 26.0142 29.961C22.2014 29.9491 18.6603 30.8871 15.391 32.775C12.2217 34.6299 9.71625 37.1528 7.87475 40.3439C5.96656 43.568 5.00652 47.0782 4.99464 50.8744L0.998659 50.8619C1.00929 47.4653 1.63539 44.2538 2.87696 41.2274C4.11854 38.2009 5.92517 35.5093 8.29686 33.1524ZM36.6241 15.4587C36.6299 13.5939 36.1608 11.8525 35.2168 10.2345C34.2728 8.61646 32.9948 7.33041 31.3827 6.37631C29.7707 5.42221 28.0239 4.94221 26.1425 4.93633C24.261 4.93044 22.5113 5.3995 20.8933 6.34349C19.2753 7.28748 17.9892 8.56552 17.0351 10.1776C16.081 11.7897 15.601 13.5364 15.5951 15.4179C15.5892 17.2993 16.0583 19.049 17.0023 20.6671C17.9463 22.2851 19.2243 23.5711 20.8364 24.5252C22.4485 25.4793 24.1953 25.951 26.0767 25.9402C27.9582 25.9295 29.708 25.4604 31.3259 24.5331C32.9439 23.6057 34.2299 22.336 35.184 20.7239C36.1381 19.1119 36.6181 17.3568 36.6241 15.4587Z" fill="black"/>
				</svg>
			</a>
		</div>
	<?php
	}
}

if ( ! function_exists( 'editorx_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function editorx_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item nav--cart-item';
		} else {
			$class = 'nav--cart-item';
		}
		?>
		<div class="block-minicart">
			<ul id="site-header-cart" class="site-header-cart">
				<li class="<?php echo esc_attr( $class ); ?>">
					<?php editorx_woocommerce_cart_link(); ?>
				</li>
				<li class="minicart__item hide">
					<?php $instance = array( 'title' => '');
					the_widget( 'WC_Widget_Cart', $instance );
					?>
				</li>
			</ul>
		</div>
		<?php
	}
}

function editorx_woocommerce_page_header() {

	if ( !is_shop() && !is_product_category() && !is_product_tag() ) {
		return;
	}

	//Remove elements
	add_filter( 'woocommerce_show_page_title', '__return_false' );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description' );
	remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description' );


	$editorx_shop_page = get_option( 'woocommerce_shop_page_id' ); ?>
	<div class="woocommerce-page-header page-header entry-header <?php if( has_post_thumbnail( $editorx_shop_page ) ): ?> has-thumbnail <?php endif; ?>">
		<div class="block--header-main">
			<?php if( has_post_thumbnail( $editorx_shop_page ) ): ?>
				<?php echo get_the_post_thumbnail( $editorx_shop_page, array( 1920, 300) ); ?>
			<?php endif; ?>

			<div class="block--header-inner">
				<div class="container">
					<?php
						if ( is_shop() || is_product_category() || is_product_tag() ) : ?>
							<h1 class="woocommerce-products-header__title page-title entry-title"><?php woocommerce_page_title(); ?></h1>
						<?php endif; ?>
						<?php
						if( is_shop() || is_product_category() || is_product_tag() ) {
							woocommerce_taxonomy_archive_description();
							woocommerce_product_archive_description();
						}
					?>
				</div>
			</div>

		</div>
	</div>
	<?php
}
add_action( 'editorx_header_after', 'editorx_woocommerce_page_header' );

