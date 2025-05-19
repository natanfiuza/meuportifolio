<template>
    <AppLayout>
        <InicioSection id="inicio" />
        <HabilidadesSection id="habilidades" />
        <ProjetosSection id="projetos" :projects="props.projects" />
        <SobreSection id="sobre" :userProfile="props.userProfile" />
        <!-- <BlogSection id="blog" :posts="props.blogPosts" /> -->
        <ContatoSection id="contato" />
    </AppLayout>
</template>
<script setup>
console.log('index page loaded');

import AppLayout from '@/Layouts/AppLayout.vue';
import InicioSection from '@/Components/Sections/InicioSection.vue';
import HabilidadesSection from '@/Components/Sections/HabilidadesSection.vue';
import ProjetosSection from '@/Components/Sections/ProjetosSection.vue';
import SobreSection from '@/Components/Sections/SobreSection.vue';
import BlogSection from '@/Components/Sections/BlogSection.vue';
import ContatoSection from '@/Components/Sections/ContatoSection.vue';

// Dados de exemplo que viriam do Laravel via props
// Em um cenário real, você passaria esses dados do seu Controller Laravel para a view Inertia
const props = defineProps({
    projects: {
        type: Array,
        default: () => [
            { id: 1, title: 'Projeto Alpha', description: 'Uma breve descrição do Projeto Alpha, focado em resolver X.', image: 'https://via.placeholder.com/400x250/334155/e2e8f0?text=Projeto+Alpha', tags: ['PHP', 'Laravel', 'Vue.js'] },
            { id: 2, title: 'Sistema Beta', description: 'Descrição do Sistema Beta, uma ferramenta para Y.', image: 'https://via.placeholder.com/400x250/475569/e2e8f0?text=Sistema+Beta', tags: ['Python', 'Django', 'JavaScript'] },
            { id: 3, title: 'App Gama', description: 'Detalhes sobre o App Gama, que facilita Z.', image: 'https://via.placeholder.com/400x250/52525b/e2e8f0?text=App+Gama', tags: ['JavaScript', 'Node.js', 'React'] },
        ]
    },
    blogPosts: {
        type: Array,
        default: () => [
            { id: 1, title: 'Dominando o Laravel', category: 'Backend', date: '15 Maio, 2025', image: 'https://via.placeholder.com/400x250/334155/e2e8f0?text=Blog+Post+1', excerpt: 'Descubra como o Laravel pode acelerar seu desenvolvimento web...', slug: 'dominando-laravel' },
            { id: 2, title: 'Vue.js para Iniciantes', category: 'Frontend', date: '10 Maio, 2025', image: 'https://via.placeholder.com/400x250/475569/e2e8f0?text=Blog+Post+2', excerpt: 'Um guia completo para começar com Vue.js e construir interfaces incríveis.', slug: 'vuejs-iniciantes' },
            { id: 3, title: 'Boas Práticas em APIs REST', category: 'Arquitetura', date: '05 Maio, 2025', image: 'https://via.placeholder.com/400x250/52525b/e2e8f0?text=Blog+Post+3', excerpt: 'Aprenda a criar APIs robustas e fáceis de manter.', slug: 'boas-praticas-apis' },
        ]
    },
    userProfile: {
        type: Object,
        default: () => ({
            name: 'Nataniel Fiuza',
            imageUrl: '/assets/img/profile/natanfiuza.jpeg',
            bio: 'Sou Nataniel Fiuza, um desenvolvedor Fullstack apaixonado por tecnologia e por transformar ideias em realidade digital. Minha jornada na programação é marcada pela busca constante por conhecimento e pela aplicação de soluções inovadoras. Especializado em PHP, Laravel, Python e JavaScript, dedico-me a construir aplicações web que não apenas funcionam bem, mas que também oferecem uma experiência de usuário excepcional. Acredito no poder da colaboração e no compartilhamento de conhecimento para o crescimento da comunidade de desenvolvimento.',
            cvUrl: '/cv/NatanielFiuza_CV.pdf' // Link para o seu CV
        })
    }

});
console.log('index page loaded finish');

</script>
<style >
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}


.fira-code-400 {
    font-family: "Fira Code", serif;
    font-optical-sizing: auto;
    font-weight: 400;
    font-style: normal;
}


.libre-franklin-400 {
    font-family: "Libre Franklin", serif;
    font-optical-sizing: auto;
    font-weight: 400;
    font-style: normal;
}

.space-grotesk-400 {
    font-family: "Libre Franklin", serif;
    font-optical-sizing: auto;
    font-weight: 400;
    font-style: normal;
}

body {
    font-family: "Fira Code", serif;
    font-weight: 500;
    line-height: 1.6;
    background-color: #fffff5;
}
</style>
