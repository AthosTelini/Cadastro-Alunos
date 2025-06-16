<div class="container mt-5">

  <?php if (isset($_SESSION['mensagem'])): ?>
  <div class="alert alert-info alert-dismissible fade show" role="alert">
      <?= $_SESSION['mensagem'] ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php unset($_SESSION['mensagem']); ?>
  <?php endif; ?>

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">
      <i class="bi bi-person-badge-fill text-primary"></i> Professores Cadastrados
    </h2>
    <a href="/Cadastro-alunos-MVC/public/professores/criar" class="btn btn-outline-primary btn-lg">Novo Professor</a>
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
        <?php foreach ($professores as $professor): ?>
        <tr>
          <td><?= htmlspecialchars($professor['nome']) ?></td>
          <td><?= htmlspecialchars($professor['area_atuacao']) ?></td>
          <td><?= htmlspecialchars($professor['contato']) ?></td>
          <td><?= htmlspecialchars($professor['cat'] ?? '-') ?></td>
          <td class='text-center'>
            <a href="/Cadastro-alunos-MVC/public/professores/editar/<?= $professor['id'] ?>" class='btn btn-sm btn-warning me-2'><i class='bi bi-pencil'></i></a>
            <a href="/Cadastro-alunos-MVC/public/professores/excluir/<?= $professor['id'] ?>" class='btn btn-sm btn-danger' onclick="return confirm('Tem certeza que deseja excluir este professor?');"><i class='bi bi-trash'></i></a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>