<?php
include '../conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel de Escolas</title>
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
        <a class="nav-link" href="painel_professor.php">Professores</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="painel_escola.php">Escolas</a>
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
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold">
    <i class="bi bi-building-fill-gear text-primary"></i> Escolas Cadastradas
    </h2>
    <a href="http://localhost/cadastro-alunos/admin/cadastro_escola.php" class="btn btn-outline-primary btn-lg">
        Cadastrar Escola
      </a>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-hover bg-white shadow-sm">
    <thead class="table-dark">
        <tr>
          <th>Nome</th>
          <th>Endereço</th>
          <th>Cidade</th>
          <th>Estado</th>
          <th>Contato</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
      <?php
        $sql = "SELECT * FROM escola ORDER BY id";
        $stmt = $pdo->prepare($sql);  // Usando PDO para preparar a consulta
        $stmt->execute();  // Executando a consulta
        $escolas = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Buscando os resultados

        foreach ($escolas as $linha) {
            echo "<tr>";
            echo "<td>{$linha['nome']}</td>";
            echo "<td>{$linha['endereco']}</td>";
            echo "<td>{$linha['cidade']}</td>";
            echo "<td>{$linha['estado']}</td>";
            echo "<td>{$linha['contato']}</td>";
            echo "<td>
                    <a href='editar_escola.php?id={$linha['id']}' class='btn btn-sm btn-warning me-2'>
                      <i class='bi bi-pencil'></i>
                    </a>
                    <a href='excluir_escola.php?id={$linha['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Deseja realmente excluir esta escola?')\">
                      <i class='bi bi-trash'></i>
                    </a>
                  </td>";
            echo "</tr>";
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
