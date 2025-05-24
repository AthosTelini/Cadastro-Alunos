<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Escola</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php
include '../conexao.php';

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $endereco = trim($_POST['endereco']);
    $cidade = trim($_POST['cidade']);
    $estado = trim($_POST['estado']);
    $contato = trim($_POST['contato']);

    // Validação básica
    if (empty($nome) || empty($endereco) || empty($cidade) || empty($estado) || empty($contato)) {
        $mensagem = "<div class='alert alert-warning'>Todos os campos devem ser preenchidos.</div>";
    } elseif (strlen($nome) < 3 || strlen($nome) > 100) {
        $mensagem = "<div class='alert alert-warning'>O nome deve ter entre 3 e 100 caracteres.</div>";
    } elseif (strlen($contato) < 8 || strlen($contato) > 20) {
        $mensagem = "<div class='alert alert-warning'>O contato deve ter entre 8 e 20 caracteres.</div>";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO escola (nome, endereco, cidade, estado, contato) 
                                   VALUES (:nome, :endereco, :cidade, :estado, :contato)");
            $stmt->execute([
                ':nome' => $nome,
                ':endereco' => $endereco,
                ':cidade' => $cidade,
                ':estado' => $estado,
                ':contato' => $contato
            ]);
            $mensagem = "<div class='alert alert-success'>Escola cadastrada com sucesso!</div>";
        } catch (PDOException $e) {
            $mensagem = "<div class='alert alert-danger'>Erro ao cadastrar escola: " . $e->getMessage() . "</div>";
        }
    }
}
?>
    
<div class="container mt-5" style="max-width: 600px;">
  <?= $mensagem ?>
  <form method="post" class="border p-4 bg-white rounded shadow-sm">
    <h2 class="mb-4 text-center">Cadastro de Escola</h2>
    
    <div class="mb-3">
      <label class="form-label">Nome:</label>
      <input type="text" name="nome" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Endereço:</label>
      <input type="text" name="endereco" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Cidade:</label>
      <input type="text" name="cidade" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Estado:</label>
      <input type="text" name="estado" class="form-control" required>
    </div>

    <div class="mb-4">
      <label class="form-label">Contato:</label>
      <input type="text" name="contato" class="form-control" required>
    </div>
    
    <div class="row">
      <div class="col-md-6">
          <a href="painel.php" class="btn btn-outline-secondary w-100 mb-2">Voltar</a>
      </div>
      <div class="col-md-6">
          <button type="submit" class="btn btn-primary w-100 mb-2">Cadastrar</button>
      </div>
    </div>
  </form>
</div>
</body>
</html>
