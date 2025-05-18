<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $projectsData = [
            ['id' => 1, 'title' => 'Meu SaaS Inovador', 'description' => 'Plataforma completa para gerenciamento de X, construída com as melhores práticas.', 'image' => '/images/projects/saas.jpg', 'tags' => ['Laravel', 'Vue.js', 'Inertia.js', 'MySQL']],
            ['id' => 2, 'title' => 'API de Pagamentos', 'description' => 'API RESTful robusta para processamento de pagamentos online.', 'image' => '/images/projects/api.jpg', 'tags' => ['PHP', 'Laravel', 'Stripe SDK']],
            ['id' => 3, 'title' => 'Dashboard Analítico', 'description' => 'Painel interativo para visualização de dados complexos.', 'image' => '/images/projects/dashboard.jpg', 'tags' => ['Python', 'Flask', 'JavaScript', 'Chart.js']],
        ];

        $blogPostsData = [
            ['id' => 1, 'title' => 'O Poder do Laravel Octane', 'category' => 'Performance', 'date' => '18 Mai, 2025', 'image' => '/assets/img/blog/laravel-octane.jpg', 'excerpt' => 'Explore como o Laravel Octane pode turbinar a performance das suas aplicações.', 'slug' => 'laravel-octane'],
            ['id' => 2, 'title' => 'Vue 3 Composition API na Prática', 'category' => 'Frontend', 'date' => '12 Mai, 2025', 'image' => '/assets/img/blog/composition-api.png', 'excerpt' => 'Um guia prático para utilizar a Composition API e organizar melhor seus componentes Vue.', 'slug' => 'vue3-composition-api'],
            ['id' => 3, 'title' => 'Microsserviços com Python: Primeiros Passos', 'category' => 'Backend', 'date' => '05 Mai, 2025', 'image' => '/assets/img/blog/post_capa_1.png', 'excerpt' => 'Introdução à arquitetura de microsserviços utilizando Python e frameworks leves.', 'slug' => 'microsservicos-python'],
        ];

        // Exemplo de dados para a seção "Sobre"
        $userProfileData = [
            'name' => 'Nataniel Fiuza',
            'imageUrl' => '/assets/img/profile/natanfiuza.jpeg', // Coloque sua foto em public/assets/img/profile
            'bio' => 'Sou Nataniel Fiuza, um desenvolvedor Fullstack apaixonado por tecnologia e por transformar ideias em realidade digital. Minha jornada na programação é marcada pela busca constante por conhecimento e pela aplicação de soluções inovadoras. Especializado em PHP, Laravel, Python e JavaScript, dedico-me a construir aplicações web que não apenas funcionam bem, mas que também oferecem uma experiência de usuário excepcional. Acredito no poder da colaboração e no compartilhamento de conhecimento para o crescimento da comunidade de desenvolvimento.',
            'cvUrl' => '/cv/NatanielFiuza_CV.pdf' // Coloque seu CV em public/cv/
        ];

        $contactInfoData = [
            'email' => 'contato@natanfiuza.dev.br',
            'phone' => '+55 (83) 99681-2716',
            'location' => 'João Pessoa, Paraíba',
            'social' => [
                [ 'name' => 'Github', 'url' => 'https://github.com/natanfiuza', 'iconClass' => 'fab fa-github' ],
                [ 'name' => 'LinkedIn', 'url' => 'https://linkedin.com/in/natanfiuza', 'iconClass' => 'fab fa-linkedin' ],
                [ 'name' => 'Twitter', 'url' => 'https://twitter.com/natanfiuza', 'iconClass' => 'fab fa-twitter' ], // ou fa-x-twitter
            ]
        ];

        return Inertia::render('Index', [
            'projects' => $projectsData,
            'blogPosts' => $blogPostsData,
            'userProfile' => $userProfileData,
            'contactInfo' => $contactInfoData,
            // Outros dados que suas seções possam precisar
        ]);
    }
}
