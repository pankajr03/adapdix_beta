( function ( $ ) {
	'use strict';

	let olwsClass = {

		init: function () {
			this.createRequiredFields();
		},

		createRequiredFields: function () {
			var adaptiveCssClass = ( olLoginForm.adaptiveStyle ) ? 'olws-adaptive' : '';

			if ( '' !== olLoginForm.selector ) {
				$( olLoginForm.selector ).append( '<button id="olws-dynamic-btn" class="olws-dynamic-btn ' + adaptiveCssClass + '" type="button">' + olLoginForm.btnText + '</button>' );
			}

		}

	};

	if  ( 'undefined' !== typeof olLoginForm ) {
		olwsClass.init();
	}

} ( jQuery ) );
