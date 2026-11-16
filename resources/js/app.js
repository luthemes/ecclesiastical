/**
 * Primary front-end script.
 *
 * Primary JavaScript file. Any includes or anything imported should be filtered through this file 
 * and eventually saved back into the `/assets/js/app.js` file.
 *
 * @package   Initiator
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019-2020 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/benlumia007/initiator
 */

/**
 * A simple immediately-invoked function expression to kick-start
 * things and encapsulate our code.
 *
 * @since  1.0.0 
 * @access public
 * @return void
 */
 ( function() {
	var container, button, dropdown, icon, screenreadertext, parentLink, menu, submenu, links, i, len;

	container = document.getElementById( 'masthead' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'nav' )[0];

	screenreadertext = document.createElement( 'span' );
	screenreadertext.classList.add( 'screen-reader-text' );
	screenreadertext.textContent = ecclesiasticalScreenReaderText.expandMain;
	button.appendChild( screenreadertext );

	parentLink = container.querySelectorAll( '.has-children, .menu-item-has-children, .page_item_has_children' );

	for ( i = 0, len = parentLink.length; i < len; i++ ) {
		var dropdown = document.createElement( 'button' ),
			submenu = parentLink[i].querySelector( '.sub-menu' ),
			icon = document.createElement( 'span' ),
			screenreadertext = document.createElement( 'span' );

		icon.classList.add( 'fontawesome' );
		icon.setAttribute( 'aria-hidden', 'true' );

		screenreadertext.classList.add( 'screen-reader-text' );
		screenreadertext.textContent = ecclesiasticalScreenReaderText.expandChild;

		parentLink[i].insertBefore( dropdown, submenu );
		dropdown.classList.add( 'dropdown-toggle' );
		dropdown.setAttribute( 'aria-expanded', 'false' );
		dropdown.appendChild( icon );
		dropdown.appendChild( screenreadertext );

		dropdown.onclick = function() {
			var parentLink = this.parentElement,
				submenu = parentLink.querySelector( '.sub-menu' ),
				screenreadertext = this.querySelector( '.screen-reader-text' );

			if ( -1 !== parentLink.className.indexOf( 'toggled-on' ) ) {
				parentLink.className = parentLink.className.replace( ' toggled-on', '' );
				this.setAttribute( 'aria-expanded', 'false' );
				submenu.setAttribute ( 'aria-expanded', 'false');
				screenreadertext.textContent = ecclesiasticalScreenReaderText.expandChild;
			} else {
				parentLink.className += ' toggled-on';
				this.setAttribute( 'aria-expanded', 'true' );
				submenu.setAttribute ( 'aria-expanded', 'true');
				screenreadertext.textContent = ecclesiasticalScreenReaderText.collapseChild;
			}
		};
	}

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	button.onclick = function() {
		screenreadertext = this.querySelector( '.screen-reader-text' );
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			screenreadertext.textContent = ecclesiasticalScreenReaderText.expandMain;
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			screenreadertext.textContent = ecclesiasticalScreenReaderText.collapseMain;
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the primary menu.

	links = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .menu__items.
		while ( -1 === self.className.indexOf( 'menu__items' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}
			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( container ) {
		var touchStartFn, i,
			parentLink = container.querySelectorAll( '.has-children > a, .menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );
} )();