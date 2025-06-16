<?php
require_once __DIR__ . '/../../Core/Controller.php';

class AdminController extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
            header('Location: /Cadastro-alunos-MVC/public/login');
            exit;
        }
    }
}