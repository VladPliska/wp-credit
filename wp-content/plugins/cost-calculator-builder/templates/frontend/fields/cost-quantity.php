<div class="calc-item ccb-field" :class="{required: $store.getters.isUnused(quantityField), [quantityField.additionalStyles]: quantityField.additionalStyles}" v-if="Object.keys($store.getters.getCustomStyles).length" :data-id="quantityField.alias">

    <div class="calc-item__title" :style="$store.getters.getCustomStyles['labels']">
        <span> {{ quantityField.label }} </span>
        <span v-if="quantityField.required" class="calc-required-field">
            *
            <div class="ccb-field-required-tooltip">
                <span class="ccb-field-required-tooltip-text" :class="{active: $store.getters.isUnused(quantityField)}" style="display: none;">{{ $store.getters.getSettings.notice.requiredField }}</span>
            </div>
        </span>
    </div>

    <div class="calc-input-wrapper ccb-field" :class="'calc_' + quantityField.alias">
        <input :placeholder="quantityField.placeholder" type="number" v-model.trim="quantityValue" class="calc-input number ccb-field vertical" :style="$store.getters.getCustomStyles['quantity']">
        <span class="ccb-arrow-up ccb-arrow" @click.prevent="increment"></span>
        <span class="ccb-arrow-down ccb-arrow" @click.prevent="decrement"></span>
    </div>
    <p class="calc-description" :style="$store.getters.getCustomStyles['descriptions']">{{ quantityField.description }}</p>
</div>