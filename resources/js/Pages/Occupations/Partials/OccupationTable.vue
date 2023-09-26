<script setup>
import OccupationTableRow from './OccupationTableRow.vue'

const props = defineProps({
  occupations: Array
});

</script>

<template>
  <table class="w-full text-left">
    <thead class="text-cyan-500">
      <tr class="border-b-2 border-gray-300">
        <th class="px-3 py-3">職種</th>
        <th class="w-20 py-3 text-center">IT系</th>
        <th class="w-20 py-3 text-center">削除</th>
      </tr>
    </thead>

    <tbody>
      <OccupationTableRow v-for="occupation in occupations" :key="occupation.id" :occupation="occupation" />
    </tbody>
  </table>
</template>
