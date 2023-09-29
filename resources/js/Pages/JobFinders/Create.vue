<script setup>
import Header from '@/Components/Header.vue'
import Form from './Partials/Form.vue'

defineProps({
  'handicaps': Array,
  'labels': Object,
})
</script>
<template>
  <Header>
    就職者さんデータ入力フォーム
  </Header>

  <Form :handicaps="handicaps" :labels="labels" />
</template>