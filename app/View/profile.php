<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $context['titulo'] ?></title>
    <!-- Utilizado com Bulma css (https://bulma.io) -->
    <link rel="stylesheet" href="app/View/assets/css/bulma.min.css">
  </head>
  <body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
          <a class="navbar-item" href="/">
            <a class="navbar-item" href="/">
              SMART IN TECH
            </a>
          </a>
        </div>
      
        <div class="navbar-end">
            <div class="navbar-item">
              <?php if(!isset($_SESSION['id'])): ?>
              <div class="buttons">
                <a class="button is-primary" href="/register">
                  <strong>Registre-se</strong>
                </a>
                <a class="button is-light" href="/login">
                  Entrar
                </a>
              </div>
              <?php else: ?>
                <div class="navbar-item has-dropdown is-hoverable">
                  <a class="navbar-link">
                  <?php echo $context['user']->getName() ?>
                  </a>

                  <div class="navbar-dropdown">
                    <a class="navbar-item" href="/profile">
                      Perfil
                    </a>
                    <a class="navbar-item" href="/logout">
                      Sair
                    </a>
                  </div>
                </div>
              <?php endif ?>
            </div>
          </div>
        </div>
    </nav>
    <section class="section">
        <div class="container">
            <h1 class="title is-1">Dados do usuário logado:</h1>
            <br>

            <h3 class="subtitle is-2">Seu id de usuário: <?= $context['user']->getId() ?></h3>

            <h3 class="subtitle is-2">Seu nome: <?= $context['user']->getName() ?></h3>

            <h3 class="subtitle is-2">Seu e-mail: <?= $context['user']->getEmail() ?></h3>
        </div>
    </section>
  </body>
</html>