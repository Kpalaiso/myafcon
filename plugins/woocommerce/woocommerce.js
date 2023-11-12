/* global jQuery:false */
/* global FCUNITED_STORAGE:false */

(function() {
	"use strict";

	jQuery( document ).on(
		'action.ready_fcunited', function() {

			// Change display mode
			jQuery( '.woocommerce,.woocommerce-page' ).on(
				'click', '.fcunited_shop_mode_buttons a', function(e) {
					var mode = jQuery( this ).hasClass( 'woocommerce_thumbs' ) ? 'thumbs' : 'list';
					fcunited_set_cookie( 'fcunited_shop_mode', mode, 365 );
					jQuery( this ).siblings( 'input' ).val( mode ).parents( 'form' ).get( 0 ).submit();
					e.preventDefault();
					return false;
				}
			);


			// Add buttons to quantity
			//--------------------------------

			// On first run
			if (jQuery( '.woocommerce div.quantity .q_inc,.woocommerce-page div.quantity .q_inc' ).length == 0) {
				var woocomerce_inc_dec = '<span class="q_inc"></span><span class="q_dec"></span>';
				jQuery( '.woocommerce div.quantity,.woocommerce-page div.quantity' ).append( woocomerce_inc_dec );
				jQuery( '.woocommerce div.quantity,.woocommerce-page div.quantity' ).on(
					'click', '>span', function(e) {
						fcunited_woocomerce_inc_dec_click( jQuery( this ) );
						e.preventDefault();
						return false;
					}
				);
			}
			// After the cart is updated
			jQuery( document.body ).on(
				'updated_wc_div', function() {
					if (jQuery( '.woocommerce div.quantity .q_inc,.woocommerce-page div.quantity .q_inc' ).length == 0) {
						jQuery( '.woocommerce div.quantity,.woocommerce-page div.quantity' ).append( woocomerce_inc_dec );
						jQuery( '.woocommerce div.quantity,.woocommerce-page div.quantity' ).on(
							'click', '>span', function(e) {
								fcunited_woocomerce_inc_dec_click( jQuery( this ) );
								e.preventDefault();
								return false;
							}
						);
					}
				}
			);

			// Inc/Dec quantity on buttons inc/dec
			function fcunited_woocomerce_inc_dec_click(button) {
				var f = button.siblings( 'input' );
				if (button.hasClass( 'q_inc' )) {
					f.val( ( f.val() == '' ? 0 : parseInt( f.val(), 10 ) ) + 1 ).trigger( 'change' );
				} else {
					f.val( Math.max( 0, ( f.val() == '' ? 0 : parseInt( f.val(), 10 ) ) - 1 ) ).trigger( 'change' );
				}
			}


			// Decorate YITH Compare & Add to wishlist
			//----------------------------------------------

			// Move 'Compare' before 'Wishlist' and convert 'Wishlist' to the button (if 'Compare' is a button)
			var wishlist = jQuery( '.woocommerce .product .summary .yith-wcwl-add-to-wishlist' ).eq( 0 );
			if (wishlist.length > 0) {
				var compare = jQuery( '.woocommerce .product .summary .compare' ).eq( 0 );
				if ( compare.length > 0 ) {
					compare.insertBefore( wishlist );
					if ( compare.hasClass( 'button' ) ) {
						wishlist.find( '.add_to_wishlist' ).addClass( 'button' );
					}
				}
			}

			// Remove class 'button' from links 'Compare' and 'Add to Wishlist' in the 'Related products' on the single product page
			jQuery( '.single-product ul.products li.product .post_data .yith_buttons_wrap a' ).removeClass( 'button' );

			// Wrap inner text in the links 'Compare' and 'Add to Wishlist' to the span
			jQuery( 'ul.products li.product .post_data .yith_buttons_wrap a' ).wrapInner( '<span class="tooltip"></span>' );

			// Wrap inner text in the link 'Compare' after click
			jQuery( 'ul.products li.product .post_data .yith_buttons_wrap .compare' ).on('click', function(e) {
				var bt = jQuery(this), atts = 10;
				setTimeout(trx_addons_add_tooltip, 500);
				function trx_addons_add_tooltip() {
					if (bt.hasClass('added') && bt.find('.tooltip').length == 0) {
						bt.wrapInner( '<span class="tooltip"></span>' );
					} else if (atts-- > 0) {
						setTimeout(trx_addons_add_tooltip, 500);
					}
				}
			});
			// Change spinner image in the 'Add to Wishlist'
			var img = jQuery( 'ul.products li.product .yith_buttons_wrap .yith-wcwl-add-button > img' );
			if ( img.length > 0 ) {
				img.each( function() {
					var src = jQuery(this).attr('src');
					if ( src != undefined && src.indexOf('wpspin_light') > 0) {
						jQuery(this).attr('src', src.replace('wpspin_light', 'ajax-loader'));
					}
				});
			}

			// Wrap new select (created dynamically) with .select_container
			//-------------------------------------------------------------------------


			// Generate 'scroll' event after the cart is filled
			jQuery( document.body ).on(
				'wc_fragment_refresh', function() {
					jQuery( window ).trigger( 'scroll' );
				}
			);

			// Add stretch behaviour to WooC tabs area
			jQuery( document ).on(
				'action.prepare_stretch_width', function() {
					if ( jQuery( 'body' ).hasClass( 'single_product_layout_stretched' ) && jQuery( 'body' ).hasClass( 'sidebar_hide' ) ) {
						jQuery( '.single-product .woocommerce-tabs' ).wrap( '<div class="trx-stretch-width"></div>' );
					}
				}
			);

			// Check device and update cart if need
			if (jQuery( 'table.cart' ).length > 0) {
				fcunited_woocommerce_update_cart( 'init' );
			}

			// Resize action
			jQuery( window ).resize(
				function() {
					"use strict";
					if (jQuery( 'table.cart' ).length > 0) {
						fcunited_woocommerce_update_cart( 'resize' );
					}
				}
			);

			// Update cart
			jQuery( document.body ).on(
				'updated_wc_div', function() {
					"use strict";
					if (jQuery( 'table.cart' ).length > 0) {
						fcunited_woocommerce_update_cart( 'update' );
					}
				}
			);

			// Update cart display
			function fcunited_woocommerce_update_cart(status){
				"use strict";
				setTimeout(
					function() {
						var w = window.innerWidth;
						if (w == undefined) {
							w = jQuery( window ).width() + (jQuery( window ).height() < jQuery( document ).height() || jQuery( window ).scrollTop() > 0 ? 16 : 0);
						}

						if (FCUNITED_STORAGE['mobile_layout_width'] >= w) {
							if (status == 'resize' && jQuery( 'table.cart .mobile_cell' ).length > 0) {
								return false;
							} else {
								var tbl = jQuery( 'table.cart' );
								if ( tbl.length > 0 ) {
									tbl.find( 'thead tr .product-quantity, thead tr .product-subtotal, thead tr .product-thumbnail' ).hide();
									if ( tbl.hasClass( 'wishlist_table' ) ) {
										tbl.find( 'thead tr .product-remove, thead tr .product-stock-status' ).hide();
										tbl.find( 'tfoot tr td' ).each(function() {
											jQuery( this ).data( 'colspan', jQuery( this ).attr( 'colspan' ) ).attr( 'colspan', 3 );
										});
									}
									tbl.find( '.cart_item,[id*="yith-wcwl-row-"]' ).each(
										function(){
											jQuery( this ).prepend( '<td class="mobile_cell" colspan="3"><table width="100%"><tr class="first_row"></tr><tr class="second_row"></tr></table></td>' );
											jQuery( this ).find( '.first_row' ).append( jQuery( this ).find( '.product-thumbnail, .product-name, .product-price' ) );
											jQuery( this ).find( '.second_row' ).append( jQuery( this ).find( '.product-remove, .product-quantity, .product-subtotal, .product-stock-status, .product-add-to-cart' ) );
										}
									);
									if ( ! tbl.hasClass( 'inited' )) {
										tbl.addClass( 'inited' );
									}
								}
							}
						}

						if (FCUNITED_STORAGE['mobile_layout_width'] < w && status == 'resize' && jQuery( 'table.cart .mobile_cell' ).length > 0) {
							var tbl = jQuery( 'table.cart' );
							if ( tbl.length > 0 ) {
								tbl.find( 'thead tr .product-quantity, thead tr .product-subtotal, thead tr .product-thumbnail' ).show();
								if ( tbl.hasClass( 'wishlist_table' ) ) {
									tbl.find( 'thead tr .product-remove, thead tr .product-stock-status' ).show();
									tbl.find( 'tfoot tr td' ).each(function() {
										jQuery( this ).attr( 'colspan', jQuery( this ).data( 'colspan' ) );
									});
								}
								tbl.find( '.cart_item,[id*="yith-wcwl-row-"]' ).each(
									function(){
										jQuery( this ).find( '.first_row td, .second_row td' ).prependTo( jQuery( this ) );
										jQuery( this ).find( '.product-remove' ).prependTo( jQuery( this ) );
										jQuery( this ).find( 'td.mobile_cell' ).remove();
									}
								);
							}
						}

					}, 10
				);
			}
		}
	);
})();
