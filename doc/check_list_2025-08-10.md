# ✅ Checklist do Projeto NatanFiuza.dev

#### **1. Estrutura e Layout do Projeto**
- [x] **Setup Inicial:** Projeto Laravel configurado com Inertia.js e Vue.js.
- [x] **Estilo Principal:** Design minimalista com Tailwind CSS, focado no "dark mode".
- [x] **Layout Principal (`AppLayout.vue`):**
    - [x] Header com navegação que se torna fixo ao rolar a página.
    - [x] Footer com 3 colunas:
        - [x] Informações do site e links de redes sociais.
        - [x] Links rápidos para as seções da página.
        - [x] Formulário de inscrição na Newsletter.
    - [x] Lógica de "scroll suave" para a navegação entre as seções.
- [x] **Página Principal (`Index.vue`):** Estruturada como uma "landing page", contendo todas as seções.

#### **2. Seções da Landing Page (Componentes Vue)**
- [x] **`InicioSection`:** Seção de boas-vindas com título, subtítulo e botões de ação.
- [x] **`HabilidadesSection`:** Cards para "Backend", "Frontend" e "Database & DevOps" listando as tecnologias.
- [x] **`ProjetosSection`:** Galeria de projetos em cards, recebendo dados do backend (props).
- [x] **`SobreSection`:** Seção "Sobre Mim" com foto, biografia e botão para download do currículo, recebendo dados do backend.
- [x] **`BlogSection`:** Exibição dos 3 posts mais recentes em cards, recebendo dados do backend.
- [x] **`ContatoSection`:** Seção de contato com duas colunas:
    - [x] Informações de contato e redes sociais.
    - [x] Formulário de contato funcional.

#### **3. Funcionalidades do Backend (Laravel)**
- [x] **Passagem de Dados:** Controller principal configurado para passar dados (projetos, posts, perfil) para a view Inertia.
- [x] **Formulário de Contato:**
    - [x] **Controller (`ContactController`):** Criado para gerenciar a submissão.
    - [x] **Validação:** Implementada para os campos do formulário.
    - **Envio de E-mail:**
        - [x] **Configuração SMTP:** Arquivo `.env` ajustado para o envio de e-mails.
        - [x] **Mailable (`ContactFormMail`):** Classe Mailable criada para estruturar o e-mail de contato.
        - [x] **Template de E-mail:** View em Markdown para o corpo do e-mail.
        - [x] **Autorização de Remetente:** Corrigido o erro "553 Sender address rejected", ajustando os cabeçalhos "From" e "Reply-To".
- [x] **Inscrição na Newsletter:**
    - [x] **Model e Migration (`NewsletterSubscription`):** Criados para armazenar e-mails no banco de dados.
    - [x] **Controller (`NewsletterController`):** Criado para gerenciar a inscrição.
    - [x] **Validação:** Implementada para o campo de e-mail, incluindo verificação de e-mail único.
    - [x] **Rota:** Definida para receber os POSTs de inscrição.
- [x] **Segurança:**
    - [x] **CSRF:** Problema "419 Page Expired" resolvido, garantindo a presença do token CSRF nas requisições.

#### **4. Interatividade e Feedback no Frontend (Vue.js/Inertia)**
- [x] **Gerenciamento de Formulários:** Uso do `useForm` do Inertia para os formulários de contato e newsletter.
- [x] **Mensagens de Feedback (Flash Messages):**
    - [x] Middleware `HandleInertiaRequests` configurado para compartilhar mensagens de `success` e `error` da sessão.
    - [x] Componentes Vue (`ContatoSection` e `AppLayout`) configurados para exibir mensagens de feedback de sucesso, erro e validação.
