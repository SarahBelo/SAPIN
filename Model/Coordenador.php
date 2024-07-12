<?php

class ModelCoordenador{
    public $db = null;
    public $id = 0;
    public $nome = null;
    public $email = null;
    public $senha = null;
    public $statusCoordenador = null;
    public function __construct($conexaoBanco){
        $this->db = $conexaoBanco;
    }
    public function cadastroCoordenador(){
         $retorno = ['status' => 0, 'dados' => null];
        try{
            $stmt = $this->db->prepare('
            INSERT INTO coordenador(nome, email, senha)
            VALUES (:nome, :email, :senha);
            ');
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':senha', $this->senha);
            $stmt->execute();
            $retorno['status'] = 1;
        } catch (PDOException $ex){
            echo 'Erro ao cadastrar o Coordenador' .$ex->getMessage();
        }
        return $retorno;
    }
    public function listarCoordenador() {
        $retorno = ['status' => 0, 'dados' => null];
        try{
            $query = $this->db->query('SELECT * FROM coordenador;');
            $dados = $query->fetchALL();
            $retorno['status'] = 1;
            $retorno['dados'] = $dados;
    }
    catch (PDOException $ex) {
        echo 'Erro ao listar todos os usuarios' .$ex->getMessage();
    }
    return $retorno;
    }

    public function editarCoordenador(){
        $retorno = ['status' => 0, 'dados' => null];
        try{
            $stmt = $this->db->prepare('
            UPDATE coordenador 
            SET nome = :nome, email = :email, senha = :senha
            WHERE id = :id;
            ');
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':senha', $this->senha);
            $stmt->bindValue(':id', $this->id);
            $stmt->execute();
            $retorno['status'] = 1;
            $retorno['dados'] = 'User updated successfully';
        } catch (PDOException $ex) {
            $retorno['status'] = 0;
            $retorno['dados'] = 'Erro ao atualizar usuário: ' . $ex->getMessage();
        }
        return $retorno;
    }

        public function listarIDCoordenador()
{
    $retorno = ['status' => 0, 'dados' => null];
    try {
        $stmt = $this->db->prepare('SELECT * FROM coordenador WHERE id = :id');
        $stmt->bindValue(':id', $this->id);
        $stmt->execute();
        $dados = $stmt->fetchAll();
        if ($dados) {
            $retorno['status'] = 1;
            $retorno['dados'] = $dados;
        } else {
            $retorno['status'] = 0;
            $retorno['dados'] = 'No data found';
        }
    } catch (PDOException $ex) {
        $retorno['status'] = 0;
        $retorno['dados'] = 'Erro ao buscar os dados deste usuário: ' . $ex->getMessage();
    }
    return $retorno;
}

    public function statusCoordenador()
    {
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $stmt = $this->db->prepare('UPDATE coordenador 
            SET status_coordenador = :statusCoordenador
            WHERE id = :id;');

            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindValue(':statusCoordenador', $this->statusCoordenador, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt-> rowCount() > 0){
                $retorno['status'] = 1;
                $retorno['dados'] = 'Status Atualizado';
            } else{
                $retorno['dados'] = 'Erro de atualização';
            }
    } catch (PDOException $ex){
        $retorno['dados'] = 'Erro ao atualizar os dados deste usuário: ' . $ex->getMessage();
    }
    return $retorno;
    }
    public function logar() {
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $stmt = $this->db->prepare('
            select id, email, senha FROM coordenador WHERE email = :email and senha = :senha and status_coordenador = 1;
            ');
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':senha', $this->senha);
            $stmt->execute();
            $dado = $stmt->fetch();
            if ($dado && $dado['id'] && $dado['id'] > 0) {
                $retorno['status'] = 1;
                $retorno['dados'] = $dado;
            }
        } catch (PDOException $ex) {
            echo 'Erro ao logar: ' . $ex->getMessage();
        }
        return $retorno;
    }
    
    
}