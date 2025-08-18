<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $projectsData = [
            ['id' => 1, 'title' => 'TechPulse Blog', 'description' => 'Blog pessoal desenvolvido utilizando a stack Laravel + Inertia.js + Vue.js', 'image' => '/assets/img/projects/techpulse.png', 'tags' => ['Laravel', 'Inertia.js', 'Vue.js', 'MySQL'],"url" => 'https://tech-pulse.natanfiuza.dev.br'],
            ['id' => 2, 'title' => 'StartupConnect', 'description' => 'StartupConnect é uma plataforma de networking social projetada para o ecossistema de startups .', 'image' => '/assets/img/projects/logo_menor.png', 'tags' => ['Laravel', 'Inertia.js', 'Vue.js', 'MySQL'],"url" => 'https://startupconnect.natanfiuza.dev.br'],
            //['id' => 2, 'title' => 'API de Pagamentos', 'description' => 'API RESTful robusta para processamento de pagamentos online.', 'image' => '/images/projects/api.jpg', 'tags' => ['PHP', 'Laravel', 'Stripe SDK'],'url' => '#'],
           // ['id' => 3, 'title' => 'Dashboard Analítico', 'description' => 'Painel interativo para visualização de dados complexos.', 'image' => '/images/projects/dashboard.jpg', 'tags' => ['Python', 'Flask', 'JavaScript', 'Chart.js'],'url' => '#'],
        ];

        $blogPostsData = [
            ['id' => 1, 'title' => 'O Poder do Laravel Octane', 'category' => 'Performance', 'date' => '18 Mai, 2025', 'image' => '/assets/img/blog/laravel-octane.jpg', 'excerpt' => 'Explore como o Laravel Octane pode turbinar a performance das suas aplicações.', 'slug' => 'laravel-octane'],
            ['id' => 2, 'title' => 'Vue 3 Composition API na Prática', 'category' => 'Frontend', 'date' => '12 Mai, 2025', 'image' => '/assets/img/blog/composition-api.png', 'excerpt' => 'Um guia prático para utilizar a Composition API e organizar melhor seus componentes Vue.', 'slug' => 'vue3-composition-api'],
            ['id' => 3, 'title' => 'Microsserviços com Python: Primeiros Passos', 'category' => 'Backend', 'date' => '05 Mai, 2025', 'image' => '/assets/img/blog/post_capa_1.png', 'excerpt' => 'Introdução à arquitetura de microsserviços utilizando Python e frameworks leves.', 'slug' => 'microsservicos-python'],
        ];

        // Exemplo de dados para a seção "Sobre"
        $userProfileData = [
            'name' => 'Nataniel Fiuza',
            'imageUrl' => '/assets/img/profile/natanfiuza.jpeg',
            'bio' => "Olá! Sou Nataniel Fiúza, um profissional de tecnologia com mais de 20 anos de experiência transformando ideias em realidade digital. Minha carreira foi construída sobre uma base sólida em desenvolvimento web, com especialização em PHP e na criação de sistemas robustos e escaláveis, incluindo a fundação de iniciativas como a Miti (onde desenvolvemos o ClippingExpress) e a Laxus Tecnologia.\n\n Minha curiosidade e busca por evolução me levaram a uma graduação em Arquivologia, que expandiu minha compreensão sobre a gestão da informação, e mais recentemente, a um MBA em Engenharia e Ciência de Dados (concluído em abril de 2025). Esta nova especialização alinha-se perfeitamente com minha paixão por dados e minha vivência em desenvolvimento, permitindo-me explorar novas fronteiras na análise, engenharia de dados e desenvolvimento orientado a dados.\n\n Estou entusiasmado para conectar minha experiência prática em desenvolvimento e gestão de projetos com as mais recentes técnicas em ciência de dados para resolver problemas complexos, otimizar processos e gerar valor. Se você procura um profissional que une profundidade técnica, visão estratégica e uma paixão por dados, vamos conversar!\n",
            'cvUrl' => '/cv/Nataniel_Fiuza_CV.pdf'
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
