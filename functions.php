<?php


require_once('vendor/autoload.php');

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Check if WooCommerce is active
 **/
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    require_once 'woo_functions.php';
}
add_action('woocommerce_before_shop_loop_item_title', 'displayWrapStart', 5);
function displayWrapStart()
{
    if (is_product_category('new')) {
?><div class="wrap-new"><?php
                            }
                        }

                        add_action('woocommerce_before_shop_loop_item_title', 'displayNewLabel', 7);
                        function displayNewLabel()
                        {
                            if (is_product_category('new')) {
                                ?><span class="product__label-new"><?php _e('НОВИНКА', 'asti-divi'); ?></span><?php
                                                                                    }
                                                                                }




                                                                                add_action('wp', 'remove_template_loop_product_thumbnail');
                                                                                function remove_template_loop_product_thumbnail()
                                                                                {

                                                                                    if (is_product_category('new')) {
                                                                                        remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
                                                                                    }
                                                                                }



                                                                                add_action('woocommerce_before_shop_loop_item_title', 'displayWrapEnd', 11);
                                                                                function displayWrapEnd()
                                                                                {
                                                                                    if (is_product_category('new')) {
                                                                                        ?></div><?php
                                                                                    }
                                                                                }

                                                                                add_action('woocommerce_before_shop_loop_item_title', 'display_template_loop_product_thumbnail', 12);

                                                                                function display_template_loop_product_thumbnail()
                                                                                {

                                                                                    if (is_product_category('new')) {
                                                                                        add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 12);
                                                                                    }
                                                                                }


                                                                                add_action('woocommerce_after_shop_loop_item', 'displayFavorite', 8);
                                                                                function displayFavorite()
                                                                                {
                                                                                    if (is_product_category('new')) {
                ?>
        <!-- class favorite--active added at the of a button and change text in button -->
        <button class="product__favorite-button favorite--active">
            <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 28C18.8481 27.9995 18.7006 27.9509 18.5806 27.8618C14.7574 25.018 12.1239 22.5692 10.2811 20.1534C7.92947 17.066 7.39313 14.2157 8.68584 11.6814C9.60724 9.87109 12.2545 8.38997 15.3488 9.25232C16.8241 9.66027 18.1113 10.5352 19 11.734C19.8887 10.5352 21.1759 9.66027 22.6512 9.25232C25.7386 8.40314 28.3928 9.87109 29.3142 11.6814C30.6069 14.2157 30.0705 17.066 27.7189 20.1534C25.8761 22.5692 23.2426 25.018 19.4194 27.8618C19.2994 27.9509 19.1519 27.9995 19 28Z" fill="none" />
            </svg>

            <span class="product__favorite-text">

                <!-- or this-->
                <!-- Добавить в список желаний -->

                <!-- or this-->
                Убрать из список желаний

            </span>

        </button><?php
                                                                                    }
                                                                                }
