<script setup>
import RoundButton from '@/Components/RoundButton.vue';

defineProps({
  jobFinder: Object
});
</script>

<template>
  <div>
    <p class="text-gray-600 text-sm font-semibold">{{ jobFinder.hired }}</p>
    <div class="bg-white rounded-2xl px-6 py-6">
      <header class="flex items-center">
        <img :src="'avatar/' + jobFinder.avatar" alt="" class="rounded-full mr-4 w-16 border border-gray-00">
        <div>
          <p class="text-sm">{{ jobFinder.age }}歳 {{ jobFinder.gender.name }}</p>
          <p class="text-xl font-bold text-cyan-500 tracking-wider">{{ jobFinder.occupation.name }}</p>
          <p class="text-sm">{{ jobFinder.description }}</p>
        </div>
      </header>
      <div class="mt-6 text-sm">
        <table class="w-full">
          <tr class="border-y-2">
            <th class="text-left font-bold px-4 py-2">障害</th>
            <td>
              {{ jobFinder.handicaps.map(handicap => handicap.name).join(", ") }}
              (手帳{{ jobFinder.has_certificate ? 'あり' : 'なし' }})
            </td>
          </tr>
          <tr class="border-y-2">
            <th class="text-left font-bold px-4 py-2">利用期間</th>
            <td>{{ jobFinder.period_of_use }}</td>
          </tr>
          <tr class="border-y-2">
            <th class="text-left font-bold px-4 py-2">習得スキル</th>
            <td>{{ jobFinder.skills.map(skill => skill.name).join(", ") }}</td>
          </tr>
          <tr class="border-y-2">
            <th class="text-left font-bold px-4 py-2">雇用形態</th>
            <td>
              {{ jobFinder.employment_pattern.name }}
              ({{ jobFinder.is_handicaps_opened ? 'オープン' : 'クローズ' }}就労)
            </td>
          </tr>
        </table>
      </div>
      <Link :href="route('portfolio.show', jobFinder.id)">
      <RoundButton v-if="jobFinder.works_count > 0" class="w-full justify-center mt-8">ポートフォリオを見る</RoundButton>
      <RoundButton v-else class="w-full justify-center mt-8" disabled>ポートフォリオを見る</RoundButton>
      </Link>
    </div>
  </div>
</template>