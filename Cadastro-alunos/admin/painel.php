<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: index.php");
    exit;
}

include '../conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel Administrativo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="card mb-4 shadow-sm border-0">
  <div class="card-body d-flex justify-content-between align-items-center px-4 py-3">
    <h3 class="fw-bold m-0">
      <i class="bi bi-people-fill text-primary me-2"></i> Gestão de Alunos
    </h3>
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" href="/cadastro-alunos/admin/painel.php">Alunos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="painel_professor.php">Professores</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="painel_escola.php">Escolas</a>
      </li>
      <li>
        <a href="http://localhost/cadastro-alunos/" class="btn btn-outline-danger">
          <i class="bi bi-box-arrow-right"></i> Sair
        </a>
      </li>
    </ul>
  </div>
</div>


<div class="container mt-5">
  <h2 class="mb-4 text-center"><i class="bi bi-person-lock"></i> Painel Administrativo</h2>
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="bi bi-person-lock"></i> Alunos cadastrados</h2>
    <a href="http://localhost/cadastro-alunos/admin/cadastro.php" class="btn btn-outline-primary btn-lg ms-4">
      Cadastrar Aluno
    </a>
  </div>

  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>Nome</th>
        <th>Data de Nascimento</th>
        <th>Ano/Turma</th>
        <th>Escola</th>
        <th>Professor</th>
        <th>Observação</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Consulta utilizando PDO
      $query = "SELECT a.*, 
                       e.nome AS escola_nome, 
                       p.nome AS professor_nome 
                FROM alunos a
                LEFT JOIN escola e ON a.id_escola = e.id
                LEFT JOIN professor p ON a.id_professor = p.id
                ORDER BY a.nome";

      // Usando PDO preparado
      $stmt = $pdo->prepare($query);
      $stmt->execute();

      // Verificando se há resultados
      if ($stmt->rowCount() > 0) {
          while ($aluno = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($aluno['nome']) . "</td>";
              echo "<td>" . date('d/m/Y', strtotime($aluno['data_nascimento'])) . "</td>";
              echo "<td>" . htmlspecialchars($aluno['ano_turma']) . "</td>";
              echo "<td>" . htmlspecialchars($aluno['escola_nome'] ?? 'Não informado') . "</td>";
              echo "<td>" . htmlspecialchars($aluno['professor_nome'] ?? 'Não informado') . "</td>";
              echo "<td>" . htmlspecialchars($aluno['observacao']) . "</td>";
              echo "<td>
                        <a href='editar_aluno.php?id={$aluno['id']}' class='btn btn-sm btn-warning'>
                          <i class='bi bi-pencil'></i>
                        </a>
                        <a href='excluir_aluno.php?id={$aluno['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>
                          <i class='bi bi-trash'></i>
                        </a>
                      </td>";
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='7' class='text-center'>Nenhum aluno cadastrado.</td></tr>";
      }
      ?>
    </tbody>
  </table>
  
</div>

<!-- Rodapé -->
<footer class="bg-primary text-white py-4 mt-5 w-100" style="position: absolute; bottom: 0;">
  <div class="container text-center">
    <div class="row">
      <div class="col-12 mb-2">
        Desenvolvido por <strong>Athos Telini</strong> e <strong>Gustavo Alves Luiz</strong>
      </div>
      <div class="col-12">
        Disciplina: <strong>Projeto e Desenvolvimento de Software</strong> · Professor: <strong>Matheus Guedes</strong> · 7º Período · Curso: <strong>Sistemas de Informação</strong>
      </div>
    </div>
  </div>
</footer>

</body>
</html>
