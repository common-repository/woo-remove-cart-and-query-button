/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery(function(){
    "use strict";
    if( jQuery('#remove_cart_inquire_btn_disable_add_to_cart').val() != 'inquire_us' ){
        jQuery('.remove_cart_inquire_btn_inqure_us_link_field').hide();
    }
    jQuery('#remove_cart_inquire_btn_disable_add_to_cart').change(function(){
        if(jQuery(this).val() == 'inquire_us'){
            jQuery('.remove_cart_inquire_btn_inqure_us_link_field').fadeIn();
        }else{
            jQuery('.remove_cart_inquire_btn_inqure_us_link_field').fadeOut();
        }
    });
});