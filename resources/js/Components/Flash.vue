<script setup>
import { onUpdated } from 'vue'
import { usePage } from '@inertiajs/vue3'

// メッセージを10秒後に消す
const page = usePage()
onUpdated(() => {
  if (page.props.flash.success) {
    setTimeout(() => {
      delete page.props.flash.success
    }, 10000)
  }
})
</script>

<template>
  <div v-if="$page.props.flash.success"
    class="fixed shadow bg-white text-cyan-500 py-2 px-8 rounded-full bottom-3 right-3 text-sm"
  >
    {{ $page.props.flash.success }}
  </div>
</template>
