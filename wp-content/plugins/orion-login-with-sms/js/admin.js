( function ( $ ) {
	'use strict';

	var adminSettings = {

		inputFields: {
			twilio: {
				hide: [
					'api_username',
					'api_secret',
					'sender_id'
				],
				show: [
					'api_key'
				]
			},
			nexmo: {
				hide: [
					'api_username'
				],
				show: [
					'api_key',
					'api_secret',
					'sender_id'
				]
			},
			clicksend: {
				hide: [
					'api_secret'
				],
				show: [
					'api_key',
					'api_username',
					'sender_id'
				]
			},
			msg91_international: {
				hide: [
					'api_secret',
					'api_username'
				],
				show: [
					'api_key',
					'sender_id'
				]
			},
			msg91_standard: {
				hide: [
					'api_secret',
					'api_username'
				],
				show: [
					'api_key',
					'sender_id'
				]
			},
			clickatell: {
				hide: [
					'api_secret',
					'api_username',
					'sender_id'
				],
				show: [
					'api_key'
				]
			},
			ringcaptcha: {
				hide: [
					'api_secret',
					'sender_id'
				],
				show: [
					'api_key',
					'api_username'
				]
			}
		},

		init: function() {
			this.bindEvents();
		},

		bindEvents: function() {
			const that = this;
			const apiTypeSelector = '#olws_plugin_settings_api_type';
			const apiType = $( apiTypeSelector );

			that.manageVisibleOptions = this.manageVisibleOptions;

			// Trigger on initial load
			this.manageVisibleOptions( apiType.val() );

			// Trigger on chnage
			$( '#olws_plugin_settings_api_type' ).change( function( event ) {
				that.manageVisibleOptions( event.target.value );
			} );

		},

		manageVisibleOptions: function( apiType ) {


			const apiTypeLower = apiType.toLowerCase();
			const currentField = this.inputFields[ apiTypeLower ];
			let hideSelectorArray;

			hideSelectorArray = currentField.hide.map( function ( item ) {
				return '.' + item.toLowerCase() + '-wrapper';
			} );

			$( hideSelectorArray.join( ',' ) ).addClass( 'lighten' );

			let showSelectorArray = currentField.show.map( function ( item ) {
				return '.' + item.toLowerCase() + '-wrapper';
			} );
			$( showSelectorArray.join( ',' ) ).removeClass( 'lighten' );
		}

	};

	adminSettings.init();

} ( jQuery ) );
