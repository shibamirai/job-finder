<script setup>
import { computed } from 'vue';

let props = defineProps({
    modelValue: Array,
    options: Array,
});

const emit = defineEmits(['update:modelValue']);

const proxySelected = computed({
    get() {
        return props.modelValue;
    },

    set(val) {
        emit('update:modelValue', val);
    },
});
</script>

<template>
    <v-select
        v-model="proxySelected"
        :options="options"
    ></v-select>
</template>

<style>
.v-select .vs__search,
.v-select .vs__search:focus {
    color: var(--vs-search-input-color);
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    line-height: var(--vs-line-height);
    font-size: var(--vs-font-size);
    border: 1px solid transparent;
    border-left: none;
    outline: none;
    margin: 0 0 0;
    padding: .5rem .75rem;
    background: none;
    box-shadow: none;
    width: 0;
    max-width: 100%;
    flex-grow: 1;
    z-index: 1;

    --vs-search-input-placeholder-color: gray;
}
.v-select .vs__dropdown-toggle {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    display: flex;
    padding: 0;
    background: none;
    white-space: normal;

    --tw-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --tw-shadow-colored: 0 1px 2px 0 var(--tw-shadow-color);
    box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
    --tw-border-opacity: 1;
    border-color: rgb(209 213 219 / var(--tw-border-opacity));
    border-radius: 0.375rem;
}
.v-select .vs__dropdown-toggle:focus-within {
    --tw-ring-opacity: 0.5;
    --tw-ring-color: rgb(165 243 252 / var(--tw-ring-opacity));
    --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
    --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(3px + var(--tw-ring-offset-width)) var(--tw-ring-color);
    box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
    --tw-border-opacity: 1;
    border-color: rgb(103 232 249 / var(--tw-border-opacity));
}
.v-select .vs__selected {
    display: flex;
    align-items: center;
    background-color: #fff;
    border: none;
    border-radius: var(--vs-border-radius);
    color: var(--vs-selected-color);
    line-height: var(--vs-line-height);
    margin: 0 2px 0;
    padding: 0 .25em;
    z-index: 0;
}
.v-select .vs__dropdown-menu {
  --vs-dropdown-box-shadow: 0px 2px 2px 2px rgba(165, 243, 252, 1);
  --vs-dropdown-option--active-bg: rgba(6, 182, 212, 1);
}
</style>
