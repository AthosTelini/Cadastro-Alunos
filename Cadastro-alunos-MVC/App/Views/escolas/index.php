<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold">
        <i class="bi bi-building-fill-gear text-primary"></i> Escolas Cadastradas
    </h2>
    <a href="/Cadastro-alunos-MVC/public/escolas/criar" class="btn btn-outline-primary btn-lg">
        Cadastrar Escola
    </a>
  </div>
  
    <div class="container mt-5">

  <?php if (isset($_SESSION['mensagem'])): ?>
  <div class="alert alert-info alert-dismissible fade show" role="alert">
      <?= $_SESSION['mensagem'] ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php unset($_SESSION['mensagem']); ?>
  <?php endif; ?>

 

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
        <?php foreach ($escolas as $escola): ?>
            <tr>
                <td><?= htmlspecialchars($escola['nome']) ?></td>
                <td><?= htmlspecialchars($escola['endereco']) ?></td>
                <td><?= htmlspecialchars($escola['cidade']) ?></td>
                <td><?= htmlspecialchars($escola['estado']) ?></td>
                <td><?= htmlspecialchars($escola['contato']) ?></td>
                <td>
                    <a href="/Cadastro-alunos-MVC/public/escolas/editar/<?= $escola['id'] ?>" class='btn btn-sm btn-warning me-2'><i class='bi bi-pencil'></i></a>
                    <a href="/Cadastro-alunos-MVC/public/escolas/excluir/<?= $escola['id'] ?>" class='btn btn-sm btn-danger' onclick="return confirm('Tem certeza que deseja excluir esta escola?')"><i class='bi bi-trash'></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>