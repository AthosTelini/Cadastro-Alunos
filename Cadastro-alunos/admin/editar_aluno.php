<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: index.php");
    exit;
}

require '../conexao.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['mensagem'] = "ID do aluno não especificado.";
    header("Location: painel.php");
    exit;
}

$id = (int)$_GET['id'];
$erro = '';

try {
    // Buscar escolas e professores
    $stmtEscolas = $pdo->query("SELECT id, nome FROM escola ORDER BY nome ASC");
    $escolas = $stmtEscolas->fetchAll(PDO::FETCH_ASSOC);

    $stmtProfessores = $pdo->query("SELECT id, nome FROM professor ORDER BY nome ASC");
    $professores = $stmtProfessores->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = trim($_POST['nome']);
        $data_nascimento = $_POST['data_nascimento'];
        $ano_turma = trim($_POST['ano_turma']);
        $senha = trim($_POST['senha']);
        $observacao = trim($_POST['observacao']);
        $id_escola = (int)$_POST['id_escola'];
        $id_professor = (int)$_POST['id_professor'];

        // Validação básica
        if (empty($nome) || empty($data_nascimento) || empty($ano_turma) || empty($senha) || empty($observacao)) {
            $erro = "Todos os campos devem ser preenchidos.";
        } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data_nascimento)) {
            $erro = "Data de nascimento inválida.";
        } else {
            $stmt = $pdo->prepare("UPDATE alunos 
                SET nome = ?, data_nascimento = ?, ano_turma = ?, senha = ?, observacao = ?, id_escola = ?, id_professor = ? 
                WHERE id = ?");
            $resultado = $stmt->execute([$nome, $data_nascimento, $ano_turma, $senha, $observacao, $id_escola, $id_professor, $id]);

            if ($resultado) {
                $_SESSION['mensagem'] = "Aluno atualizado com sucesso!";
                header("Location: painel.php");
                exit;
            } else {
                $erro = "Erro ao atualizar aluno.";
            }
        }
    }

    // Buscar aluno (sempre necessário para preencher o formulário)
    $stmt = $pdo->prepare("SELECT * FROM alunos WHERE id = ?");
    $stmt->execute([$id]);
    $aluno = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$aluno) {
        $_SESSION['mensagem'] = "Aluno não encontrado.";
        header("Location: painel.php");
        exit;
    }
} catch (PDOException $e) {
    $erro = "Erro no banco de dados: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Aluno</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5" style="max-width: 600px;">
    <h2 class="mb-4 text-center">Editar Aluno</h2>

    <?php if (!empty($erro)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="POST" class="border p-4 bg-white rounded shadow-sm">
      <div class="mb-3">
        <label class="form-label">Nome:</label>
        <input type="text" class="form-control" name="nome" value="<?= htmlspecialchars($aluno['nome']) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Data de Nascimento:</label>
        <input type="date" class="form-control" name="data_nascimento" value="<?= $aluno['data_nascimento'] ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Ano/Turma:</label>
        <input type="text" class="form-control" name="ano_turma" value="<?= htmlspecialchars($aluno['ano_turma']) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Senha:</label>
        <input type="text" class="form-control" name="senha" value="<?= htmlspecialchars($aluno['senha']) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Observação:</label>
        <textarea class="form-control" name="observacao" rows="3" required><?= htmlspecialchars($aluno['observacao']) ?></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Escola:</label>
        <select name="id_escola" class="form-select" required>
          <?php foreach ($escolas as $row): ?>
            <option value="<?= $row['id'] ?>" <?= $row['id'] == $aluno['id_escola'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($row['nome']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Professor:</label>
        <select name="id_professor" class="form-select" required>
          <?php foreach ($professores as $row): ?>
            <option value="<?= $row['id'] ?>" <?= $row['id'] == $aluno['id_professor'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($row['nome']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="d-flex justify-content-between">
        <a href="painel.php" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
      </div>
    </form>
  </div>
</body>
</html>
