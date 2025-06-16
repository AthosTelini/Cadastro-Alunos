<?php
require_once __DIR__ . '/AdminController.php';
require_once __DIR__ . '/../Models/Aluno.php';
require_once __DIR__ . '/../Models/Escola.php';
require_once __DIR__ . '/../Models/Professor.php';

class AlunoController extends AdminController
{
    public function index()
    {
        $alunos = Aluno::listarTodos();
        $this->view('alunos/index', ['alunos' => $alunos, 'titulo' => 'Painel de Alunos']);
    }

    public function create()
    {
        $escolas = Escola::listarTodos();
        $professores = Professor::listarTodos();
        $this->view('alunos/create', [
            'escolas' => $escolas, 
            'professores' => $professores, 
            'titulo' => 'Cadastrar Novo Aluno'
        ]);
    }

    public function store()
    {
        Aluno::salvar($_POST);
        $_SESSION['mensagem'] = "Aluno cadastrado com sucesso!";
        header('Location: /Cadastro-alunos-MVC/public/alunos');
        exit;
    }
    
    public function edit($params)
    {
        $aluno = Aluno::buscarPorId($params['id']);
        $escolas = Escola::listarTodos();
        $professores = Professor::listarTodos();
        $this->view('alunos/edit', [
            'aluno' => $aluno,
            'escolas' => $escolas, 
            'professores' => $professores, 
            'titulo' => 'Editar Aluno'
        ]);
    }

    public function update()
    {
        Aluno::atualizar($_POST);
        $_SESSION['mensagem'] = "Aluno atualizado com sucesso!";
        header('Location: /Cadastro-alunos-MVC/public/alunos');
        exit;
    }

    public function destroy($params)
    {
        Aluno::deletar($params['id']);
        $_SESSION['mensagem'] = "Aluno excluído com sucesso!";
        header('Location: /Cadastro-alunos-MVC/public/alunos');
        exit;
    }
}