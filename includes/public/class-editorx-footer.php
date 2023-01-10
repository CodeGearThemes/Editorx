<?php
/**
 * Class to handle the footer elements
 *
 * @package Editorx
 */

if ( !class_exists( 'Editorx_Footer' ) ) :

    /**
	 * Editorx_Footer
	 */

    class Editorx_Footer {

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
            add_action('editorx_footer_columns', [ $this, 'footer_markup' ] );
        }

        public function footer_markup(){
            if( is_active_sidebar('footer-column-1') || is_active_sidebar('footer-column-2') || is_active_sidebar('footer-column-3') || is_active_sidebar('footer-column-4') ): ?>
                <div class="section-footer section--footer-widget">
                    <div class="grid">
                        <div class="one-whole footer-block ">
                            <?php dynamic_sidebar('footer-column'); ?>
                        </div>
                        <div class="grid__item large--two-fifths medium--two-quarters small--one-whole footer-block-one ">
                            <?php dynamic_sidebar('footer-column-1'); ?>
                        </div>
                        <div class="grid__item large--one-fifth medium--two-quarters small--one-whole footer-block-two ">
                            <?php dynamic_sidebar('footer-column-2'); ?>
                        </div>
                        <div class="grid__item large--one-fifth medium--two-quarters small--one-whole footer-block-three ">
                            <?php dynamic_sidebar('footer-column-3'); ?>
                        </div>
                        <div class="grid__item large--one-fifth medium--two-quarters small--one-whole footer-block-four ">
                            <?php
                                dynamic_sidebar('footer-column-4');
                            ?>
                        </div>
                    </div>
                </div>
            <?php endif;
        }


    }

     /**
	 * Initialize class
	 */
	Editorx_Footer::get_instance();

endif;
