<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// autoload Classes
require_once('vendor/autoload.php');


// includes CONSTANS
require_once "constants/constans.php";
// autoload Classes

use AstiDivi\Classes\GeneralClasses;


//$free_shop_amount = new WC_Shipping_Free_Shipping(1);
$GeneralClasses = new GeneralClasses(new WC_Shipping_Free_Shipping(1));


//Add checked on checkout page to terms privacy policy
add_filter('woocommerce_terms_is_checked_default',  array( $GeneralClasses, 'termsChecked' ) );


// display attributes in  menu
add_filter('woocommerce_attribute_show_in_nav_menus', array( $GeneralClasses, 'attrForMenus' ), 1, 2);

add_action('woocommerce_before_shop_loop', 'addHtmlBeforeSelect', 21 );
function addHtmlBeforeSelect() {
    ?>
<button class="mobile__btn-filter">
      <span class="mobile__btn-filter-icon">
      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="M3 5a1 1 0 0 1 1-1h12a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1ZM3 10a1 1 0 0 1 1-1h12a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1ZM3 15a1 1 0 0 1 1-1h6a1 1 0 0 1 0 2H4a1 1 0 0 1-1-1Z"
        fill="#011350" />
</svg>
      </span>

      Фильтры
</button>
    <?php
}
