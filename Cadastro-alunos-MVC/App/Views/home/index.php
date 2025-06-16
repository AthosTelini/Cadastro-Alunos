<div class="container mt-5">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold"><i class="bi bi-people-fill text-primary"></i> Alunos Cadastrados</h2>
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
        </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan='6' class='text-center'>Nenhum aluno cadastrado.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>