<?php

class Bolo implements ActiveRecord{

    private int $id;
    
    public function __construct(private string $nome,private string $votos, private string $sabor, private string $descricao, private string $imagem){
    }

    public function setId(int $id):void{
        $this->id = $id;
    }

    public function getId():int{
        return $this->id;
    }

    public function setNome(string $nome):void{
        $this->nome = $nome;
    }
    public function getNome():string{
        return $this->nome;
    }

    public function setVotos(string $votos):void{
        $this->votos = $votos;
    }

    public function getVotos():string{
        return $this->votos;
    }
    public function setDescricao(string $descricao):void{
        $this->descricao = $descricao;
    }
    public function getDescricao():string{
        return $this->descricao;
    }
    public function setImagem(string $imagem):void{
        $this->imagem = $imagem;

    }
    public function getImagem():string{
        return $this->imagem;
    }


    public function save():bool{
        $conexao = new MySQL();
        if(isset($this->id)){
            $sql = "UPDATE bolo SET nome = '{$this->nome}', votos = '{$this->votos}', descricao = '{$this->descricao}',  WHERE id = {$this->id}";
        }else{
            $sql = "INSERT INTO bolo (nome,votos,idUsuario) VALUES ('{$this->nome}','{$this->votos}',{$this->idUsuario})";
        }
        return $conexao->executa($sql);
        
    }
    public function delete():bool{
        $conexao = new MySQL();
        $sql = "DELETE FROM bolo WHERE id = {$this->id}";
        return $conexao->executa($sql);
    }

    public static function find($id):Bolo{
        $conexao = new MySQL();
        $sql = "SELECT * FROM bolo WHERE id = {$id}";
        $resultado = $conexao->consulta($sql);
        $p = new Bolo($resultado[0]['nome'],$resultado[0]['votos']);
        $p->setIdUsuario($resultado[0]['idUsuario']);
        $p->setId($resultado[0]['id']);
        return $p;
    }
    public static function findall():array{
        $conexao = new MySQL();
        $sql = "SELECT * FROM bolo";
        $resultados = $conexao->consulta($sql);
        $bolo = array();
        foreach($resultados as $resultado){
            $p = new Bolo($resultado['nome'],$resultado['votos']);
            $p->setId($resultado['id']);
            $p->setIdUsuario($resultado['idUsuario']);
            $bolo[] = $p;
        }
        return $bolo;
    }

    public static function findallByUsuario($idUsuario):array{
        $conexao = new MySQL();
        $sql = "SELECT * FROM bolo WHERE idUsuario = {$idUsuario}";
        $resultados = $conexao->consulta($sql);
        $bolo = array();
        foreach($resultados as $resultado){
            $p = new Bolo($resultado['nome'],$resultado['votos']);
            $p->setId($resultado['id']);
            $p->setIdUsuario($resultado['idUsuario']);
            $bolo[] = $p;
        }
        return $bolo;
    }
    
}
