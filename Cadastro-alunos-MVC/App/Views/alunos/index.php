<div class="container mt-5">

  <?php if (isset($_SESSION['mensagem'])): ?>
  <div class="alert alert-info alert-dismissible fade show" role="alert">
      <?= $_SESSION['mensagem'] ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php unset($_SESSION['mensagem']); ?>
  <?php endif; ?>

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="bi bi-person-fill text-primary"></i> Alunos cadastrados</h2>
    <a href="/Cadastro-alunos-MVC/public/alunos/criar" class="btn btn-outline-primary btn-lg ms-4">
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
      <?php if (!empty($alunos)): ?>
        <?php foreach ($alunos as $aluno): ?>
        <tr>
          <td><?= htmlspecialchars($aluno['nome']) ?></td>
          <td><?= date('d/m/Y', strtotime($aluno['data_nascimento'])) ?></td>
          <td><?= htmlspecialchars($aluno['ano_turma']) ?></td>
          <td><?= htmlspecialchars($aluno['escola_nome'] ?? 'Não informado') ?></td>
          <td><?= htmlspecialchars($aluno['professor_nome'] ?? 'Não informado') ?></td>
          <td><?= htmlspecialchars($aluno['observacao']) ?></td>
          <td>
            <a href="/Cadastro-alunos-MVC/public/alunos/editar/<?= $aluno['id'] ?>" class='btn btn-sm btn-warning'><i class='bi bi-pencil'></i></a>
            <a href="/Cadastro-alunos-MVC/public/alunos/excluir/<?= $aluno['id'] ?>" class='btn btn-sm btn-danger' onclick='return confirm("Tem certeza que deseja excluir?")'><i class='bi bi-trash'></i></a>
          </td>
        </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan='7' class='text-center'>Nenhum aluno cadastrado.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>