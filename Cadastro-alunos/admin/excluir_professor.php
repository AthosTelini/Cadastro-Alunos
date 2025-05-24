<?php
include '../conexao.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID do professor não informado ou inválido.");
}

$id = (int) $_GET['id'];

try {
    // Verifica se existem alunos vinculados ao professor
    $stmtVerifica = $pdo->prepare("SELECT 1 FROM alunos WHERE id_professor = :id LIMIT 1");
    $stmtVerifica->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtVerifica->execute();

    if ($stmtVerifica->fetch()) {
        echo "<script>alert('Este professor está vinculado a um ou mais alunos e não pode ser excluído.');
        window.location.href='painel_professor.php';</script>";
        exit;
    }

    // Exclui o professor
    $stmtDelete = $pdo->prepare("DELETE FROM professor WHERE id = :id");
    $stmtDelete->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtDelete->execute();

    header("Location: painel_professor.php");
    exit;

} catch (PDOException $e) {
    echo "<script>alert('Erro ao excluir professor: " . addslashes($e->getMessage()) . "');
    window.location.href='painel_professor.php';</script>";
}
