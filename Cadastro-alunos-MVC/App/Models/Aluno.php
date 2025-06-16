<?php
class Aluno
{
    public static function listarTodos()
    {
        $pdo = Database::getInstance();
        $query = "SELECT a.*, 
                         e.nome AS escola_nome, 
                         p.nome AS professor_nome 
                  FROM alunos a
                  LEFT JOIN escola e ON a.id_escola = e.id
                  LEFT JOIN professor p ON a.id_professor = p.id
                  ORDER BY a.nome";
        $stmt = $pdo->query($query);
        return $stmt->fetchAll();
    }

    public static function buscarPorId($id)
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM alunos WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public static function salvar($dados)
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("INSERT INTO alunos (nome, data_nascimento, ano_turma, observacao, senha, id_escola, id_professor) 
                               VALUES (:nome, :data_nascimento, :ano_turma, :observacao, :senha, :id_escola, :id_professor)");
        $stmt->execute($dados);
    }
    
    public static function atualizar($dados)
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("UPDATE alunos SET nome = :nome, data_nascimento = :data_nascimento, ano_turma = :ano_turma, observacao = :observacao, senha = :senha, id_escola = :id_escola, id_professor = :id_professor WHERE id = :id");
        $stmt->execute($dados);
    }
    
    public static function deletar($id)
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("DELETE FROM alunos WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}