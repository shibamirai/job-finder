<script setup>
defineProps({
  'active': Boolean
})

defineEmits(['click'])
</script>
<template>
  <li class="flex-1 py-2 rounded-t-md text-sm font-medium"
    :class="{
      'bg-white': active,
      'bg-gray-200': !active,
      'text-gray-400': !active,
      'hover:text-gray-700': !active
    }"
  >
    <button class="w-full" @click="$emit('click')">
      <slot />
    </button>
  </li>
</template>
