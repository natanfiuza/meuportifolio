<script setup>
console.log('sobre section loaded');

const props = defineProps({
    userProfile: {
        type: Object,
        required: true,
        default: () => ({
            imageUrl: '/assets/img/profile/natanfiuza.jpeg',
            bio: 'Carregando biografia...',
            cvUrl: '#'
        })
    }
});
console.log('sobre section loaded finish');

</script>

<template>
    <section class="py-20 px-6 bg-gray-800 text-white">
        <div class="container mx-auto mt-4 pt-4">
            <h2 class="text-4xl font-bold mb-12 text-center mt-4">Sobre Mim</h2>
            <div class="flex flex-col md:flex-row items-center md:items-start gap-10 md:gap-16  pb-6 mb-4">
                <div class="flex-shrink-0 md:w-1/3 lg:w-1/4">
                    <img :src="userProfile.imageUrl" alt="Foto de Nataniel Fiuza"
                        class="rounded-full w-64 h-64 md:w-full md:h-auto max-w-sm mx-auto object-cover shadow-2xl border-4 border-indigo-500">
                </div>
                <div class="md:w-2/3 lg:w-3/4 text-center md:text-left">
                    <h3 class="text-3xl font-semibold text-indigo-400 mb-4">{{ userProfile.name }}</h3>
                    <p class="text-lg text-gray-300 leading-relaxed mb-8 whitespace-pre-line">
                        {{ userProfile.bio }}
                    </p>
                    <a :href="userProfile.cvUrl" target="_blank" download="NatanielFiuza_CV.pdf"
                        class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-8 rounded-lg text-lg transition-colors shadow-md hover:shadow-lg">
                        Baixar Meu Currículo
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>
