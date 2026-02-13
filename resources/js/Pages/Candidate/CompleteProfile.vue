<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  phone: '',
  birth_date: '',
})

function submit() {
  form.post(route('candidate.complete-profile.store'))
}
</script>

<template>
  <div class="max-w-xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">
      Complete seu perfil
    </h1>

    <form @submit.prevent="submit" class="space-y-4">

      <div>
        <label class="block mb-1">Telefone</label>
        <input
          v-model="form.phone"
          type="text"
          class="w-full border rounded p-2"
        />
        <div v-if="form.errors.phone" class="text-red-500 text-sm">
          {{ form.errors.phone }}
        </div>
      </div>

      <div>
        <label class="block mb-1">Data de Nascimento</label>
        <input
          v-model="form.birth_date"
          type="date"
          class="w-full border rounded p-2"
        />
        <div v-if="form.errors.birth_date" class="text-red-500 text-sm">
          {{ form.errors.birth_date }}
        </div>
      </div>

      <button
        type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded"
        :disabled="form.processing"
      >
        Salvar e continuar
      </button>

    </form>
  </div>
</template>
