## Sistema de cadastro e login

<h3>Desenvolvido por: Glauco Neto</h3>

Sistema proposto: Plataforma de login e cadastro de usuários. Feito com:
- HTML
- CSS
- JS
- PHP
- banco de dados Postgresql

Projeto feito com sistema de versionamentos Git.

Páginas:
- index: página inicial com informações e menu com botões de login e cadastro.
- login: formulário de usuários com e-mail e senha.
- registro: formulário de cadastro de usuário com nome, e-mail e senha.
- perfil: página de informações com dados do usuário logado.

### Requisitos
1. Composer
2. PHP 7+
3. Postgres

### Como executar o projeto

1. Na raiz do projeto, execute: `composer install` para verificar dependências e configurações.
2. Com o arquivo db.sql, criar base de dados no Postgres.
3. Na raiz do projeto, execute: `php -S localhost:8000` para rodar o servidor PHP.
4. Abrir no navegador: http://localhost:8000

### Melhorias:

1. Adicionar biblioteca de renderização de views.
2. Melhorar tratamento de erros.
