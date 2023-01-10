<?php
/**
 * Template for displaying search forms in Theme
 *
 * @author      CodeGearThemes
 * @category    WordPress
 * @package     Editorx
 * @version     1.0.0
 *
 */
?>
<div class="search-form-wrapper" data-search-form>
    <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'editorx' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
        <button type="submit" class="search-submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-search">
                <circle cx="10" cy="10" r="7.5"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <span class="screen-reader-text"><?php echo esc_html_x( 'Search', 'submit button', 'editorx' ); ?></span>
        </button>
    </form>
</div>
