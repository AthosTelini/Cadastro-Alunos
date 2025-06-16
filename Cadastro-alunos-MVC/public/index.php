<?php
session_start();

require_once __DIR__ . '/../Core/Router.php';
require_once __DIR__ . '/../Core/Database.php';

$router = new Router();

// Rotas de Autenticação
$router->add('GET', '', 'HomeController@index'); // Rota raiz
$router->add('GET', 'login', 'AuthController@loginForm');
$router->add('POST', 'login', 'AuthController@login');
$router->add('GET', 'logout', 'AuthController@logout');

// Rotas de Escola
$router->add('GET', 'escolas', 'EscolaController@index');
$router->add('GET', 'escolas/criar', 'EscolaController@create');
$router->add('POST', 'escolas/criar', 'EscolaController@store');
$router->add('GET', 'escolas/editar/{id}', 'EscolaController@edit'); 
$router->add('POST', 'escolas/editar', 'EscolaController@update');   
$router->add('GET', 'escolas/excluir/{id}', 'EscolaController@destroy');

// Rotas de Professor
$router->add('GET', 'professores', 'ProfessorController@index');
$router->add('GET', 'professores/criar', 'ProfessorController@create');
$router->add('POST', 'professores/criar', 'ProfessorController@store');
$router->add('GET', 'professores/editar/{id}', 'ProfessorController@edit');
$router->add('POST', 'professores/editar', 'ProfessorController@update');
$router->add('GET', 'professores/excluir/{id}', 'ProfessorController@destroy');

// Rotas de Aluno
$router->add('GET', 'alunos', 'AlunoController@index');
$router->add('GET', 'alunos/criar', 'AlunoController@create');
$router->add('POST', 'alunos/criar', 'AlunoController@store');
$router->add('GET', 'alunos/editar/{id}', 'AlunoController@edit');
$router->add('POST', 'alunos/editar', 'AlunoController@update');
$router->add('GET', 'alunos/excluir/{id}', 'AlunoController@destroy');

$router->dispatch();