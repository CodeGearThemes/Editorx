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

add_action( 'woocommerce_after_quantity_input_field', 'editorx_product_quantity_start', 10);
function editorx_product_quantity_start(){ ?>
	<button type="button" class="plus" >
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-plus">
			<line x1="12" y1="5" x2="12" y2="19"/>
			<line x1="5" y1="12" x2="19" y2="12"/>
		</svg>
	</button>
<?php
}

add_action( 'woocommerce_before_quantity_input_field', 'editorx_product_quantity_end', 10);
function editorx_product_quantity_end(){ ?>
	<button type="button" class="minus" >
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-minus">
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
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
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
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php editorx_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
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

