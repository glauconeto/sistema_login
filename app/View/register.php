<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $context['titulo'] ?></title>
    <!-- Utilizado com Bulma css (https://bulma.io) -->
    <link rel="stylesheet" href="app/View/assets/css/bulma.min.css">
    <!-- Utilizado ícones Font Awesome 4 -->
    <link rel="stylesheet" href="/app/View//assets/icons/font-awesome-4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
          <a class="navbar-item" href="/">
            <a class="navbar-item" href="/">
              SMART IN TECH
            </a>
          </a>

          <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
          </a>
        </div>
          <div class="navbar-end">
            <div class="navbar-item">
              <div class="buttons">
                <a class="button is-primary" href="/register">
                  <strong>Registre-se</strong>
                </a>
                <a class="button is-light" href="/login">
                  Entrar
                </a>
              </div>
            </div>
          </div>
        </div>
    </nav>
    <section class="section">
      <div class="container">
        <form class="box" action="/register/save" method="post">
          <h3 class="title is-3"><i class="fa fa-user" style="padding-right: 7px;" aria-hidden="true"></i>Registrar usuário</h3>
          <div class="field">
            <label class="label"><i class="fa fa-address-card" aria-hidden="true" style="padding-right: 6px;"></i>Nome</label>
            <div class="control">
              <input class="input" type="text" name="name" id="name" placeholder="Digite seu nome">
            </div>
          </div>
          <div class="field">
            <label class="label"><i class="fa fa-envelope" style="padding-right: 7px;" aria-hidden="true"></i>E-mail</label>
            <div class="control">
              <input class="input" type="email" name="email" id="email" placeholder="Digite seu e-mail">
            </div>
          </div>

          <div class="field">
            <label class="label"><label class="label"><i class="fa fa-key" style="padding-right: 7px;" aria-hidden="true"></i>Senha</label>
            <div class="control">
              <input class="input" type="password" name="password" id="password" placeholder="Digite sua senha">
            </div>
          </div>

          <button class="button is-primary" type="submit">Registrar</button>
          <div class="buttons pt-2">
            <a class="button is-warning" href="/login">
              Já possui conta? Entre
            </a>
          </div>
          <?php if (isset($_SESSION['error'])): ?>
            <div class="control">
                <label class="label"><?= $_SESSION['error'] ?></label>
            </div>
          <?php endif ?>
        </form>      
      </div>
    </section>
  </body>
</html>