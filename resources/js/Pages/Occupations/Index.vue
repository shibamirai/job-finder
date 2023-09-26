<script setup>
import Header from '@/Components/Header.vue'
import NewItem from './Partials/NewItem.vue'
import OccupationTable from './Partials/OccupationTable.vue'

defineProps({
  occupations: Array
});
</script>

<template>
  <Header>職種編集</Header>

  <main class="max-w-2xl mx-auto bg-white shadow-md rounded px-10 py-8 overflow-auto">

    <NewItem />

    <OccupationTable :occupations="occupations" />

  </main>
</template>
