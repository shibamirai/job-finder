<script setup>
import Header from '@/Components/Header.vue'
import Form from './Partials/Form.vue'

defineProps({
  'employmentPatterns': Array,
  'genders': Array,
  'handicaps': Array,
  'labels': Object,
})
</script>
<template>
  <Header>
    就職者さんデータ入力フォーム
  </Header>

  <Form
    :employmentPatterns="employmentPatterns"
    :genders="genders"
    :handicaps="handicaps"
    :labels="labels"
  />
</template>