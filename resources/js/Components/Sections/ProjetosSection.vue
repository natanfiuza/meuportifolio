<script setup>
import { Link } from '@inertiajs/vue3';
console.log('projects section loaded');

const props = defineProps({
    projects: {
        type: Array,
        required: true,
        default: () => [] // Adicionado default para evitar erro se não passado
    }
});
console.log('projects section loaded finish');

</script>

<template>
    <section class="py-20 px-6 bg-gray-900 text-white ">
        <div class="container mx-auto text-center mb-7">
            <h2 class="text-4xl font-bold mb-8 mt-4">Meus Projetos</h2>
            <p class="text-lg max-w-3xl mx-auto mb-12 text-gray-300">
                Uma seleção dos meus projetos open source que demonstram minhas habilidades e experiência.
            </p>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div v-for="project in projects" :key="project.id"
                    class="bg-gray-800 rounded-lg shadow-xl overflow-hidden transform hover:scale-105 transition-transform duration-300 flex flex-col">
                    <img :src="project.image" :alt="project.title" class="w-full h-56 object-cover">
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-2xl font-semibold mb-2 text-indigo-400">{{ project.title }}</h3>
                        <p class="text-gray-400 text-sm mb-4 flex-grow">{{ project.description }}</p>
                        <div class="mb-4">
                            <span v-for="tag in project.tags" :key="tag"
                                class="inline-block bg-gray-700 text-indigo-300 text-xs font-semibold mr-2 mb-2 px-2.5 py-0.5 rounded-full">
                                {{ tag }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
