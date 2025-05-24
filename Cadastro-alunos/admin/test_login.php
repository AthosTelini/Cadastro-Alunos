<?php
require_once '../conexao.php';

$usuario = 'admin';
$senha = password_hash('1234', PASSWORD_DEFAULT);
$nome_completo = 'Administrador';

try {
    $stmt = $pdo->prepare("INSERT INTO usuarios_admin (usuario, senha, nome_completo) VALUES (:usuario, :senha, :nome)");
    $stmt->execute([
        ':usuario' => $usuario,
        ':senha' => $senha,
        ':nome' => $nome_completo
    ]);
    echo "Usuário admin criado com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao inserir: " . $e->getMessage();
}
