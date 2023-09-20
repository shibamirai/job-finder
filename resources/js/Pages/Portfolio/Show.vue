<script setup>
import Detail from './Partials/Detail.vue';
import Header from '@/Components/Header.vue';
import RoundButton from '@/Components/RoundButton.vue';

defineProps({
  'jobFinder': Object
});
</script>

<template>
  <Header>
    就職者さんのデータ・ポートフォリオ
  </Header>

  <main>
    <div class="bg-white rounded-lg px-10 py-8">
      <Detail :jobFinder="jobFinder" />
      <div class="flex justify-center">
          <Link :href="route('index')">
            <RoundButton class="w-48 justify-center">
              一覧へ戻る
            </RoundButton>
          </Link>
      </div>
    </div>
  </main>
</template>