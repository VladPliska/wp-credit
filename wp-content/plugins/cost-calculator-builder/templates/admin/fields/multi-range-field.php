<?php if(ccb_pro_active()) :
    do_action('render-multi-range');
    ?>
<?php else:?>
    <div class="multi-range-wrapper">
        <?php
            echo \cBuilder\Classes\CCBTemplate::load('/admin/partials/pro-feature');
        ?>
        <div class="list-row">
            <div class="list-content">
                <input type="text" placeholder="<?php esc_attr_e('- Field Label -', 'cost-calculator-builder')?>">
            </div>

            <div class="list-content">
                <input type="text" placeholder="<?php esc_attr_e('- Field Description -', 'cost-calculator-builder')?>">
            </div>

            <div class="list-content">
                <input type="number" placeholder="<?php esc_attr_e('- Min Value -', 'cost-calculator-builder')?>">
            </div>

            <div class="list-content">
                <input type="number" placeholder="<?php esc_attr_e('- Max Value -', 'cost-calculator-builder')?>">
            </div>

            <div class="list-content">
                <input type="number" placeholder="<?php esc_attr_e('- Step -', 'cost-calculator-builder')?>">
            </div>

            <div class="list-content">
                <input type="number" placeholder="<?php esc_attr_e('- Default Left Value -', 'cost-calculator-builder')?>">
            </div>

            <div class="list-content">
                <input type="number" placeholder="<?php esc_attr_e('- Default Right Value -', 'cost-calculator-builder')?>">
            </div>

            <div class="list-content">
                <input type="number" placeholder="<?php esc_attr_e('- Unit -', 'cost-calculator-builder')?>">
            </div>

            <div class="list-header ccb-modal-list" style="margin-top: 38px">
                <div class="ccb-switch">
                    <input type="checkbox"/>
                    <label></label>
                </div>
                <h6><?php esc_html_e('Currency Symbol On Total Description', 'cost-calculator-builder')?></h6>
            </div>

            <div class="list-header ccb-modal-list">
                <div class="ccb-switch">
                    <input type="checkbox"/>
                    <label></label>
                </div>
                <h6><?php esc_html_e('Round Value', 'cost-calculator-builder')?></h6>
            </div>

            <div class="list-content">
                <h6><?php esc_html_e('Additional Classes', 'cost-calculator-builder')?></h6>
                <textarea></textarea>
            </div>
        </div>

        <div class="list-row" style="margin-top: 30px">
            <div class="list-content ccb-flex">

                <div class="list-content--header">
                    <button type="button" class="green">
                        <i class="fas fa-save"></i>
                        <span><?php esc_html_e('Save Settings', 'cost-calculator-builder')?></span>
                    </button>
                </div>

                <div class="list-content--header">
                    <button type="button" class="white">
                        <i class="far fa-times-circle"></i>
                        <span><?php esc_html_e('Cancel Settings', 'cost-calculator-builder')?></span>
                    </button>
                </div>

            </div>
        </div>

    </div>
<?php endif;?>