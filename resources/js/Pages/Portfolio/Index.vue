<script setup>
import Pagenation from '@/Components/Pagination.vue';
import Header from '@/Components/Header.vue';
import Card from './Partials/Card.vue';

defineProps({
  jobFinders: Object
});
</script>

<template>
  <!-- Page heading -->
  <Header>
    就職者さんのデータ・ポートフォリオ
  </Header>

  <!-- Page Content -->
  <main>
    <div class="lg:grid lg:grid-cols-6">
      <Card
        v-for="jobFinder in jobFinders.data"
        :key="jobFinder.id"
        :jobFinder="jobFinder"
        class="col-span-2 mx-4 mb-6"
      ></Card>
    </div>
    <Pagenation
      :prev_page_url="jobFinders.prev_page_url"
      :next_page_url="jobFinders.next_page_url"
      :from="jobFinders.from"
      :to="jobFinders.to"
      :total="jobFinders.total"
      :links="jobFinders.links" />
  </main>
</template>