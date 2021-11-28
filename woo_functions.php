<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// autoload Classes
require_once('vendor/autoload.php');


// includes CONSTANS
require_once "constants/constans.php";
// autoload Classes

use AstiDivi\Classes\GeneralClasses;
use AstiDivi\Classes\CustomEnqueueStyles;

$custom_style = new CustomEnqueueStyles();

$GeneralClasses = new GeneralClasses(new WC_Shipping_Free_Shipping(1));


//Add checked on checkout page to terms privacy policy
add_filter('woocommerce_terms_is_checked_default',  array($GeneralClasses, 'termsChecked'));


// display attributes in  menu
add_filter('woocommerce_attribute_show_in_nav_menus', array($GeneralClasses, 'attrForMenus'), 1, 2);



add_action('woocommerce_before_shop_loop', 'addHtmlBeforeSelect', 21);
function addHtmlBeforeSelect()
{
    //        if ( is_product_category('new' ) ) {
?>
    <button class="mobile__btn-filter">
        <span class="mobile__btn-filter-icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M3 5a1 1 0 0 1 1-1h12a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1ZM3 10a1 1 0 0 1 1-1h12a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1ZM3 15a1 1 0 0 1 1-1h6a1 1 0 0 1 0 2H4a1 1 0 0 1-1-1Z" fill="#011350" />
            </svg>
        </span><?php _e('Фильтры', 'asti-divi'); ?>
    </button>
    <?php
    //        }

}

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
add_action('woocommerce_before_main_content', 'displayHeaderBanner', 25);

function displayHeaderBanner()
{
    if (is_product_category() || is_shop() || is_product_taxonomy()) {
        global $custom_style;
        $new =  get_term_by('slug', 'new', 'product_cat');
    ?>
        <div class="banner-img">
            <div class="banner-img__inner">
                <img src="<?php $custom_style->theImgPath(); ?>banner.jpg" alt="<?php echo $new->name; ?>">
            </div>
        </div>
    <?php
    }
}


function get_cart_total()
{
    if (!class_exists('woocommerce') || !WC()->cart) {
        return;
    }
    return WC()->cart->get_cart_contents_count();
}



add_action('woocommerce_before_shop_loop_item_title', 'displayWrapStart', 5);
function displayWrapStart()
{
    //    if ( is_product_category('new' ) ) {
    ?><div class="wrap-new"><?php
                            //    }
                        }

                        add_action('woocommerce_before_shop_loop_item_title', 'displayNewLabel', 7);
                        function displayNewLabel()
                        {
                            //    if ( is_product_category('new' ) ) {
                            ?><span class="product__label-new"><?php _e('НОВИНКА', 'asti-divi'); ?></span><?php
                                                                                                                //    }
                                                                                                            }

                                                                                                            //add_action( 'wp', 'remove_template_loop_product_thumbnail' );
                                                                                                            add_action('woocommerce_before_shop_loop_item_title', 'remove_template_loop_product_thumbnail', 9);
                                                                                                            function remove_template_loop_product_thumbnail()
                                                                                                            {
                                                                                                                //    if ( is_product_category('new' ) ) {
                                                                                                                remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
                                                                                                                //    }
                                                                                                            }

                                                                                                            add_action('woocommerce_before_shop_loop_item_title', 'displayWrapEnd', 11);
                                                                                                            function displayWrapEnd()
                                                                                                            {
                                                                                                                //    if ( is_product_category('new' ) ) {
                                                                                                                ?></div><?php
                                                                                                                //    }
                                                                                                            }

                                                                                                            add_action('woocommerce_before_shop_loop_item_title', 'display_template_loop_product_thumbnail', 11);
                                                                                                            function display_template_loop_product_thumbnail()
                                                                                                            {
                                                                                                                //    if ( is_product_category('new' ) ) {
                                                                                                                add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 12);
                                                                                                                //    }
                                                                                                            }

                                                                                                            add_action('woocommerce_after_shop_loop_item', 'displayFavorite', 8);
                                                                                                            function displayFavorite()
                                                                                                            {
                                                                                                                //    if ( is_product_category('new' ) ) {
                                                                                                ?>
    <!-- class favorite--active added at the of a button and change text in button -->
    <button class="product__favorite-button favorite--active">
        <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M19 28C18.8481 27.9995 18.7006 27.9509 18.5806 27.8618C14.7574 25.018 12.1239 22.5692 10.2811 20.1534C7.92947 17.066 7.39313 14.2157 8.68584 11.6814C9.60724 9.87109 12.2545 8.38997 15.3488 9.25232C16.8241 9.66027 18.1113 10.5352 19 11.734C19.8887 10.5352 21.1759 9.66027 22.6512 9.25232C25.7386 8.40314 28.3928 9.87109 29.3142 11.6814C30.6069 14.2157 30.0705 17.066 27.7189 20.1534C25.8761 22.5692 23.2426 25.018 19.4194 27.8618C19.2994 27.9509 19.1519 27.9995 19 28Z" fill="none" />
        </svg>
        <span class="product__favorite-text">
            <!-- or this-->
            Добавить в список желаний
            <!-- or this-->
            <!--                            Убрать из список желаний-->
        </span>
    </button><?php
                                                                                                                //    }
                                                                                                            }

                                                                                                            add_action('woocommerce_after_shop_loop_item', 'displayCartWrapStart', 7);
                                                                                                            function displayCartWrapStart()
                                                                                                            {
                                                                                                                //    if ( is_product_category('new' ) ) {
                ?><div class="wrappefr-slide"><?php
                                                                                                                //    }
                                                                                                            }

                                                                                                            add_action('woocommerce_after_shop_loop_item', 'displayCountToCart', 8);
                                                                                                            function displayCountToCart()
                                                                                                            {
                                                                                                                //    if ( is_product_category('new' ) ) {
                                                ?>
        <div class="product-card__quantity">
            <form>
                <button type="button" data-quantity-minus class="product-card__quantity-minus">-</button>
                <label>
                    <input data-quantity-input type="text" value="1">
                </label>
                <button type="button" data-quantity-plus class="product-card__quantity-plus">+</button>
            </form>
        </div>


    <?php
                                                                                                                //    }
                                                                                                            }


                                                                                                            add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 11);




                                                                                                            add_action('woocommerce_after_shop_loop_item', 'displayCartWrapEnd', 15);
                                                                                                            function displayCartWrapEnd()
                                                                                                            {
                                                                                                                //    if ( is_product_category('new' ) ) {
    ?>
    </div><?php
                                                                                                                //    }
                                                                                                            }

                                                                                                            //add_filter( 'woocommerce_loop_add_to_cart_link', 'quantity_inputs_for_woocommerce_loop_add_to_cart_link', 10, 2 );
                                                                                                            /**
                                                                                                             * Override loop template and show quantities next to add to cart buttons
                                                                                                             * @link https://gist.github.com/mikejolley/2793710
                                                                                                             */
                                                                                                            function quantity_inputs_for_woocommerce_loop_add_to_cart_link($html, $product)
                                                                                                            {
                                                                                                                if (is_user_logged_in() && is_shop() || is_product_category() && $product && $product->is_type('simple') && $product->is_purchasable() && $product->is_in_stock() && !$product->is_sold_individually()) {
                                                                                                                    $html = '<form action="' . esc_url($product->add_to_cart_url()) . '" class="cart" method="post" enctype="multipart/form-data">';
                                                                                                                    $html .= woocommerce_quantity_input(array(), $product, false);
                                                                                                                    $html .= '<button type="submit" class="button alt">' . esc_html($product->add_to_cart_text()) . '</button>';
                                                                                                                    $html .= '</form>';
                                                                                                                }
                                                                                                                //    return $html;
                                                                                                            }


                                                                                                            /**
                                                                                                             * Remove product content based on category
                                                                                                             */
                                                                                                            //add_action( 'wp', 'remove_product_content' );
                                                                                                            function remove_product_content()
                                                                                                            {

                                                                                                                //    if ( is_product_category('new' ) ) {
                                                                                                                remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
                                                                                                                //    }

                                                                                                                //    // If a product in the 'Cookware' category is being viewed…
                                                                                                                //    if ( is_product() && has_term( 'Cookware', 'product_cat' ) ) {
                                                                                                                //        //… Remove the images
                                                                                                                //        remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
                                                                                                                //        // For a full list of what can be removed please see woocommerce-hooks.php
                                                                                                                //    }
                                                                                                            }

                                                                                                            //add_action('woocommerce_shop_loop', 'displayProductExample');
                                                                                                            function displayProductExample()
                                                                                                            {
                                                                                                                if (is_product_category('new')) {
            ?> <li style="position:relative" class="product type-product post-1760 status-publish first outofstock
                      product_cat-asti-secco product_cat-asti-dolce product_tag-acquesi
                    product_tag-secco product_tag-akujezi product_tag-asti product_tag-italija
                    product_tag-sekko product_tag-shampanskoe has-post-thumbnail shipping-taxable purchasable product-type-simple">
            <a href="/spumante/acquesi-asti-secco-docg" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><span class="et_shop_image"><img width="300" height="300" src="/wp-content/uploads/2018/08/Acquesi-asti-secco-docg-min-300x300.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="Acquesi Asti Secco DOCG Купить Шампанское Асти Акуэзи Секко цена Италия" loading="lazy" srcset="/wp-content/uploads/2018/08/Acquesi-asti-secco-docg-min-300x300.jpg 300w, http://dima.site/wp-content/uploads/2018/08/Acquesi-asti-secco-docg-min-150x150.jpg 150w, http://dima.site/wp-content/uploads/2018/08/Acquesi-asti-secco-docg-min.jpg 600w, http://dima.site/wp-content/uploads/2018/08/Acquesi-asti-secco-docg-min-100x100.jpg 100w" sizes="(max-width: 300px) 100vw, 300px"><span class="et_overlay"></span></span>
                <h2 class="woocommerce-loop-product__title">Шампанское Acquesi Asti Secco DOCG Асти Акуэзи Секко
                    Италия купить, спец цена</h2>

                <span class="product__country-name">Италия, 0.75 L</span>
                <div class="product__bottom">
                    <span class="product__availability">В наличии</span>

                    <span class="price">
                        <span class="product__old-price">289 грн.</span>
                        <span class="woocommerce-Price-amount amount"><bdi>300&nbsp;<span class="woocommerce-Price-currencySymbol">грн.</span></bdi></span></span>

                </div>
            </a>
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

            </button>

            <span class="product__label-new">
                НОВИНКА
            </span>

            <div class="wrappefr-slide">

                <div class="product-card__quantity">
                    <form>
                        <button type="button" class="product-card__quantity-minus">-</button>
                        <label>
                            <input type="text" value="1">
                        </label>
                        <button type="button" class="product-card__quantity-plus">+</button>
                    </form>
                </div>

                <a href="/spumante/acquesi-asti-secco-docg" rel="nofollow" data-product_id="1760" class="button add_to_cart_button product_type_simple">Купить</a>
            </div>
        </li>
<?php
                                                                                                                }
                                                                                                            }
