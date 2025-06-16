<div class="container mt-5" style="max-width: 600px;">
  <form method="post" action="/Cadastro-alunos-MVC/public/escolas/criar" class="border p-4 bg-white rounded shadow-sm">
    <h2 class="mb-4 text-center">Cadastro de Nova Escola</h2>
    
    <div class="mb-3">
      <label class="form-label">Nome:</label>
      <input type="text" name="nome" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Endereço:</label>
      <input type="text" name="endereco" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Cidade:</label>
      <input type="text" name="cidade" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Estado: (Ex: MG,SP,RJ,...)</label>
      <input type="text" name="estado" class="form-control" required>
    </div>

    <div class="mb-4">
      <label class="form-label">Contato:</label>
      <input type="text" name="contato" class="form-control" required>
    </div>
    
    <div class="row">
      <div class="col-md-6">
          <a href="/Cadastro-alunos-MVC/public/escolas" class="btn btn-outline-secondary w-100 mb-2">Voltar</a>
      </div>
      <div class="col-md-6">
          <button type="submit" class="btn btn-primary w-100 mb-2">Cadastrar</button>
      </div>
    </div>
  </form>
</div>