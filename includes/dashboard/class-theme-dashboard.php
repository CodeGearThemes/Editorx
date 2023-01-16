<?php
/**
 * Theme Dashboard
 *
 * @package Theme Dashboard
 */

/**
 * Theme Dashboard class.
 */
class Editorx {

	/**
	 * Theme type
	 *
	 * @var boolean $pro_status.
	 */
	public $pro_status = false;

	/**
	 * The slug name to refer to this menu by.
	 *
	 * @var string $menu_slug The menu slug.
	 */
	public $menu_slug = 'editorx';

	/**
	 * The starter menu slug.
	 *
	 * @var string $starter_menu_slug The starter menu slug.
	 */
	public $starter_menu_slug = 'starter';

	/**
	 * The plugin slug.
	 *
	 * @var string $starter_plugin_slug The plugin slug.
	 */
	public $starter_plugin_slug = 'codegear-starter';

	/**
	 * The plugin path.
	 *
	 * @var string $starter_plugin_path The plugin path.
	 */
	public $starter_plugin_path = 'codegear-starter/codegear-starter.php';

	/**
	 * The settings of page.
	 *
	 * @var array $settings The settings.
	 */
	public $settings = array(
		'promo_link'          => 'https://www.codegearthemes.com/products/editorx-pro',
		'review_link'         => 'https://wordpress.org/support/theme/editorx/reviews',
		'changelog_link'      => 'https://www.codegearthemes.com/products/editorx',
		'suggest_idea_link'   => '#',
		'support_link'        => 'https://wordpress.org/support/theme/editorx',
		'support_pro_link'    => '#',
		'community_link'      => '#',
		'documentation_link'  => 'https://www.codegearthemes.com/products/editorx',
	);


	/**
	 * Constructor.
	 */
	public function __construct() {
		$self = $this;

		add_action( 'init', function () use ( $self ) {
			add_action( 'admin_menu', array( $self, 'add_menu_page' ) );
		} );

		add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );

		add_action( 'init', array( $this, 'set_settings' ) );

		add_action( 'admin_notices', array( $self , 'notice' ) );
		add_action( 'wp_ajax_editorx_install_starter_plugin', array( $this, 'install_starter_plugin' ) );
		add_action( 'wp_ajax_nopriv_editorx_install_starter_plugin', array( $this, 'install_starter_plugin' ) );

        add_action( 'admin_enqueue_scripts', array( $self , 'admin_scripts' ), 100 );
		add_action( 'admin_enqueue_scripts', array( $this, 'notice_enqueue_scripts' ), 100 );

		add_action( 'wp_ajax_codegear_dismissed_handler', array( $this, 'dismissed_handler' ) );

		add_action( 'switch_theme', array( $this, 'reset_notices' ) );
		add_action( 'after_switch_theme', array( $this, 'reset_notices' ) );

	}

	/**
	 * Add menu page
	 */
	public function add_menu_page() {
		add_submenu_page( 'themes.php', esc_html__( 'Editorx', 'editorx' ), esc_html__( 'Editorx', 'editorx' ), 'manage_options', $this->menu_slug, array( $this, 'welcome' ), 1 ); // phpcs:ignore WPThemeReview.PluginTerritory.NoAddAdminPages.add_menu_pages_add_submenu_page
	}

    public function admin_scripts() {

        wp_register_style( 'editorx-admin-style', get_template_directory_uri() . '/assets/admin/css/admin-style.css', false, EDITORX_THEME_VERSION );
        wp_enqueue_style( 'editorx-admin-style' );

		wp_enqueue_script( 'editorx-admin-script', get_template_directory_uri() . '/assets/admin/js/admin-script.js', array(), EDITORX_THEME_VERSION, true );

		wp_localize_script( 'editorx-admin-script', 'editorx_localize', array(
			'ajax_url'       => admin_url( 'admin-ajax.php' ),
			'nonce'          => wp_create_nonce( 'nonce' ),
			'failed_message' => esc_html__( 'Something went wrong, contact support.', 'editorx' ),
		) );



    }

	/**
	 * Settings
	 *
	 * @param array $settings The settings.
	 */
	public function set_settings( $settings ) {
		$this->settings = apply_filters( 'codegear_register_settings', $this->settings ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound

		if ( isset( $this->settings['pro_status'] ) ) {
			$this->pro_status = $this->settings['pro_status'];
		}

		if ( isset( $this->settings['starter_plugin_slug'] ) ) {
			$this->starter_plugin_slug = $this->settings['starter_plugin_slug'];
		}

		if ( isset( $this->settings['starter_plugin_path'] ) ) {
			$this->starter_plugin_path = $this->settings['starter_plugin_path'];
		}

		if ( isset( $this->settings['starter_menu_slug'] ) ) {
			$this->starter_menu_slug = $this->settings['starter_menu_slug'];
		}
	}

	/**
	 * Get plugin status.
	 *
	 * @param string $plugin_path Plugin path.
	 */
	public function get_plugin_status( $plugin_path ) {
		if ( ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		if ( ! file_exists( WP_PLUGIN_DIR . '/' . $plugin_path ) ) {
			return 'not_installed';
		} elseif ( in_array( $plugin_path, (array) get_option( 'active_plugins', array() ), true ) || is_plugin_active_for_network( $plugin_path ) ) {
			return 'active';
		} else {
			return 'inactive';
		}
	}


	/**
	 * Install a plugin.
	 *
	 * @param string $plugin_slug Plugin slug.
	 */
	public function install_plugin( $plugin_slug ) {
		if ( ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		if ( ! function_exists( 'plugins_api' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin-install.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		}
		if ( ! class_exists( 'WP_Upgrader' ) ) {
			require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		}

		if ( false === filter_var( $plugin_slug, FILTER_VALIDATE_URL ) ) {
			$api = plugins_api(
				'plugin_information',
				array(
					'slug'   => $plugin_slug,
					'fields' => array(
						'short_description' => false,
						'sections'          => false,
						'requires'          => false,
						'rating'            => false,
						'ratings'           => false,
						'downloaded'        => false,
						'last_updated'      => false,
						'added'             => false,
						'tags'              => false,
						'compatibility'     => false,
						'homepage'          => false,
						'donate_link'       => false,
					),
				)
			);

			$download_link = $api->download_link;
		} else {
			$download_link = $plugin_slug;
		}

		// Use AJAX upgrader skin instead of plugin installer skin.
		// ref: function wp_ajax_install_plugin().
		$upgrader = new Plugin_Upgrader( new WP_Ajax_Upgrader_Skin() );

		$install = $upgrader->install( $download_link );

		if ( false === $install ) {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * Activate a plugin.
	 *
	 * @param string $plugin_path Plugin path.
	 */
	public function activate_plugin( $plugin_path ) {

		if ( ! current_user_can( 'install_plugins' ) ) {
			return false;
		}

		$activate = activate_plugin( $plugin_path, '', false, true );

		if ( is_wp_error( $activate ) ) {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * Install starter plugin.
	 */
	public function install_starter_plugin() {
		check_ajax_referer( 'nonce', 'nonce' );

		if ( ! current_user_can( 'install_plugins' ) ) {
			wp_send_json_error( esc_html__( 'Insufficient permissions to install the plugin.', 'editorx' ) );
			wp_die();
		}

		if ( 'not_installed' === $this->get_plugin_status( $this->starter_plugin_path ) ) {

			$this->install_plugin( $this->starter_plugin_slug );

			$this->activate_plugin( $this->starter_plugin_path );

		} elseif ( 'inactive' === $this->get_plugin_status( $this->starter_plugin_path ) ) {

			$this->activate_plugin( $this->starter_plugin_path );
		}

		if ( 'active' === $this->get_plugin_status( $this->starter_plugin_path ) ) {
			wp_send_json_success();
		}

		wp_send_json_error( esc_html__( 'Failed to initialize or activate importer plugin.', 'editorx' ) );

		wp_die();
	}



	/**
	 * Html Hero
	 *
	 * @param string $location The location.
	 */
	public function html_hero( $location = null ) {
		global $pagenow;

		$screen = get_current_screen();

		$file_path = 'designer/designer.php';
		$installed_plugins = get_plugins();
		?>
		<div class="wrapper codegear--theme-dashboard">
			<div class="wrap">
				<div class="main-hero">
					<div class="content">
						<div class="section--hero-image">
							<div class="hero-content">
								<div class="hero--user-welcome">
									<?php esc_html_e( 'Hello, ', 'editorx' ); ?>
									<?php
										$current_user = wp_get_current_user();
										echo esc_html( $current_user->display_name );
									?>
									<?php esc_html_e( '👋', 'editorx' ); ?>
								</div>

								<div class="hero-title">
									<?php esc_html_e( 'Welcome to Editorx', 'editorx' ); ?>
									<?php if ( !$this->pro_status ) { ?>
										<span class="badge badge-success"><?php esc_html_e( 'free', 'editorx' ); ?></span>
									<?php } else { ?>
										<span class="badge badge-success"><?php esc_html_e( 'pro', 'editorx' ); ?></span>
									<?php } ?>
								</div>
								<div class="hero-description">
									<?php esc_html_e('Editorx is now installed and ready to go. To help you with the next step, we have gathered together on this page all the resources you might need. We hope you enjoy using Editorx.', 'editorx'); ?>
								</div>

								<div class="hero-actions">
									<?php
										$status = 'inactive';
										if ( 'active' === $this->get_plugin_status( $this->starter_plugin_path ) ) {
											$status = 'active';
										}
									?>
									<a id="starter-install" href="<?php echo esc_url( add_query_arg( 'page', $this->starter_menu_slug, admin_url( 'themes.php' ) ) ); ?>" data-status="<?php echo esc_attr( $status ); ?>" class="button button-primary">
										<?php esc_html_e( 'Starter Sites', 'editorx' ); ?>
									</a>

									<?php if( !isset( $installed_plugins[ $file_path ] )): ?>
										<a id="required-plugins-install" href="<?php echo esc_url( add_query_arg( 'page', 'install-plugins', admin_url( 'themes.php' ) ) ); ?>" data-status="<?php echo esc_attr( $status ); ?>" class="button button-secondary">
											<?php esc_html_e( 'Install Recommended Plugins', 'editorx' ); ?>
										</a>
									<?php endif; ?>

									<?php if ( 'themes.php' === $pagenow && 'themes' === $screen->base ) { ?>
										<a href="<?php echo esc_url( add_query_arg( 'page', $this->menu_slug, admin_url( 'themes.php' ) ) ); ?>" class="button">
											<?php esc_html_e( 'Theme Dashboard', 'editorx' ); ?>
										</a>
									<?php } ?>
									<?php if ( 'active' !== $this->get_plugin_status( $this->starter_plugin_path ) ) { ?>
										<p class="hero-info">
											<?php esc_html_e( 'Clicking “Starter Sites” button will install and activate the  codegear starter plugin.', 'editorx' ); ?>
										</p>
									<?php } ?>
								</div>
							</div>
							<div class="hero-image">

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	public function notice(){
		global $pagenow;

		$screen = get_current_screen();

		if ( 'themes.php' === $pagenow && 'themes' === $screen->base ) {
			$transient_name = sprintf( '%s_hero_notice', get_template() );

			if ( ! get_transient( $transient_name ) ) {
				?>
				<div class="codegear-notice notice notice-success codegear-theme-dashboard codegear-theme-dashboard-notice is-dismissible" data-notice="<?php echo esc_attr( $transient_name ); ?>">
					<button type="button" class="notice-dismiss"></button>
					<?php $this->html_hero( 'themes' ); ?>
				</div>
				<?php
			}
		}
	}

	/**
     * Add welcome page
     */
    public function welcome(){ ?>

		<div class="wrapper codegear--theme-dashboard">
			<div class="codegear-header">
				<div class="codegear--header-left">
					<div class="codegear--header-column codegear--header-logo">
						<div class="codegear-branding">
							<a href="<?php echo esc_url( 'https://codegearthemes.com/' ); ?>" target="_blank">
								<img width="220px" src="<?php echo esc_url( get_template_directory_uri() . '/assets/admin/src/logo.png' ); ?>" alt="<?php esc_attr_e( 'CodeGearThemes', 'editorx' ); ?>">
							</a>
						</div>
					</div>
				</div>

				<div class="codegear--header-right">
					<div class="upsell-promotion__links">
						<a href="<?php echo esc_url( $this->settings['documentation_link'] ); ?>" class="codegear--documentation-link button button-secondary" target="_blank">
							<span><?php esc_html_e( 'Documentation', 'editorx' ); ?></span>
							<i class="dashicons dashicons-external"></i>
						</a>
						<a href="<?php echo esc_url( $this->settings['promo_link'] ); ?>" class="codegear--upgrade-link button button-primary" target="_blank">
							<span><?php esc_html_e( 'Upgrade Now', 'editorx' ); ?></span>
							<i class="dashicons dashicons-external"></i>
						</a>
					</div>
				</div>
			</div>
			<?php $this->html_hero(); ?>
			<div class="wrap">

				<div class="main-content">
					<div class="panel primary">
						<div class="content-inner">
							<div class="block-features">
								<div class="feature-tab">
									<h3 class= "feature-tab-title"><?php echo esc_html_e( 'Theme Features', 'editorx' ); ?></h3>
								</div>
								<div class="feature-content">
									<div class="feature-content-list">
										<div class="list-row">
											<div class="feature-name">
												<div class="main-feature"><?php  echo esc_html_e( 'Typography', 'editorx' ); ?></div>
												<div class = "sub-feature">
													<?php echo esc_html_e( 'Unlimited Google Fonts', 'editorx' ); ?>
												</div>
											</div>
											<span class="badge badge-success"><?php echo esc_html_e( 'free', 'editorx'); ?></span>
										</div>
										<div class="list-row">
											<div class="feature-name">
												<div class="main-feature"><?php  echo esc_html_e( 'Two Selective Container', 'editorx' ); ?></div>
												<div class = "sub-feature"> <?php  echo esc_html_e( 'Fixed & Full Width', 'editorx' ); ?></div>
											</div>
											<span class="badge badge-success"><?php echo esc_html_e( 'free', 'editorx'); ?></span>
										</div>
										<div class="list-row">
											<div class="feature-name">
												<div class="main-feature"><?php  echo esc_html_e( 'Colors', 'editorx' ); ?></div>
												<div class = "sub-feature">
													<?php  echo esc_html_e( 'Primary & Secondary', 'editorx' ); ?>
												</div>
											</div>
											<span class="badge badge-success"><?php echo esc_html_e( 'free', 'editorx'); ?></span>
										</div>
										<div class="list-row">
											<div class="feature-name">
												<div class="main-feature"><?php  echo esc_html_e( '5 Social Profiles', 'editorx' ); ?></div>
												<div class = "sub-feature">
													<?php  echo esc_html_e( 'Facebook, Twitter, Linkedin, Instagram & Youtube', 'editorx' ); ?>
												</div>
											</div>
											<span class="badge badge-success"><?php echo esc_html_e( 'free', 'editorx'); ?></span>
										</div>
										<div class="list-row">
											<div class="feature-name">
												<div class="main-feature"><?php  echo esc_html_e( 'Archive Layout Options', 'editorx' ); ?></div>
												<div class = "sub-feature">
													<?php  echo esc_html_e( 'Simple & Grid ', 'editorx' ); ?>
												</div>
											</div>
											<span class="badge badge-success"><?php echo esc_html_e( 'free', 'editorx'); ?></span>
										</div>
										<div class="list-row">
											<div class="feature-name">
												<div class="main-feature"><?php  echo esc_html_e( 'Post , Page , Single Layout', 'editorx' ); ?></div>
												<div class = "sub-feature">
													<?php  echo esc_html_e( 'Left Sidebar, Right Sidebar and No Sidebar', 'editorx' ); ?>
												</div>
											</div>
											<span class="badge badge-success"><?php echo esc_html_e( 'free', 'editorx'); ?></span>
										</div>
										<div class="list-row">
											<div class="feature-name">
												<div class="main-feature"><?php  echo esc_html_e( 'Footer Options', 'editorx' ); ?></div>
												<div class = "sub-feature">
													<?php echo esc_html_e( 'Footer Widgets Column Disabled and Enable', 'editorx' ); ?>
												</div>
											</div>
											<span class="badge badge-success"><?php echo esc_html_e( 'free', 'editorx'); ?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="aside">
						<div class="secondary">
							<div class="panel">
								<div class="panel-head">
									<h3 class="panel-title"><?php echo esc_html_e( 'Review', 'editorx'); ?></h3>
								</div>
								<div class="panel-content">
									<div class="stars">
										<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="24" height="24" x="0" y="0" viewBox="0 0 24 24" class="star"><g><path xmlns="http://www.w3.org/2000/svg" d="m23.363 8.584-7.378-1.127-3.307-7.044c-.247-.526-1.11-.526-1.357 0l-3.306 7.044-7.378 1.127c-.606.093-.848.83-.423 1.265l5.36 5.494-1.267 7.767c-.101.617.558 1.08 1.103.777l6.59-3.642 6.59 3.643c.54.3 1.205-.154 1.103-.777l-1.267-7.767 5.36-5.494c.425-.436.182-1.173-.423-1.266z" fill="#ffc107" data-original="#ffc107" class=""></path></g></svg>
										<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="24" height="24" x="0" y="0" viewBox="0 0 24 24" class="star"><g><path xmlns="http://www.w3.org/2000/svg" d="m23.363 8.584-7.378-1.127-3.307-7.044c-.247-.526-1.11-.526-1.357 0l-3.306 7.044-7.378 1.127c-.606.093-.848.83-.423 1.265l5.36 5.494-1.267 7.767c-.101.617.558 1.08 1.103.777l6.59-3.642 6.59 3.643c.54.3 1.205-.154 1.103-.777l-1.267-7.767 5.36-5.494c.425-.436.182-1.173-.423-1.266z" fill="#ffc107" data-original="#ffc107" class=""></path></g></svg>
										<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="24" height="24" x="0" y="0" viewBox="0 0 24 24" class="star"><g><path xmlns="http://www.w3.org/2000/svg" d="m23.363 8.584-7.378-1.127-3.307-7.044c-.247-.526-1.11-.526-1.357 0l-3.306 7.044-7.378 1.127c-.606.093-.848.83-.423 1.265l5.36 5.494-1.267 7.767c-.101.617.558 1.08 1.103.777l6.59-3.642 6.59 3.643c.54.3 1.205-.154 1.103-.777l-1.267-7.767 5.36-5.494c.425-.436.182-1.173-.423-1.266z" fill="#ffc107" data-original="#ffc107" class=""></path></g></svg>
										<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="24" height="24" x="0" y="0" viewBox="0 0 24 24" class="star"><g><path xmlns="http://www.w3.org/2000/svg" d="m23.363 8.584-7.378-1.127-3.307-7.044c-.247-.526-1.11-.526-1.357 0l-3.306 7.044-7.378 1.127c-.606.093-.848.83-.423 1.265l5.36 5.494-1.267 7.767c-.101.617.558 1.08 1.103.777l6.59-3.642 6.59 3.643c.54.3 1.205-.154 1.103-.777l-1.267-7.767 5.36-5.494c.425-.436.182-1.173-.423-1.266z" fill="#ffc107" data-original="#ffc107" class=""></path></g></svg>
										<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="24" height="24" x="0" y="0" viewBox="0 0 24 24" class="star"><g><path xmlns="http://www.w3.org/2000/svg" d="m23.363 8.584-7.378-1.127-3.307-7.044c-.247-.526-1.11-.526-1.357 0l-3.306 7.044-7.378 1.127c-.606.093-.848.83-.423 1.265l5.36 5.494-1.267 7.767c-.101.617.558 1.08 1.103.777l6.59-3.642 6.59 3.643c.54.3 1.205-.154 1.103-.777l-1.267-7.767 5.36-5.494c.425-.436.182-1.173-.423-1.266z" fill="#ffc107" data-original="#ffc107" class=""></path></g></svg>
									</div>
									<p class="description"><?php echo esc_html_e( 'It makes us happy to hear from our users. We would appreciate a review.', 'editorx'); ?></p>
									<div class="action-button">
										<a href="<?php echo esc_url( $this->settings['review_link'] ); ?>" class="button button-secondary" target="_blank"><?php echo esc_html_e( 'Submit a Review', 'editorx'); ?></a>
									</div>
									<div class="divider"></div>
								</div>
							</div>
							<div class="panel">
								<div class="panel-head">
									<h3 class="panel-title"><?php echo esc_html_e( 'Changelog', 'editorx'); ?> <?php echo esc_html( EDITORX_THEME_VERSION ); ?></h3>
								</div>
								<div class="panel-content">
									<p class="description"><?php echo esc_html_e( 'Keep informed with the latest changes about each theme.', 'editorx' ); ?></p>
									<div class="action-button">
										<a href="<?php echo esc_url( $this->settings['changelog_link'] ); ?>" target="_blank"><?php echo esc_html_e( 'See the Changelog', 'editorx'); ?></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	<?php
    }
	/**
	 * Purified from the database information about notification.
	 */
	public function reset_notices() {
		delete_transient( sprintf( '%s_hero_notice', get_template() ) );
	}

	/**
	 * Dismissed handler
	 */
	public function dismissed_handler() {
		wp_verify_nonce( null );

		if ( isset( $_POST['notice'] ) ) { // Input var ok; sanitization ok.

			set_transient( sanitize_text_field( wp_unslash( $_POST['notice'] ) ), true, 0 ); // Input var ok.

		}
	}

	/**
	 * Notice Enqunue Scripts
	 *
	 * @param string $page Current page.
	 */
	public function notice_enqueue_scripts( $page ) {

		wp_enqueue_script( 'jquery' );

		ob_start();
		?>
		<script>
			jQuery(function($) {
				$( document ).on( 'click', '.codegear-notice .notice-dismiss', function () {
					jQuery.post( 'ajax_url', {
						action: 'codegear_dismissed_handler',
						notice: $( this ).closest( '.codegear-notice' ).data( 'notice' ),
					});
					$( '.codegear-theme-dashboard-notice' ).hide();
				} );
			});
		</script>
		<?php
		$script = str_replace( 'ajax_url', admin_url( 'admin-ajax.php' ), ob_get_clean() );

		wp_add_inline_script( 'jquery', str_replace( array( '<script>', '</script>' ), '', $script ) );
	}




}

new Editorx();
