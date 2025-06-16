<?php
require_once __DIR__ . '/../../Core/Controller.php';
require_once __DIR__ . '/../Models/Usuario.php';

class AuthController extends Controller
{
    public function loginForm()
    {
        require_once __DIR__ . '/../Views/auth/login.php';
    }

    
public function login()
{
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $user = Usuario::buscarPorUsuario($usuario);

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['logado'] = true;
        $_SESSION['nome'] = $user['nome_completo'];
        header('Location: /Cadastro-alunos-MVC/public/alunos'); 
        exit;
    } else {
        $_SESSION['erro_login'] = "Usuário ou senha inválidos.";
        header('Location: /Cadastro-alunos-MVC/public/login');
        exit;
    }
}

    public function logout()
    {
        session_destroy();
        header('Location: /Cadastro-alunos-MVC/public/'); 
        exit;
    }
}