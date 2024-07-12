<?php

class ModelPerfil{
    public $db = null;
    public $id = 0;
    public $nome = null;
    public $email = null;
    public $senha = null;
    public function __construct($conexaoBanco){
        $this->db = $conexaoBanco;
    }
    public function editarCoordenador() {
        $retorno = ['status' => 0, 'dados' => null];
        try {
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
public function editarProfessor(){
    $retorno = ['status' => 0, 'dados' => null];
    try{
        $stmt = $this->db->prepare('
        UPDATE professor
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
public function listarIdProfessor()
    {
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $stmt = $this->db->prepare('SELECT * FROM professor WHERE id = :id;');
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
}