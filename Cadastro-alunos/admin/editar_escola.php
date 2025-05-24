<?php
session_start();
require '../conexao.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['mensagem'] = "ID inválido.";
    header("Location: painel_escola.php");
    exit;
}

$id = (int)$_GET['id'];
$erro = '';

try {
    // Busca os dados atuais da escola
    $stmt = $pdo->prepare("SELECT * FROM escola WHERE id = ?");
    $stmt->execute([$id]);
    $escola = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$escola) {
        $_SESSION['mensagem'] = "Escola não encontrada.";
        header("Location: painel_escola.php");
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = trim($_POST['nome']);
        $endereco = trim($_POST['endereco']);
        $cidade = trim($_POST['cidade']);
        $estado = trim($_POST['estado']);
        $contato = trim($_POST['contato']);

        // Validação simples
        if (empty($nome) || empty($endereco) || empty($cidade) || empty($estado) || empty($contato)) {
            $erro = "Todos os campos são obrigatórios.";
        } else {
            $stmt = $pdo->prepare("UPDATE escola SET nome = ?, endereco = ?, cidade = ?, estado = ?, contato = ? WHERE id = ?");
            $atualizado = $stmt->execute([$nome, $endereco, $cidade, $estado, $contato, $id]);

            if ($atualizado) {
                $_SESSION['mensagem'] = "Escola atualizada com sucesso!";
                header("Location: painel_escola.php");
                exit;
            } else {
                $erro = "Erro ao atualizar escola.";
            }
        }
    }
} catch (PDOException $e) {
    $erro = "Erro de banco de dados: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Escola</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 600px;">
  <form method="post" class="border p-4 bg-white rounded shadow-sm">
    <h2 class="mb-4 text-center">Editar Escola</h2>

    <?php if (!empty($erro)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <div class="mb-3">
      <label class="form-label">Nome:</label>
      <input type="text" name="nome" value="<?= htmlspecialchars($escola['nome']) ?>" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Endereço:</label>
      <input type="text" name="endereco" value="<?= htmlspecialchars($escola['endereco']) ?>" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Cidade:</label>
      <input type="text" name="cidade" value="<?= htmlspecialchars($escola['cidade']) ?>" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Estado:</label>
      <input type="text" name="estado" value="<?= htmlspecialchars($escola['estado']) ?>" class="form-control" required>
    </div>

    <div class="mb-4">
      <label class="form-label">Contato:</label>
      <input type="text" name="contato" value="<?= htmlspecialchars($escola['contato']) ?>" class="form-control" required>
    </div>

    <div class="row">
      <div class="col-md-6">
        <a href="painel_escola.php" class="btn btn-outline-secondary w-100">Voltar</a>
      </div>
      <div class="col-md-6">
        <button type="submit" class="btn btn-success w-100">Atualizar</button>
      </div>
    </div>
  </form>
</div>

</body>
</html>
