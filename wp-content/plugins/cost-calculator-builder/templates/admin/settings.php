<div class="ccb-page-content settings">
    <div class="settings-wrapper">
        <div class="ccb-settings-sidebar">
            <div class="ccb-sidebar-item" :class="{active: active_content === 'general'}"
                 @click.prevent="active_content = 'general'">
                <i class="fas fa-cog"></i>
                <p class=""><?php esc_html_e('General', 'cost-calculator-builder') ?></p>
                <i class="fas fa-chevron-right after"></i>
            </div>

            <div class="ccb-sidebar-item" :class="{active: active_content === 'currency'}"
                 @click.prevent="active_content = 'currency'">
                <i class="fas fa-coins"></i>
                <p class=""><?php esc_html_e('Currency', 'cost-calculator-builder') ?></p>
                <i class="fas fa-chevron-right after"></i>
            </div>

            <div class="ccb-sidebar-item" :class="{active: active_content === 'form'}"
                 @click.prevent="active_content = 'form'">
                <i class="fas fa-envelope"></i>
                <p class=""><?php esc_html_e('Send Form', 'cost-calculator-builder') ?></p>
                <i class="fas fa-chevron-right after"></i>
            </div>

            <div class="ccb-sidebar-item" :class="{active: active_content === 'woo_products'}"
                 @click.prevent="active_content = 'woo_products'">
                <i class="fas fa-archive"></i>
                <p class=""><?php esc_html_e('Woo Products', 'cost-calculator-builder') ?></p>
                <i class="fas fa-chevron-right after"></i>
            </div>

            <div class="ccb-sidebar-item" :class="{active: active_content === 'woo_checkout'}"
                 @click.prevent="active_content = 'woo_checkout'">
                <i class="fas fa-shopping-cart"></i>
                <p class=""><?php esc_html_e('Woo Checkout', 'cost-calculator-builder') ?></p>
                <i class="fas fa-chevron-right after"></i>
            </div>

            <div class="ccb-sidebar-item" :class="{active: active_content === 'stripe'}"
                 @click.prevent="active_content = 'stripe'">
                <i class="fab fa-stripe-s"></i>
                <p class=""><?php esc_html_e('Stripe', 'cost-calculator-builder') ?></p>
                <i class="fas fa-chevron-right after"></i>
            </div>

            <div class="ccb-sidebar-item" :class="{active: active_content === 'paypal'}"
                 @click.prevent="active_content = 'paypal'">
                <i class="fab fa-paypal"></i>
                <p class=""><?php esc_html_e('PayPal', 'cost-calculator-builder') ?></p>
                <i class="fas fa-chevron-right after"></i>
            </div>

            <div class="ccb-sidebar-item" :class="{active: active_content === 'recaptcha'}"
                 @click.prevent="active_content = 'recaptcha'">
                <i class="fas fa-robot"></i>
                <p class=""><?php esc_html_e('reCAPTCHA', 'cost-calculator-builder') ?></p>
                <i class="fas fa-chevron-right after"></i>
            </div>

            <div class="ccb-sidebar-item" :class="{active: active_content === 'notice'}"
                 @click.prevent="active_content = 'notice'">
                <i class="fas fa-exclamation-circle"></i>
                <p class=""><?php esc_html_e('Notice', 'cost-calculator-builder') ?></p>
                <i class="fas fa-chevron-right after"></i>
            </div>
        </div>
        <div class="ccb-sidebar-content">
            <div class="ccb-sidebar-content-list" v-if="active_content === 'general'">
                <div class="list-row">
                    <div class="list-content">
                        <input type="text" v-model.trim="settingsField.general.header_title" placeholder="<?php esc_attr_e('- Total Descriptions Header Title -', 'cost-calculator-builder') ?>">
                    </div>

                    <div class="list-content">
                        <select v-model="settingsField.general.boxStyle">
                            <option value="" selected disabled><?php esc_html_e('- Select Calculator Box Style -', 'cost-calculator-builder') ?></option>
                            <option value="vertical"><?php esc_html_e('Vertical', 'cost-calculator-builder') ?></option>
                            <option value="horizontal"><?php esc_html_e('Horizontal', 'cost-calculator-builder') ?></option>
                        </select>
                    </div>

                    <div class="list-content">
                        <select v-model="settingsField.general.descriptions">
                            <option value="" selected disabled><?php esc_html_e('- Select Descriptions Option -', 'cost-calculator-builder') ?></option>
                            <option value="show"><?php esc_html_e('show', 'cost-calculator-builder') ?></option>
                            <option value="hide"><?php esc_html_e('hide', 'cost-calculator-builder') ?></option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="ccb-sidebar-content-list" v-if="active_content === 'currency'">
                <div class="list-row">
                    <div class="list-content">
                        <input v-model="settingsField.currency.currency" type="text" placeholder="<?php esc_attr_e('- Type Currency Symbol -', 'cost-calculator-builder') ?>">
                    </div>
                    <div class="list-content">
                        <select v-model="settingsField.currency.currencyPosition">
                            <option value="" selected disabled><?php esc_html_e('- Select Currency Position -', 'cost-calculator-builder') ?></option>
                            <option value="left"><?php esc_html_e('Left', 'cost-calculator-builder') ?></option>
                            <option value="right"><?php esc_html_e('Right', 'cost-calculator-builder') ?></option>
                            <option value="left_with_space"><?php esc_html_e('Left with space', 'cost-calculator-builder') ?></option>
                            <option value="right_with_space"><?php esc_html_e('Right with space', 'cost-calculator-builder') ?></option>
                        </select>
                    </div>

                    <div class="list-content">
                        <input type="text" v-model="settingsField.currency.thousands_separator" placeholder="<?php esc_attr_e('- Type Thousands Separator -', 'cost-calculator-builder') ?>">
                    </div>

                    <div class="list-content">
                        <input type="text" v-model="settingsField.currency.decimal_separator" placeholder="<?php esc_attr_e('- Type Decimal Separator -', 'cost-calculator-builder') ?>">
                    </div>

                    <div class="list-content">
                        <input type="text" v-model="settingsField.currency.num_after_integer" placeholder="<?php esc_attr_e('- Type Number Of Characters After Integer -', 'cost-calculator-builder') ?>">
                    </div>
                </div>
            </div>

            <div class="ccb-sidebar-content-list" v-if="active_content === 'form'">
                <?php
                echo \cBuilder\Classes\CCBTemplate::load('admin/settings/send-form');
                ?>
            </div>

            <div class="ccb-sidebar-content-list" v-if="active_content === 'woo_products'">
                <?php
                echo \cBuilder\Classes\CCBTemplate::load('admin/settings/woo-products');
                ?>
            </div>

            <div class="ccb-sidebar-content-list" v-if="active_content === 'woo_checkout'">
                <?php
                echo \cBuilder\Classes\CCBTemplate::load('admin/settings/woo-checkout');
                ?>
            </div>

            <div class="ccb-sidebar-content-list" v-if="active_content === 'stripe'">
                <?php
                echo \cBuilder\Classes\CCBTemplate::load('admin/settings/stripe');
                ?>
            </div>

            <div class="ccb-sidebar-content-list" v-if="active_content === 'paypal'">
                <?php
                echo \cBuilder\Classes\CCBTemplate::load('admin/settings/paypal');
                ?>
            </div>

            <div class="ccb-sidebar-content-list" v-if="active_content === 'recaptcha'">
                <?php
                echo \cBuilder\Classes\CCBTemplate::load('admin/settings/recaptcha');
                ?>
            </div>

            <div class="ccb-sidebar-content-list" v-if="active_content === 'notice'">
                <?php
                echo \cBuilder\Classes\CCBTemplate::load('admin/settings/notice');
                ?>
            </div>
        </div>
    </div>
</div>
