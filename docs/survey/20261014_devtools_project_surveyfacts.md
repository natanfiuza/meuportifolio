# Survey — Adição do projeto DevTools ao portfólio

- **Data:** 2026-10-14
- **Branch:** `develop_natan`
- **Repo:** `natanfiuza-dev` (site pessoal `natanfiuza.dev.br`)
- **Skill:** `grill-with-docs` (grilling + domain-modeling)
- **Rodadas de grill:** 3 (8 decisões)
- **Fronteira:** esgotada, entendimento compartilhado confirmado

---

## 1. Contexto da tarefa

### Pedido original

> Adicione o novo projeto devtools_, veja especificações em `C:\Users\nataniel\projetos\pessoal\devtools_natanfiuza\docs\SPEC.md`, na seção projetos `resources\js\Components\Sections\ProjetosSection.vue` utilize o ícone em svg de `C:\Users\nataniel\projetos\pessoal\devtools_natanfiuza\public\favicon.svg` e copie para `public/assets/img/projects`.

### O que é o projeto devtools

Lido de `devtools_natanfiuza/docs/SPEC.md` (v1.0):

- **Domínio:** `devtools.natanfiuza.dev.br` — site de ferramentas para desenvolvedores.
- **Modelo:** tools do cliente gratuitas e sem login; o AI SQL Builder exige conta, com 5 usos grátis e planos pagos por franquia mensal de tokens. Monetização por planos e doação (anúncios no futuro).
- **Stack:** PHP 8.3 / Laravel 13 / Inertia / Vue 3 / TypeScript estrito / Tailwind / shadcn-vue / vue-i18n. MySQL. Testes com Pest e Vitest.
- **Tools do MVP:** JSON Viewer/Formatter, AI SQL Builder, JSON → TypeScript/PHP DTO/Pydantic, SQL Formatter, Base64/URL encode/Hash, JWT Decoder, Timestamp/UUID/ULID, Regex Tester.
- **Estado:** a F1 (registro de tools + home + busca + LGPD/GA) fechou no mesmo dia, 2026-10-14. As 8 tools do MVP entram registradas com `status: "soon"`.
- **Idiomas:** en, pt-BR, pt-PT, fr, es.

---

## 2. Fatos levantados

### 2.1 Onde os projetos realmente vivem

O pedido aponta para o `ProjetosSection.vue`, mas **a lista não está lá**. O componente é puramente data-driven:

| Camada | Arquivo | Papel |
|---|---|---|
| Dados | `app/Http/Controllers/HomeController.php` → `$projectsData` | fonte única |
| Ponte | `HomeController::index()` → `Inertia::render('Index', ['projects' => $projectsData])` | prop |
| Página | `resources/js/Pages/Index.vue` | repassa a prop |
| Render | `resources/js/Components/Sections/ProjetosSection.vue` | `v-for`, sem estado |

**Shape de cada projeto** (7 campos, todos obrigatórios para renderizar bem):

```php
['id' => int, 'title' => string, 'description' => string, 'image' => string, 'tags' => string[], "url" => string]
```

`id` é o `:key` do `v-for`. **A ordem de exibição é a ordem do array** — não há ordenação nem filtro em lugar nenhum.

### 2.2 Como a imagem é referenciada

Caminho público absoluto em string, renderizado como `<img :src="project.image">`. Sem `import`, sem `@/assets`, sem CSS background. Funciona porque `vite.config.js` define:

```js
vue({ template: { transformAssetUrls: { base: null, includeAbsolute: false } } })
```

Ou seja, `/assets/...` passa intacto e é servido direto do `public/`.

A classe do `<img>` é `w-full h-56 object-contain p-4 bg-gray-800` — mudou de `object-cover` para `object-contain` no commit `2fab957` (adição do GitPR CLI), justamente para acomodar logos quadrados sem cortar.

**Não há fallback nem handler de `@error`.** Se o arquivo não existir, o card mostra imagem quebrada.

### 2.3 Convenção do diretório de imagens

`public/assets/img/projects/`, antes desta tarefa:

| Arquivo | Dimensões | Tamanho | Observação |
|---|---|---|---|
| `api.png` | 1920x1080 | 1,5 MB | **órfã** — nenhuma referência aponta para ela |
| `logo_gitpr.png` | 323x349 | 101 KB | logo quadrado |
| `logo_menor.png` | 403x350 | 113 KB | logo quadrado |
| `techpulse.png` | 561x245 | 32 KB | screenshot/wordmark |

Padrão: lowercase, `logo_*.png` para logos, `<projeto>.png` para screenshot/wordmark. **Todos PNG** — o `logo_devtools.svg` é o primeiro SVG do diretório.

### 2.4 Estado do domínio devtools

`https://devtools.natanfiuza.dev.br` **responde, mas é placeholder**: devolve apenas a palavra "devtools", sem title, sem meta description, sem navegação. Domínio no ar, conteúdo ainda não.

### 2.5 O que NÃO lista projetos

- **`public/cv/index.html`** — o currículo em HTML lista experiência, formação acadêmica e grade de habilidades, mas **não** o portfólio. Nada a atualizar lá.
- **`resources/js/Pages/Index.vue`** — tem props default com 3 projetos fictícios (`Projeto Alpha` / `Sistema Beta` / `App Gama`, imagens `via.placeholder.com`). É **código morto**: o controller sempre passa `projects`, que sobrescreve o default.

### 2.6 `public/build/` é versionado

23 arquivos rastreados em `public/build/` (daí os commits "Deploy do JS"). O `.gitignore` não os exclui. Consequência prática: mudanças em Vue/CSS exigem `npm run build` + commit; mas **mudanças só de PHP e assets estáticos não exigem nada** — o hash do Vite é por conteúdo, então entrada idêntica produz saída idêntica.

### 2.7 Ambiente

- Backend: Laravel 12, PHP ^8.2, Inertia Laravel ^2.0, Ziggy, Sanctum.
- Frontend: Vue 3.5, Vite 6, Tailwind **3** (`@tailwindcss/vite ^4` está no `package.json` mas **não** está ligado no `vite.config.js` — Tailwind 4 não está ativo).
- Testes: Pest 3.8, **só backend**. `composer test` → `php artisan test`. Não há Vitest/Jest.
- `tests/Feature/` mistura dois estilos: Pest funcional (`ExampleTest.php`, `it(...)`) e classe PHPUnit (`ProfileTest.php`). `tests/Pest.php` aplica `RefreshDatabase` a todo o diretório `Feature`.
- Sem i18n: todas as strings são português hardcoded no PHP e nos templates Vue.
- Os métodos de asserção do Inertia (`component`, `has`, `where`) existem em `vendor/inertiajs/inertia-laravel/src/Testing/`.

### 2.8 Convenção de documentação

**Este repo escreve docs COM acentuação** (`doc/check_list_2025-08-10.md` tem 27 linhas acentuadas, `doc/prompt_inicial.md` 17, `README.md` 27). Isso é o **oposto** do repo devtools, cujo SPEC determina documentação sem acentos por ser um produto traduzido. Não confundir as duas convenções.

---

## 3. Decisões por rodada

### Rodada 1

| # | Decisão | Escolha | Justificativa |
|---|---|---|---|
| D1 | URL e timing | Adicionar agora com `https://devtools.natanfiuza.dev.br` | Domínio já responde e a F1 fechou no mesmo dia. O card é um link só (imagem e título) — linkar para placeholder foi aceito conscientemente. |
| D2 | Descrição | `Ferramentas essenciais para o dia a dia do desenvolvedor — JSON Viewer, AI SQL Builder, JWT Decoder, Regex Tester e mais, direto no navegador e sem instalar nada.` | Estilo do card do GitPR CLI (diz o que a pessoa encontra), citando as tools do MVP do SPEC. |
| D3 | Tags | `['Laravel', 'Inertia.js', 'Vue.js', 'TypeScript', 'MySQL']` | Mesma base dos outros dois projetos Laravel, acrescida de TypeScript (o SPEC pede TS estrito). |
| D4 | Local dos artefatos | Criar `docs/` novo | Não misturar com o `doc/` singular legado (checklist + prompt inicial, de outro assunto). |

### Rodada 2

| # | Decisão | Escolha | Justificativa |
|---|---|---|---|
| D5 | Nome do arquivo do ícone | `logo_devtools.svg` | Segue o prefixo `logo_*` dos outros logos e mantém a extensão explícita. Cópia verbatim — o `role`/`aria-label` interno do SVG é inerte dentro do `<img>`, que já tem `alt`. |
| D6 | Escopo adicional | Essencial **+** teste Pest **+** fallback do `Index.vue` | Resolvido após uma resposta contraditória no grill (ver nota abaixo). |
| D7 | Git | Sem commit | Convenção registrada no SPEC do devtools: commits e PR apenas pelo usuário, via gitpr, com aprovação de cada um. |

### Rodada 3

| # | Decisão | Escolha | Justificativa |
|---|---|---|---|
| D8 | 4º projeto do fallback | Espelhar a entrada real do DevTools | Decisão do usuário. O fallback passa a ter 3 exemplos fictícios + 1 projeto real, com `url` também nas 3 entradas dummy (valor `'#'`, seguindo o precedente das entradas comentadas do próprio `HomeController.php`). |

### Nota sobre a resposta contraditória

No Q6 (multiSelect), o usuário marcou simultaneamente **"Nenhum — só o essencial"** e os dois extras. A contradição foi levantada explicitamente, com o alerta de que mexer no fallback exigiria **também** adicionar `url` nas 3 entradas dummy existentes — sem isso os cards linkariam para `href="undefined"`. O usuário então escolheu o escopo completo.

---

## 4. Fatos que sustentaram o plano

- **Sem `npm run build`.** Só PHP e um asset estático mudam; `ProjetosSection.vue` não muda. Confirmado depois: `git status --short public/build` veio vazio.
- **Sem tocar em `public/cv/index.html`** — o currículo não lista projetos.
- **Sem mexer no `ProjetosSection.vue`** — renderiza o que o array contiver.
- **Sem `docs/adr/`** — nenhuma das decisões desta sessão é difícil de reverter, surpreendente sem contexto e resultado de um trade-off real. Nenhum ADR se justifica.

---

## 5. Entregável

1. `app/Http/Controllers/HomeController.php` — uma linha nova no `$projectsData` (`id => 4`).
2. `public/assets/img/projects/logo_devtools.svg` — cópia verbatim do `favicon.svg` do repo devtools.
3. `resources/js/Pages/Index.vue` — `url: '#'` nas 3 entradas dummy + 4ª entrada espelhando o DevTools.
4. `tests/Feature/HomeControllerTest.php` — 3 casos Pest.

Verificação: `composer test` com **28 passando / 90 asserções**, asset servido como `image/svg+xml` (424 bytes, HTTP 200), `public/build` sem diff. Alterações deixadas **sem commit** para o usuário rodar o gitpr.
