<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link } from '@inertiajs/vue3';
console.log('app layout loaded');

// Lógica para header fixo
const isHeaderFixed = ref(false);
const handleScroll = () => {
    if (window.scrollY > 100) { // Ajuste o valor 100 conforme necessário
        isHeaderFixed.value = true;
    } else {
        isHeaderFixed.value = false;
    }
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});

const navLinks = [
    { id: 'inicio', text: 'Início' },
    { id: 'habilidades', text: 'Habilidades' },
    { id: 'projetos', text: 'Projetos' },
    { id: 'sobre', text: 'Sobre Mim' }, // Ajustado para o ID da seção
    { id: 'blog', text: 'Blog' },
    { id: 'contato', text: 'Contato' },
];

const scrollToSection = (sectionId) => {
    const section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({ behavior: 'smooth' });
    }
};
console.log('app layout loaded finish');
</script>

<template>
    <div class="bg-gray-900 text-gray-100 min-h-screen font-sans">
        <header :class="[
            'bg-gray-800 shadow-md w-full z-50 transition-all duration-300 ease-in-out',
            isHeaderFixed ? 'fixed top-0 animate-slideDown' : 'relative'
        ]">
            <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
                <Link href="/" class="text-2xl font-bold text-white hover:text-indigo-400" style="color:#878bf6;">
                NatanFiuza.dev
                </Link>
                <div class="space-x-4">
                    <a v-for="link in navLinks" :key="link.id" href="#" @click.prevent="scrollToSection(link.id)"
                        class="hover:text-indigo-400 transition-colors">
                        {{ link.text }}
                    </a>
                </div>
            </nav>
        </header>

        <main>
            <slot />
        </main>

        <footer class="bg-gray-800 text-gray-300 py-12">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-xl font-bold text-white mb-3">NatanFiuza.dev</h3>
                        <p class="text-sm mb-4">
                            Desenvolvedor fullstack especializado em criar soluções web modernas e eficientes.
                        </p>
                        <div class="flex space-x-4">
                            <a href="https://github.com/natanfiuza" target="_blank" class="hover:text-indigo-400"
                                aria-label="Github">
                                <i class="fab fa-github fa-lg"></i>
                            </a>
                            <a href="https://linkedin.com/in/natanfiuza" target="_blank" class="hover:text-indigo-400"
                                aria-label="LinkedIn">
                                <i class="fab fa-linkedin fa-lg"></i>
                            </a>
                            <a href="https://twitter.com/natanfiuza" target="_blank" class="hover:text-indigo-400"
                                aria-label="Twitter/X">
                                <i class="fab fa-twitter fa-lg"></i> </a>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold text-white mb-3">Links Rápidos</h3>
                        <ul class="space-y-2">
                            <li v-for="link in navLinks" :key="`footer-${link.id}`">
                                <a href="#" @click.prevent="scrollToSection(link.id)"
                                    class="hover:text-indigo-400 transition-colors text-sm">
                                    {{ link.text }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold text-white mb-3">Newsletter</h3>
                        <p class="text-sm mb-3">
                            Inscreva-se para receber atualizações e artigos sobre desenvolvimento web.
                        </p>
                        <form @submit.prevent="handleNewsletterSignup">
                            <div class="flex">
                                <input type="email" placeholder="Seu e-mail"
                                    class="bg-gray-700 text-white px-4 py-2 rounded-l-md focus:outline-none focus:ring-2 focus:ring-indigo-500 flex-grow"
                                    required />
                                <button type="submit"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-r-md transition-colors">
                                    Inscrever
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-12 border-t border-gray-700 pt-8 text-center text-sm">
                    <p>&copy; {{ new Date().getFullYear() }} NatanFiuza.dev. Todos os direitos reservados.</p>
                </div>
            </div>
        </footer>
    </div>
</template>

<style scoped>
/* Estilo para animação do header fixo (opcional, mas dá um toque legal) */
@keyframes slideDown {
    from {
        transform: translateY(-100%);
    }

    to {
        transform: translateY(0);
    }
}

.animate-slideDown {
    animation: slideDown 0.3s ease-out;
}

/* Adicione aqui o CSS para o scroll suave, se não for usar o do navegador */
html {
    scroll-behavior: smooth;
}
</style>
