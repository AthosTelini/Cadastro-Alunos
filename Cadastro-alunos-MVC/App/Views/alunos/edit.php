<div class="container mt-5" style="max-width: 600px;">
    <h2 class="mb-4 text-center">Editar Aluno</h2>

    <form method="POST" action="/Cadastro-alunos-MVC/public/alunos/editar" class="border p-4 bg-white rounded shadow-sm">
      <input type="hidden" name="id" value="<?= $aluno['id'] ?>">
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
          <?php foreach ($escolas as $escola): ?>
            <option value="<?= $escola['id'] ?>" <?= ($escola['id'] == $aluno['id_escola']) ? 'selected' : '' ?>>
              <?= htmlspecialchars($escola['nome']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Professor:</label>
        <select name="id_professor" class="form-select" required>
          <?php foreach ($professores as $prof): ?>
            <option value="<?= $prof['id'] ?>" <?= ($prof['id'] == $aluno['id_professor']) ? 'selected' : '' ?>>
              <?= htmlspecialchars($prof['nome']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="d-flex justify-content-between">
        <a href="/Cadastro-alunos-MVC/public/alunos" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
      </div>
    </form>
</div>