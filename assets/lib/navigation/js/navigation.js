/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
 (function () {
	var container, button, menu, links, i, len, buttonClose;

	container = document.getElementById('header-navigation');
	if (!container) {
		return;
	}

	button = container.getElementsByTagName('button')[0];
	buttonClose = container.querySelector('.mobile-menu__toggle');
	if ('undefined' === typeof button) {
		return;
	}

	menu = container.getElementsByTagName('ul')[0];

	// Hide menu toggle button if menu is empty and return early.
	if ('undefined' === typeof menu) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute('aria-expanded', 'false');
	if (-1 === menu.className.indexOf('nav-menu')) {
		menu.className += ' nav-menu';
	}

	button.onclick = function () {
		if (-1 !== container.className.indexOf('toggled')) {
			container.className = container.className.replace(' toggled', '');
			button.setAttribute('aria-expanded', 'false');
			buttonClose.setAttribute('aria-expanded', 'false');
			menu.setAttribute('aria-expanded', 'false');
		}

		else {
			container.className += ' toggled';
			button.setAttribute('aria-expanded', 'true');
			buttonClose.setAttribute('aria-expanded', 'true');
			menu.setAttribute('aria-expanded', 'true');
		}
	};

	buttonClose.onclick = function(){
		if (-1 !== container.className.indexOf('toggled')) {
			container.className = container.className.replace(' toggled', '');
			button.setAttribute('aria-expanded', 'false');
			buttonClose.setAttribute('aria-expanded', 'false');
		}else {
			container.className += ' toggled';
			button.setAttribute('aria-expanded', 'true');
			buttonClose.setAttribute('aria-expanded', 'true');
		}
	}

	//Get all the link elements within the menu.
	links = menu.getElementsByTagName('a');

	// Each time a menu link is focused or blurred, toggle focus.
	for (i = 0, len = links.length; i < len; i++) {
		links[i].addEventListener('focus', toggleFocus, true);
		links[i].addEventListener('blur', toggleFocus, true);
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while (-1 === self.className.indexOf('nav-menu')) {

			// On li elements toggle the class .focus.
			if ('li' === self.tagName.toLowerCase()) {
				if (-1 !== self.className.indexOf('focus')) {
					self.className = self.className.replace(' focus', '');
				}

				else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}
	
	const  focusableElements =
	'button, [href], [tabindex]:not([tabindex="-1"])';
	const mobileMenu = document.getElementById('site-navigation'); 

	const firstFocusableElement = mobileMenu.querySelectorAll(focusableElements)[0]; 
	const focusableContent = mobileMenu.querySelectorAll(focusableElements);
	const lastFocusableElement = focusableContent[focusableContent.length - 1];

	if( window.innerWidth < 993 ){
		document.addEventListener('keydown', function(e) {
			let isTabPressed = e.key === 'Tab' || e.keyCode === 9;

			if (!isTabPressed) {
				return;
			}

			if (e.shiftKey) { 
				if (document.activeElement === firstFocusableElement) {
					lastFocusableElement.focus(); 
					e.preventDefault();
				}
			} else { // if tab key is pressed
				if (document.activeElement === lastFocusableElement) {
					firstFocusableElement.focus();
					e.preventDefault();
				}
			}
		});

		firstFocusableElement.focus();
	}
})();