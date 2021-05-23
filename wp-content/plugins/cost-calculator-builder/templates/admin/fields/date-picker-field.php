<?php if(ccb_pro_active()) :
    do_action('render-date-picker');
 ?>
<?php else:?>
    <div class="date-picker-wrapper">
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
                <input type="text" placeholder="<?php esc_attr_e('- Field Placeholder -', 'cost-calculator-builder')?>">
            </div>

            <div class="list-content">
                <select>
                    <option value="1"><?php esc_html_e('With range', 'cost-calculator-builder');?></option>
                    <option value="0"><?php esc_html_e('No range', 'cost-calculator-builder');?></option>
                </select>
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
