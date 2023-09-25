<script setup>
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue'
import TextArea from '@/Components/TextArea.vue'
import TextInput from '@/Components/TextInput.vue'
import RoundButton from '@/Components/RoundButton.vue'
import { useForm } from '@inertiajs/vue3'
import { watch } from 'vue'

const props = defineProps({
  jobFinder: {
    type: Object,
  },
  work:  {
    type: Object,
  },
})

// 各 form の submit が成功したら利用者情報編集タブにもどるために使用する
const emit = defineEmits(['submit'])

const form = useForm({
  content:       props.work ? props.work.content       : '',
  title:         props.work ? props.work.title         : '',
  url:           props.work ? props.work.url           : '',
  languages:     props.work ? props.work.languages     : '',
  creation_time: props.work ? props.work.creation_time : '',
  description:   props.work ? props.work.description   : '',
})

watch(
  () => props.work,
  (work) => {
    form.content      = work ? work.content       : ''
    form.title        = work ? work.title         : ''
    form.url          = work ? work.url           : ''
    form.languages    = work ? work.languages     : ''
    form.creation_time= work ? work.creation_time : ''
    form.description  = work ? work.description   : ''
  }
)

const submit = () => {
  if (props.work) {
    form.patch(route('job-finders.works.update', [props.jobFinder.id, props.work.id]), {
      onSuccess: () => emit('submit')
    })
  } else {
    form.post(route('job-finders.works.store', props.jobFinder.id), {
      onSuccess: () => emit('submit')
    })
  }
}

const onDeleteSubmit = () => {
  form.delete(route('job-finders.works.destroy', [props.jobFinder.id, props.work.id]), {
    onSuccess: () => emit('submit')
  })
}
</script>

<template>
  <div class="max-w-4xl mx-auto bg-white shadow-md rounded px-10 py-8 mb-4">
    <h1 class="text-xl text-cyan-500 text-center font-bold">成果物（ポートフォリオ）について</h1>

    <form @submit.prevent="submit">
      <!-- 作品の内容 -->
      <div class="mt-4 md:grid md:grid-cols-6 items-center">
        <InputLabel value="作品の内容" />

        <TextInput class="col-span-5" name="content" type="text" v-model="form.content"
          placeholder="旅行サイト、ポートフォリオサイトなど" required autofocus />

        <InputError v-if="form.errors.content" :message="form.errors.content" class="col-start-2 col-span-5" />
      </div>

      <!-- 作品名 -->
      <div class="mt-4 md:grid md:grid-cols-6 items-center">
        <InputLabel value="作品名" />

        <TextInput class="col-span-5" name="title" type="text" v-model="form.title"
          placeholder="省略可" />

        <InputError v-if="form.errors.title" :message="form.errors.title" class="col-start-2 col-span-5" />
      </div>

      <!-- URL -->
      <div class="mt-4 md:grid md:grid-cols-6 items-center">
        <InputLabel value="URL" />

        <TextInput class="col-span-5" name="url" type="text" v-model="form.url" />

        <InputError v-if="form.errors.url" :message="form.errors.url" class="col-start-2 col-span-5" />
      </div>

      <!-- 使用言語 -->
      <div class="mt-4 md:grid md:grid-cols-6 items-center">
        <InputLabel value="使用言語" />

        <TextInput class="col-span-5" name="languages" type="text" v-model="form.languages"
          placeholder="PHP、JAVAなど" required />

        <InputError v-if="form.errors.languages" :message="form.errors.languages" class="col-start-2 col-span-5" />
      </div>

      <!-- 制作期間 -->
      <div class="mt-4 md:grid md:grid-cols-6 items-center">
        <InputLabel value="制作期間" />

        <TextInput class="col-start-2"
          type="number"
          min="0"
          name="creation_time"
          v-model="form.creation_time"
        />
        <div class="ml-2">ヶ月</div>

        <InputError v-if="form.errors.creation_time" :message="form.errors.creation_time" class="col-start-2 col-span-5" />
      </div>

      <!-- 自由記入 -->
      <div class="mt-4 md:grid md:grid-cols-6 items-center">
        <InputLabel value="自由記入" />

        <TextArea class="col-span-5 h-48"
          placeholder="頑張った点など自由に記入してください"
          name="description"
          v-model="form.description"
        />

        <InputError v-if="form.errors.description" :message="form.errors.description" class="col-start-2 col-span-5" />
      </div>

      <div class="text-center mt-8">
        <RoundButton class="w-36">{{ work ? '更新' : '追加'}}</RoundButton>
        <RoundButton v-if="work" class="w-36 ml-1" form="delete">削除</RoundButton>
      </div>
    </form>
    <form v-if="work" id="delete" @submit.prevent="onDeleteSubmit"></form>
  </div>
</template>
