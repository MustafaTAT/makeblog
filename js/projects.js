jQuery(document).ready(function(){
	jQuery('#link-js-step-1').click(function() {
		console.log('Clicked');
		googletag.pubads().refresh();
		_gaq.push(['_trackPageview']);
		jQuery('#js-step-1').slideDown();
		jQuery('#js-step-2').slideUp();
		jQuery('#js-step-3').slideUp();
		jQuery('#js-step-4').slideUp();
		jQuery('#js-step-5').slideUp();
	});
	jQuery('#link-js-step-2').click(function() {
		console.log('Clicked');
		googletag.pubads().refresh();
		_gaq.push(['_trackPageview']);
		jQuery('#js-step-2').slideDown();
		jQuery('#js-step-1').slideUp();
		jQuery('#js-step-3').slideUp();
		jQuery('#js-step-4').slideUp();
		jQuery('#js-step-5').slideUp();
	});
	jQuery('#link-js-step-3').click(function() {
		console.log('Clicked');
		googletag.pubads().refresh();
		_gaq.push(['_trackPageview']);
		jQuery('#js-step-3').slideDown();
		jQuery('#js-step-1').slideUp();
		jQuery('#js-step-2').slideUp();
		jQuery('#js-step-4').slideUp();
		jQuery('#js-step-5').slideUp();
	});
	jQuery('#link-js-step-4').click(function() {
		console.log('Clicked');
		googletag.pubads().refresh();
		_gaq.push(['_trackPageview']);
		jQuery('#js-step-4').slideDown();
		jQuery('#js-step-1').slideUp();
		jQuery('#js-step-2').slideUp();
		jQuery('#js-step-3').slideUp();
		jQuery('#js-step-5').slideUp();
	});
	jQuery('#link-js-step-5').click(function() {
		console.log('Clicked');
		googletag.pubads().refresh();
		_gaq.push(['_trackPageview']);
		jQuery('#js-step-5').slideDown();
		jQuery('#js-step-1').slideUp();
		jQuery('#js-step-2').slideUp();
		jQuery('#js-step-3').slideUp();
		jQuery('#js-step-4').slideUp();
	});
});