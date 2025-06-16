<div class="container mt-5" style="max-width: 600px;">
  <form method="post" action="/Cadastro-alunos-MVC/public/professores/criar" class="border p-4 bg-white rounded shadow-sm">
    <h2 class="mb-4 text-center">Cadastro de Professor</h2>

    <div class="mb-3">
      <label class="form-label">Nome:</label>
      <input type="text" name="nome" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Área de Atuação:</label>
      <input type="text" name="area_atuacao" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Contato:</label>
      <input type="text" name="contato" class="form-control" required>
    </div>

    <div class="mb-4">
      <label class="form-label">CAT (opcional):</label>
      <input type="text" name="cat" class="form-control">
    </div>

    <div class="row">
      <div class="col-md-6">
        <a href="/Cadastro-alunos-MVC/public/professores" class="btn btn-outline-secondary w-100">Cancelar</a>
      </div>
      <div class="col-md-6">
        <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
      </div>
    </div>
  </form>
</div>