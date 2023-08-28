<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $context['titulo'] ?></title>
    <!-- Utilizado com Bulma css (https://bulma.io) -->
    <link rel="stylesheet" href="app/View/assets/css/bulma.min.css">
  </head>
  <body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
          <a class="navbar-item" href="/">
            <a class="navbar-item" href="./">
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
            <form class="box" action="/login" method="post">
              <h3 class="title is-3">Login</h3>
                <div class="field">
                <label class="label">E-mail</label>
                <div class="control">
                    <input class="input" type="email" name="email" placeholder="Digite aqui seu e-mail">
                </div>
                </div>

                <div class="field">
                <label class="label">Senha</label>
                <div class="control">
                    <input class="input" type="password" name="password" placeholder="Digite aqui sua senha">
                </div>
                <?php if (isset($_SESSION['error'])): ?>
                <div class="control">
                    <?php $_SESSION ?>
                    <label class="label"><?= $_SESSION['error'] ?></label>
                </div>
                <?php endif ?>
                </div>

                <button class="button is-primary" type="submit">Entrar</button>
                <div class="buttons pt-2">
                    <a class="button is-warning" href="/register">
                        Não possui conta? Registre-se
                    </a>
                </div>
            </form>
        </div>
  </section>
  </body>
</html>