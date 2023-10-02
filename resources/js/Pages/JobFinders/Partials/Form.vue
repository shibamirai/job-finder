<script setup>
import AvatarSelect from './AvatarSelect.vue'
import Checkbox from '@/Components/Checkbox.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue'
import TextInput from '@/Components/TextInput.vue'
import RoundButton from '@/Components/RoundButton.vue'
import SelectBox from '@/Components/SelectBox.vue'
import MultiSelectBox from '@/Components/MultiSelectBox.vue'
import RadioButton from '@/Components/RadioButton.vue'
import { useForm } from '@inertiajs/vue3';
import 'vue-select/dist/vue-select.css';

let props = defineProps({
  jobFinder: Object,
  employmentPatterns: Array,
  handicaps: Array,
  labels: Object,
})

let form = useForm({
  avatar:               props.jobFinder ? props.jobFinder.avatar              : '',
  name:                 props.jobFinder ? props.jobFinder.name                : '',
  gender:               props.jobFinder ? props.jobFinder.gender              : 0,
  age:                  props.jobFinder ? props.jobFinder.age                 : '',
  handicaps:            props.jobFinder ? props.jobFinder.handicaps
                                                .map(handicap => handicap.id) : [],
  has_certificate:      props.jobFinder ? props.jobFinder.has_certificate     : false,
  use_from:             props.jobFinder ? props.jobFinder.use_from            : '',
  skills:               props.jobFinder ? props.jobFinder.skills
                                                    .map(skill => skill.name) : [],
  occupation:           props.jobFinder ? props.jobFinder.occupation.name     : '',
  description:          props.jobFinder ? props.jobFinder.description         : '',
  hired_at:             props.jobFinder ? props.jobFinder.hired_at            : '',
  employment_pattern_id:props.jobFinder ? props.jobFinder.employment_pattern.id: 1,
  is_handicaps_opened:  props.jobFinder ? props.jobFinder.is_handicaps_opened : false,
})

let submit = () => {
  if (props.jobFinder) {
    form.patch(route('job-finders.update', props.jobFinder.id))
  } else {
    form.post(route('job-finders.store'))
  }
}
</script>

<template>
  <div class="max-w-4xl mx-auto bg-white shadow-md rounded px-10 py-8">
    <h1 class="text-xl text-cyan-500 text-center font-bold">利用者さんについて</h1>

    <form @submit.prevent="submit">
      <!-- アバター -->
      <div class="mt-4 md:grid md:grid-cols-6 items-center">
        <InputLabel value="アバターを選ぶ" />

        <AvatarSelect class="col-span-5" :options="labels.avatar" v-model="form.avatar" />

        <InputError v-if="form.errors.avatar" :message="form.errors.avatar" class="col-start-2 col-span-5" />
      </div>

      <!-- 名前 -->
      <div class="mt-4 md:grid md:grid-cols-6 items-center">
        <InputLabel value="名前" />

        <TextInput v-if="jobFinder" class="col-span-5" name="name" type="text" v-model="form.name"
          placeholder="非公開" autocomplete="off" readonly />
        <TextInput v-else="jobFinder" class="col-span-5" name="name" type="text" v-model="form.name"
          placeholder="非公開" autocomplete="off" required />

        <InputError v-if="form.errors.name" :message="form.errors.name" class="col-start-2 col-span-5" />
      </div>

      <!-- 性別 -->
      <div class="mt-4 md:grid md:grid-cols-6 items-center">
        <InputLabel value="性別" />

        <div class="flex flex-wrap items-center col-span-5">
          <div v-for="(option, index) in labels.gender" :key="index">
            <label>
              <RadioButton v-model="form.gender" :value="index" name="gender"/>
              <span class="ml-2 mr-4">{{ option }}</span>
            </label>
          </div>
        </div>

        <InputError v-if="form.errors.gender" :message="form.errors.gender" class="col-start-2 col-span-5" />
      </div>

      <!-- 年齢 -->
      <div class="mt-4 md:grid md:grid-cols-6 items-center">
        <InputLabel value="年齢" />

        <TextInput class="col-start-2"
          type="number"
          min="18"
          max="70"
          name="age"
          v-model="form.age"
          required
        />
        <div class="ml-2">歳</div>

        <InputError v-if="form.errors.age" :message="form.errors.age" class="col-start-2 col-span-5" />
      </div>

      <!-- 障害 -->
      <div class="mt-4 md:grid md:grid-cols-6 items-center">
        <InputLabel value="障害" />

        <label v-for="handicap in handicaps" :key="handicap.id" class="flex items-center">
            <Checkbox name="handicaps" v-model:checked="form.handicaps" :value="handicap.id"/>
            <span class="ml-2 mr-4">{{ handicap.name }}</span>
        </label>

        <InputError v-if="form.errors.handicaps" :message="form.errors.handicaps" class="col-start-2 col-span-5" />
      </div>

      <!-- 手帳有無 -->
      <div class="mt-4 md:grid md:grid-cols-6 items-center">
        <InputLabel value="手帳有無" />

        <label class="flex items-center">
            <Checkbox name="has_certificate" v-model:checked="form.has_certificate" />
            <span class="ml-2 mr-4">手帳あり</span>
        </label>

        <InputError v-if="form.errors.has_certificate" :message="form.errors.has_certificate" class="col-start-2 col-span-5" />
      </div>

      <!-- 利用開始日 -->
      <div class="mt-4 md:grid md:grid-cols-6 items-center">
        <InputLabel value="利用開始日" />

        <TextInput class="col-span-2"
          type="date"
          id="use_from"
          name="use_from"
          v-model="form.use_from"
          required
        />

        <InputError v-if="form.errors.use_from" :message="form.errors.use_from" class="col-start-2 col-span-5" />
      </div>

      <!-- 習得スキル -->
      <div class="mt-4 md:grid md:grid-cols-6 items-center">
        <InputLabel value="習得スキル" />

        <MultiSelectBox class="col-span-5"
          name="skill"
          :options="labels.skill"
          v-model="form.skills"
          taggable
          placeholder="選択または入力（複数可）"
        />

        <InputError v-if="form.errors.skills" :message="form.errors.skills" class="col-start-2 col-span-5" />
      </div>

      <h1 class="text-xl text-cyan-500 text-center font-bold mt-10">就職先について</h1>

      <!-- 職種 -->
      <div class="mt-4 md:grid md:grid-cols-6 items-center">
        <InputLabel value="職種" />

        <SelectBox class="col-span-2"
          name="occupation"
          :options="labels.occupation"
          v-model="form.occupation"
          taggable
          placeholder="選択または入力"
        />

        <InputError v-if="form.errors.occupation" :message="form.errors.occupation" class="col-start-2 col-span-5" />
      </div>

      <!-- 仕事内容 -->
      <div class="mt-4 md:grid md:grid-cols-6 items-center">
        <InputLabel value="仕事内容" />

        <TextInput class="col-span-5" type="text" name="description"
          v-model="form.description" placeholder="システム開発, Webサイト構築など" />

        <InputError v-if="form.errors.description" :message="form.errors.description" class="col-start-2 col-span-5" />
      </div>

      <!-- 就労開始日 -->
      <div class="mt-4 md:grid md:grid-cols-6 items-center">
        <InputLabel value="就労開始日" />

        <TextInput class="col-span-2" type="date" name="hired_at"
          v-model="form.hired_at" required />

        <InputError v-if="form.errors.hired_at" :message="form.errors.hired_at" class="col-start-2 col-span-5" />
      </div>

      <!-- 雇用形態 -->
      <div class="mt-4 md:grid md:grid-cols-6 items-center">
        <InputLabel value="雇用形態" />

        <div class="flex flex-wrap items-center col-span-5">
          <div v-for="employment_pattern in employmentPatterns" :key="employment_pattern.id">
            <label>
              <RadioButton v-model="form.employment_pattern_id" :value="employment_pattern.id" name="employment_pattern_id"/>
              <span class="ml-2 mr-4">{{ employment_pattern.name }}</span>
            </label>
          </div>
        </div>

        <InputError v-if="form.errors.employment_pattern_id" :message="form.errors.employment_pattern_id" class="col-start-2 col-span-5" />
      </div>

      <!-- 就労スタイル -->
      <div class="mt-4 md:grid md:grid-cols-6 items-center">
        <InputLabel value="就労スタイル" />

        <label class="flex items-center">
            <Checkbox name="is_handicaps_opened" v-model:checked="form.is_handicaps_opened" />
            <span class="ml-2 mr-4">オープン就労</span>
        </label>

        <InputError v-if="form.errors.is_handicaps_opened" :message="form.errors.is_handicaps_opened" class="col-start-2 col-span-5" />
      </div>

      <div class="text-center mt-8">
        <RoundButton class="w-36">{{ jobFinder ? '更新' : '登録'}}</RoundButton>
      </div>
    </form>
  </div>
</template>
