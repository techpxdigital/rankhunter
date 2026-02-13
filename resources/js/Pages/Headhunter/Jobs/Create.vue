<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    title: '',
    description: '',
    location: '',
    type: '',
    salary: '',
});

const submit = () => {
    form.post(route('headhunter.jobs.store'));
};
</script>

<template>
    <div class="p-6 max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Criar Nova Vaga</h1>

        <form @submit.prevent="submit" class="space-y-4">
            <div>
                <label>Título</label>
                <input v-model="form.title" type="text" class="w-full border p-2" />
                <div v-if="form.errors.title" class="text-red-500 text-sm">
                    {{ form.errors.title }}
                </div>
            </div>

            <div>
                <label>Descrição</label>
                <textarea v-model="form.description" class="w-full border p-2"></textarea>
                <div v-if="form.errors.description" class="text-red-500 text-sm">
                    {{ form.errors.description }}
                </div>
            </div>

            <div>
                <label>Localização</label>
                <input v-model="form.location" type="text" class="w-full border p-2" />
            </div>

            <div>
                <label>Tipo</label>
                <input v-model="form.type" type="text" class="w-full border p-2" />
            </div>

            <div>
                <label>Salário</label>
                <input v-model="form.salary" type="number" class="w-full border p-2" />
            </div>

            <button 
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded"
                :disabled="form.processing"
            >
                Criar Vaga
            </button>
        </form>
    </div>
</template>
