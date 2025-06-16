<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Acesso Administrativo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container mt-5" style="max-width: 400px;">
    <h3 class="text-center mb-4"><i class="bi bi-lock-fill"></i> Acesso Administrativo</h3>

    <?php if (isset($_SESSION['erro_login'])): ?>
      <div class="alert alert-danger"><?= $_SESSION['erro_login'] ?></div>
      <?php unset($_SESSION['erro_login']); ?>
    <?php endif; ?>

    <form method="post" action="/Cadastro-alunos-MVC/public/login">
      <div class="mb-3">
        <label for="usuario" class="form-label">Usuário</label>
        <input type="text" name="usuario" id="usuario" class="form-control" required autofocus>
      </div>

      <div class="mb-3">
        <label for="senha" class="form-label">Senha</label>
        <input type="password" name="senha" id="senha" class="form-control" required>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-box-arrow-in-right"></i> Entrar
        </button>
      </div>
    </form>
  </div>

</body>
</html>