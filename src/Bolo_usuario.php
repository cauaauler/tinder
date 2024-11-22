<?php

class Bolo_usuario implements ActiveRecord
{
    private int $id;

    public function __construct(
        private int $voto,
        private int $idUsuario,
        private int $idBolo
    ) {
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function getVoto(): int
    {
        return $this->voto;
    }

    public function setVoto(int $voto): void
    {
        $this->voto = $voto;
    }

    public function getIdUsuario(): int
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(int $idUsuario): void
    {
        $this->idUsuario = $idUsuario;
    }

    public function getIdBolo(): int
    {
        return $this->idBolo;
    }

    public function setIdBolo(int $idBolo): void
    {
        $this->idBolo = $idBolo;
    }

    public static function find($id): Bolo_usuario
    {
        $conexao = new MySQL();
        $sql = "SELECT * FROM bolo_usuario WHERE id = ?";
        $conexao->executa($sql, [$id]);
        $resultado = $conexao->consulta($sql);
        $p = new Bolo_usuario($resultado[0]['voto'], $resultado[0]['idUsuario'], $resultado[0]['idBolo']);
        $p->setId($resultado[0]['id']);
        return $p;
    }


    public static function findAll(): array
    {
        $conexao = new MySQL();
        $sql = "SELECT * FROM bolo_usuario";
        $resultados = $conexao->consulta($sql);
        $bolo_usuario = [];
        foreach ($resultados as $resultado) {
            $p = new Bolo_usuario($resultado['voto'], $resultado['idUsuario'], $resultado['idBolo']);
            $p->setId($resultado['id']);
            $bolo_usuario[] = $p;
        }
        return $bolo_usuario;
    }

    public function save(): bool
    {
        $conexao = new MySQL();
        if (isset($this->id)) {
            $sql = "UPDATE bolo_usuario SET voto = ?, idUsuario = ?, idBolo = ? WHERE id = ?";
            $conexao->executa($sql, [$this->voto, $this->idUsuario, $this->idBolo, $this->id]);
        } else {
            $sql = "INSERT INTO bolo_usuario (voto, idUsuario, idBolo) VALUES (?,?,?)";
            $conexao->executa($sql, [$this->voto, $this->idUsuario, $this->idBolo]);
        }
        return true;
    }

    public function delete(): bool
    {
        $conexao = new MySQL();
        $sql = "DELETE FROM bolo_usuario WHERE id = ?";
        return $conexao->executa($sql, [$this->id]);
    }


}
