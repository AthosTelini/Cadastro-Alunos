<?php
class Usuario
{
    public static function buscarPorUsuario($usuario)
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM usuarios_admin WHERE usuario = :usuario LIMIT 1");
        $stmt->execute(['usuario' => $usuario]);
        return $stmt->fetch();
    }
}