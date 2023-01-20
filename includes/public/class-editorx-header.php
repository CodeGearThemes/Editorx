<?php
/**
 * Class to handle the header elements
 *
 * @package Editorx
 */

if ( !class_exists( 'Editorx_Header' ) ) :

    /**
	 * Editorx_Header
	 */

    class Editorx_Header {

        /**
         * Instance
         */
        private static $instance;

        /**
         * Initiator
         */

        public static function get_instance(){
            if ( !isset( self::$instance ) ) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        /**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'editorx_header', array( $this, 'header_markup_branding' ), 10 );

			add_action( 'editorx_header', array( $this, 'header_navigation_open' ), 15 );
			add_action( 'editorx_header', array( $this, 'header_navigation' ), 20 );
			add_action( 'editorx_header', array( $this, 'header_search' ), 25 );
			add_action( 'editorx_header', array( $this, 'header_social' ), 30 );
			add_action( 'editorx_header', array( $this, 'header_navigation_close' ), 40 );
		}

         public function header_markup_branding() {

            //Main header layout
			$header_layout		= get_theme_mod( 'editorx_main_header_layout', 'default' ); ?>

			<div class="grid__item large--one-quarter medium--one-half small--one-half">
				<div class="site-branding">
					<?php the_custom_logo(); ?>
					<div class="site-title h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
					<?php
						$editorx_description = get_bloginfo( 'description', 'display' );
						if ( $editorx_description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $editorx_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->
			</div>

			<?php
        }

        /**
		 * Main navigation
		*/
        public function header_navigation(){ ?>

			<div class="navigation header--main-navigation align--flex-center">
				<div id="header-navigation" class="header--desktop-navigation header-navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-menu">
							<line x1="3" y1="12" x2="21" y2="12"/>
							<line x1="3" y1="6" x2="21" y2="6"/>
							<line x1="3" y1="18" x2="21" y2="18"/>
						</svg>
						<small class="screen-reader-text"><?php esc_html_e( 'Menu', 'editorx' ); ?></small>
					</button>
					<nav id="site-navigation" class="main-navigation">
						<button class="mobile-menu__toggle" aria-controls="primary-menu" aria-expanded="false">
							<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
								<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
							</svg>
							<small class="screen-reader-text"><?php esc_html_e( 'Close', 'editorx' ); ?></small>
						</button>
						<div class="navigation--desktop">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'main-menu',
									'menu_id'        => 'primary-menu',
								) );
							?>
						</div>
					</nav><!-- #site-navigation -->
				</div>
			</div>

        <?php
        }

        /**
		 * Header button
		 */
		public function header_social() {

			editorx_social_profiles();

		}

        /**
         * Header search
         */
        public function header_search() {

            $enable = get_theme_mod( 'editorx_enable_header_search', 1 );
            if ( !$enable ) { return; } ?>
			<button class="search-toggle large--hide small-show" aria-label="<?php esc_attr__( 'View Search', 'editorx' ); ?>" data-search-toggle>
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-search">
					<circle cx="10" cy="10" r="7.5"/>
					<line x1="21" y1="21" x2="16.65" y2="16.65"/>
				</svg>
				<span class="fallback-text"><?php esc_html_e( 'Search', 'editorx' ); ?></span>
			</button>
            <?php
				get_search_form();
        }

		public function header_navigation_open(){ ?>
			<div class="grid__item large--three-quarters medium--one-half small--one-half d-flex align--flex-center flex-end">
				<div class="header--navigation-inner">
			<?php
		}

		public function header_navigation_close(){ ?>
				</div>
			</div>
			<?php
		}

    }


    /**
	 * Initialize class
	 */
	Editorx_Header::get_instance();

endif;


