<script setup>


const scrollToSection = (sectionId) => {
    const section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({ behavior: 'smooth' });
    }
};


</script>

<template>
    <section class="min-h-screen flex items-center justify-center bg-gray-900 text-white py-20 px-6 text-center">
        <div class="container mx-auto">
            <h1 class="text-5xl md:text-6xl font-bold mb-4">
                Olá, eu sou Nataniel Fiuza
            </h1>
            <p class="text-3xl md:text-4xl font-light text-indigo-400 mb-6">
                Desenvolvedor Fullstack
            </p>
            <p class="text-lg md:text-xl max-w-2xl mx-auto mb-10">
                Especializado em PHP, Laravel, Python e JavaScript, criando soluções web completas e intuitivas.
            </p>
            <div
                class="space-x-0 md:space-x-4 space-y-4 md:space-y-0 flex flex-col md:flex-row justify-center items-center">
                <button @click="scrollToSection('projetos')"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-8 rounded-lg text-lg transition-colors w-full md:w-auto">
                    Meus Projetos
                </button>
                <button @click="scrollToSection('contato')"
                    class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-3 px-8 rounded-lg text-lg transition-colors w-full md:w-auto">
                    Entre em Contato
                </button>
            </div>
        </div>
    </section>
</template>
