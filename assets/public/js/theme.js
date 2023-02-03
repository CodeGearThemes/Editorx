/**
 * Cosme Theme Scripts
 *
 * @author      CodeGearThemes
 * @category    WordPress
 * @package     Cosme
 * @version     1.0.0
 *
 */

 window.editorxtheme = window.editorxtheme || {};

(function( $ ){
	'use strict';

    editorxtheme.Header = ( function () {

		var Header = function(){

			this.init();
		}

		Header.prototype = Object.assign( {}, Header.prototype, {
			init: function(){
				this._initSearch();
			},

			_initSearch(){
				let searchToggle = document.querySelector('[data-search-toggle]');
				if( !searchToggle ) return;

				searchToggle.addEventListener( 'click', function(){
					document.querySelector('[data-search-form]').classList.toggle('active');
				});
			}

		});

		return new Header();

	})();

    /*============================================================================
    Things that require DOM to be ready
	==============================================================================*/
	function DOMready(callback) {
		if (document.readyState != 'loading') callback();
		else document.addEventListener('DOMContentLoaded', callback);
	}

	editorxtheme.init = function(){
		editorxtheme.Header;
	}

	DOMready(function(){

		editorxtheme.init();

    	document.dispatchEvent(new CustomEvent('page:loaded'));
	});

	$('form.cart').on( 'click', 'button.plus, button.minus', function() {

		var qty = $( this ).closest( 'form.cart' ).find( '.qty' );
		var val   = parseFloat(qty.val());
		var max = parseFloat(qty.attr( 'max' ));
		var min = parseFloat(qty.attr( 'min' ));
		var step = parseFloat(qty.attr( 'step' ));

		if ( $( this ).is( '.plus' ) ) {
		   if ( max && ( max <= val ) ) {
			  qty.val( max );
		   }
		else {
		   qty.val( val + step );
			 }
		}
		else {
		   if ( min && ( min >= val ) ) {
			  qty.val( min );
		   }
		   else if ( val > 1 ) {
			  qty.val( val - step );
		   }
		}

	});


})(jQuery);
