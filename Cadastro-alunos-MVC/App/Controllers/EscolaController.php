<?php
require_once __DIR__ . '/AdminController.php';
require_once __DIR__ . '/../Models/Escola.php';

class EscolaController extends AdminController
{
    public function index()
    {
        $escolas = Escola::listarTodos();
        $this->view('escolas/index', ['escolas' => $escolas, 'titulo' => 'Painel de Escolas']);
    }

    public function create()
    {
        $this->view('escolas/create', ['titulo' => 'Cadastrar Nova Escola']);
    }

    public function store()
    {
        Escola::salvar($_POST);
        // LINHA ADICIONADA:
        $_SESSION['mensagem'] = "Escola cadastrada com sucesso!";
        header('Location: /Cadastro-alunos-MVC/public/escolas');
        exit;
    }
    
    public function edit($params)
    {
        $escola = Escola::buscarPorId($params['id']);
        $this->view('escolas/edit', ['escola' => $escola, 'titulo' => 'Editar Escola']);
    }

    public function update()
    {
        Escola::atualizar($_POST);
        // LINHA ADICIONADA:
        $_SESSION['mensagem'] = "Escola atualizada com sucesso!";
        header('Location: /Cadastro-alunos-MVC/public/escolas');
        exit;
    }

    public function destroy($params)
    {
        try {
            Escola::deletar($params['id']);
            $_SESSION['mensagem'] = "Escola excluída com sucesso!";
        } catch (PDOException $e) {
            if ($e->getCode() === '23503') {
                $_SESSION['mensagem'] = "Não é possível excluir a escola, pois ela está vinculada a um ou mais alunos.";
            } else {
                $_SESSION['mensagem'] = "Erro ao excluir escola: " . $e->getMessage();
            }
        }

        header('Location: /Cadastro-alunos-MVC/public/escolas');
        exit;
    }
}