<?php
/*
  Plugin Name: Remove Cart And Query Button
  Plugin URI: https://tortoizthemes.com/downloads/woo-remove-cart-and-add-inquiry-button/
  Description: This plugin removes add to cart from all products, individual Product, Whole Category. It changes add to cart button to contact us or inquire button. It also hide product Price from Category as well as individual Product. We provide best possible support.
  Requires at least: 4.6
  Tested up to: 5.3.0
  Version: 1.2.1
  Author: Tortoizthemes
  Author URI: https://www.tortoizthemes.com
 */
add_action('product_cat_edit_form_fields', 'remove_cart_inquire_btn_edit_form_fields');
add_action('product_cat_edit_form', 'remove_cart_inquire_btn_edit_form');
add_action('product_cat_add_form_fields', 'remove_cart_inquire_btn_edit_form_fields');
add_action('product_cat_add_form', 'remove_cart_inquire_btn_edit_form');


if (!function_exists('remove_cart_inquire_btn_scripts')) {
    /**
     * Adding JS Script
     */
    function remove_cart_inquire_btn_scripts() {
        echo wp_enqueue_script('inquire-us-and-disable-cart-button', plugin_dir_url(__FILE__) . 'inquire-us-and-disable-cart-button.js');
    }

    add_action('admin_enqueue_scripts', 'remove_cart_inquire_btn_scripts');
}


/**
 * Category Form Edit Callback
 * @param type $tag
 */
if (!function_exists('remove_cart_inquire_btn_edit_form_fields')) {

    function remove_cart_inquire_btn_edit_form_fields($tag) {
        $remove_cart_inquire_btn_category_disable_add_to_cart = 'default';
        $remove_cart_inquire_btn_inqure_us_link = '';
        if (isset($tag->term_id)) {
            $termid = $tag->term_id;
            $remove_cart_inquire_btn_category_disable_add_to_cart = get_option("remove_cart_inquire_btn_category_disable_add_to_cart_{$termid}");
            $remove_cart_inquire_btn_inqure_us_link = get_option("remove_cart_inquire_btn_inqure_us_link_{$termid}");
        } ?>
        <tr class="form-field">
            <th valign="top" scope="row">
                <label for="catpic"><?php esc_html_e('Alter Add to Cart Button', 'woocommerce'); ?></label>
            </th>
            <td>
                <select id="remove_cart_inquire_btn_disable_add_to_cart" name="remove_cart_inquire_btn_category_disable_add_to_cart" class="select short" style="">
                    <option value="default" <?php selected($remove_cart_inquire_btn_category_disable_add_to_cart, 'default'); ?> >Default</option>
                    <option value="remove_button" <?php selected($remove_cart_inquire_btn_category_disable_add_to_cart, 'remove_button'); ?>>Remove Button</option>
                    <option value="inquire_us" <?php selected($remove_cart_inquire_btn_category_disable_add_to_cart, 'inquire_us'); ?>>Query Us</option>
                </select>
                <span class="description"></span>
            </td>
        </tr>
        <tr class="form-field remove_cart_inquire_btn_inqure_us_link_field">
            <th valign="top" scope="row">
                <label for="catpic"><?php esc_html_e('Query Us Link', ''); ?></label>
            </th>
            <td>
                <input type="text" class="short" style="" name="remove_cart_inquire_btn_inqure_us_link" id="remove_cart_inquire_btn_inqure_us_link" value="<?php echo esc_url($remove_cart_inquire_btn_inqure_us_link) ?>" placeholder="http://">
                <span class="description"></span>
            </td>
        </tr>

         <tr class="form-field">
            <th valign="top" scope="row">
                <label for="catpic"><?php esc_html_e('Hide Price', 'woocommerce'); ?></label>
            </th>
            <td>
                <a href="<?php echo esc_url('https://tortoizthemes.com/downloads/woo-remove-cart-and-add-query-button/'); ?>" style="text-decoration: none; color:red;"> <?php esc_html_e('Upgrade Premium Version', 'woocommerce'); ?></a>
            </td>
        </tr>

         <tr class="form-field">
            <th valign="top" scope="row">
                <label for="catpic"><?php esc_html_e('Query Us Text', 'woocommerce'); ?></label>
            </th>
            <td>
               <a href="<?php echo esc_url('https://tortoizthemes.com/downloads/woo-remove-cart-and-add-query-button/'); ?>" style="text-decoration: none; color:red;"> <?php esc_html_e('Upgrade Premium Version', 'woocommerce'); ?></a>
            </td>
        </tr>         

        <tr class="form-field">
            <th valign="top" scope="row">
                <label for="catpic"><?php esc_html_e('Query Us Form Shortcode', 'woocommerce'); ?></label>
            </th>
            <td>
               <a href="<?php echo esc_url('https://tortoizthemes.com/downloads/woo-remove-cart-and-add-query-button/'); ?>" style="text-decoration: none; color:red;"> <?php esc_html_e('Upgrade Premium Version', 'woocommerce'); ?></a>
            </td>
        </tr>
        <?php
    }

}

add_action('edited_product_cat', 'remove_cart_inquire_btn_save_extra_fileds');
add_action('created_product_cat', 'remove_cart_inquire_btn_save_extra_fileds');

/**
 * save extra category extra fields callback function
 * @param type $term_id
 */
if (!function_exists('remove_cart_inquire_btn_save_extra_fileds')) {

    function remove_cart_inquire_btn_save_extra_fileds($term_id) {
        $termid = $term_id;
        if (isset($_POST['remove_cart_inquire_btn_category_disable_add_to_cart'])) {
            $cat_meta = get_option("remove_cart_inquire_btn_category_disable_add_to_cart_{$termid}");
            $disable_update = sanitize_text_field( $_POST['remove_cart_inquire_btn_category_disable_add_to_cart']);
            if ($cat_meta !== false) {
                update_option("remove_cart_inquire_btn_category_disable_add_to_cart_{$termid}", $disable_update);
            } else {
                add_option("remove_cart_inquire_btn_category_disable_add_to_cart_{$termid}", $disable_update, '', 'yes');
            }
        }
        if (isset($_POST['remove_cart_inquire_btn_inqure_us_link'])) {
            $cat_meta = get_option("remove_cart_inquire_btn_inqure_us_link_{$termid}");
            $link_update = sanitize_text_field( $_POST['remove_cart_inquire_btn_inqure_us_link']);
            if ($cat_meta !== false) {
                update_option("remove_cart_inquire_btn_inqure_us_link_{$termid}", $link_update);
            } else {
                add_option("remove_cart_inquire_btn_inqure_us_link_{$termid}", $link_update, '');
            }
        }
    }

}

// when a category is removed
add_filter('deleted_term_taxonomy', 'remove_cart_inquire_btn_remove_tax_Extras');

/**
 * when a category is removed
 * @param type $term_id
 */
if (!function_exists('remove_cart_inquire_btn_remove_tax_Extras')) {

    function remove_cart_inquire_btn_remove_tax_Extras($term_id) {
        $termid = $term_id;
        if ($_POST['taxonomy'] == 'product_cat'):
            if (get_option("remove_cart_inquire_btn_category_disable_add_to_cart_{$termid}"))
                delete_option("remove_cart_inquire_btn_category_disable_add_to_cart_{$termid}");
        endif;
    }

}
add_filter('manage_edit-product_cat_columns', 'remove_cart_inquire_btn_taxonomy_columns_type');
add_filter('manage_product_cat_custom_column', 'remove_cart_inquire_btn_taxonomy_columns_type_manage', 10, 3);

/**
 * Taxonomy Columns Type
 * @param array $columns
 * @return type
 */
if (!function_exists('remove_cart_inquire_btn_taxonomy_columns_type')) {

    function remove_cart_inquire_btn_taxonomy_columns_type($columns) {
        $columns['keywords'] = esc_html__('Detailed Description', 'dd_tax');
        return $columns;
    }

}

/**
 * Columns Type Manage
 * @global type $wp_version
 * @param type $out
 * @param type $column_name
 * @param type $term
 * @return type
 */
if (!function_exists('remove_cart_inquire_btn_taxonomy_columns_type_manage')) {

    function remove_cart_inquire_btn_taxonomy_columns_type_manage($out, $column_name, $term) {
        global $wp_version;

        $out = get_option("remove_cart_inquire_btn_category_disable_add_to_cart_{$term}");
        
        if (((float) $wp_version) < 3.1){
			return $out;
		}
            
        else{
			if($column_name != "thumb" && $column_name !== "handle"){
				echo $out;
			} 
			
		}
            
    }

}

add_action('woocommerce_before_shop_loop_item', 'remove_cart_inquire_btn_replace_add_to_cart');

/**
 * Replacing add to card button
 * @global type $product
 */
if (!function_exists('remove_cart_inquire_btn_replace_add_to_cart')) {

    function remove_cart_inquire_btn_replace_add_to_cart() {
        global $product;
        $link = $product->get_permalink();
        $text = get_post_custom_values('remove_cart_inquire_btn_disable_add_to_cart', $product->get_id());

        $terms = get_the_terms($product->get_id(), 'product_cat');
        $cat_option = 'default';

        if (!empty($terms)) {

            foreach ($terms as $cat) {
            

                if (get_option("remove_cart_inquire_btn_category_disable_add_to_cart_{$cat->term_id}") && get_option("remove_cart_inquire_btn_category_disable_add_to_cart_{$cat->term_id}") != 'Default') {
                    $cat_option = get_option("remove_cart_inquire_btn_category_disable_add_to_cart_{$cat->term_id}");
                }
            }
        }

        if ((!is_null($text) && $text[0] != 'default' ) || $cat_option != 'default') {
            remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
        }
        else{
            add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
        }
    }

}

add_filter( 'woocommerce_loop_add_to_cart_link', 'remove_cart_hide_add_to_cart_link', 10, 2 );
function remove_cart_hide_add_to_cart_link( $html, $product ) {
    $wpiudacb_inqure_us_link = get_post_meta( $product->get_id(), 'wpiudacb_inqure_us_link' );
    $wpiudacb_inqure_us_text = get_post_meta( $product->get_id(), 'wpiudacb_inqure_us_text', true );
    $disable_cart_option = get_post_custom_values( 'wpiudacb_disable_add_to_cart', $product->get_id() );
    $terms = get_the_terms( $product->get_id(), 'product_cat' );
    $cat_option = 'default';
    $cat_inquire_us_link = '';
    $cat_inquire_us_text = '';
    if ( !empty($terms) ) {
        foreach ( $terms as $cat ) {
            if ( get_option( "wpiudacb_category_disable_add_to_cart_{$cat->term_id}" ) && get_option( "wpiudacb_category_disable_add_to_cart_{$cat->term_id}" ) != 'Default' ) {
                $cat_option = get_option( "wpiudacb_category_disable_add_to_cart_{$cat->term_id}" );
                $cat_inquire_us_link = get_option( "wpiudacb_inqure_us_link_{$cat->term_id}" );
                $cat_inquire_us_text = get_option( "wpiudacb_inqure_us_text_field_{$cat->term_id}", "Query Us" );
                $cat_inquire_us_text = ( $wpiudacb_inqure_us_text == '' ? $cat_inquire_us_text : $wpiudacb_inqure_us_text );
            }
            
        }
    }
    $cat_page = get_queried_object();
    if ( get_option( "wpiudacb_category_disable_add_to_cart_{$cat_page->term_id}" ) && get_option( "wpiudacb_category_disable_add_to_cart_{$cat_page->term_id}" ) != 'Default' ) {
        $cat_option = get_option( "wpiudacb_category_disable_add_to_cart_{$cat_page->term_id}" );
        $cat_inquire_us_link = get_option( "wpiudacb_inqure_us_link_{$cat_page->term_id}" );
        $cat_inquire_us_text = get_option( "wpiudacb_inqure_us_text_field_{$cat_page->term_id}", "Query Us" );
        $cat_inquire_us_text = ( $wpiudacb_inqure_us_text == '' ? $cat_inquire_us_text : $wpiudacb_inqure_us_text );
    }
    
    $inquire_us_added = FALSE;
    
    if ( $cat_option != 'default' ) {
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 100 );
        $html = '';
        
        if ( $cat_option == 'inquire_us' ) {
            remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
            $html = '<a href="' . esc_url( $cat_inquire_us_link ) . '"  class="button ">' . $cat_inquire_us_text . '</a>';
            $inquire_us_added = true;
        }
        return $html;
    
    }     
    
    if ( !is_null( $disable_cart_option ) && $disable_cart_option[0] == 'inquire_us' && !$inquire_us_added ) {
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
        $html = '<a href="' . esc_url( $wpiudacb_inqure_us_link[0] ) . '"  class="button ">' . $wpiudacb_inqure_us_text . '</a>';
        return $html;
    }
    return $html;

}

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 100 );

//add_action('woocommerce_after_shop_loop_item', 'remove_cart_inquire_btn_replace_add_to_cart_with_inqure_us_on_listing_page');

/**
 * Adding Query Us button to listing page
 * @global type $product
 */
if (!function_exists('remove_cart_inquire_btn_replace_add_to_cart_with_inqure_us_on_listing_page')) {

    function remove_cart_inquire_btn_replace_add_to_cart_with_inqure_us_on_listing_page() {
        global $product;
        $remove_cart_inquire_btn_inqure_us_link = get_post_meta($product->get_id(), 'remove_cart_inquire_btn_inqure_us_link');

        $disable_cart_option = get_post_custom_values('remove_cart_inquire_btn_disable_add_to_cart', $product->get_id());

        $terms = get_the_terms($product->get_id(), 'product_cat');
        $cat_option = 'default';
        $cat_inquire_us_link = '';
        if (!empty($terms)) {
            foreach ($terms as $cat) {
                if (get_option("remove_cart_inquire_btn_category_disable_add_to_cart_{$cat->term_id}") && get_option("remove_cart_inquire_btn_category_disable_add_to_cart_{$cat->term_id}") != 'Default') {
                    $cat_option = get_option("remove_cart_inquire_btn_category_disable_add_to_cart_{$cat->term_id}");
                    $cat_inquire_us_link = get_option("remove_cart_inquire_btn_inqure_us_link_{$cat->term_id}");
                }
            }
        }
        $inquire_us_added = FALSE;
        if ($cat_option != 'default') {
            remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
            if ($cat_option == 'inquire_us') {
                remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
                echo do_shortcode('<a href="' . esc_url($cat_inquire_us_link) . '" target="_blank" class="button ">Query Us</a>');
                $inquire_us_added = true;
            }
        }
        if (!is_null($disable_cart_option) && $disable_cart_option[0] == 'inquire_us' && !$inquire_us_added) {
            remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
            echo do_shortcode('<a href="' . esc_url($remove_cart_inquire_btn_inqure_us_link[0]) . '" target="_blank" class="button ">Query Us</a>');
        }
    }

}

/* remove add-to-cart from single product  page for product author  */
add_action('woocommerce_before_single_product_summary', 'remove_cart_inquire_btn_user_filter_addtocart_for_single_product_page');

/**
 * Appling Filter on single product page
 * @global type $product
 */
function remove_cart_user_woocommerce_before_add_to_cart_button(  ) { 
    echo '<div style="display: none;">';
}
function remove_cart_user_woocommerce_after_add_to_cart_button(  ) { 
    echo '</div>';
}

/**
 * Appling Filter on single product page
 * @global type $product
 */
if (!function_exists('remove_cart_inquire_btn_user_filter_addtocart_for_single_product_page')) {

    function remove_cart_inquire_btn_user_filter_addtocart_for_single_product_page() {
        global $product;
        global $post;
        $terms = get_the_terms($product->get_id(), 'product_cat');
        $cat_option = 'default';
        $cat_inquire_us_link = '';
        if (!empty($terms)) {
            foreach ($terms as $cat) {
                if (get_option("remove_cart_inquire_btn_category_disable_add_to_cart_{$cat->term_id}") && get_option("remove_cart_inquire_btn_category_disable_add_to_cart_{$cat->term_id}") != 'Default') {
                    $cat_option = get_option("remove_cart_inquire_btn_category_disable_add_to_cart_{$cat->term_id}");
                    $cat_inquire_us_link = get_option("remove_cart_inquire_btn_inqure_us_link_{$cat->term_id}");
                }
            }
        }
        if ($cat_option != 'default') {
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
            
            add_action( 'woocommerce_before_add_to_cart_button', 'remove_cart_user_woocommerce_before_add_to_cart_button', 10, 0 ); 
            add_action( 'woocommerce_after_add_to_cart_button', 'remove_cart_user_woocommerce_after_add_to_cart_button', 10, 0 ); 
            if ($cat_option == 'inquire_us') {
                $product->inqure_us_url = $cat_inquire_us_link;
                add_action('woocommerce_single_product_summary', 'remove_cart_inquire_btn_add_inqure_us_button');
            }
        }
        else{
            add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
        }
        $text = get_post_custom_values('remove_cart_inquire_btn_disable_add_to_cart', $product->get_id());
        if (!is_null($text) && $text[0] != 'default') {

        	add_action( 'woocommerce_before_add_to_cart_button', 'remove_cart_user_woocommerce_before_add_to_cart_button', 10, 0 ); 
        	add_action( 'woocommerce_after_add_to_cart_button', 'remove_cart_user_woocommerce_after_add_to_cart_button', 10, 0 ); 
        	
        	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
        }
        if (!is_null($text) && $text[0] == 'inquire_us') {
            $remove_cart_inquire_btn_inqure_us_link = get_post_meta($post->ID, 'remove_cart_inquire_btn_inqure_us_link');
            $product->inqure_us_url = $remove_cart_inquire_btn_inqure_us_link[0];
            add_action('woocommerce_single_product_summary', 'remove_cart_inquire_btn_add_inqure_us_button');
        }
    }

}

/**
 * Add Query Us Button
 * @global type $post
 */
if (!function_exists('remove_cart_inquire_btn_add_inqure_us_button')) {

    function remove_cart_inquire_btn_add_inqure_us_button($as) {
        global $post;
        global $product;
        echo '<a href="' . esc_url($product->inqure_us_url) . '" target="_blank"> <button type="button" class="button alt">Query Us</button></a>';
    }

}
// add_action('woocommerce_product_options_general_product_data', 'woocommerce_general_product_data_custom_field');

/**
 * Product Data Custom Field
 * @global type $woocommerce
 * @global type $post
 */
if (!function_exists('woocommerce_general_product_data_custom_field')) {


    function woocommerce_general_product_data_custom_field() {
        global $woocommerce, $post;
        echo '<div class="options_group">';
        woocommerce_wp_select(
                array(
                    'id' => 'remove_cart_inquire_btn_disable_add_to_cart',
                    'label' => esc_html__('Alter Add to Cart Button', 'woocommerce'),
                    'options' => array(
                        'default' => esc_html__('Default', 'woocommerce'),
                        'remove_button' => esc_html__('Remove Button', 'woocommerce'),
                        'inquire_us' => esc_html__('Query Us', 'woocommerce')
                    )
                )
        );
        woocommerce_wp_text_input(
                array(
                    'id' => 'remove_cart_inquire_btn_inqure_us_link',
                    'label' => esc_html__('Query Us Link', 'woocommerce'),
                    'placeholder' => 'http://',
                    'desc_tip' => 'true',
                    'description' => esc_html__('Enter the URL to Query Us button.', 'woocommerce'),
                    'value' => get_post_meta($post->ID, 'remove_cart_inquire_btn_inqure_us_link', true)
                )
        );

        echo '</div>';
    }

}

// Save Fields using WooCommerce Action Hook
add_action('woocommerce_process_product_meta', 'woocommerce_process_product_meta_fields_save');

/**
 * Product Meta Fields Save
 * @param type $post_id
 */
if (!function_exists('woocommerce_process_product_meta_fields_save')) {

    function woocommerce_process_product_meta_fields_save($post_id) {
        $disable_carts = sanitize_text_field( $_POST['remove_cart_inquire_btn_disable_add_to_cart']);

        $remove_cart_inquire_btn_disable_add_to_cart = isset($_POST['remove_cart_inquire_btn_disable_add_to_cart']) ? $disable_carts : 'Default';

        update_post_meta($post_id, 'remove_cart_inquire_btn_disable_add_to_cart', $remove_cart_inquire_btn_disable_add_to_cart);

        $disable_links = sanitize_text_field( $_POST['remove_cart_inquire_btn_inqure_us_link']);

        $remove_cart_inquire_btn_inqure_us_link = isset($_POST['remove_cart_inquire_btn_inqure_us_link']) ? $disable_links : '';
        update_post_meta($post_id, 'remove_cart_inquire_btn_inqure_us_link', $remove_cart_inquire_btn_inqure_us_link);
    }

}

/**
 * Edit Callback
 */
if (!function_exists('remove_cart_inquire_btn_edit_form')) {

    function remove_cart_inquire_btn_edit_form() {
        
    }

}

/*
 * Edit - 11/12/2017
 * By Figarts - https://figarts.co
 */

// First Register the Tab by hooking into the 'woocommerce_product_data_tabs' filter
function remove_cart_inquire_btn_remove_cart_data_tab( $product_data_tabs ) {
    $product_data_tabs['remove_cart_inquire_btn-cart'] = array(
        'label' => esc_html__( 'Remove Cart Button', 'woocommerce' ),
        'target' => 'remove_cart_inquire_btn_remove_cart_button',
        'class'   => array( 'show_if_remove_cart_inquire_btn_remove_cart_button'  ),
    );
    return $product_data_tabs;
}
add_filter( 'woocommerce_product_data_tabs', 'remove_cart_inquire_btn_remove_cart_data_tab' );

/**
 * Contents of the drug options product tab.
 */
function remove_cart_inquire_btn_remove_cart_data_content() {
    global $post;
    ?><div id='remove_cart_inquire_btn_remove_cart_button' class='panel woocommerce_options_panel'><?php
        ?><div class='options_group'><?php
            
        woocommerce_wp_select(
          array(
            'id' => 'remove_cart_inquire_btn_disable_add_to_cart',
            'label' => esc_html__('Alter Add to Cart Button', 'woocommerce'),
            'options' => array(
                'default' => esc_html__('Default', 'woocommerce'),
                'remove_button' => esc_html__('Remove Button', 'woocommerce'),
                'inquire_us' => esc_html__('Query Us', 'woocommerce')
            )
          )
        );
        woocommerce_wp_text_input(
          array(
            'id' => 'remove_cart_inquire_btn_inqure_us_link',
            'label' => esc_html__('Query Us Link', 'woocommerce'),
            'placeholder' => 'http://',
            'desc_tip' => 'true',
            'description' => esc_html__('Enter the URL to Query Us button.', 'woocommerce'),
            'value' => get_post_meta($post->ID, 'remove_cart_inquire_btn_inqure_us_link', true)
          )
        ); ?>
            
        <p class="form-field remove_cart_inquire_btn_inqure_us_link_field ">
        <label for="remove_cart_inquire_btn_inqure_us_link"><?php echo esc_html__( 'Hide Price', 'woocommerce' ); ?></label> <a href="<?php echo esc_url('https://www.tortoizthemes.com/woo-remove-cart-and-query-button'); ?>" style="text-decoration: none; color:red;"><?php echo esc_html__( 'Upgrade Premium Version', 'woocommerce' ); ?></a> </p>
        <p class="form-field remove_cart_inquire_btn_inqure_us_link_field ">
        <label for="remove_cart_inquire_btn_inqure_us_link"><?php echo esc_html__('Query Us Text', 'woocommerce'); ?></label><a href="<?php echo esc_url('https://www.tortoizthemes.com/woo-remove-cart-and-query-button'); ?>" style="text-decoration: none; color:red;"><?php echo esc_html__( 'Upgrade Premium Version', 'woocommerce' ); ?></a> </p>        
        <p class="form-field remove_cart_inquire_btn_inqure_us_link_field ">
        <label for="remove_cart_inquire_btn_inqure_us_link"><?php echo esc_html__('Query Us Form Shortcode', 'woocommerce'); ?></label><a href="<?php echo esc_url('https://www.tortoizthemes.com/woo-remove-cart-and-query-button'); ?>" style="text-decoration: none; color:red;"><?php echo esc_html__( 'Upgrade Premium Version', 'woocommerce' ); ?></a> </p>
        </div>

    </div><?php
}
add_action( 'woocommerce_product_data_panels', 'remove_cart_inquire_btn_remove_cart_data_content' );


function remove_cart_inquire_btn_custom_css() {
  // if ( class_exists('WooCommerce') && is_product()) {
    # code...
    echo '<style>#woocommerce-product-data ul.wc-tabs li.remove_cart_inquire_btn-cart_options a::before {
    font-family: Dashicons;
    content: "\f174";
    }</style>';
  // }
}
add_action('admin_head', 'remove_cart_inquire_btn_custom_css');

/*ENDS FIGARTS customizations*/
