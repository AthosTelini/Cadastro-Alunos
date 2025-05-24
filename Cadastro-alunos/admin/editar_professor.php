<?php
include '../conexao.php';

// Verifica se o ID foi informado e é numérico
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID do professor não informado ou inválido.");
}

$id = (int)$_GET['id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Coleta e valida os dados do formulário
    $nome = trim($_POST['nome'] ?? '');
    $area = trim($_POST['area_atuacao'] ?? '');
    $contato = trim($_POST['contato'] ?? '');
    $cat = trim($_POST['cat'] ?? '');

    if ($nome && $area && $contato) {
        try {
            $stmt = $pdo->prepare("UPDATE professor SET nome = :nome, area_atuacao = :area, contato = :contato, cat = :cat WHERE id = :id");
            $stmt->execute([
                ':nome' => $nome,
                ':area' => $area,
                ':contato' => $contato,
                ':cat' => $cat,
                ':id' => $id
            ]);
            header("Location: painel_professor.php");
            exit;
        } catch (PDOException $e) {
            echo "Erro ao atualizar professor: " . $e->getMessage();
        }
    } else {
        echo "Por favor, preencha todos os campos obrigatórios.";
    }
} else {
    // Carrega os dados do professor para edição
    try {
        $stmt = $pdo->prepare("SELECT * FROM professor WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $professor = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$professor) {
            die("Professor não encontrado.");
        }
    } catch (PDOException $e) {
        die("Erro ao buscar professor: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Professor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 600px;">
  <form method="post" class="border p-4 bg-white rounded shadow-sm">
    <h2 class="mb-4 text-center">Editar Professor</h2>

    <div class="mb-3">
      <label class="form-label">Nome:</label>
      <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($professor['nome']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Área de Atuação:</label>
      <input type="text" name="area_atuacao" class="form-control" value="<?= htmlspecialchars($professor['area_atuacao']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Contato:</label>
      <input type="text" name="contato" class="form-control" value="<?= htmlspecialchars($professor['contato']) ?>" required>
    </div>

    <div class="mb-4">
      <label class="form-label">CAT (opcional):</label>
      <input type="text" name="cat" class="form-control" value="<?= htmlspecialchars($professor['cat']) ?>">
    </div>

    <div class="row">
      <div class="col-md-6">
        <a href="painel_professor.php" class="btn btn-outline-secondary w-100">Cancelar</a>
      </div>
      <div class="col-md-6">
        <button type="submit" class="btn btn-success w-100">Salvar</button>
      </div>
    </div>
  </form>
</div>

</body>
</html>
