<script setup>
import { ref } from 'vue'
import Tab from '@/Components/Tab.vue'
import TabItem from '@/Components/TabItem.vue'
import Header from '@/Components/Header.vue'
import Work from './Partials/Work.vue'
import Form from './Partials/Form.vue'

const props = defineProps({
    'jobFinder': Object,
    'employmentPatterns': Array,
    'handicaps': Array,
    'labels': Object
})

const currentComponent = ref('Form')
const currentTab = ref('Form')
const components = {
    'Form': Form,
    'Work': Work
}

const selectedWork = ref()
const onTabClick = (component, work) => {
    currentComponent.value = component
    selectedWork.value = work
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
            :active="currentTab === 'Work' + work.id"
            @click="onTabClick('Work', work)"
        >
            作品「{{ work.content }}」
        </TabItem>
        <TabItem :active="currentTab === 'Work'" @click="onTabClick('Work')">
            ポートフォリオ追加
        </TabItem>
    </Tab>
    
    <component :is="components[currentComponent]"
        :jobFinder="jobFinder"
        :employmentPatterns="employmentPatterns"
        :handicaps="handicaps"
        :labels="labels"
        :work="selectedWork"
        @submit="onTabClick('Form')"
    ></component>
</template>
