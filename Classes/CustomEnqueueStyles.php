<?php

namespace AstiDivi\Classes;

class CustomEnqueueStyles
{

    protected $temp_dir;
    protected $css_dir;
    protected $js_dir;




    public function __construct($img_temp_dir = '/assets/images/', $css_dir = '/assets/style/', $js_dir = '/assets/js/')
    {
        $this->temp_dir = get_stylesheet_directory_uri();
        $this->img_temp_dir = get_stylesheet_directory_uri() . $img_temp_dir;
        $this->css_dir = get_stylesheet_directory_uri() . $css_dir;
        $this->js_dir = get_stylesheet_directory_uri() . $js_dir;

        add_action('wp_enqueue_scripts', array($this, 'addCartScript'));
        add_action('wp_enqueue_scripts', array($this, 'deleteScript'));
        add_action('wp_enqueue_scripts', array($this, 'addStyle'), 200);
    }

    public function loadJS($js_paths, $pref = '')
    {
        if ($pref !== '') {
            $pref = '-' . $pref;
        }
        foreach ($js_paths as $js_path) {
            wp_enqueue_script($js_path . $pref,  $this->js_dir . $js_path . '.js', [], false, true);
        }
    }

    public function addStyle()
    {

        //CSS
        $css_paths = ['main'];
        foreach ($css_paths as $css_path) {
            wp_enqueue_style($css_path,  $this->css_dir . $css_path . '.css', array());
        }

        //JS
        $this->loadJS(['main.min']);
    }

    public function getImgPath()
    {
        return $this->img_temp_dir;
    }

    public function theImgPath()
    {
        echo $this->getImgPath();
    }

    public function deleteScript()
    {
        if (is_cart()) {
            wp_dequeue_script('wc-cart');
        }
    }

    public function addCartScript()
    {
        //    case 'wc-cart':
        $params = array(
            'ajax_url'                     => WC()->ajax_url(),
            'wc_ajax_url'                  => \WC_AJAX::get_endpoint('%%endpoint%%'),
            'update_shipping_method_nonce' => wp_create_nonce('update-shipping-method'),
            'apply_coupon_nonce'           => wp_create_nonce('apply-coupon'),
            'remove_coupon_nonce'          => wp_create_nonce('remove-coupon'),
        );
        //
        $js_path = 'cart';
        if (is_cart()) {
            wp_enqueue_script(
                $js_path,
                $this->js_dir . $js_path . '.js',
                array('jquery', 'woocommerce', 'wc-country-select', 'wc-address-i18n'),
                false,
                true
            );

            wp_localize_script($js_path, 'wc_cart_params', $params);
        }
    }



    public function custom_manage_woo_styles()
    {
        // Disable default CF7 CSS
        // divi-style
        //add_filter( 'wpcf7_load_css', '__return_false' );


        if (function_exists('is_woocommerce')) {

            if (!is_front_page() && !is_page() && !is_woocommerce() && !is_cart() && !is_checkout() && !is_account_page() || is_page('brands')) {

                //                wp_dequeue_style( 'woocommerce-layout' );
                //                wp_dequeue_style( 'woocommerce-smallscreen' );
                //                wp_dequeue_style( 'woocommerce-general' );
                wp_dequeue_style('evolution-woostyles');
                wp_dequeue_script('wc_price_slider');
                wp_dequeue_script('wc-single-product');
                wp_dequeue_script('wc-add-to-cart');
                wp_dequeue_script('wc-cart-fragments');
                wp_dequeue_script('wc-checkout');
                wp_dequeue_script('wc-add-to-cart-variation');
                //                wp_dequeue_script( 'wc-single-product' );
                wp_dequeue_script('wc-cart');
                wp_dequeue_script('wc-chosen');
                wp_dequeue_script('woocommerce');
                wp_dequeue_script('prettyPhoto');
                wp_dequeue_script('prettyPhoto-init');
                wp_dequeue_script('jquery-blockui');
                wp_dequeue_script('jquery-placeholder');
                wp_dequeue_script('fancybox');
                wp_dequeue_script('jqueryui');
            }
        }
    }


    public function add_mobile_search()
    {

        if (is_shop() || is_archive() ||  is_front_page()) {
?>
            <div class="search-mobile">
                <form role="search" method="get" class="et-search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <?php
                    printf(
                        '<input type="search" class="et-search-field" placeholder="%1$s" value="%2$s" name="s" title="%3$s" />',
                        esc_attr__('Search &hellip;', 'Divi'),
                        get_search_query(),
                        esc_attr__('Search for:', 'Divi')
                    );
                    ?>
                </form>
            </div>
<?php }
    }
}
