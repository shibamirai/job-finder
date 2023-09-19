<script>
import AppLayout from '@/Layouts/AppLayout.vue';
export default {
  layout: AppLayout
};
</script>

<script setup>
import Header from '@/Pages/Portfolio/Header.vue';
import Detail from '@/Pages/Portfolio/Detail.vue';
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