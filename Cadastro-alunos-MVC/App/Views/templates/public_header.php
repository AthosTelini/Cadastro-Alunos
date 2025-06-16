<!DOCTYPE html>
<html lang="pt-br" class="h-100">
<head>
  <meta charset="UTF-8">
  <title><?= $titulo ?? 'Gestão de Alunos' ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">

<header>
    <div class="navbar navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <i class="bi bi-mortarboard-fill me-2"></i>
                <strong>Projeto Alunos</strong>
            </a>
            <a href="/Cadastro-alunos-MVC/public/login" class="btn btn-light">
                <i class="bi bi-lock-fill"></i> Acesso Administrativo
            </a>
        </div>
    </div>
</header>

<main class="flex-grow-1">