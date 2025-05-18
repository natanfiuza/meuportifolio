<script setup>
import { Link } from '@inertiajs/vue3';
console.log('blog section loaded');

const props = defineProps({
    posts: {
        type: Array,
        required: true,
        default: () => [] // Adicionado default para evitar erro se não passado
    }
});
console.log('blog finish');

</script>

<template>
    <section class="py-20 px-6 bg-gray-900 text-white">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold mb-4 text-center">Meu Blog</h2>
            <p class="text-lg max-w-3xl mx-auto mb-12 text-gray-300 text-center">
                Compartilho meus conhecimentos e experiências sobre desenvolvimento web, frameworks e boas práticas.
            </p>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div v-for="post in posts.slice(0, 3)" :key="post.id"
                    class="bg-gray-800 rounded-lg shadow-xl overflow-hidden flex flex-col transform hover:scale-105 transition-transform duration-300">
                    <img :src="post.image" :alt="post.title" class="w-full h-56 object-cover">
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex justify-between items-center text-xs text-indigo-400 mb-2">
                            <span>{{ post.category.toUpperCase() }}</span>
                            <span>{{ post.date }}</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-3 text-white hover:text-indigo-300 transition-colors">
                            <a href="#">{{ post.title }}</a>
                        </h3>
                        <p class="text-gray-400 text-sm mb-4 flex-grow">{{ post.excerpt }}</p>
                        <a href="#" class="mt-auto text-indigo-400 hover:text-indigo-300 font-semibold self-start">
                            Ler Mais &rarr;
                        </a>
                    </div>
                </div>
            </div>
            <div v-if="posts.length > 3" class="text-center mt-12">
                <Link href="/blog"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-8 rounded-lg text-lg transition-colors">
                Ver Todos os Posts
                </Link>
            </div>
        </div>
    </section>
</template>
