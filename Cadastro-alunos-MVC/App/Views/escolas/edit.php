<div class="container mt-5" style="max-width: 600px;">
  <form method="post" action="/Cadastro-alunos-MVC/public/escolas/editar" class="border p-4 bg-white rounded shadow-sm">
    <h2 class="mb-4 text-center">Editar Escola</h2>
    
    <input type="hidden" name="id" value="<?= $escola['id'] ?>">

    <div class="mb-3">
      <label class="form-label">Nome:</label>
      <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($escola['nome']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Endereço:</label>
      <input type="text" name="endereco" class="form-control" value="<?= htmlspecialchars($escola['endereco']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Cidade:</label>
      <input type="text" name="cidade" class="form-control" value="<?= htmlspecialchars($escola['cidade']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Estado:</label>
      <input type="text" name="estado" class="form-control" value="<?= htmlspecialchars($escola['estado']) ?>" maxlength="2" required>
    </div>

    <div class="mb-4">
      <label class="form-label">Contato:</label>
      <input type="text" name="contato" class="form-control" value="<?= htmlspecialchars($escola['contato']) ?>" required>
    </div>
    
    <div class="row">
      <div class="col-md-6">
          <a href="/Cadastro-alunos-MVC/public/escolas" class="btn btn-outline-secondary w-100 mb-2">Cancelar</a>
      </div>
      <div class="col-md-6">
          <button type="submit" class="btn btn-success w-100 mb-2">Salvar</button>
      </div>
    </div>
  </form>
</div>