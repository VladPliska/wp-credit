<div class="calc-item ccb-field" :class="{required: $store.getters.isUnused(checkboxField), [checkboxField.additionalStyles]: checkboxField.additionalStyles}" v-if="Object.keys($store.getters.getCustomStyles).length"  :data-id="checkboxField.alias">
    <div class="calc-item__title" :style="$store.getters.getCustomStyles['labels']">
        <span> {{ checkboxField.label }} </span>
        <span v-if="checkboxField.required" class="calc-required-field">
            *
            <div class="ccb-field-required-tooltip">
                <span class="ccb-field-required-tooltip-text" :class="{active: $store.getters.isUnused(checkboxField)}" style="display: none;">{{ $store.getters.getSettings.notice.requiredField }}</span>
            </div>
        </span>
    </div>
    <div class="calc-checkbox" :class="'calc_' + checkboxField.alias">
        <div class="calc-checkbox-item" v-for="( element, index ) in getOptions">
            <input type="checkbox" :id="checkboxLabel + index" :value="element.value" @change="change(event, element.label)">
            <label :for="checkboxLabel + index">
                <span :style="$store.getters.getCustomStyles['checkbox']">{{ element.label }}</span>
            </label>
        </div>
        <p class="calc-description" :style="$store.getters.getCustomStyles['descriptions']">{{ checkboxField.description }}</p>
    </div>
</div>