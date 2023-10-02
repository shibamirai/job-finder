<script setup>
import Work from './Work.vue';

defineProps({
  jobFinder: Object,
  editing: {
    type: Boolean,
    default: false
  }
});
</script>

<template>
  <div class="lg:flex border border-white">
    <div class="flex-1 lg:px-10 py-8">
      <div class="pl-4">
        <div v-if="editing">
          <div class="flex items-center">
            <img :src="'../avatar/' + jobFinder.avatar" alt=""
              class="rounded-full mr-4 w-16 border border-gray-00">
            <div>
              <div class="flex items-center">
                <p class="text-xl font-bold mr-4">{{ jobFinder.name }}</p>
                <p class="text-sm">{{ jobFinder.age }}歳 {{ jobFinder.gender_label }}</p>
              </div>
              <p class="text-xl font-bold text-cyan-500 tracking-wider">{{ jobFinder.occupation.name }}</p>
            </div>
          </div>
        </div>
        <div v-else>
          <img :src="'../avatar/' + jobFinder.avatar" alt=""
            class="rounded-full w-48 border-4 border-gray-500">
          <p class="relative left-14">{{ jobFinder.age }}歳 {{ jobFinder.gender_label }}</p>
          <p class="text-2xl font-bold text-cyan-500 tracking-wider py-1">{{ jobFinder.occupation.name }}</p>
        </div>
        <p class="">{{ jobFinder.description }}</p>
      </div>
      <div class="mt-6">
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
            <th class="text-left font-bold px-4 py-2">就職時期</th>
            <td>{{ jobFinder.hired }}</td>
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
    </div>
    <div class="flex-1 lg:px-10 py-8">
      <Work v-for="work in jobFinder.works" :key="work.id" :work="work" />
    </div>
  </div>
</template>