<div class="container mt-5" style="max-width: 600px;">
    <h3 class="mb-4 text-center">Cadastro de Novo Aluno</h3>

    <form method="post" action="/Cadastro-alunos-MVC/public/alunos/criar" class="border p-4 bg-white rounded shadow-sm">
        <div class="mb-3">
            <label class="form-label">Nome:</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Data de Nascimento:</label>
            <input type="date" name="data_nascimento" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Ano/Turma:</label>
            <input type="text" name="ano_turma" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Observação:</label>
            <input type="text" name="observacao" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Senha:</label>
            <input type="text" name="senha" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Escola:</label>
            <select name="id_escola" class="form-select" required>
                <option value="">Selecione</option>
                <?php foreach ($escolas as $escola): ?>
                    <option value="<?= $escola['id'] ?>"><?= htmlspecialchars($escola['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Professor:</label>
            <select name="id_professor" class="form-select" required>
                <option value="">Selecione</option>
                <?php foreach ($professores as $prof): ?>
                    <option value="<?= $prof['id'] ?>"><?= htmlspecialchars($prof['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row">
            <div class="col-md-6"><a href="/Cadastro-alunos-MVC/public/alunos" class="btn btn-outline-secondary w-100 mb-2">Voltar</a></div>
            <div class="col-md-6"><button type="submit" class="btn btn-primary w-100 mb-2">Cadastrar</button></div>
        </div>
    </form>
</div>