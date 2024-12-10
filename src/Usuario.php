<?php

namespace Guy\Tinder;

class Usuario implements ActiveRecord {
    private int $id;

    public function __construct(
        private string $nome,
        private string $email,
        private string $senha
    ) {}

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function save(): bool {
        $conexao = new MySQL();
        $this->senha = password_hash($this->senha, PASSWORD_BCRYPT);

        if (isset($this->id)) {
            $sql = "UPDATE usuario SET email = ?, senha = ?, nome = ? WHERE idUsuario = ?";
            $params = [$this->email, $this->senha, $this->nome, $this->id];
        } else {
            $sql = "INSERT INTO usuario (email, senha, nome) VALUES (?, ?, ?)";
            $params = [$this->email, $this->senha, $this->nome];
        }

        return $conexao->executa($sql, $params);
    }

    public static function find($id): Usuario
    {
        $conexao = new MySQL();
        $sql = "SELECT * FROM usuario WHERE id = $id";
        $conexao->executa($sql);
        $resultado = $conexao->consulta($sql);
        $u = new Usuario($resultado[0]['nome'], $resultado[0]['email'], $resultado[0]['senha']);
        $u->setId($resultado[0]['id']);
        return $u;
    }

    public static function findAll(): array {
        $conexao = new MySQL();
        $sql = "SELECT * FROM usuario";
        $resultados = $conexao->consulta($sql);

        $usuarios = [];
        foreach ($resultados as $resultado) {
            $u = new Usuario($resultado['nome'], $resultado['email'], '');
            $u->setId($resultado['idUsuario']);
            $usuarios[] = $u;
        }
        return $usuarios;
    }

    public function delete(): bool {
        if (!isset($this->id)) {
            return false;
        }

        $conexao = new MySQL();
        $sql = "DELETE FROM usuario WHERE idUsuario = ?";
        return $conexao->executa($sql, [$this->id]);
    }

    public function authenticate(): bool {
        $conexao = new MySQL();
        $sql = "SELECT idUsuario, senha FROM usuario WHERE email = '$this->email'";
        $resultados = $conexao->consulta($sql);

        if (empty($resultados)) {
            return false;
        }

        if (password_verify($this->senha, $resultados[0]['senha'])) {
            session_start();
            $_SESSION['idUsuario'] = $resultados[0]['idUsuario'];
            return true;
        }

        return false;
    }
}
