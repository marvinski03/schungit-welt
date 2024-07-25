jQuery( document ).ready(function() {
	jQuery('.fusion-live-search-input').attr('placeholder', 'Gesamten Shop durchsuchen...');
	//jQuery('.cc-img-banner').parent().appendTo('.fusion-header .fusion-header-content-3-wrapper');
	jQuery('#newsletterwidget-2 input.tnp-email').attr('placeholder', 'E-Mailadresse eintragen...');
	jQuery('.fusion-out-of-stock .fusion-position-text').html('bald wieder verfügbar').show();
	
	/*if(!( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || window.matchMedia('(max-width: 991px)').matches)) {
		jQuery('.cc-img-banner').parent().attr('href', 'tel:+4952459259196');
	}*/
	
	jQuery('.additionalinfo').insertBefore('.woocommerce-tabs').show();
	
	jQuery('.versandkosten').each(function(){
		jQuery(this).attr('href', '/zahlung-und-versand/');
	});
	
	jQuery('.delivery-time-nicht-angegeben span').html('Lieferzeit: 2-3 Tage').show();
	
	
	//Ab einem Warenwert von nur 90 Euro liefern wir nach Deutschland versandkostenfrei.
	jQuery('.woocommerce-shipping-destination').html('Ab einem Warenwert von nur 90 Euro liefern wir nach Deutschland versandkostenfrei.');
	
	jQuery('.woocommerce-shipping-destination').show();


	jQuery(window).on('scroll', function(event) {
	    var scroll = jQuery(window).scrollTop();
	    var body = jQuery(document).height() - jQuery(window).height()


	    if (scroll < 100) {
	        jQuery("body").removeClass("scrolled");
	    } else {
	        jQuery("body").addClass("scrolled");
	    }

	    if(scroll < (body-500)){
	    	jQuery("body").removeClass("scrolled-footer");
	    }else{
	    	jQuery("body").addClass("scrolled-footer");
	    }
	});
	
});

jQuery( document ).ajaxComplete(function() {
	jQuery('.payment_method_sofortueberweisung_gateway p:last-child').html("Klarna <a href='https://cdn.klarna.com/1.0/shared/content/legal/terms/0/de_de/privacy' target='_blank' title='Klarna Privacy Policy'>Datenschutzerklärung</a>.");
}); 




//===== Sticky M