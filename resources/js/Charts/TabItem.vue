<script setup>
defineProps({
  id: Number,
  open: Number
})

defineEmits([
  'open'
])
</script>
<template>
  <li class="flex-1 py-2 rounded-t-md text-sm font-medium cursor-pointer"
    :class="{
      'bg-white': open === id,
      'bg-gray-200': open !== id,
      'text-gray-400': open !== id,
      'hover:text-gray-700': open !== id
    }"
    @click="$emit('open', id)"
  >
    <slot />
  </li>
</template>