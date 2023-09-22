<script setup>
defineProps({
  modelValue: {
    type: String,
    required: true,
  },
  options: Object,
})

const emit = defineEmits(['update:modelValue']);

const appUrl = import.meta.env.VITE_APP_URL;
</script>
<template>
  <div class="flex flex-wrap items-center">
    <div v-for="avatar in options" class="text-center mr-2">
      <img :src="appUrl + '/avatar/' + avatar" alt="avatar" class="w-16 rounded-full">
      <input type="radio"
        class="text-cyan-500 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        name="avatar"
        :value="avatar"
        :checked="avatar == modelValue"
        @change="emit('update:modelValue', $event.target.value)"
      >
    </div>
  </div>
</template>