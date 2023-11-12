/* global jQuery:false */
/* global FCUNITED_STORAGE:false */

(function() {
	"use strict";

	// Init skin-specific actions on first run
	// Attention! Don't forget to add the class "inited" and check it to prevent re-initialize the elements
	jQuery( document ).on(
		'action.ready_fcunited', function() {

		}
	);

	// Init skin-specific hidden elements when their parent container becomes visible
	// Attention! Don't forget to add the class "inited" and check it to prevent re-initialize the elements
	jQuery( document ).on(
		'action.init_hidden_elements', function() {

		}
	);

	// Skin-specific scroll actions
	jQuery( document ).on(
		'action.scroll_fcunited', function() {

		}
	);

	// Skin-specific resize actions
	jQuery( document ).on(
		'action.resize_fcunited', function() {

		}
	);

})();
