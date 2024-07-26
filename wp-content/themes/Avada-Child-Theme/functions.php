<?php

function theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'avada-stylesheet' ) );

    wp_enqueue_style( 'schungit-styles', get_stylesheet_directory_uri() . '/screen.css', array( 'avada-stylesheet' ) );
    

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );

// Add specific CSS class by filter
add_filter('body_class','er_logged_in_filter');
function er_logged_in_filter($classes) {
	if( is_user_logged_in() ) {
		$classes[] = 'user-loggedin';
	} else {
		$classes[] = 'user-loggedout';
	}
	// return the $classes array
	return $classes;
}

/**
 * Set a minimum order amount for checkout
 */
//add_action( 'woocommerce_checkout_process', 'wc_minimum_order_amount' );
//add_action( 'woocommerce_before_cart' , 'wc_minimum_order_amount' );
// 
//function wc_minimum_order_amount() {
//    // Set this variable to specify a minimum order value
//    $minimum = 200;
//
//    if ( WC()->cart->total < $minimum ) {
//
//        if( is_cart() ) {
//
//            wc_print_notice( 
//                sprintf( 'Ihre aktuelle Bestellsumme ist %s - Sie müssen eine Bestellung mit mindestens %s haben' , 
//                    wc_price( WC()->cart->total ), 
//                    wc_price( $minimum )
//                ), 'error' 
//            );
//
//        } else {
//
//            wc_add_notice( 
//                sprintf( 'Ihre aktuelle Bestellsumme ist %s - Sie müssen eine Bestellung mit mindestens %s haben' , 
//                    wc_price( WC()->cart->total ), 
//                    wc_price( $minimum )
//                ), 'error' 
//            );
//
//        }
//    }
//}

//add_action('woocommerce_before_checkout_form', 'bbloomer_print_cart_weight');
//add_action('woocommerce_before_cart', 'bbloomer_print_cart_weight');
// 
//function bbloomer_print_cart_weight( $posted ) {
//global $woocommerce;
//$notice = 'Ihr Warenkorb gewicht beträgt: ' . $woocommerce->cart->cart_contents_weight . get_option('woocommerce_weight_unit');
//if( is_cart() ) {
//   wc_print_notice( $notice, 'notice' );
//} else {
//   wc_add_notice( $notice, 'notice' );
//}
//}


/**
 * @snippet       WooCommerce User Registration Shortcode
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.6.5
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
  
// THIS WILL CREATE A NEW SHORTCODE: [wc_reg_form_bbloomer]
  
add_shortcode( 'wc_reg_form_bbloomer', 'bbloomer_separate_registration_form' );
    
function bbloomer_separate_registration_form() {
   if ( is_admin() ) return;
   if ( is_user_logged_in() ) return;
   ob_start();
 
   // NOTE: THE FOLLOWING <FORM></FORM> IS COPIED FROM woocommerce\templates\myaccount\form-login.php
   // IF WOOCOMMERCE RELEASES AN UPDATE TO THAT TEMPLATE, YOU MUST CHANGE THIS ACCORDINGLY
    
   ?>
 
      <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >
 
         <?php do_action( 'woocommerce_register_form_start' ); ?>
 
         <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
 
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
               <label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
               <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
            </p>
 
         <?php endif; ?>
 
         <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
            <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
         </p>
 
         <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
 
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
               <label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
               <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
            </p>
 
         <?php else : ?>
 
            <p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>
 
         <?php endif; ?>
 
         <?php do_action( 'woocommerce_register_form' ); ?>
 
         <p class="woocommerce-FormRow form-row">
            <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
            <button type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
         </p>
 
         <?php do_action( 'woocommerce_register_form_end' ); ?>
 
      </form>
 
   <?php
     
   return ob_get_clean();
}



// Function to check starting char of a string
function startsWith($haystack, $needle){
    return $needle === '' || strpos($haystack, $needle) === 0;
}


// Custom function to display the Billing Address form to registration page
function zk_add_billing_form_to_registration(){
    global $woocommerce;
    $checkout = $woocommerce->checkout();
    ?>
    <?php foreach ( $checkout->get_checkout_fields( 'billing' ) as $key => $field ) : ?>

        <?php if($key!='billing_email'){ 
            woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
        } ?>

    <?php endforeach; 
}
add_action('woocommerce_register_form_start','zk_add_billing_form_to_registration');

// Custom function to save Usermeta or Billing Address of registered user
function zk_save_billing_address($user_id){
    global $woocommerce;
    $address = $_POST;
    foreach ($address as $key => $field){
        if(startsWith($key,'billing_')){
            // Condition to add firstname and last name to user meta table
            if($key == 'billing_first_name' || $key == 'billing_last_name'){
                $new_key = explode('billing_',$key);
                update_user_meta( $user_id, $new_key[1], $_POST[$key] );
            }
            update_user_meta( $user_id, $key, $_POST[$key] );
        }
    }

}
add_action('woocommerce_created_customer','zk_save_billing_address');


// Registration page billing address form Validation
function zk_validation_billing_address(){
    global $woocommerce;
    $address = $_POST;
	
    foreach ($address as $key => $field) :
        // Validation: Required fields
        if(startsWith($key,'billing_')){
            if($key == 'billing_country' && $field == ''){
                $woocommerce->add_error( '<strong>' . __( 'ERROR', 'woocommerce' ) . '</strong>: ' . __( 'Please select a country.', 'woocommerce' ) );
            }
            if($key == 'billing_first_name' && $field == ''){
                $woocommerce->add_error( '<strong>' . __( 'ERROR', 'woocommerce' ) . '</strong>: ' . __( 'Please enter first name.', 'woocommerce' ) );
            }
            if($key == 'billing_last_name' && $field == ''){
                $woocommerce->add_error( '<strong>' . __( 'ERROR', 'woocommerce' ) . '</strong>: ' . __( 'Please enter last name.', 'woocommerce' ) );
            }
            if($key == 'billing_address_1' && $field == ''){
                $woocommerce->add_error( '<strong>' . __( 'ERROR', 'woocommerce' ) . '</strong>: ' . __( 'Please enter address.', 'woocommerce' ) );
            }
            if($key == 'billing_city' && $field == ''){
                $woocommerce->add_error( '<strong>' . __( 'ERROR', 'woocommerce' ) . '</strong>: ' . __( 'Please enter city.', 'woocommerce' ) );
            }
            if($key == 'billing_state' && $field == ''){
                $woocommerce->add_error( '<strong>' . __( 'ERROR', 'woocommerce' ) . '</strong>: ' . __( 'Please enter state.', 'woocommerce' ) );
            }
            if($key == 'billing_postcode' && $field == ''){
                $woocommerce->add_error( '<strong>' . __( 'ERROR', 'woocommerce' ) . '</strong>: ' . __( 'Please enter a postcode.', 'woocommerce' ) );
            }
			/*
            if($key == 'billing_vat' && $field == ''){
                $woocommerce->add_error( '<strong>' . __( 'ERROR', 'woocommerce' ) . '</strong>: ' . __( 'Please enter a Vat ID.', 'woocommerce' ) );
            }
			*/
			
            /*
            if($key == 'billing_email' && $field == ''){
                $woocommerce->add_error( '<strong>' . __( 'ERROR', 'woocommerce' ) . '</strong>: ' . __( 'Please enter billing email address.', 'woocommerce' ) );
            }
            */
            if($key == 'billing_phone' && $field == ''){
                $woocommerce->add_error( '<strong>' . __( 'ERROR', 'woocommerce' ) . '</strong>: ' . __( 'Please enter phone number.', 'woocommerce' ) );
            }

        }
    endforeach;
}
add_action('register_post','zk_validation_billing_address');

//add_filter( 'wf_pklist_modify_order_date', 'wf_add_vat_number_in_invoice',10,3 );
// function wf_add_vat_number_in_invoice($order_date, $order, $action)
// {  
//
//   $vatnumber='VAT Number:' . get_post_meta((WC()->version < '2.7.0') ? $order->id : $order->get_id(),'_vat_number',true);
//   return $order_date.'<br/>'.$vatnumber;
// }

/*****************************  FRONTEND  ****************************************/

/**************************
Filter to add a VAT field to:

- My Account - Edit Form -- Billing fields
- Checkout - Edit Form - Billing Fields

This function is also reordering the form fields

Source:  https://docs.woothemes.com/document/tutorial-customising-checkout-fields-using-actions-and-filters
***************************/
function add_woocommerce_billing_fields($billing_fields){

	//reorder woo my billing address form fields
	$billing_fields2['billing_first_name'] = $billing_fields['billing_first_name'];
	$billing_fields2['billing_last_name'] = $billing_fields['billing_last_name'];
 
	$billing_fields2['billing_vat'] = array(
		'type' => 'text',
		'label' =>  __('Ust.-ID',  'keyelp-shop-customization' ),
		'class' => array('form-row-wide'),
		'required' => false,
		'clear' => true
	);
	
	
	//unimos el resto de campos 
	$merged_billing_fields =  $billing_fields2 + $billing_fields;

	return $merged_billing_fields;
}
add_filter('woocommerce_billing_fields' , 'add_woocommerce_billing_fields');


/*********
Filters to add VAT when printing billing address on:
- (1) My account  
- (2) Checkout - Order Received (after checkout compeltion), 

+++ Additional filters to format the printed output.

********/

// (1) Printing the Billing Address on My Account
add_filter( 'woocommerce_my_account_my_address_formatted_address', 'custom_my_account_my_address_formatted_address', 10, 3 );
function custom_my_account_my_address_formatted_address( $fields, $customer_id, $type ) {

	if ( $type == 'billing' ) {
		$fields['vat'] = get_user_meta( $customer_id, 'billing_vat', true );
	}

	return $fields;
}

// (2) Checkout -- Order Received (printed after having completed checkout)
add_filter( 'woocommerce_order_formatted_billing_address', 'custom_add_vat_formatted_billing_address', 10, 2 );
function custom_add_vat_formatted_billing_address( $fields, $order ) {
	$fields['vat'] = $order->billing_vat;

	return $fields;
}


// Creating merger VAT variables for printing formatting
add_filter( 'woocommerce_formatted_address_replacements', 'custom_formatted_address_replacements', 10, 2 );
function custom_formatted_address_replacements( $address, $args ) {
	$address['{vat}'] = '';
	$address['{vat_upper}']= '';

	if ( ! empty( $args['vat'] ) ) {
		$address['{vat}'] = $args['vat'];
		$address['{vat_upper}'] = strtoupper($args['vat']);
	}
	return $address;
}

//Defining the Spanish formatting to print the address, including VAT.
add_filter( 'woocommerce_localisation_address_formats', 'custom_localisation_address_format' );
function custom_localisation_address_format( $formats ) {
	$formats['ES'] = "{name}\n{company}\n{vat_upper}\n{address_1}\n{address_2}\n{postcode} {city}\n{state}\n{country}";

	return $formats;
}

/*****************************  ADMIN USER PROFILE PAGE  ****************************************/

/*************** 
Filter to add VAT Customer meta fields (user profile field on the billing address grouping)
*****************/
add_filter( 'woocommerce_customer_meta_fields', 'custom_customer_meta_fields' );
function custom_customer_meta_fields( $fields ) {
	$fields['billing']['fields']['billing_vat'] = array(
		'label'       => __( 'Ust.-ID', 'keyelp-shop-customization' )
	); 

	return $fields;
}

add_action( 'show_user_profile', 'crf_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'crf_show_extra_profile_fields' );

function crf_show_extra_profile_fields( $user ) {
	$gewerbenachweis =  get_user_meta( $user->ID , 'billing_gewerbenachweis', true );
	
	?>

	<table class="form-table">
		<h3><?php esc_html_e( 'Gewerbenachweis', 'crf' ); ?></h3>
		<tr>
			<th><label for="billing_gewerbenachweis"><?php esc_html_e( 'File:', 'crf' ); ?></label></th>
			<td>
				<?php if(!empty($gewerbenachweis)): ?>
					<?php $link = wp_get_attachment_url($gewerbenachweis); ?>
					<a target="_blank" href="<?php echo $link; ?>">Open Attachment</a>
				<?php endif; ?>
			</td>
		</tr>
	</table>
	<?php
}

/***************************  ADMIN ORDER PAGE  ****************************************/

/*********  
Filter to add VAT to the Edit Form on:  Order --  Admin page
*********/
add_filter( 'woocommerce_admin_billing_fields', 'custom_admin_billing_fields' );
function custom_admin_billing_fields( $fields ) {
	$fields['vat'] = array(
		'label' => __( 'Ust.-ID', 'keyelp-shop-customization' ),
		'show'  => true
	);
	
	
	return $fields;
}


/**************** 
Filter to copy the VAT field from User meta fields to the Order Admin form (after clicking dedicated button on admin page)
******************/

add_filter( 'woocommerce_found_customer_details', 'custom_found_customer_details' );
function custom_found_customer_details( $customer_data ) {
	$customer_data['billing_vat'] = get_user_meta( $_POST['user_id'], 'billing_vat', true );
	
	return $customer_data;
}

//add required field
add_filter( 'woocommerce_billing_fields', 'ts_unrequire_wc_phone_field');
function ts_unrequire_wc_phone_field( $fields ) {
$fields['billing_company']['required'] = false;
return $fields;
}

/////////////////////////////////////////////////////////////////////////////////////////////

/**
 * @snippet       File Upload @ WooCommerce My Account Registration
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.7
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
 
// --------------
// 1. Add file input to register form
 
//add_action( 'woocommerce_register_form', 'bbloomer_add_woo_account_registration_fields' );
  
function bbloomer_add_woo_account_registration_fields() {
    
   ?>
    
   <p class="form-row validate-required" id="billing_gewerbenachweis" data-priority=""><label for="billing_gewerbenachweis" class="">Gewerbenachweis (JPG, PNG, PDF)<?php /*<abbr class="required" title="required">*</abbr>*/ ?></label><span class="woocommerce-input-wrapper"><input type='file' name='billing_gewerbenachweis' accept='image/*,.pdf'></span></p>
    
   <?php
       
}
 
// --------------
// 2. Validate new field
 
//add_filter( 'woocommerce_registration_errors', 'bbloomer_validate_woo_account_registration_fields', 10, 3 );
  
function bbloomer_validate_woo_account_registration_fields( $errors, $username, $email ) {
    if ( isset( $_POST['billing_gewerbenachweis'] ) && empty( $_POST['billing_gewerbenachweis'] ) ) {
        $errors->add( 'gewerbenachweis_error', __( 'Please provide a valid gewerbenachweis', 'woocommerce' ) );
    }
    return $errors;
}
 
// --------------
// 3. Save new field
 
//add_action( 'user_register', 'bbloomer_save_woo_account_registration_fields', 1 );
  
function bbloomer_save_woo_account_registration_fields( $customer_id ) {
   if ( isset( $_FILES['billing_gewerbenachweis'] ) ) {
      require_once( ABSPATH . 'wp-admin/includes/image.php' );
      require_once( ABSPATH . 'wp-admin/includes/file.php' );
      require_once( ABSPATH . 'wp-admin/includes/media.php' );
	  
	  add_filter( 'upload_dir', 'wpse_141088_upload_dir' );
		add_filter('intermediate_image_sizes_advanced', 'no_image_resizing');
			add_filter( 'wp_unique_filename', 'custom_image_name', 10, 2 );
			
				$attachment_id = media_handle_upload( 'billing_gewerbenachweis', 0 );
				
			remove_filter( 'wp_unique_filename', 'custom_image_name', 10, 2 );
		remove_filter('intermediate_image_sizes_advanced', 'no_image_resizing');
	  remove_filter( 'upload_dir', 'wpse_141088_upload_dir' );
	  
	  
      if ( is_wp_error( $attachment_id ) ) {
         update_user_meta( $customer_id, 'billing_gewerbenachweis', $_FILES['billing_gewerbenachweis'] . ": " . $attachment_id->get_error_message() );
      } else {
         update_user_meta( $customer_id, 'billing_gewerbenachweis', $attachment_id );
      }
   }
}

function wpse_141088_upload_dir( $dir ) {
    return array(
        'path'   => $dir['basedir'] . '/private',
        'url'    => $dir['baseurl'] . '/private',
        'subdir' => '/private',
    ) + $dir;
}

function no_image_resizing($size) {
	$ret = array();
	return $ret;
}

function custom_image_name( $filename, $ext ) {
    global $postID;
    $post = get_post( $postID );
    return time() .'-'. $filename;
}
			
// --------------
// 4. Add enctype to form to allow image upload
 
//add_action( 'woocommerce_register_form_tag', 'bbloomer_enctype_custom_registration_forms' );
 
function bbloomer_enctype_custom_registration_forms() {
   echo 'enctype="multipart/form-data"';
}


/**
 * @snippet       Change User Role for New Customers - WooCommerce
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WC 3.7
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
  

///////////////////////////////
// 2. ASSIGN NEW ROLE
  
//add_filter( 'woocommerce_new_customer_data', 'bbloomer_assign_custom_role', 10, 1 );
  
function bbloomer_assign_custom_role( $args ) {
  $args['role'] = 'subscriber';
  return $args;
}

function so174837_registration_email_alert( $user_id ) {
    $user    = get_userdata( $user_id );
    $email   = $user->user_email;
    $message = $email . ' has registered to your website.';
    wp_mail( 'info@schungit-grosshandel.com', 'New User registration', $message );
}
//add_action('user_register', 'so174837_registration_email_alert');


/* ----------------------------- */
function my_user_field( $user ) {
    $gender = get_the_author_meta( 'vatid_checked', $user->ID);
?>
    <table class="form-table">
        <tr>
            <th>
                <label for=""><?php _e('Vat ID Checked?'); ?>
            </label></th>
            <td><span class="description"><?php _e(''); ?></span><br>
            <label><input type="radio" name="vatid_checked" <?php if ($gender != 'ja' ) { ?>checked="checked"<?php }?> value="nein">Nein<br /></label>
            <label><input type="radio" name="vatid_checked" <?php if ($gender == 'ja' ) { ?>checked="checked"<?php }?> value="ja">Ja<br /></label>
            </td>
        </tr>
    </table>
<?php 
}


function my_save_custom_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) )
        return FALSE;

    update_usermeta( $user_id, 'vatid_checked', $_POST['vatid_checked'] );
}

//add_action( 'show_user_profile', 'my_user_field' );
//add_action( 'edit_user_profile', 'my_user_field' );
//add_action( 'personal_options_update', 'my_save_custom_user_profile_fields' );
//add_action( 'edit_user_profile_update', 'my_save_custom_user_profile_fields' );


//function change_product_price_html($price){
//  	
//	$newPrice 	 = "";
//  	$newPrice 	.= $price;
//  	$newPrice	.= ' <span class="pricesuffix">inkl. MwSt. <a class="zzglversandkosten" href="/zahlung-und-versand/" target="_blank" style="color:#747474;">zzgl. Versandkosten</a>';
//  
//	return $newPrice;
//}
//  
//add_filter('woocommerce_get_price_html', 'change_product_price_html');


//   add_filter('request', function( $vars ) {
//      global $wpdb;
//      if( ! empty( $vars['pagename'] ) || ! empty( $vars['category_name'] ) || ! empty( $vars['name'] ) || ! empty( $vars['attachment'] ) ) {
//         $slug = ! empty( $vars['pagename'] ) ? $vars['pagename'] : ( ! empty( $vars['name'] ) ? $vars['name'] : ( !empty( $vars['category_name'] ) ? $vars['category_name'] : $vars['attachment'] ) );
//         $exists = $wpdb->get_var( $wpdb->prepare( "SELECT t.term_id FROM $wpdb->terms t LEFT JOIN $wpdb->term_taxonomy tt ON tt.term_id = t.term_id WHERE tt.taxonomy = 'product_cat' AND t.slug = %s" ,array( $slug )));
//         if( $exists ){
//            $old_vars = $vars;
//            $vars = array('product_cat' => $slug );
//            if ( !empty( $old_vars['paged'] ) || !empty( $old_vars['page'] ) )
//               $vars['paged'] = ! empty( $old_vars['paged'] ) ? $old_vars['paged'] : $old_vars['page'];
//            if ( !empty( $old_vars['orderby'] ) )
//               $vars['orderby'] = $old_vars['orderby'];
//            if ( !empty( $old_vars['order'] ) )
//               $vars['order'] = $old_vars['order']; 
//         }
//      }
//      return $vars;
//   });



function custom_cart_totals_order_total_html( $value ){
$value = '<strong>' . WC()->cart->get_total() . '</strong> ';

	// If prices are tax inclusive, show taxes here.
	if ( wc_tax_enabled() && WC()->cart->display_prices_including_tax() ) {
		$tax_string_array = array();
		$cart_tax_totals  = WC()->cart->get_tax_totals();

		if ( get_option( 'woocommerce_tax_total_display' ) === 'itemized' ) {
			
			$tax_19_val = 0;
			foreach ( $cart_tax_totals as $code => $tax ) {
				
				//print_r($tax);
				if($tax->label == 'MwSt. (19%)') {
					$tax_19_val = $tax_19_val + $tax->amount;
				} else {
					$tax_string_array[] = sprintf( '%s %s', $tax->formatted_amount, $tax->label );
				}
			}
			if($tax_19_val > 0) {
				$tax_string_array[] = sprintf( '%s %s', wc_price($tax_19_val), 'MwSt. (19%)' );
			}
			
		} elseif ( ! empty( $cart_tax_totals ) ) {
			$tax_string_array[] = sprintf( '%s %s', wc_price( WC()->cart->get_taxes_total( true, true ) ), WC()->countries->tax_or_vat() );
		}

		if ( ! empty( $tax_string_array ) ) {
			$taxable_address = WC()->customer->get_taxable_address();
			/* translators: %s: country name */
			$estimated_text = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ? sprintf( ' ' . __( 'estimated for %s', 'woocommerce' ), WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] ) : '';
			/* translators: %s: tax information */
			
			$value .= '<br />';
			foreach($tax_string_array as $tax){
				$value .= '<span class="wgm-tax includes_tax">Enthält '.$tax. '</span><br />';
			}
			
			//$value .= '<small class="includes_tax">' . sprintf( __( '(includes %s)', 'woocommerce' ), implode( ', ', $tax_string_array ) . $estimated_text ) . '</small>';
		}
	}
    return $value;
}

add_filter( 'woocommerce_cart_totals_order_total_html', 'custom_cart_totals_order_total_html', 20, 1 ); 


add_action('admin_head', 'admin_only_warnings');

function admin_only_warnings() {

  echo '<style>
    .wp-core-ui .notice.is-dismissible {display:none !important;}
    } 
  </style>';
}


//Product Cat Create page
function wh_taxonomy_add_new_meta_field() {
    ?>
        
    <div class="form-field">
        <label for="wh_meta_title"><?php _e('Meta Title', 'wh'); ?></label>
        <input type="text" name="wh_meta_title" id="wh_meta_title">
        <p class="description"><?php _e('Enter a meta title, <= 60 character', 'wh'); ?></p>
    </div>
    <div class="form-field">
        <label for="wh_meta_desc"><?php _e('Meta Description', 'wh'); ?></label>
        <textarea name="wh_meta_desc" id="wh_meta_desc"></textarea>
        <p class="description"><?php _e('Enter a meta description, <= 160 character', 'wh'); ?></p>
    </div>
    <?php
}

//Product Cat Edit page
function wh_taxonomy_edit_meta_field($term) {

    //getting term ID
    $term_id = $term->term_id;

    // retrieve the existing value(s) for this meta field.
    $wh_meta_desc = get_term_meta($term_id, 'wh_meta_desc', true);
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="wh_meta_desc"><?php _e('Bottom Category Text', 'wh'); ?></label></th>
        <td>
			<?php wp_editor($wh_meta_desc, 'wh_meta_desc'); ?>
            <p class="description"><?php _e('Enter Bottom Category Text', 'wh'); ?></p>
        </td>
    </tr>
    <?php
}

add_action('product_cat_add_form_fields', 'wh_taxonomy_add_new_meta_field', 10, 1);
add_action('product_cat_edit_form_fields', 'wh_taxonomy_edit_meta_field', 10, 1);

// Save extra taxonomy fields callback function.
function wh_save_taxonomy_custom_meta($term_id) {

    $wh_meta_desc = $_POST['wh_meta_desc'];

    update_term_meta($term_id, 'wh_meta_desc', $wh_meta_desc);
}

add_action('edited_product_cat', 'wh_save_taxonomy_custom_meta', 10, 1);
add_action('create_product_cat', 'wh_save_taxonomy_custom_meta', 10, 1);