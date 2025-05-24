<?php include 'conexao.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Alunos Cadastrados</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold">
        <i class="bi bi-mortarboard-fill text-primary"></i> Lista de Alunos
      </h2>
      <a href="/cadastro-alunos/admin" class="btn btn-primary">
        <i class="bi bi-lock-fill"></i> Acesso Administrativo
      </a>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-dark text-center">
          <tr>
            <th>Nome</th>
            <th>Data de Nascimento</th>
            <th>Ano/Turma</th>
            <th>Escola</th>
            <th>Professor</th>
            <th>Observação</th>
          </tr>
        </thead>
        <tbody>
          <?php
          try {
              $query = "SELECT a.nome, a.data_nascimento, a.ano_turma, a.observacao, 
                               e.nome AS escola_nome, 
                               p.nome AS professor_nome
                        FROM alunos a
                        LEFT JOIN escola e ON a.id_escola = e.id
                        LEFT JOIN professor p ON a.id_professor = p.id
                        ORDER BY a.nome";
              $stmt = $pdo->query($query);
              $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

              if ($alunos && count($alunos) > 0) {
                  foreach ($alunos as $aluno) {
                      echo "<tr>";
                      echo "<td>" . htmlspecialchars($aluno['nome']) . "</td>";
                      echo "<td>" . date('d/m/Y', strtotime($aluno['data_nascimento'])) . "</td>";
                      echo "<td>" . htmlspecialchars($aluno['ano_turma']) . "</td>";
                      echo "<td>" . htmlspecialchars($aluno['escola_nome'] ?? 'Não informado') . "</td>";
                      echo "<td>" . htmlspecialchars($aluno['professor_nome'] ?? 'Não informado') . "</td>";
                      echo "<td>" . htmlspecialchars($aluno['observacao']) . "</td>";
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='6' class='text-center text-muted'>Nenhum aluno cadastrado.</td></tr>";
              }
          } catch (PDOException $e) {
              echo "<tr><td colspan='6' class='text-danger'>Erro ao acessar o banco de dados: " . $e->getMessage() . "</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>
