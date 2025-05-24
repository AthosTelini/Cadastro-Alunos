<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: index.php");
    exit;
}

include '../conexao.php';

$mensagem = '';

try {
    // Carregar escolas e professores via PDO
    $stmtEscolas = $pdo->query("SELECT id, nome FROM escola ORDER BY nome ASC");
    $escolas = $stmtEscolas->fetchAll(PDO::FETCH_ASSOC);

    $stmtProfessores = $pdo->query("SELECT id, nome FROM professor ORDER BY nome ASC");
    $professores = $stmtProfessores->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao carregar escolas/professores: " . $e->getMessage());
}

// Cadastro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome'] ?? '');
    $data_nascimento = trim($_POST['data_nascimento'] ?? '');
    $ano_turma = trim($_POST['ano_turma'] ?? '');
    $observacao = trim($_POST['observacao'] ?? '');
    $senha = trim($_POST['senha'] ?? '');
    $id_escola = $_POST['id_escola'] ?? '';
    $id_professor = $_POST['id_professor'] ?? '';

    if ($nome && $data_nascimento && $ano_turma && $observacao && $senha && $id_escola && $id_professor) {
        try {
            $stmt = $pdo->prepare("INSERT INTO alunos 
                (nome, data_nascimento, ano_turma, observacao, senha, id_escola, id_professor) 
                VALUES (:nome, :data_nascimento, :ano_turma, :observacao, :senha, :id_escola, :id_professor)");

            $stmt->execute([
                ':nome' => $nome,
                ':data_nascimento' => $data_nascimento,
                ':ano_turma' => $ano_turma,
                ':observacao' => $observacao,
                ':senha' => $senha,
                ':id_escola' => $id_escola,
                ':id_professor' => $id_professor
            ]);

            $mensagem = '<div class="alert alert-success">Aluno cadastrado com sucesso!</div>';
        } catch (PDOException $e) {
            $mensagem = '<div class="alert alert-danger">Erro ao cadastrar aluno: ' . $e->getMessage() . '</div>';
        }
    } else {
        $mensagem = '<div class="alert alert-warning">Preencha todos os campos.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Novo Aluno</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 600px;">
    <h3 class="mb-4 text-center">Cadastro de Novo Aluno</h3>

    <?= $mensagem ?>

    <form method="post" class="border p-4 bg-white rounded shadow-sm">
        <div class="mb-3">
            <label class="form-label">Nome:</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Data de Nascimento:</label>
            <input type="date" name="data_nascimento" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ano/Turma:</label>
            <input type="text" name="ano_turma" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Observação:</label>
            <input type="text" name="observacao" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Senha:</label>
            <input type="text" name="senha" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Escola:</label>
            <select name="id_escola" class="form-select" required>
                <option value="">Selecione</option>
                <?php foreach ($escolas as $escola): ?>
                    <option value="<?= $escola['id'] ?>"><?= htmlspecialchars($escola['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Professor:</label>
            <select name="id_professor" class="form-select" required>
                <option value="">Selecione</option>
                <?php foreach ($professores as $prof): ?>
                    <option value="<?= $prof['id'] ?>"><?= htmlspecialchars($prof['nome']) ?></option>
                <?php endforeach; ?>
            </select>
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
