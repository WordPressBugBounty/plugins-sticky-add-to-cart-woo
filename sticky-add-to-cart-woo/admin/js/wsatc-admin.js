(function ($) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(document).ready(function () {
		$('.wsatc-color-field').wpColorPicker()
	});

})(jQuery);


document.addEventListener('DOMContentLoaded', (e) => {
	 
	var tabs = document.querySelectorAll('.wsatc-tabs .tab-link');
	if (tabs) {
		tabs.forEach(
			(tab) => {
				tab.addEventListener('click', (e) => {
					var tabContnet = e.target.getAttribute('id');
					if( !tabContnet ){
						return;
					}
					localStorage.setItem("wsatc_active_tab", tabContnet);
					tabs.forEach((_tab) => {
						_tab.classList.remove("active");
					});
					e.target.classList.add('active');
					
					document.querySelectorAll('.wsatc-tab-content').forEach((tc) => {
						tc.classList.remove("active");
					});

					document.getElementsByClassName(tabContnet)[0].classList.add('active');
				});
			}
		);


		let activeTab = localStorage.getItem("wsatc_active_tab");
		document.getElementById( `${activeTab}`).click();
	}
	var submitButton = document.querySelector('.button-primary.wsatc[type=submit]');
	if (submitButton) {
		submitButton.addEventListener('click', (e) => {
			e.preventDefault();
			var settingForm = document.getElementById('wsatc-settings');
			var wsatcForm = new FormData(settingForm);
			wsatcForm.append('action', 'wsatc_save_settings');
			showLoader();
			fetch(WSATC.ajaxUrl, { method: 'POST', body: wsatcForm })
				.then((response) => response.json())
				.then((data) => {
					if (data.success) {
						// document.querySelector( '#wsatc-settings #_wpnonce').value = data._nonce
						hideLoader();
						document.getElementById( 'snackbar' ).classList.add('show');
							setTimeout( function(){ 
								document.getElementById( 'snackbar' ).classList.remove('show');
							}, 3000);
						
					}
				});
		});
	}

	var resetButton = document.querySelector('.reset-button.wsatc[type=submit]');
	if (resetButton) {
		resetButton.addEventListener('click', (e) => {
			e.preventDefault();
			if (confirm("Click OK to reset. All your settings will be lost!")) {
				var wsatcForm = new FormData();
				wsatcForm.append('action', 'wsatc_reset_settings');
				showLoader();
				fetch(WSATC.ajaxUrl, { method: 'POST', body: wsatcForm })
					.then((response) => response.json())
					.then((data) => {
						if (data.success) {
							// document.querySelector( '#wsatc-settings #_wpnonce').value = data._nonce
							location.reload();
							hideLoader();
						}
					});
			}
		});
	}

	if ( document.querySelector("input[name='wsatc-redirect']").checked ){
		document.querySelector(".wsatc-redirect-opt").classList.remove("wsatc-hide");
		if(document.querySelector("#wsatc-redirect-location").value === 'custom_url') {
			document.querySelector(".wsatc-custom-url").classList.remove("wsatc-hide");
		}
	}else{
		document.querySelector(".wsatc-redirect-opt").classList.add("wsatc-hide");
		document.querySelector(".wsatc-custom-url").classList.add("wsatc-hide");
	}
	
	document.querySelector("input[name='wsatc-redirect']").addEventListener("change", (e) => { 
		if(e.target.checked) {
			document.querySelector(".wsatc-redirect-opt").classList.remove("wsatc-hide");
			if(document.querySelector("#wsatc-redirect-location").value === 'custom_url') {
				document.querySelector(".wsatc-custom-url").classList.remove("wsatc-hide");
			}
		} 
		else {
			document.querySelector(".wsatc-redirect-opt").classList.add("wsatc-hide");
			document.querySelector(".wsatc-custom-url").classList.add("wsatc-hide");
		}
	});

	document.querySelector("#wsatc-redirect-location").addEventListener("change", (e) => {
	
		if (e.target.value === "custom_url") {
			document.querySelector(".wsatc-custom-url").classList.remove("wsatc-hide");
		}else{
			document.querySelector(".wsatc-custom-url").classList.add("wsatc-hide");
		}
	});


})

function showLoader() {
	document.querySelector('.loader-containter').classList.add('display');
	document.querySelectorAll('#wsatc-settings input[type=submit]').forEach((item) => {
		item.setAttribute('disabled', true)
	});
}
function hideLoader() {
	document.querySelector('.loader-containter').classList.remove('display');
	document.querySelectorAll('#wsatc-settings input[type=submit]').forEach((item) => {
		item.removeAttribute('disabled')
	});
}
