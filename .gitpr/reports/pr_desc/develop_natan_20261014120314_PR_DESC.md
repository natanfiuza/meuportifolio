# 🚀 Sugestão de Pull Request

**Mensagem de Commit Recomendada:**
```text
feat: adiciona projeto DevTools à listagem de projetos da home
```

---

## 🎯 Resumo

Divulga o novo produto **DevTools** no portfólio exibido na página inicial. A listagem de projetos passa a incluir a entrada do DevTools tanto no payload enviado pelo backend quanto no fallback de props do componente Vue, garantindo consistência de exibição mesmo quando a página é renderizada sem os dados do controller. Também são adicionados testes de feature para travar regressões na contagem de projetos e nos dados do novo item.

## 🛠️ Mudanças Técnicas

- `HomeController`: adiciona o item `id => 4` (DevTools) à lista de projetos com título, descrição, imagem, tags (`Laravel`, `Inertia.js`, `Vue.js`, `TypeScript`, `MySQL`) e `url` de destino.
- `Index.vue`: inclui a propriedade `url` nos projetos default (`id` 1, 2 e 3) e adiciona o registro do DevTools no array de fallback, alinhando o shape dos dados ao contrato do backend.
- `tests/Feature/HomeControllerTest.php`: novo teste cobrindo a renderização da home com 4 projetos, a presença e os campos do projeto DevTools no payload Inertia e a existência do arquivo de logo em `public/assets/img/projects/logo_devtools.svg`.

## ⚠️ Impacto/Avisos

- **Sem migrações de banco de dados**, sem novas variáveis de ambiente e sem novas dependências.
- **Asset obrigatório:** o teste `has the devtools logo file in the public assets` falha caso `public/assets/img/projects/logo_devtools.svg` não exista no repositório/ambiente de CI. Garanta o commit do arquivo de imagem.
- **Contrato de dados:** o campo `url` passa a ser esperado em todos os itens da listagem; consumidores que usem shape estrito devem considerar a nova propriedade.