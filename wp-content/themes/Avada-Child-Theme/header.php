<?php
/**
 * Header template.
 *
 * @package Avada
 * @subpackage Templates
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<!DOCTYPE html>
<html class="<?php avada_the_html_class(); ?>" <?php language_attributes(); ?>>
<head>
	<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<?php Avada()->head->the_viewport(); ?>

	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/favicon-16x16.png">
	<link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/site.webmanifest">
	<link rel="mask-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/safari-pinned-tab.svg" color="#67b7e1">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/favicon.ico">
	<meta name="msapplication-TileColor" content="#67b7e1">
	<meta name="msapplication-config" content="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
		
	<meta name="google-site-verification" content="OVHbH2AuvuBsgpX64HFKihGyAMWtPtwzMCQFejOa2XU" />

	<?php wp_head(); ?>

	<?php $object_id = get_queried_object_id(); ?>
	<?php $c_page_id = Avada()->fusion_library->get_page_id(); ?>

	<script type="text/javascript">
		var doc = document.documentElement;
		doc.setAttribute('data-useragent', navigator.userAgent);
	</script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KZ2PCPB');</script>
<!-- End Google Tag Manager -->
	<?php
	/**
	 *
	 * The settings below are not sanitized.
	 * In order to be able to take advantage of this,
	 * a user would have to gain access to the database
	 * in which case this is the least on your worries.
	 */
	echo apply_filters( 'avada_google_analytics', Avada()->settings->get( 'google_analytics' ) ); // WPCS: XSS ok.
	echo apply_filters( 'avada_space_head', Avada()->settings->get( 'space_head' ) ); // WPCS: XSS ok.
	?>
	<link
	  rel="preload"
	  as="image"
	  href="/wp-content/uploads/2020/09/Schungit-Wasser.jpg"
	/>
	<link rel="preload" as="font" href="/wp-content/plugins/side-cart-woocommerce/assets/css/fonts/Woo-Side-Cart.woff?le17z4" type="font/woff2" crossorigin="anonymous">
	<link rel="preload" as="font" href="/wp-content/themes/Avada/includes/lib/assets/fonts/icomoon/icomoon.woff" type="font/woff2" crossorigin="anonymous">
	<link rel="preload" as="font" href="/wp-content/themes/Avada/includes/lib/assets/fonts/fontawesome/webfonts/fa-solid-900.woff2" type="font/woff2" crossorigin="anonymous">
</head>

<?php
$wrapper_class = ( is_page_template( 'blank.php' ) ) ? 'wrapper_blank' : '';

if ( 'modern' === Avada()->settings->get( 'mobile_menu_design' ) ) {
	$mobile_logo_pos = strtolower( Avada()->settings->get( 'logo_alignment' ) );
	if ( 'center' === strtolower( Avada()->settings->get( 'logo_alignment' ) ) ) {
		$mobile_logo_pos = 'left';
	}
}

?>
<body <?php body_class(); ?>>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'Avada' ); ?></a>
	<?php
	do_action( 'avada_before_body_content' );

	$boxed_side_header_right = false;
	$page_bg_layout          = 'default';
	if ( $c_page_id && is_numeric( $c_page_id ) ) {
		$fpo_page_bg_layout = get_post_meta( $c_page_id, 'pyre_page_bg_layout', true );
		$page_bg_layout     = ( $fpo_page_bg_layout ) ? $fpo_page_bg_layout : $page_bg_layout;
	}

	?>
	<?php if ( ( ( 'Boxed' === Avada()->settings->get( 'layout' ) && ( 'default' === $page_bg_layout || '' == $page_bg_layout ) ) || 'boxed' === $page_bg_layout ) && 'Top' != Avada()->settings->get( 'header_position' ) ) : ?>
		<div id="boxed-wrapper">
	<?php endif; ?>
	<?php if ( ( ( 'Boxed' === Avada()->settings->get( 'layout' ) && 'default' === $page_bg_layout ) || 'boxed' === $page_bg_layout ) && 'framed' === Avada()->settings->get( 'scroll_offset' ) ) : ?>
		<div class="fusion-sides-frame"></div>
	<?php endif; ?>
	<div id="wrapper" class="<?php echo esc_attr( $wrapper_class ); ?>">
		<div id="home" style="position:relative;top:-1px;"></div>
		<?php avada_header_template( 'Below', ( is_archive() || Avada_Helper::bbp_is_topic_tag() ) && ! ( class_exists( 'WooCommerce' ) && is_shop() ) ); ?>
		<?php if ( 'Left' === Avada()->settings->get( 'header_position' ) || 'Right' === Avada()->settings->get( 'header_position' ) ) : ?>
			<?php avada_side_header(); ?>
		<?php endif; ?>

		<?php avada_sliders_container(); ?>

		<?php avada_header_template( 'Above', ( is_archive() || Avada_Helper::bbp_is_topic_tag() ) && ! ( class_exists( 'WooCommerce' ) && is_shop() ) ); ?>

		<?php if ( has_action( 'avada_override_current_page_title_bar' ) ) : ?>
			<?php do_action( 'avada_override_current_page_title_bar', $c_page_id ); ?>
		<?php else : ?>
			<?php avada_current_page_title_bar( $c_page_id ); ?>
		<?php endif; ?>
		<?php do_action( 'avada_after_page_title_bar' ); ?>

		<?php
		$main_css   = '';
		$row_css    = '';
		$main_class = '';

		if ( apply_filters( 'fusion_is_hundred_percent_template', false, $c_page_id ) ) {
			$main_css         = 'padding-left:0px;padding-right:0px;';
			$hundredp_padding = get_post_meta( $c_page_id, 'pyre_hundredp_padding', true );
			if ( Avada()->settings->get( 'hundredp_padding' ) && ! $hundredp_padding ) {
				$main_css = 'padding-left:' . Avada()->settings->get( 'hundredp_padding' ) . ';padding-right:' . Avada()->settings->get( 'hundredp_padding' );
			}
			if ( $hundredp_padding ) {
				$main_css = 'padding-left:' . $hundredp_padding . ';padding-right:' . $hundredp_padding;
			}
			$row_css    = 'max-width:100%;';
			$main_class = 'width-100';
		}
		do_action( 'avada_before_main_container' );
		?>
		<main id="main" class="clearfix <?php echo esc_attr( $main_class ); ?>" style="<?php echo esc_attr( $main_css ); ?>">
			<div class="fusion-row" style="<?php echo esc_attr( $row_css ); ?>">
			<div style="display:none;">
				<a href="tel:+4952459259196"><img class="cc-img-banner" src="/wp-content/themes/Avada-Child-Theme/images/banner.png" alt="" /></a>
			</div>
		<div class="mobile-casts">
			<div class="mob-cat-item ccff">
				<a href="/produkt-kategorie/schungit-schmuck/">Schmuck aus Schungit<span>►</span></a>
			</div>
			<div class="mob-cat-item">
				<a href="/produkt-kategorie/schungit-wasser/">Schungit für Wasser<span>►</span></a>
			</div>
			<div class="clearfix"></div>
			<div class="mob-cat-item ccff">
				<a href="/produkt-kategorie/schungit-pyramide/">Schungit-Pyramiden<span>►</span></a>
			</div>
			<div class="mob-cat-item">
				<a href="/produkt-kategorie/schungit-handyzubehoer/">Schungit-Handyzubehör<span>►</span></a>
			</div>
			<div class="clearfix"></div>
			<div class="mob-cat-item ccff">
				<a href="/produkt-kategorie/schungit-anhaenger/">Schungit-Anhänger<span>►</span></a>
			</div>
			<div class="mob-cat-item">
				<a href="/produkt-kategorie/kugel-und-ei/">Kugeln und Eier aus Schungit<span>►</span></a>
			</div>
			<div class="clearfix"></div>
		</div>