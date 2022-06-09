/*
Document: app-custom.js
Description: Write your custom code here
*/

$('.video-popup').magnificPopup({
	type: 'iframe',
	mainClass: 'mfp-fade',
	removalDelay: 160,
	preloader: false,
	zoom: {
		enabled: true,
	}
  });
  
// Below is an example of function and its initialization
var AppCustom = function() {
	var showAppName = function() {
		console.log( 'MS' );
	};

	return {
		init: function() {
			showAppName();
		}
	}
}();

// Initialize AppCustom when page loads
jQuery( function() {
	AppCustom.init();
});
