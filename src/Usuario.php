<?php

class Usuario implements ActiveRecord{

    private int $id;
    
    public function __construct(
    private string $nome,
    private string $email,
    private string $senha
    ){
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

    public function setSenha(string $senha):void{
        $this->senha = $senha;
    }

    public function setEmail(string $email):void{
        $this->email = $email;
    }

    public function getSenha():string{
        return $this->senha;
    }

    public function getEmail():string{
        return $this->email;
    }

    public function save():bool{
        $conexao = new MySQL();
        $this->senha = password_hash($this->senha,PASSWORD_BCRYPT); 
        if(isset($this->id)){
            $sql = "UPDATE usuarios SET email = ?, senha = ?, nome = ? WHERE id = ?";
            $conexao->executa($sql,[$this->email,$this->senha,$this->nome,$this->id]);
        }else{
            $sql = "INSERT INTO usuarios (email, senha, nome) VALUES (?,?,?)";
            $conexao->executa($sql,[$this->email,$this->senha,$this->nome]);
        }
        return true;
    }

    public static function find($id):Usuario{
        $conexao = new MySQL();
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $conexao->executa($sql,[$id]);
        $resultado = $conexao->consulta($sql);
        $u = new Usuario($resultado[0]['nome'], $resultado[0]['email'], $resultado[0]['senha']);
        $u->setId($resultado[0]['id']);
        return $u;
    }

    public function delete():bool{
        $conexao = new MySQL();
        $sql = "DELETE FROM usuarios WHERE id = ?";
        return $conexao->executa($sql,[$this->id]);
    }

    public static function findAll():array{
        $conexao = new MySQL();
        $sql = "SELECT * FROM usuarios";
        $conexao->executa($sql);
        $resultados = $conexao->consulta($sql);
        $usuarios = array();
        foreach($resultados as $resultado){
            $u = new Usuario($resultado['nome'], $resultado['email'], $resultado['senha']);
            $u->setId($resultado['id']);
            $usuarios[] = $u;
        }
        return $usuarios;
    }

    public function authenticate():bool{
        $conexao = new MySQL();
        $sql = "SELECT id, senha FROM usuarios WHERE email = ?";
        $conexao->executa($sql,[$this->email]);
        $resultados = $conexao->consulta($sql);
        if(password_verify($this->senha,$resultados[0]['senha'])){
            session_start();
            $_SESSION['id'] = $resultados[0]['id'];
            $_SESSION['email'] = $resultados[0]['email'];
            return true;
        }else{
            return false;
        }
    }
}

