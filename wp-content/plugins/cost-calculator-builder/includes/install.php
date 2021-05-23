<?php
function ccb_add_nonces()
{
    $variables = array(
        'ccb_paypal'        => wp_create_nonce( 'ccb_paypal' ),
        'ccb_stripe'        => wp_create_nonce( 'ccb_stripe' ),
        'ccb_contact_form'  => wp_create_nonce( 'ccb_contact_form' ),
        'ccb_woo_checkout'   => wp_create_nonce( 'ccb_woo_checkout' ),
    );
    echo( '<script type="text/javascript">window.ccb_nonces = ' . json_encode( $variables ) . ';</script>' );
}

function ccb_add_admin_nonces()
{
    $variables = array(
        'ccb_ajax_add_review'   => wp_create_nonce( 'ccb_ajax_add_review' ),
        'ccb_create_id'         => wp_create_nonce( 'ccb_create_id' ),
        'ccb_edit_calc'         => wp_create_nonce( 'ccb_edit_calc' ),
        'ccb_delete_calc'       => wp_create_nonce( 'ccb_delete_calc' ),
        'ccb_save_custom'       => wp_create_nonce( 'ccb_save_custom' ),
        'ccb_get_existing'      => wp_create_nonce( 'ccb_get_existing' ),
        'ccb_save_settings'     => wp_create_nonce( 'ccb_save_settings' ),
        'ccb_duplicate_calc'    => wp_create_nonce( 'ccb_duplicate_calc' ),
        'ccb_demo_import_apply' => wp_create_nonce( 'ccb_demo_import_apply' ),
        'ccb_demo_import_run'   => wp_create_nonce( 'ccb_demo_import_run' ),
        'ccb_run_calc_updates'  => wp_create_nonce( 'ccb_run_calc_updates' ),
        'ccb_custom_import'     => wp_create_nonce( 'ccb_custom_import' ),
    );
    echo( '<script type="text/javascript">window.ccb_nonces = ' . json_encode( $variables ) . ';</script>' );
}

add_action( 'wp_head', 'ccb_add_nonces' );
add_action( 'admin_head', 'ccb_add_admin_nonces' );

if( !function_exists( 'ccb_ajax_add_review' ) ) {
    function ccb_ajax_add_review()
    {
        check_ajax_referer( 'ccb_ajax_add_review', 'security' );
        $status = isset($_GET[ 'add_review_status' ]) ? sanitize_text_field($_GET[ 'add_review_status' ]) : '';
        update_option( 'ccb_canceled', $status );
    }
}

add_action( 'wp_ajax_ccb_ajax_add_review', 'ccb_ajax_add_review' );

function ccb_review_admin_notice()
{
    $interval_value = 7;
    $now =  date( 'Y-m-d h:i:s' );
    $installed_time = get_option('ccb_installed');
    $canceled_rating = !empty(get_option('ccb_canceled')) ? get_option('ccb_canceled') : 'no';

    $now = new DateTime( $now );
    if(!empty($installed_time)){
        $installed_time = new DateTime( $installed_time );
        $interval_value = round( ($now->format( 'U' ) - $installed_time->format('U')) / 86400 );
    }

    if( $interval_value >= 7 && $canceled_rating === 'no' ) {
        wp_enqueue_script('ccb-review-js', CALC_URL . '/frontend/dist/review-notice.js', CALC_VERSION);

        echo '
                <style>
                      .ccb-review-message {
                        border-color: #8F9EB0 !important;
                      }
                      
                      .ccb-thanks-message {
                        border-color: #76a928 !important;
                        padding: 10px;
                      }
                                            
                      .ccb-review-message p:last-child {
                        margin-top: 0;
                      }
                      
                      .ccb-review-message p.submit a.button-primary{
                           background: #17a2b8;
                            border-color: #17a2b8 #17a2b8 #8F9EB0;
                            box-shadow: 0 1px 0 #8F9EB0;
                            color: #fff;
                            text-decoration: none;
                            text-shadow: 0 -1px 1px #17a2b8, 1px 0 1px #17a2b8, 0 1px 1px #17a2b8, -1px 0 1px #17a2b8;
                      }
                      
                      #ccb_thanks_message {
                        display: none;
                      }
                  </style>
                  
                  <div id="ccb_message" class="notice notice-info ccb-review-message">
                    <p>Hey! We are so happy you choose <strong>Cost Calculator Builder!</strong> If you enjoy using it, can we ask you to give it a <strong>5-star rating</strong>?
                        Thank you for helping us out!</p>
                    <p class="submit">
                        <a href="https://wordpress.org/support/plugin/cost-calculator-builder/reviews/?filter=5#new-post" class="add_review button-primary" target="_blank">OK, you deserve it</a>
                        <a href="javascript:void(0);" class="skip_review button-secondary">Nope, maybe later</a>
                        <a href="javascript:void(0);" class="did_review button-secondary">I already did</a>
                    </p>
                </div> 
                <div id="ccb_thanks_message" class="notice notice-info ccb-thanks-message">
                    <p>Great! Thank you for your contribution. We really appreciate you being our customer, and helping us to build a better customer experience.</p>
                </div>
            ';
    }
}

add_action('admin_notices', 'ccb_review_admin_notice');
