<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import Toggle from '@vueform/toggle'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'

const props = defineProps({
  occupation: Object
});

// カスタムディレクティブ v-focus の定義。
const vFocus = {
  mounted: (el) => el.focus()
}

const isEditing = ref(false)

const form = useForm({
  id: props.occupation.id,
  name: props.occupation.name,
  is_it: props.occupation.is_it
})

// フォーカスが外れたら編集モードを解除する。
const onBlur = () => {
  isEditing.value = false
  form.reset()
}

const updateItem = () => {
  form.patch(route('occupations.update', props.occupation.id), {
    preserveScroll: true,
    onSuccess: () => {
      isEditing.value = false
      form.defaults({
        id: props.occupation.id,
        name: props.occupation.name,
        is_it: props.occupation.is_it
      })
    },
    onError: () => {
      form.reset()
    }
  }) 
}

const deleteItem = () => {
  if (confirm(props.occupation.name + 'を削除しますか？')) {
    useForm({}).delete(route('occupations.destroy', props.occupation.id), {
      preserveScroll: true
    });
  }
};
</script>

<style src="@vueform/toggle/themes/default.css"></style>

<template>
  <tr class="border-b border-gray-300">
    <td class="px-3 py-3">
      <div v-if="!isEditing" @click="isEditing = true">{{ occupation.name }}</div>
      <form v-else @submit.prevent="updateItem">
        <TextInput type="text" v-model="form.name" v-focus @blur="onBlur" class="w-full"/>
      </form>
    </td>
    <td class="py-3 text-center">
      <Toggle v-model="form.is_it" @change="updateItem" />
    </td>
    <td class="py-3 text-center">
      <!-- その職種での就職者がだれもいない場合のみ削除可能とする -->
      <PrimaryButton class="text-xs w-16" @click="deleteItem" :disabled="occupation.workers_count > 0">削除</PrimaryButton>
    </td>
  </tr>
</template>
