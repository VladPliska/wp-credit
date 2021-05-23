<div class="calc-item ccb-field" :class="{required: $store.getters.isUnused(toggleField), [toggleField.additionalStyles]: toggleField.additionalStyles}" v-if="Object.keys($store.getters.getCustomStyles).length" :data-id="toggleField.alias">
    <div class="calc-item__title" :style="$store.getters.getCustomStyles['labels']">
        <span> {{ toggleField.label }} </span>
        <span v-if="toggleField.required" class="calc-required-field">
        *
        <div class="ccb-field-required-tooltip">
            <span class="ccb-field-required-tooltip-text" :class="{active: $store.getters.isUnused(toggleField)}" style="display: none;">{{ $store.getters.getSettings.notice.requiredField }}</span>
        </div>
    </div>

    <div class="calc-toggle" :class="'calc_' + toggleField.alias">
        <div class="calc-switch"  v-for="( element, index ) in getOptions">
            <input type="checkbox" :id="toggleLabel + index" :value="element.value" @change="change(event, element.label)">
            <label :for="toggleLabel + index"></label>
            <span @click="toggle(toggleLabel + index, element.label)" :style="$store.getters.getCustomStyles['toggle']">{{ element.label }}</span>
        </div>
    </div>
    <p class="calc-description" :style="$store.getters.getCustomStyles['descriptions']">{{ toggleField.description }}</p>
</div>
