<?php
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: index.php");
    exit;
}

include '../conexao.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM alunos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['mensagem'] = "Aluno excluído com sucesso!";
    } catch (PDOException $e) {
        $_SESSION['mensagem'] = "Erro ao excluir aluno: " . $e->getMessage();
    }
} else {
    $_SESSION['mensagem'] = "ID inválido para exclusão.";
}

header("Location: painel.php");
exit;
