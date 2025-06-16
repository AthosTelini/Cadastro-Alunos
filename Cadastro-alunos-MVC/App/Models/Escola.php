<?php
class Escola
{
    public static function listarTodos()
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->query("SELECT * FROM escola ORDER BY nome");
        return $stmt->fetchAll();
    }

    public static function buscarPorId($id)
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM escola WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public static function salvar($dados)
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("INSERT INTO escola (nome, endereco, cidade, estado, contato) 
                               VALUES (:nome, :endereco, :cidade, :estado, :contato)");
        $stmt->execute($dados);
    }
    
    public static function atualizar($dados)
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("UPDATE escola SET nome = :nome, endereco = :endereco, cidade = :cidade, estado = :estado, contato = :contato WHERE id = :id");
        $stmt->execute($dados);
    }
     public static function deletar($id)
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("DELETE FROM escola WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}