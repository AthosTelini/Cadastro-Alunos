<?php
include '../conexao.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM escola WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: painel_escola.php");
        exit();
    } catch (PDOException $e) {
        // Erro de integridade referencial (chave estrangeira)
        if ($e->getCode() == '23503') {
            echo "
            <script>
                alert('Erro: A escola está vinculada a outros registros e não pode ser excluída.');
                window.location.href = 'painel_escola.php';
            </script>";
        } else {
            echo "
            <script>
                alert('Erro ao excluir: " . addslashes($e->getMessage()) . "');
                window.location.href = 'painel_escola.php';
            </script>";
        }
    }
} else {
    header("Location: painel_escola.php");
    exit();
}
