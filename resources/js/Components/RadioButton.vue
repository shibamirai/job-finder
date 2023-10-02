<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:modelValue']);

const props = defineProps({
  modelValue: {
        type: Number,
        required: true,
    },
  value: Number,
  name: String,
});

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
  <input 
    class="text-cyan-500 border-gray-300 focus:border-cyan-300 focus:ring focus:ring-cyan-200 focus:ring-opacity-50"
    type="radio"
    :value="value"
    :name="name"
    v-model="proxySelected"
  >
</template>
