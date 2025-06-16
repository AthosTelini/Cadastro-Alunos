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
    <div class="card mb-4 shadow-sm border-0">
      <div class="card-body d-flex justify-content-between align-items-center px-4 py-3">
        <h3 class="fw-bold m-0">
          <i class="bi bi-people-fill text-primary me-2"></i> Gestão de Alunos
        </h3>
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link <?= ($menu_ativo === 'alunos') ? 'active' : '' ?>" href="/Cadastro-alunos-MVC/public/alunos">Alunos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($menu_ativo === 'professores') ? 'active' : '' ?>" href="/Cadastro-alunos-MVC/public/professores">Professores</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($menu_ativo === 'escolas') ? 'active' : '' ?>" href="/Cadastro-alunos-MVC/public/escolas">Escolas</a>
          </li>
          <li>
            <a href="/Cadastro-alunos-MVC/public/logout" class="btn btn-outline-danger ms-4">
              <i class="bi bi-box-arrow-right"></i> Sair
            </a>
          </li>
        </ul>
      </div>
    </div>
</header>

<main class="flex-grow-1">