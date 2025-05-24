<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Professor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php
include '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $area = trim($_POST['area_atuacao']);
    $contato = trim($_POST['contato']);
    $cat = trim($_POST['cat']);

    $erros = [];

    if (empty($nome)) {
        $erros[] = "O nome é obrigatório.";
    } elseif (strlen($nome) < 3 || strlen($nome) > 64) {
        $erros[] = "O nome deve ter entre 3 e 64 caracteres.";
    }

    if (empty($area)) {
        $erros[] = "A área de atuação é obrigatória.";
    }

    if (empty($contato)) {
        $erros[] = "O contato é obrigatório.";
    } elseif (!is_numeric($contato)) {
        $erros[] = "O contato deve conter apenas números.";
    }

    if (empty($erros)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO professor (nome, area_atuacao, contato, cat) 
                                   VALUES (:nome, :area, :contato, :cat)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':area', $area);
            $stmt->bindParam(':contato', $contato);
            $stmt->bindParam(':cat', $cat);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success text-center'>Professor cadastrado com sucesso!</div>";
            } else {
                echo "<div class='alert alert-danger text-center'>Erro ao cadastrar professor.</div>";
            }
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger text-center'>Erro no banco de dados: " . $e->getMessage() . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning'><ul>";
        foreach ($erros as $erro) {
            echo "<li>$erro</li>";
        }
        echo "</ul></div>";
    }
}
?>

<div class="container mt-5" style="max-width: 600px;">
  <form method="post" class="border p-4 bg-white rounded shadow-sm">
    <h2 class="mb-4 text-center">Cadastro de Professor</h2>

    <div class="mb-3">
      <label class="form-label">Nome:</label>
      <input type="text" name="nome" class="form-control" required minlength="3" maxlength="64">
    </div>

    <div class="mb-3">
      <label class="form-label">Área de Atuação:</label>
      <input type="text" name="area_atuacao" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Contato:</label>
      <input type="text" name="contato" class="form-control" required pattern="\d+">
    </div>

    <div class="mb-4">
      <label class="form-label">CAT (opcional):</label>
      <input type="text" name="cat" class="form-control">
    </div>

    <div class="row">
      <div class="col-md-6">
        <a href="painel.php" class="btn btn-outline-secondary w-100 d-inline-flex justify-content-center align-items-center mb-2">
          Voltar
        </a>
      </div>
      <div class="col-md-6">
        <button type="submit" class="btn btn-primary w-100 mb-2">Cadastrar</button>
      </div>
    </div>
  </form>
</div>
</body>
</html>
