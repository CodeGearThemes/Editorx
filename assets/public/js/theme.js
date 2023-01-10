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

(function(){
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


})();
