<?php
/*
Plugin Name: Finance Calculator
Plugin URI: https://getbutterfly.com/wordpress-plugins/
Description: Finance Calculator is a drop in form for users to calculate indicative repayments. It can be implemented on a page or a post.
Author: Ciprian Popescu
Author URI: https://getbutterfly.com/
Version: 2.1.7
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Finance Calculator with Application Form
Copyright (C) 2010-2021 Ciprian Popescu (getbutterfly@gmail.com)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

add_action('admin_menu', 'wpfcs_plugin_menu');

add_option('wpfc_finance_rate', 11);
add_option('wpfc_application_email', '');
add_option('wpfc_currency', 'EUR');
add_option('wpfc_currency_symbol', '&euro;');
add_option('wpfcs_loan_options', 'Motor Loan|7.9,Standard Loan|9,College Loan|7,Green Loan|7.9,Secured Loan|5.5,Savers Loan|5.5');
add_option('wpfc_show_application', 1);

function wpfcs_assets() {
    wp_register_style('wpfcs', plugins_url('css/style.css', __FILE__), [], '2.1.7');

    wp_register_script('wpfcs', plugins_url('includes/js.finance.js', __FILE__), [], '2.1.7', true);
}
add_action('wp_enqueue_scripts', 'wpfcs_assets');


/**
 * Register/enqueue plugin scripts and styles (back-end)
 */
function wpfcs_enqueue_scripts() {
    wp_enqueue_style('wpfcs', plugins_url('css/admin.css', __FILE__));
}
add_action('admin_enqueue_scripts', 'wpfcs_enqueue_scripts');



function wpfcs_plugin_menu() {
	add_options_page(__('Finance Calculator', 'wpfc'), __('Finance Calculator', 'wpfc'), 'manage_options', 'wpfcs', 'wpfc_plugin_options');
}

function wpfc_plugin_options() {
    global $wpdb;

    // See if the user has posted us some information // if they did, this hidden field will be set to 'Y'
	if(isset($_POST['wpfcs_submit'])) {
		update_option('wpfc_finance_rate', floatval($_POST['wpfc_finance_rate']));
		update_option('wpfc_application_email', sanitize_email($_POST['wpfc_application_email']));
		update_option('wpfc_currency', sanitize_text_field($_POST['wpfc_currency']));
		update_option('wpfc_currency_symbol', sanitize_text_field($_POST['wpfc_currency_symbol']));
		update_option('wpfcs_loan_options', sanitize_text_field($_POST['wpfcs_loan_options']));
		update_option('wpfc_show_application', sanitize_text_field($_POST['wpfc_show_application']));

		echo '<div id="message" class="updated notice is-dismissible"><p>' . __('Settings saved.', 'finance-calculator-with-aplication-form') . '</p></div>';
	}

	// read in existing option value from database
    $wpfc_finance_rate = get_option('wpfc_finance_rate');
    $wpfc_application_email = get_option('wpfc_application_email');
    $wpfc_currency = get_option('wpfc_currency');
    $wpfc_currency_symbol = get_option('wpfc_currency_symbol');
    $wpfc_show_application = get_option('wpfc_show_application');
	$wpfcs_loan_options = get_option('wpfcs_loan_options');
	?>
	<div class="wrap">
		<h2>Finance Calculator Settings</h2>

        <div class="gb-ad" id="gb-ad">
            <h3 class="gb-ad--header"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 68 68"><defs/><rect width="100%" height="100%" fill="none"/><g class="currentLayer"><path fill="#fff" d="M34.76 33C22.85 21.1 20.1 13.33 28.23 5.2 36.37-2.95 46.74.01 50.53 3.8c3.8 3.8 5.14 17.94-5.04 28.12-2.95 2.95-5.97 5.84-5.97 5.84L34.76 33"/><path fill="#fff" d="M43.98 42.21c5.54 5.55 14.59 11.06 20.35 5.3 5.76-5.77 3.67-13.1.98-15.79-2.68-2.68-10.87-5.25-18.07 1.96-2.95 2.95-5.96 5.84-5.96 5.84l2.7 2.7m-1.76 1.75c5.55 5.54 11.06 14.59 5.3 20.35-5.77 5.76-13.1 3.67-15.79.98-2.69-2.68-5.25-10.87 1.95-18.07 2.85-2.84 5.84-5.96 5.84-5.96l2.7 2.7" class="selected"/><path fill="#fff" d="M33 34.75c-11.9-11.9-19.67-14.67-27.8-6.52-8.15 8.14-5.2 18.5-1.4 22.3 3.8 3.79 17.95 5.13 28.13-5.05 3.1-3.11 5.84-5.97 5.84-5.97L33 34.75"/></g></svg> Thank you for using Finance Calculator with Application Form!</h3>
            <div class="gb-ad--content">
                <p>If you enjoy this plugin, do not forget to <a href="https://wordpress.org/support/plugin/finance-calculator-with-application-form/reviews/?filter=5" rel="external">rate it</a>! We work hard to update it, fix bugs, add new features and make it compatible with the latest web technologies.</p>
                <p>Have you tried our other <a href="https://getbutterfly.com/wordpress-plugins/">WordPress plugins</a>?</p>
            </div>
            <div class="gb-ad--footer">
                <p>For support, feature requests and bug reporting, please visit the <a href="https://getbutterfly.com/" rel="external">official website</a>.<br>Built by <a href="https://getbutterfly.com/" rel="external"><strong>getButterfly</strong>.com</a> &middot; <a href="https://getbutterfly.com/finance-calculator-with-application-form/">Documentation</a> &middot; <small>Code wrangling since 2005</small></p>

                <p>
                    <small>You are using PHP <?php echo PHP_VERSION; ?> and MySQL <?php echo $wpdb->db_version(); ?>.</small>
                </p>
            </div>
        </div>

		<form method="post" action="">
			<h3>Finance Calculator Options</h3>

            <table class="form-table">
		        <tbody>
		            <tr>
		                <th scope="row"><label for="wpfc_finance_rate">Finance Rate</label></th>
		                <td>
                            <input type="number" class="regular-text" name="wpfc_finance_rate" id="wpfc_finance_rate" value="<?php echo $wpfc_finance_rate; ?>" min="0" max="100" step="0.01">
                            <br><small>Monthly payment will be calculated using this default rate.</small>
                        </td>
                    </tr>
		            <tr>
		                <th scope="row"><label for="wpfc_application_email">Application Email</label></th>
		                <td>
                            <input type="email" class="regular-text" name="wpfc_application_email" id="wpfc_application_email" value="<?php echo $wpfc_application_email; ?>" class="regular-text">
                            <br><small>Application emails will be sent to this address.</small>
                        </td>
                    </tr>
		            <tr>
		                <th scope="row"><label for="wpfc_currency">Currency</label></th>
		                <td>
                            <p>
                                <input type="text" class="regular-text" name="wpfc_currency" id="wpfc_currency" value="<?php echo $wpfc_currency; ?>" class="regular-text">
                                <br><small>Currency code used in application emails (e.g. <code>USD</code>, <code>EUR</code>, <code>GBP</code>).</small>
                            </p>
                            <p>
                                <input type="text" class="regular-text" name="wpfc_currency_symbol" id="wpfc_currency_symbol" value="<?php echo $wpfc_currency_symbol; ?>" size="3">
                                <br><small>Currency symbol used in application emails (e.g. <code>$</code>, <code>&euro;</code>, <code>&pound;</code>).</small>
                            </p>
                        </td>
                    </tr>
		            <tr>
		                <th scope="row"><label for="wpfc_show_application">Application Button</label></th>
		                <td>
                            <select name="wpfc_show_application">
                                <option value="1" <?php if ((int) $wpfc_show_application === 1) { echo 'selected'; } ?>>Show finance application button</option>
                                <option value="0" <?php if ((int) $wpfc_show_application === 0) { echo 'selected'; } ?>>Hide finance application button</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>

			<h3>Loan Calculator Options</h3>

            <table class="form-table">
		        <tbody>
		            <tr>
		                <th scope="row"><label for="wpfcs_loan_options">Loan Options</label></th>
		                <td>
                            <textarea name="wpfcs_loan_options" id="wpfcs_loan_options" rows="6" class="large-text code"><?php echo $wpfcs_loan_options; ?></textarea>
                            <br><small>These options will populate a dropdown field in the following format: <code>name|percentage,name|percentage,name|percentage</code>.</small>
                            <br><small>Example: <code>Motor Loan|7.9,Standard Loan|9,College Loan|7,Green Loan|7.9,Secured Loan|5.5,Savers Loan|5.5</code></small>
                        </td>
                    </tr>
                </tbody>
            </table>

            <hr>
			<p>
				<input type="submit" name="wpfcs_submit" class="button button-primary" value="Save Changes">
			</p>
		</form>

        <hr>
		<h3>Plugin Usage</h3>

        <p>Add the <code>[finance_calculator]</code> shortcode to any post or page to start using the finance calculator. The calculator will use the default finance rate.</p>
		<p>Add the <code>[loan_calculator]</code> shortcode to any post or page to start using the loan calculator.</p>
		<p>
			<strong>Notes:</strong><br />
			You can override the default finance rate by adding a <code><strong>rate</strong></code> parameter to the shortcode. Example: <code>[finance_calculator rate=&quot;27&quot;]</code>.<br />
			You can restrict the price field adding a <code><strong>price</strong></code> parameter to the shortcode. Example: <code>[finance_calculator price=&quot;16000&quot;]</code>.<br />
			<small>Do not use comma or period inside the price parameter (i.e. do not use <b>16.000</b> or <b>16,000</b> - use <b>16000</b>)</small>
		</p>

        <hr>
		<h3>Plugin Policy and Terms and Conditions</h3>

        <p>The payment protection insurance policy pays your loan or hires purchase agreement repayments if you are unable to work because of sickness, an accident or unemployment. It will also provide benefit in the event of your death.</p>
		<p>Eligibility for payment protection is covered under the policy of each company. Please specify these details on the post or page itself.</p>

		<p>Payment protection insurance is a standard add-on feature for many large loans such as car loans and other large bill obligations that could become a true nightmare should a disability or death occurs. This plan can offer a true measure of security for those who have grave reservations about how a large debt would be paid should a disaster strike. Any person with a small savings reservoir or someone heavily in debt would be a prime candidate for such a safety-net plan. Making sure that a plan is sound and customer friendly remains the responsibility of the buyer.</p>
	</div>
<?php
}

function display_loan_calculator($atts, $content = null) {
	extract(shortcode_atts([
		'rate' => get_option('wpfc_finance_rate'),
		'price' => ''
	], $atts));

    wp_enqueue_style('wpfcs');
    wp_enqueue_script('wpfcs');

	$display = '<form name="frmCalc" class="wpfcs-container">
        <p>
            <label for="slt_type">' . __('Loan Type:', 'wpfc') . '</label>
            <select name="slt_type" id="slt_type">
                <option value="0">' . __('Select Loan Type...', 'wpfc') . '</option>';

                $wpfcs_loan_options = explode(',', get_option('wpfcs_loan_options'));

                foreach ($wpfcs_loan_options as $cat) {
                    $cat_taxs = explode('|', $cat);
                    $display .= '<option value="' . $cat_taxs[1] . '">' . $cat_taxs[0] . ' (' . $cat_taxs[1] . '%)</option>';
                }

            $display .= '</select>
        </p>
        <p>
            <label for="txtAmt">' . __('Amount of Loan', 'wpfc') . ' (' . get_option('wpfc_currency_symbol') . ')</label>
            <input name="txtAmt" type="text" id="txtAmt" size="10">
        </p>
        <p>
            <label for="txtYrs">' . __('Repayment Period in Years', 'wpfc') . '</label>
            <select name="txtYrs" id="txtYrs" onchange="calcAmt(this.form);">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
            </select>
            <input type="button" name="btnCalc" id="btnCalc" value="Calculate" onclick="calcAmt(this.form)">
        </p>
        <p>
            <label for="txtWk">' . __('Weekly Payment', 'wpfc') . ' (' . get_option('wpfc_currency_symbol') . ')</label>
            <input name="txtWk" type="text" size="10">
        </p>
        <p>
            <label for="txtFn">' . __('Fortnightly Payment', 'wpfc') . ' (' . get_option('wpfc_currency_symbol') . ')</label>
            <input name="txtFn" type="text" size="10">
        </p>
        <p>
            <label for="txtMnth">' . __('Monthly Payment', 'wpfc') . ' (' . get_option('wpfc_currency_symbol') . ')</label>
            <input name="txtMnth" type="text" id="txtMnth2" size="10">
        </p>
        <p>
            <label for="txtTotal">' . __('Total Repayment Amount', 'wpfc') . ' (' . get_option('wpfc_currency_symbol') . ')</label>
            <input name="txtTotal" type="text" id="txtTotal" size="10">
        </p>
        <p>
            <label for="txtInt">' . __('Total Interest Payable', 'wpfc') . ' (' . get_option('wpfc_currency_symbol') . ')</label>
            <input name="txtInt" type="text" id="txtInt" size="10">
        </p>
	</form>';

	return $display;
}


function display_finance_calculator($atts) {
    extract(shortcode_atts([
        'rate' => get_option('wpfc_finance_rate'),
        'price' => ''
    ], $atts));

    wp_enqueue_style('wpfcs');
    wp_enqueue_script('wpfcs');

    if (isset($_POST['submit'])) {
        $listprice = sanitize_text_field($_POST['NetAmount']);
		$amount = sanitize_text_field($_POST['NetAmount']);
		$deposit = sanitize_text_field($_POST['Deposit']);
		$tradein = sanitize_text_field($_POST['TradeIn']);

        $financemonths = sanitize_text_field($_POST['finance_Months']);

        $finalprice = $listprice - ($deposit + $tradein);
        $f_symbol = get_option('wpfc_currency_symbol');
        $f_currency = get_option('wpfc_currency');

        $display = '<h3>' . __('Finance Application Form', 'wpfc') . '</h3>

        <p>* ' . __('Required Fields', 'wpfc') . '</p>

		<form action="' . $_SERVER['REQUEST_URI'] . '" method="post" name="form1" class="wpfcs-container">
			<input type="hidden" name="finance_months" value="' . $financemonths . '">
			<input type="hidden" name="finance_payments" value="0">

			<input type="hidden" name="finance_Currency" value="' . $f_currency . '">
			<input type="hidden" name="Checkform" value="Yes">

            <div class="wp-block-columns">
                <div class="wp-block-column">
                    <h3>' . __('Vehicle Details', 'wpfc') . '</h3>

                    <p>
                        <label for="param_value1">' . __('Make', 'wpfc') . '</label>
                        <input type="text" name="param_value1" value="">
                    </p>
                    <p>
                        <label for="param_value2">' . __('Model', 'wpfc') . '</label>
                        <input type="text" name="param_value2" value="">
                    </p>
                    <p>
                        <label for="param_value3">' . __('Car Specification', 'wpfc') . '</label>
                        <input type="text" name="param_value3" value="">
                    </p>
                    <p>
                        <label for="lead_caryear">' . __('Year', 'wpfc') . '</label>
                        <input type="text" name="lead_caryear" value="' . date('Y') . '">
                    </p>
                </div>
                <div class="wp-block-column">
                    <h3>' . __('Finance Details', 'wpfc') . '</h3>

                    <p>
                        <label for="ListPrice">' . __('List Price', 'wpfc') . ' (' . $f_symbol . ')</label>
                        <input type="number" name="ListPrice" value="' . $listprice . '">
                    </p>
                    <p>
                        <label for="FinalPrice">' . __('Amount', 'wpfc') . ' (' . $f_symbol . ')</label>
                        <input type="number" name="FinalPrice" value="' . $finalprice . '">
                    </p>
                    <p>
                        <label for="finance_deposit">' . __('Deposit', 'wpfc') . ' (' . $f_symbol . ')</label>
                        <input type="number" name="finance_deposit" value="' . $deposit . '">
                    </p>
                    <p>
                        <label for="finance_TradeIn">' . __('Trade In', 'wpfc') . ' (' . $f_symbol . ')</label>
                        <input type="number" name="finance_TradeIn" value="' . $tradein . '">
                    </p>
                </div>
            </div>

            <div class="wp-block-columns">
                <div class="wp-block-column">
                    <h3>' . __('Applicant Details', 'wpfc') . '</h3>

                    <p>
                        <label for="wpfc_forename">' . __('First Name *', 'wpfc') . '</label>
                        <input type="text" name="wpfc_forename" required>
                    </p>
                    <p>
                        <label for="wpfc_surname">' . __('Last Name *', 'wpfc') . '</label>
                        <input type="text" name="wpfc_surname" required>
                    </p>
                    <p>
                        <label for="wpfc_workphone">' . __('Work Phone *', 'wpfc') . '</label>
                        <input type="text" size="15" name="wpfc_workphone">
                    </p>
                    <p>
                        <label for="wpfc_homephone">' . __('Home Phone *', 'wpfc') . '</label>
                        <input type="text" name="wpfc_homephone">
                    </p>
                    <p>
                        <label for="wpfc_mobile">' . __('Mobile Phone *', 'wpfc') . '</label>
                        <input type="text" name="wpfc_mobile">
                    </p>
                    <p>
                        <label for="wpfc_email">' . __('Email Address *', 'wpfc') . '</label>
                        <input type="email" name="wpfc_email">
                    </p>
                    <p>
                        <label for="EMAIL_2">' . __('Confirm Email Address *', 'wpfc') . '</label>
                        <input type="email" name="EMAIL_2">
                    </p>
                    <p>
                        <label for="wpfc_address">' . __('Address *', 'wpfc') . '</label>
                        <textarea cols="40" rows="3" name="wpfc_address" required></textarea>
                    </p>
                    <p>
                        <label for="wpfc_prev_address">' . __('Previous Address', 'wpfc') . ' <em>(' . __('If less than 3 years', 'wpfc') . ')</em></label>
                        <textarea cols="40" rows="3" name="wpfc_prev_address"></textarea>
                    </p>
                    <p>
                        <label for="wpfc_time_at_address">' . __('Years at Address *', 'wpfc') . '</label>
                        <input type="number" min="0" max="100" name="wpfc_time_at_address" required>
                    </p>
                    <p>
                        <label for="wpfc_time_at_prev_address">' . __('Years at Previous Address', 'wpfc') . '</label>
                        <input type="number" min="0" max="100" name="wpfc_time_at_prev_address">
                    </p>
                    <p>
                        <label for="DobDay">' . __('Date of Birth *', 'wpfc') . '</label>
                        <select name="DobDay">
                            <option value="">--</option>';
                            for ($d1 = 1; $d1 <= 31; $d1++) {
                                $display .= '<option value="' . $d1 . '">' . $d1 . '</option>';
                            }
                        $display .= '</select> / <select name="DobMonth">
                            <option value="">--</option>';
                            for ($d2 = 1; $d2 <= 12; $d2++) {
                                $display .= '<option value="' . $d2 . '">' . $d2 . '</option>';
                            }
                        $display .= '</select> / <select name="DobYear">
                            <option value="">--</option>';
                            $spinnerYear = date('Y');

                            for ($d3 = $spinnerYear; $d3 >= 1940; $d3--) {
                                $display .= '<option value="' . $d3 . '">' . $d3 . '</option>';
                            }
                        $display .= '</select>
                    </p>
                    <p>
                        <select name="wpfc_live_arr">
                            <option value="">' . __('Living Arrangement...', 'wpfc') . '</option>
                            <option value="' . __('House Owner', 'wpfc') . '">' . __('House Owner', 'wpfc') . '</option>
                            <option value="' . __('Tenant', 'wpfc') . '">' . __('Tenant', 'wpfc') . '</option>
                            <option value="' . __('Living with Parents', 'wpfc') . '">' . __('Living with Parents', 'wpfc') . '</option>						
                        </select>
                    </p>
                    <p>
                        <select name="wpfc_marital_status">
                            <option value="">' . __('Marital Status...', 'wpfc') . '</option>
                            <option value="' . __('Single', 'wpfc') . '">' . __('Single', 'wpfc') . '</option>
                            <option value="' . __('Married', 'wpfc') . '">' . __('Married', 'wpfc') . '</option>
                            <option value="' . __('Other', 'wpfc') . '">' . __('Other', 'wpfc') . '</option>				
                        </select>
                    </p>
                    <p>
                        <select name="track_replymethod">
                            <option value="">' . __('Reply By...', 'wpfc') . '</option>
                            <option value="' . __('Phone', 'wpfc') . '">' . __('Phone', 'wpfc') . '</option>
                            <option value="' . __('Email', 'wpfc') . '">' . __('Email', 'wpfc') . '</option>	
                        </select>
                    </p>
                </div>
                <div class="wp-block-column">
                    <h3>' . __('Employment Details', 'wpfc') . '</h3>

                    <p>
                        <label for="wpfc_occupation">' . __('Occupation *', 'wpfc') . '</label>
                        <input type="text" name="wpfc_occupation" required>
                    </p>
                    <p>
                        <label for="wpfc_company">' . __('Employer Name *', 'wpfc') . '</label>
                        <input type="text" name="wpfc_company" required>
                    </p>
                    <p>
                        <label for="wpfc_company_address">' . __('Employer Address *', 'wpfc') . '</label>
                        <textarea cols="40" rows="3" name="wpfc_company_address" required></textarea>
                    </p>
                    <p>
                        <label for="wpfc_company_years">' . __('Duration of Employment *', 'wpfc') . '</label>
                        <input type="number" name="wpfc_company_years" min="0" max="60"> ' . __('years', 'wpfc') . ' <input type="number" name="wpfc_company_months" min="1" max="12" required> ' . __('months', 'wpfc') . '
                    </p>
                    <p>
                        <label for="wpfc_income">' . __('Monthly Income (Net) *', 'wpfc') . ' (' . $f_symbol . ')</label>
                        <input type="number" name="wpfc_income" required>
                    </p>
                    <p>
                        <label for="wpfc_income">' . __('Monthly Mortgage *', 'wpfc') . ' (' . $f_symbol . ')</label>
                        <input type="number" name="wpfc_mortgage">
                    </p>
                    <p>
                        <label for="wpfc_spousenet">' . __('Spouse Income (Net)', 'wpfc') . ' (' . $f_symbol . ')</label>
                        <input type="number" name="wpfc_spousenet">
                    </p>
                    <p>
                        <label for="wpfc_bank">' . __('Bank *', 'wpfc') . '</label>
                        <input type="text" size="15" name="wpfc_bank" required>
                    </p>
                    <p>
                        <label for="wpfc_branch">' . __('Branch', 'wpfc') . '</label>
                        <input type="text" size="15" name="wpfc_branch">
                    </p>
                    <p>
                        <label for="wpfc_accn">' . __('Account Number *', 'wpfc') . '</label>
                        <input type="text" size="15" name="wpfc_accn" required>
                    </p>
                    <p>
                        <label for="wpfc_bank_sc">' . __('Sort Code', 'wpfc') . '</label>
                        <input type="text" size="15" name="wpfc_bank_sc">
                    </p>
                    <p>
                        <label for="wpfc_bank_time">' . __('Time With Bank (years) *', 'wpfc') . '</label>
                        <input type="number" min="0" max="60" name="wpfc_bank_time" required>
                    </p>
                </div>
            </div>

			<h3>' . __('Additional Information', 'wpfc') . '</h3>

            <p>
				<textarea cols="40" rows="5" name="lead_comment"></textarea>
            </p>
            <p>
				<select name="CreditCheck">
					<option value="">' . __('Select an option...', 'wpfc') . '</option>
					<option value="' . __('Yes', 'wpfc') . '">' . __('Yes', 'wpfc') . '</option>
					<option value="">' . __('No', 'wpfc') . '</option>					
				</select> ' . __('Do you consent to having your information credit checked? *', 'wpfc') . '
			</p>
			<p>
                <input type="submit" value="' . __('Submit Finance Application', 'wpfc') . '" name="submit2">
            </p>
		</form>';

		return $display;
	} else if (isset($_POST['submit2'])) {
        $subject = '' . __('Finance Application Form Email', 'wpfc') . '';

        $message = '<b>' . __('Allow credit check?', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['CreditCheck']) . '<br>' .
		'<b>' . __('Date of Birth', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['DobDay']) . '/' . sanitize_text_field($_POST['DobMonth']) . '/' . sanitize_text_field($_POST['DobYear']) . '<br>' .
		'<b>' . __('Email Address', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['EMAIL_2']) . '<br>' .
		'<b>' . __('Final price', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['FinalPrice']) . '<br>' .
		'<b>' . __('List price', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['ListPrice']) . '<br>' .
		'<b>' . __('Trade in', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['finance_TradeIn']) . '<br>' .
		'<b>' . __('Deposit', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['finance_deposit']) . '<br>' .
		'<b>' . __('Months', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['finance_months']) . '<br>' .
		'<b>' . __('Comment', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['lead_comment']) . '<br>' .
		'<b>' . __('Make', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['param_value1']) . '<br>' .
		'<b>' . __('Model', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['param_value2']) . '<br>' .
		'<b>' . __('Car spec', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['param_value3']) . '<br>' .
		'<b>' . __('Account Number', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_accn']) . '<br>' .
		'<b>' . __('Sort Code', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_bank_sc']) . '<br>' .
		'<b>' . __('Address', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_address']) . '<br>' .
		'<b>' . __('Bank', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_bank']) . '<br>' .
		'<b>' . __('Time With Bank', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_bank_time']) . '<br>' .
		'<b>' . __('Branch', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_branch']) . '<br>' .
		'<b>' . __('Company', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_company']) . '<br>' .
		'<b>' . __('Company address', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_company_address']) . '<br>' .
		'<b>' . __('Company months', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_company_months']) . '<br>' .
		'<b>' . __('Company years', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_company_years']) . '<br>' .
		'<b>' . __('Email Address', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_email']) . '<br>' .
		'<b>' . __('Name', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_forename']) . ' ' . sanitize_text_field($_POST['wpfc_surname']) . '<br>' .
		'<b>' . __('Homephone', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_homephone']) . '<br>' .
		'<b>' . __('Income', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_income']) . '<br>' .
		'<b>' . __('Live arr', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_live_arr']) . '<br>' .
		'<b>' . __('Marital Status', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_marital_status']) . '<br>' .
		'<b>' . __('Mobile', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_mobile']) . '<br>' .
		'<b>' . __('Mortgage', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_mortgage']) . '<br>' .
		'<b>' . __('Occupation', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_occupation']) . '<br>' .
		'<b>' . __('Previous address', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_prev_address']) . '<br>' .
		'<b>' . __('Spouse income', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_spousenet']) . '<br>' .
		'<b>' . __('Time at address', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_time_at_address']) . '<br>' .
		'<b>' . __('Time at previous address', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_time_at_prev_address']) . '<br>' .
		'<b>' . __('Workphone', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['wpfc_workphone']) . '<br>' .
		'<b>' . __('Reply method', 'wpfc') . ':</b> ' . sanitize_text_field($_POST['track_replymethod']) . '<br>';

        $f_email = get_option('wpfc_application_email');

        function set_contenttype($content_type) {
            return 'text/html';
        }
        add_filter('wp_mail_content_type', 'set_contenttype');

        $headers = [];
        $headers[] = "From: " . get_option('blogname') . "<" . $_POST['EMAIL_2'] . ">\r\n";
        $headers[] = "Content-Type: text/html;\r\n";

        $to = $f_email;
        $mail = wp_mail($to, $subject, $message, $headers);

        if ($mail) {
            echo '<h3>' . __('Thank you', 'wpfc') . '</h3><p>' . __('Your details have been sent to us and will be processed as soon as possible.', 'wpfc') . '</p>';
        } else {
            echo '<h3>' . __('Thank you', 'wpfc') . '</h3><p>' . __('An error occurred while sending application email!', 'wpfc') . '</p>';
        }
	} else {
        $f_rate = $rate; // extract from shortcode instead of get_option('wpfc_finance_rate'); // added in 1.3.2
        $f_symbol = get_option('wpfc_currency_symbol');
        $wpfc_show_application = get_option('wpfc_show_application');

        $display = '<form name="Finance" action="' . $_SERVER['REQUEST_URI'] . '" method="post" onsubmit="Calculate();" class="wpfcs-container">
			<input name="PcentBalloon" value="0" type="hidden">

            <div class="wp-block-columns">
                <div class="wp-block-column">';

                    if ($price != '') {
                        $display .= '<input name="NetAmount" value="' . $price . '" type="hidden">';
                    } else {
                        $display .= '<p>
                            <label for="NetAmount">' . __('Price of Car', 'wpfc') . '</label>
                            <input name="NetAmount" value="0" size="8" type="number" onfocus="Calculate();">
                        </p>';
                    }

                    $display .= '<p>
						<label for="Rate">' . __('Finance Rate', 'wpfc') . '</label>
						<input name="Rate" value="' . $f_rate . '" type="number" min="0" max="100" step="0.01" onfocus="Calculate();">%
					</p>
					<p>
						<label for="Deposit">' . __('Less Deposit', 'wpfc') . '</label>
						<input maxlength="8" name="Deposit" size="8" type="number" value="0" onfocus="Calculate();">
					</p>
					<p>
						<label for="TradeIn">' . __('Less Trade In Allowance', 'wpfc') . '</label>
						<input maxlength="8" name="TradeIn" size="8" type="number" value="0" onfocus="Calculate();">
					</p>
					<p>
						<label for="Include">' . __('Monthly payment', 'wpfc') . '</label>
                        <input name="Include" value="+" size="1" readonly type="text"> ' . __('payment protection, presuming a typical APR of', 'wpfc') . ' ' . $f_rate . '%</p></label>
					</p>
                </div>
                <div class="wp-block-column">';

                    $period_array = [12, 24, 36, 48, 60, 72];

                    foreach ($period_array as $index => $period) {
                        // Array starts at 0, so increase by 1
                        $index++;

                        $display .= '<p class="finance_repayments">
                            <input name="finance_Months" value="' . $period . '" data-months="' . $period . '" onclick="Calculate();" type="radio" checked> ' . $period . ' ' . __('months', 'wpfc') . '<br>
                            <input value="0" name="monthpay' . $index . '" readonly type="text">
                            <br><small>' . $f_symbol . '/' . __('month', 'wpfc') . '</small>
                            <input value="0" name="finalpay' . $index . '" size="10" type="hidden">
                            <input value="0" name="credit' . $index . '" size="10" type="hidden">
                            <input value="0" name="total' . $index . '" size="10" type="hidden">
                        </p>';
                    }

                $display .= '</div>
            </div>

            <p>
                <label for="total_cost" class="financecost">' . __('Total cost of the credit:', 'wpfc') . ' (' . $f_symbol . ')
                <input value="0" id="total_cost" size="8" type="text" readonly>
            </p>
            <p>
                <input checked="checked" name="PPP" value="Yes" onclick="Calculate()" type="checkbox"> ' . __('Check/uncheck this box to view figures with/without Payment Protection', 'wpfc') . '
            </p>
            <p>
                <input onclick="Calculate()" value="' . __('Calculate', 'wpfc') . '" type="button"> ';

                if ((int) $wpfc_show_application === 1) {
                    $display .= '<input type="submit" name="submit" value="' . __('Make Finance Application', 'wpfc') . '">';
                }

            $display .= '</p>
		</form>';

		return $display;
	}
}

add_shortcode('finance_calculator', 'display_finance_calculator');
add_shortcode('loan_calculator', 'display_loan_calculator');

if (function_exists('register_uninstall_hook')) {
	register_uninstall_hook(__FILE__, 'wpfc_uninstall');
}

function wpfc_uninstall() {
	delete_option('wpfc_finance_rate');
	delete_option('wpfc_application_email');
	delete_option('wpfc_currency');
	delete_option('wpfc_currency_symbol');
	delete_option('wpfc_credit');
	delete_option('wpfcs_loan_options');
	delete_option('wpfc_show_application');
	delete_option('wpfc_apply_styles');
}
