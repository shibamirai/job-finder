<script setup>
import { ref } from 'vue'
import Tab from '@/Components/Tab.vue'
import TabItem from '@/Components/TabItem.vue'
import Header from '@/Components/Header.vue'
import Portfolio from '@/Pages/JobFinders/Portfolio.vue'
import Form from '@/Pages/JobFinders/Form.vue'

const props = defineProps({
    'jobFinder': Object,
    'labels': Array
})

const currentComponent = ref('Form')
const currentTab = ref('Form')
const components = {
    'Form': Form,
    'Portfolio': Portfolio
}

const portfolio = ref()
const onTabClick = (component, work) => {
    currentComponent.value = component
    portfolio.value = work
    currentTab.value = component + (work ? work.id : '') 
}
</script>

<template>
    <Header>
        就職者さんデータ編集フォーム
    </Header>

    <Tab>
        <TabItem :active="currentTab === 'Form'" @click="onTabClick('Form')">
            {{ jobFinder.name }}さんについて
        </TabItem>
        <TabItem v-for="work in jobFinder.works" :key="work.id"
            :active="currentTab === 'Portfolio' + work.id"
            @click="onTabClick('Portfolio', work)"
        >
            作品「{{ work.content }}」
        </TabItem>
        <TabItem :active="currentTab === 'Portfolio'" @click="onTabClick('Portfolio')">
            ポートフォリオ追加
        </TabItem>
    </Tab>
    
    <component :is="components[currentComponent]"
        :jobFinder="jobFinder"
        :labels="labels"
        :work="portfolio"
        @submit="onTabClick('Form')"
    ></component>
</template>
