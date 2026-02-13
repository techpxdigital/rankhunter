<script setup>
import { useForm } from '@inertiajs/vue3'
import { defineProps } from 'vue'

const props = defineProps({
  headhunter: Object,
  token: String
})

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
})

function submit() {
  form.post(`/r/${props.token}`)
}
</script>

<template>
  <div>
    <h1>Cadastro via {{ headhunter.name }}</h1>

    <form @submit.prevent="submit">
      <input v-model="form.name" placeholder="Nome" />
      <input v-model="form.email" type="email" placeholder="Email" />
      <input v-model="form.password" type="password" placeholder="Senha" />
      <input v-model="form.password_confirmation" type="password" placeholder="Confirmar Senha" />

      <button type="submit">Cadastrar</button>
    </form>
  </div>
</template>
