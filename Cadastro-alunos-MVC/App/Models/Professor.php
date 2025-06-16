<?php
class Professor
{
    public static function listarTodos()
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->query("SELECT * FROM professor ORDER BY nome");
        return $stmt->fetchAll();
    }

    public static function buscarPorId($id)
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM professor WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public static function salvar($dados)
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("INSERT INTO professor (nome, area_atuacao, contato, cat) VALUES (:nome, :area_atuacao, :contato, :cat)");
        $stmt->execute($dados);
    }
    
    public static function atualizar($dados)
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("UPDATE professor SET nome = :nome, area_atuacao = :area_atuacao, contato = :contato, cat = :cat WHERE id = :id");
        $stmt->execute($dados);
    }
    
    public static function deletar($id)
    {
        $pdo = Database::getInstance();
        // Verifica se existem alunos vinculados ao professor
        $stmtVerifica = $pdo->prepare("SELECT 1 FROM alunos WHERE id_professor = :id LIMIT 1");
        $stmtVerifica->execute(['id' => $id]);
        if ($stmtVerifica->fetch()) {
            // Lança uma exceção personalizada que o controller irá capturar
            throw new PDOException("Este professor está vinculado a um ou mais alunos e não pode ser excluído.", 23503);
        }

        $stmtDelete = $pdo->prepare("DELETE FROM professor WHERE id = :id");
        $stmtDelete->execute(['id' => $id]);
    }
}