<script setup>
import { ref } from 'vue'
import Header from '@/Components/Header.vue'
import BarChart from '@/Charts/BarChart.vue'
import HorizontalBarChart from '@/Charts/HorizontalBarChart.vue'
import PieChart from '@/Charts/PieChart.vue'
import TabItem from '@/Charts/TabItem.vue'

let props = defineProps({
  total: Number,
  ages: Array,
  count_it: Number,
  genders: Array,
  handicaps: Array,
  employment_patterns: Array,
  skills: Array,
  days_of_uses: Array,
})

const ageLabels = ['～24歳', '25～29歳', '30～34歳', '35～39歳', '40～44歳', '45～49歳', '50～54歳', '55～59歳', '60歳以上'];
const ageData   = [0, 0, 0, 0, 0, 0, 0, 0, 0];
for (let i = 0; i < props.ages.length; i++) {
  if (props.ages[i] < 25) {
    ageData[0]++;
  } else if (props.ages[i] < 30) {
    ageData[1]++;
  } else if (props.ages[i] < 35) {
    ageData[2]++;
  } else if (props.ages[i] < 40) {
    ageData[3]++;
  } else if (props.ages[i] < 45) {
    ageData[4]++;
  } else if (props.ages[i] < 50) {
    ageData[5]++;
  } else if (props.ages[i] < 55) {
    ageData[6]++;
  } else if (props.ages[i] < 60) {
    ageData[7]++;
  } else {
    ageData[8]++;
  }
}

let daysMax = props.days_of_uses[0];
let daysMin = props.days_of_uses[0];
let daysSum = 0;
for (let i = 0; i < props.days_of_uses.length; i++) {
  if (props.days_of_uses[i] > daysMax) {
    daysMax = props.days_of_uses[i];
  }
  if (props.days_of_uses[i] < daysMin) {
    daysMin = props.days_of_uses[i];
  }
  daysSum += props.days_of_uses[i];
}
const daysAve = Math.floor(daysSum / props.days_of_uses.length);

const itLabels = ['IT系', 'それ以外'];
const itData = [props.count_it, props.total - props.count_it];

// タブ切り替え
const open = ref(1)
function tabClicked(id) {
  open.value = id
}
</script>

<template>
  <p class="text-center text-2xl text-gray-700 mt-4">
    のべ就職者数 {{ total }}人
  </p>
  <p class="text-center text-2xl text-gray-700 mb-4">
    平均利用期間 {{ daysAve }}日<span class="text-sm">(最短 {{ daysMin }}日, 最長 {{ daysMax }}日)</span>
  </p>

  <div class="bg-white pb-8">
    <nav class="mx-auto mb-4">
      <ul class="flex text-center">
        <TabItem :id=1 :open="open" @open="tabClicked">年齢分布</TabItem>
        <TabItem :id=2 :open="open" @open="tabClicked">雇用形態</TabItem>
        <TabItem :id=3 :open="open" @open="tabClicked">就職分野</TabItem>
        <TabItem :id=4 :open="open" @open="tabClicked">習得スキル</TabItem>
        <TabItem :id=5 :open="open" @open="tabClicked">性別</TabItem>
        <TabItem :id=6 :open="open" @open="tabClicked">障害</TabItem>
      </ul>
    </nav>
    <main>
      <BarChart
        v-if="open === 1"
        :data="ageData"
        :labels="ageLabels"
      />
      <HorizontalBarChart
        v-if="open === 2"
        :data="employment_patterns.map((ep) => ep.workers_count)"
        :labels="employment_patterns.map((ep) => ep.name)"
      />
      <PieChart
        v-if="open === 3"
        :data="itData"
        :labels="itLabels"
      />
      <HorizontalBarChart
        v-if="open === 4"
        :data="skills.map((skill) => skill.masters_count)"
        :labels="skills.map((skill) => skill.name)"
      />
      <PieChart
        v-if="open === 5"
        :data="genders.map((gender) => gender.workers_count)"
        :labels="genders.map((gender) => gender.name)"
      />
      <PieChart
        v-if="open === 6"
        :data="handicaps.map((handicap) => handicap.affects_count)"
        :labels="handicaps.map((handicap) => handicap.name)"
      />
    </main>
  </div>
</template>
