<script setup>
import Header from '@/Components/Header.vue'
import Form from '@/Pages/JobFinders/Form.vue'

defineProps({
  'jobFinder': Object,
  'labels': Array,
})
</script>
<template>
  <Header>
    就職者さんデータ入力フォーム
  </Header>

  <Form :jobFinder="jobFinder" :labels="labels" />
</template>