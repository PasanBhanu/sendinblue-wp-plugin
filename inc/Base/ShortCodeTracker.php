<?php 
/**
 * @package  SendinBlueWPPlugin
 */
namespace Inc\Base;
use Inc\Base\BaseController;
/**
* 
*/
class ShortCodeTracker extends BaseController
{
    // Register Hooks
	public function register(){
        add_shortcode( 'sb-tracker', array( $this, 'tracker_code_js' ) );
        add_filter ('the_content', array( $this, 'site_tracker' ));
    }

    // Add JS Tracker to each page
    public function site_tracker($content) {
        if (is_single() or is_page()){
            $api_key = esc_attr( get_option( 'sbwp_api_key' ) );

            $js = '
            <script type="text/javascript">
                (function() {
                    window.sib = { equeue: [], client_key: "' . $api_key . '" };
                    window.sib.email_id = "' . wp_get_current_user()->user_email . '";
                    window.sendinblue = {}; for (var j = ["track", "identify", "trackLink", "page"], i = 0; i < j.length; i++) { (function(k) { window.sendinblue[k] = function() { var arg = Array.prototype.slice.call(arguments); (window.sib[k] || function() { var t = {}; t[k] = arg; window.sib.equeue.push(t);})(arg[0], arg[1], arg[2]);};})(j[i]);}var n = document.createElement("script"),i = document.getElementsByTagName("script")[0]; n.type = "text/javascript", n.id = "sendinblue-js", n.async = !0, n.src = "https://sibautomation.com/sa.js?key=" + window.sib.client_key, i.parentNode.insertBefore(n, i), window.sendinblue.page();
                })();
            </script>';
        }
        $content = $js . $content;
        return $content;
    }

    // Add shortcode tracker
    public function tracker_code_js($atts = [], $content = null, $tag=''){
        ob_start();

        $js = "";
        $atts = array_change_key_case((array)$atts, CASE_LOWER);

        $atts_sample = array();
        foreach ($atts as $key => $value) {
            $atts_sample[$key] = '';
        }
        $wporg_atts = shortcode_atts($atts_sample, $atts, $tag);

        // Load Data
        $api_key = esc_attr( get_option( 'sbwp_api_key' ) );
        $current_user = wp_get_current_user();
        $user =array(
            "FIRSTNAME" => $current_user->user_firstname,
            "LASTNAME" => $current_user->user_lastname,
        );
        // Data Array
        $data = array();

        // Get Other Data
        if (!isset ($wporg_atts['data'])){$wporg_atts['data'] = '';}
        if (!isset($wporg_atts['type'])){$wporg_atts['type'] = 'identify';}

        foreach ($wporg_atts as $key => $value) {
            if ($key != 'data' or $key != 'type'){
                $data[$key] = $value;
            }
        }

        // Request
        if ($wporg_atts['type'] == 'identify'){
            $js = "sendinblue.identify('" . $current_user->user_email . "', " . json_encode($data) . ")";
        }else if($wporg_atts['type'] == 'page'){
            $js = "sendinblue.page('" . $wporg_atts['data'] . "', " . json_encode($data) . ")";
        }else if($wporg_atts['type'] == 'track'){
            $js = "sendinblue.track('" . $wporg_atts['data'] . "', " . json_encode($user) . " , " . json_encode($data) . ")";
        }else if($wporg_atts['type'] == 'link'){
            $js = "sendinblue.trackLink('" . $wporg_atts['data'] . "', " . json_encode($data) . ")";
        }else if($wporg_atts['type'] == 'product'){
            if (!isset($data['p-id'])) {$data['p-id'] = 0;}
            if (!isset($data['p-name'])) {$data['p-name'] = '';}
            if (!isset($data['p-amount'])) {$data['p-amount'] = 1;}
            if (!isset($data['p-price'])) {$data['p-price'] = 0;}
            $product = array(
                "product_id" => (int)$data['p-id'],
                "product_name" => $data['p-name'],
                "amount" => (int)$data['p-amount'],
                "price" => (int)$data['p-price'],
            );
            $products = array(
                "data" => array(
                    "products" => array(
                        $product
                    )
                )
            );
            $js = "sendinblue.track('" . $wporg_atts['data'] . "', " . json_encode($user) . "," . json_encode($products) . ")";
        }else if($wporg_atts['type'] == 'cart'){
            global $woocommerce;
            if (isset($woocommerce)){
                $items = $woocommerce->cart->get_cart();
                $amount = floatval( preg_replace( '#[^\d.]#', '', $woocommerce->cart->get_cart_total() ) );
                $product_arr = array();
                // Get Cart Items
                foreach($items as $item => $values) { 
                    $_product =  wc_get_product( $values['data']->get_id() );
                    // Get Categories
                    $terms = get_the_terms( $values['data']->get_id(), 'product_cat' );
                    $categories = "";
                    foreach ($terms as $term) {
                        $categories .= " " . $term->name;
                    }
                    $categories = ltrim($categories," ");
                    // Make Product Data
                    $product = array(
                        "product_id" => (int)$values['data']->get_id(),
                        "product_name" => $_product->get_title(),
                        "amount" => (int)$values['quantity'],
                        "price" => (int)get_post_meta($values['product_id'] , '_regular_price', true),
                        "category" => $categories,
                    );
                    array_push($product_arr,$product);
                }
                $products = array(
                    "data" => array(
                        "products" => $product_arr,
                        "amount" => $amount
                    )
                );
                $js = "sendinblue.track('" . $wporg_atts['data'] . "', " . json_encode($user) . "," . json_encode($products) . ")";
            }
        }
        ?>
        <script type="text/javascript">
        (function() {
            <?php echo $js; ?>
        })();
        </script>
        <?php
        return ob_get_clean();
    } 
}