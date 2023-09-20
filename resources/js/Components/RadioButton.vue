<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:modelValue']);

const props = defineProps({
  modelValue: {
        type: String,
        required: true,
    },
  options: Array
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
  <div class="flex flex-wrap items-center">
    <div v-for="(option, index) in options" :key="index">
      <label>
        <input 
          class="text-cyan-500 border-gray-300 focus:border-cyan-300 focus:ring focus:ring-cyan-200 focus:ring-opacity-50"
          type="radio"
          :value="index"
          v-model="proxySelected"
        >
        <span class="ml-2 mr-4">{{ option }}</span>
      </label>
    </div>
  </div>
</template>
