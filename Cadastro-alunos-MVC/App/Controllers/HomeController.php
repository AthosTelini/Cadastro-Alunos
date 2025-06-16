<?php
require_once __DIR__ . '/../../Core/Controller.php';
require_once __DIR__ . '/../Models/Aluno.php';

class HomeController extends Controller
{
    public function index()
    {
        $alunos = Aluno::listarTodos();
        
        $data['alunos'] = $alunos;
        $data['titulo'] = 'Lista de Alunos';

        extract($data);

        require_once __DIR__ . '/../Views/templates/public_header.php';
        require_once __DIR__ . '/../Views/home/index.php';
        require_once __DIR__ . '/../Views/templates/footer.php';
    }
}