<?php

use Inertia\Testing\AssertableInertia as Assert;

it('renders the home page with the projects list', function () {
    $this->get('/')
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Index')
            ->has('projects', 4)
        );
});

it('includes the devtools project in the payload', function () {
    $this->get('/')->assertInertia(fn (Assert $page) => $page
        ->where('projects.3.title', 'DevTools')
        ->where('projects.3.image', '/assets/img/projects/logo_devtools.svg')
        ->where('projects.3.tags', ['Laravel', 'Inertia.js', 'Vue.js', 'TypeScript', 'MySQL'])
        ->where('projects.3.url', 'https://devtools.natanfiuza.dev.br')
    );
});

it('has the devtools logo file in the public assets', function () {
    expect(public_path('assets/img/projects/logo_devtools.svg'))->toBeFile();
});
