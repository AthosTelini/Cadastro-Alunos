<?php
require_once __DIR__ . '/AdminController.php';
require_once __DIR__ . '/../Models/Professor.php';

class ProfessorController extends AdminController
{
    public function index()
    {
        $professores = Professor::listarTodos();
        $this->view('professores/index', ['professores' => $professores, 'titulo' => 'Painel de Professores']);
    }

    public function create()
    {
        $this->view('professores/create', ['titulo' => 'Cadastrar Novo Professor']);
    }

    public function store()
    {
        Professor::salvar($_POST);
        $_SESSION['mensagem'] = "Professor cadastrado com sucesso!";
        header('Location: /Cadastro-alunos-MVC/public/professores');
        exit;
    }
    
    public function edit($params)
    {
        $professor = Professor::buscarPorId($params['id']);
        $this->view('professores/edit', ['professor' => $professor, 'titulo' => 'Editar Professor']);
    }

    public function update()
    {
        Professor::atualizar($_POST);
        $_SESSION['mensagem'] = "Professor atualizado com sucesso!";
        header('Location: /Cadastro-alunos-MVC/public/professores');
        exit;
    }

    public function destroy($params)
    {
        try {
            Professor::deletar($params['id']);
            $_SESSION['mensagem'] = "Professor excluído com sucesso!";
        } catch (PDOException $e) {
            $_SESSION['mensagem'] = $e->getMessage();
        }

        header('Location: /Cadastro-alunos-MVC/public/professores');
        exit;
    }
}