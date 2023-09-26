<script setup>
import { useForm } from '@inertiajs/vue3'
import Toggle from '@vueform/toggle';
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'

const newForm = useForm({
  name: '',
  is_it: true
})

const onSubmit = () => {
  newForm.post(route('occupations.store'))
  newForm.reset()
}
</script>

<style src="@vueform/toggle/themes/default.css"></style>

<template>
  <form @submit.prevent="onSubmit" class="pb-4 flex items-center border-b border-gray-300">
    <div class="flex-1 px-3 py-3">
      <TextInput
        class="w-full"
        type="text"
        v-model="newForm.name"
        placeholder="追加したい職種を入力してください"
      />
    </div>
    <div class="w-20 py-3 text-center">
      <Toggle v-model="newForm.is_it" on-label="IT系" />
    </div>
    <div class="w-20 py-3 text-center">
      <PrimaryButton class="text-xs w-16">追加</PrimaryButton>
    </div>
  </form>
</template>
