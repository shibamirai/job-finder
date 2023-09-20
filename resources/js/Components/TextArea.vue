<script setup>
import { computed } from 'vue';

const props = defineProps({
    name: {
        type: String,
        required: true,
    },
    modelValue: {
        type: String,
        required: true,
    },
});

const emits = defineEmits(['update:modelValue']);
</script>

<template>
    <textarea
        :id="name"
        :name="name"
        class="w-full rounded-md shadow-sm border-gray-300 focus:border-cyan-300 focus:ring focus:ring-cyan-200 focus:ring-opacity-50"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >
    </textarea>
</template>
