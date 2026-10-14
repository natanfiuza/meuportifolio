# Plano de execução — Adição do projeto DevTools ao portfólio

- **Data:** 2026-10-14
- **Branch:** `develop_natan`
- **Repo:** `natanfiuza-dev`
- **Skill:** `grill-with-docs`
- **Survey da sessão:** `docs/survey/20261014_devtools_project_surveyfacts.md`
- **Status:** executado e verificado

---

## Contexto

O site pessoal `natanfiuza.dev.br` (Laravel 12 + Inertia + Vue 3 + Tailwind 3) lista os projetos na seção "Meus Projetos". A lista **não** vive no componente Vue — vive no array `$projectsData` de `app/Http/Controllers/HomeController.php`, passado como prop `projects` para a página `Index`, que o repassa ao `ProjetosSection.vue`. Havia 3 projetos (TechPulse Blog, StartupConnect, GitPR CLI).

O novo projeto é o **devtools.natanfiuza.dev.br** — plataforma de ferramentas para desenvolvedores (JSON Viewer, AI SQL Builder, formatadores, JWT Decoder etc.), Laravel 13 + Vue 3 + TypeScript, com tools gratuitas sem login e planos pagos por franquia de tokens. O domínio **já responde, mas ainda é placeholder** — decisão consciente de linkar assim mesmo.

## Decisões

| Item | Valor |
|---|---|
| Título | `DevTools` |
| URL | `https://devtools.natanfiuza.dev.br` |
| Descrição | `Ferramentas essenciais para o dia a dia do desenvolvedor — JSON Viewer, AI SQL Builder, JWT Decoder, Regex Tester e mais, direto no navegador e sem instalar nada.` |
| Tags | `['Laravel', 'Inertia.js', 'Vue.js', 'TypeScript', 'MySQL']` |
| `id` | `4` (append no fim — a ordem do array é a ordem de exibição) |
| Arquivo do ícone | `public/assets/img/projects/logo_devtools.svg` |
| Fallback do `Index.vue` | Corrigido (`url` nas 3 dummy) + 4ª entrada espelhando o DevTools |
| Teste | Pest, `tests/Feature/HomeControllerTest.php` |
| Git | Sem commit — o usuário roda o gitpr |

## Mudanças executadas

### 1. `app/Http/Controllers/HomeController.php`

Uma linha inserida no `$projectsData`, após a entrada do GitPR CLI (`id => 3`) e antes das duas entradas comentadas. Mantido o quoting do arquivo (`"url" =>` com aspas duplas):

```php
['id' => 4, 'title' => 'DevTools', 'description' => 'Ferramentas essenciais para o dia a dia do desenvolvedor — JSON Viewer, AI SQL Builder, JWT Decoder, Regex Tester e mais, direto no navegador e sem instalar nada.', 'image' => '/assets/img/projects/logo_devtools.svg', 'tags' => ['Laravel', 'Inertia.js', 'Vue.js', 'TypeScript', 'MySQL'],"url" => 'https://devtools.natanfiuza.dev.br'],
```

### 2. `public/assets/img/projects/logo_devtools.svg` (novo)

Cópia verbatim do `favicon.svg` do repo devtools (424 bytes). Funciona porque `vite.config.js` usa `transformAssetUrls: { base: null, includeAbsolute: false }` — o caminho absoluto `/assets/...` é servido direto do `public/`. Primeiro `.svg` do diretório; segue o prefixo `logo_*` dos demais logos.

### 3. `resources/js/Pages/Index.vue`

No bloco `projects.default`:

- `url: '#'` nas 3 entradas dummy (`Projeto Alpha`, `Sistema Beta`, `App Gama`). Sem isso os cards linkariam para `href="undefined"`. O `'#'` segue o precedente das entradas comentadas do próprio `HomeController.php`.
- 4ª entrada espelhando a entrada real do DevTools (título, descrição, image path, tags e url idênticos).

### 4. `tests/Feature/HomeControllerTest.php` (novo)

Estilo Pest funcional, como `tests/Feature/ExampleTest.php`. `RefreshDatabase` já é aplicado ao diretório `Feature` por `tests/Pest.php`. Três casos:

1. `GET /` responde 200, componente Inertia `Index`, prop `projects` com exatamente 4 itens.
2. A 4ª entrada tem `title`, `image`, `tags` e `url` esperados.
3. O arquivo do ícone existe em disco (`expect(public_path(...))->toBeFile()`) — guarda contra "esqueceu de copiar o asset".

### 5. `docs/plans/develop_natan/` e `docs/survey/`

Criados conforme a skill. `docs/` (plural) é novo e deliberadamente separado do `doc/` (singular) legado.

## Não mudou

- **`ProjetosSection.vue`** — puramente data-driven via prop.
- **`public/build/`** — versionado, mas só PHP e um asset estático mudaram. O hash do Vite é por conteúdo: entrada idêntica → saída idêntica. **Sem `npm run build`.**
- **`public/cv/index.html`** — o currículo não lista projetos do portfólio.
- **Ordenação/filtros** — não existem; `v-for` direto sobre o array.

## Verificação

| Passo | Resultado |
|---|---|
| `php artisan test --filter=HomeController` | 3 passando (29 asserções) |
| `composer test` (suíte completa) | **28 passando / 90 asserções** |
| `curl` no asset via `php artisan serve` | HTTP 200, `image/svg+xml`, 424 bytes |
| Payload da home | contém a entrada DevTools |
| `git status --short public/build` | vazio ✓ |
| `git status --short` | exatamente os 4 caminhos esperados ✓ |

Arquivos alterados no fim:

```
 M app/Http/Controllers/HomeController.php
 M resources/js/Pages/Index.vue
?? public/assets/img/projects/logo_devtools.svg
?? tests/Feature/HomeControllerTest.php
```

## Entrega

Alterações deixadas **sem commit**. O usuário revisa o diff e roda o gitpr.
