<?php
$pro_active = ccb_pro_active() ? '': 'active';
?>
<div class="toggle-wrapper">
    <div class="list-row">

        <div class="list-content">
            <input type="text" placeholder="<?php esc_attr_e('- Field Label -', 'cost-calculator-builder')?>" v-model.trim="toggleField.label">
        </div>

        <div class="list-content">
            <input type="text" placeholder="<?php esc_attr_e('- Field Description -', 'cost-calculator-builder')?>" v-model.trim="toggleField.description">
        </div>

        <div class="list-header ccb-modal-list" style="margin-top: 38px">
            <div class="ccb-switch">
                <input type="checkbox" v-model="toggleField.allowCurrency"/>
                <label></label>
            </div>
            <h6><?php esc_html_e('Currency Symbol On Total Description', 'cost-calculator-builder')?></h6>
        </div>

        <div class="list-header ccb-modal-list">
            <div class="ccb-switch">
                <input type="checkbox" v-model="toggleField.allowRound"/>
                <label></label>
            </div>
            <h6><?php esc_html_e('Round Value', 'cost-calculator-builder')?></h6>
        </div>

        <div class="list-header ccb-modal-list">
            <div class="ccb-switch <?php echo esc_attr($pro_active)?>">
                <input type="checkbox" v-model="toggleField.required"/>
                <label></label>
            </div>
            <h6>
                <?php esc_html_e('Required', 'cost-calculator-builder')?>
                <span class="pro-feature <?php echo esc_attr($pro_active)?>">
                    <a class="pro-tooltip" target="_blank" href="https://stylemixthemes.com/cost-calculator-plugin/?utm_source=wporg&utm_medium=landing&utm_campaign=2020">
                        pro
                        <span class="pro-tooltip-text">Feature Available <br> in Pro Version</span>
                    </a>
                </span>
            </h6>
        </div>

        <div class="list-content">

            <div class="list-content--header">
                <button type="button" class="green" @click="addOption">
                    <i class="fas fa-plus"></i>
                    <span><?php esc_html_e('Add Toggle Options', 'cost-calculator-builder')?></span>
                </button>
            </div>

            <div class="add-options" v-for="(option, index) in toggleField.options">
                <div class="options">
                    <input  type="text" placeholder="<?php esc_attr_e('- Option Label -', 'cost-calculator-builder')?>"
                            v-model="option.optionText">
                </div>
                <div class="options">
                    <input type="number" placeholder="<?php esc_attr_e('- Option Value -', 'cost-calculator-builder')?>"
                           v-model="option.optionValue" >
                </div>

                <div class="delete-option" @click.prevent="removeOption(index, option.optionValue)">
                    <span>
                        <i class="fas fa-trash-alt"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="list-content">
            <h6><?php esc_html_e('Additional Classes', 'cost-calculator-builder')?></h6>
            <textarea  v-model="toggleField.additionalStyles"></textarea>
        </div>
    </div>

    <div class="list-row" style="margin-top: 30px">
        <div class="list-content ccb-flex">

            <div class="list-content--header">
                <button type="button" class="green" @click="$emit( 'save', toggleField, id, index)">
                    <i class="fas fa-save"></i>
                    <span><?php esc_html_e('Save Settings', 'cost-calculator-builder')?></span>
                </button>
            </div>

            <div class="list-content--header">
                <button type="button" class="white" @click="$emit( 'cancel' )">
                    <i class="far fa-times-circle"></i>
                    <span><?php esc_html_e('Cancel Settings', 'cost-calculator-builder')?></span>
                </button>
            </div>

        </div>
    </div>
</div>
