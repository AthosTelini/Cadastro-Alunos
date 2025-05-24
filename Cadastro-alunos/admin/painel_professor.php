<?php include '../conexao.php'; 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel de Professores</title>
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
      <a class="nav-link " href="/cadastro-alunos/admin/painel.php">Alunos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="painel_professor.php">Professores</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="painel_escola.php">Escolas</a>
      </li>
      <li>
        <a href="http://localhost/cadastro-alunos/" class="btn btn-outline-danger ms-4">
          <i class="bi bi-box-arrow-right"></i> Sair
        </a>
        </li>
    </ul>
  </div>
</div>

  <div class="container mt-5">
  <h2 class="mb-4 text-center"><i class="bi bi-person-lock"></i> Painel Administrativo</h2>
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold">
        
        <i class="bi bi-person-badge-fill text-primary"></i> Professores Cadastrados
      </h2>
      <a href="cadastro_professor.php" class="btn btn-outline-primary btn-lg">
        Novo Professor
      </a>
      
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-dark text-center">
          <tr>
            <th>Nome</th>
            <th>Área de Atuação</th>
            <th>Contato</th>
            <th>CAT</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Consulta utilizando PDO
          $query = "SELECT * FROM professor ORDER BY nome";
          $stmt = $pdo->prepare($query);  // Usando PDO preparado
          $stmt->execute();

          // Verificando se há resultados
          if ($stmt->rowCount() > 0) {
              while ($professor = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  echo "<tr>";
                  echo "<td>" . htmlspecialchars($professor['nome']) . "</td>";
                  echo "<td>" . htmlspecialchars($professor['area_atuacao']) . "</td>";
                  echo "<td>" . htmlspecialchars($professor['contato']) . "</td>";
                  echo "<td>" . htmlspecialchars($professor['cat'] ?? '-') . "</td>";
                  echo "<td class='text-center'>";
                  echo "<a href='editar_professor.php?id=" . $professor['id'] . "' class='btn btn-sm btn-warning me-2'><i class='bi bi-pencil'></i></a>";
                  echo "<a href='excluir_professor.php?id=" . $professor['id'] . "' class='btn btn-sm btn-danger' onclick=\"return confirm('Tem certeza que deseja excluir este professor?');\"><i class='bi bi-trash'></i></a>";
                  echo "</td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='5' class='text-center text-muted'>Nenhum professor cadastrado.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
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
