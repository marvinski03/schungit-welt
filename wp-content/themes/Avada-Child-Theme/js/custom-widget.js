var snippet = '<!-- Shopauskunft Widget --><div id="shopauskunft_widget_side"><a href="https://www.shopauskunft.de/review/schungit-welt.com" target="_blank"><img src="https://apps.shopauskunft.de/widget/v5/seal.php?token=a08c4bd1a22873117d14d29ad0b32c19&w=140&cut_headline=0&cut_text=0&cut_count=1&cut_date=1" border="0" alt="ShopAuskunft.de Siegel" width="140" height="209" /></a></div><!-- Shopauskunft Widget End -->';
				if (document.getElementById("shopauskunft-side")) {document.getElementById("shopauskunft-side").innerHTML = snippet}


$("body.woocommerce-checkout h1.entry-title").wrap('<a href="https://schungit-welt.com/"></a>');					