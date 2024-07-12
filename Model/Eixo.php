<?php

class ModelEixo
{
    public $db = null; // Conexão com o banco
    public $id_eixo = null;
    public $eixo = null;
    public $statusEixo = null;
    public function __construct($conexaoBanco)
    {
        $this->db = $conexaoBanco;
    }

    public function cadastrarEixo()
    {
        $retorno = ['status' => 0, 'mensagem' => '', 'dados' => null];
    try {
            $stmt = $this->db->prepare('INSERT INTO eixo (nome) VALUES (:eixo)');
            $stmt->bindValue(':eixo', $this->eixo);
            $stmt->execute();
        $dados = ['id' => $this->db->lastInsertId()];
        $retorno['status'] = 1;
        $retorno['dados'] = $dados;

    } catch (PDOException $e) {
        $retorno['mensagem'] = 'Erro ao cadastrar Curso: ' . $e->getMessage();
    }
    return $retorno;
}
    public function carregarEixos()
    {
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $query = $this->db->query('SELECT*FROM eixo');
            $dados = $query->fetchAll();
            $retorno['status'] = 1;
            $retorno['dados'] = $dados;
        } catch (PDOException $e) {
            echo 'Erro ao listar todos os usuarios' . $e->getMessage();
        }
        return $retorno;
    }
    public function editarEixos()
    {
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $stmt = $this->db->prepare('UPDATE eixo SET nome = :nome_eixo WHERE id = :id_eixo');
            $stmt->bindValue(':id_eixo', $this->id_eixo);
            $stmt->bindValue(':nome_eixo', $this->eixo);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                // Consulta novamente para obter os dados atualizados do eixo
                $stmt = $this->db->prepare('SELECT * FROM eixo WHERE id = (:id_eixo)');
                $stmt->bindValue(':id_eixo', $this->id_eixo);
                $stmt->execute();
                $dados = $stmt->fetchAll();

                $retorno['status'] = 1;
                $retorno['dados'] = $dados;
            } else {
                // Caso a edição não tenha sido bem-sucedida
                $retorno['status'] = 0;
            }
        } catch (PDOException $ex) {
            echo 'Erro ao editar' . $ex->getMessage();
        }
        return $retorno;
    }
    public function statusEixo()
    {
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $stmt = $this->db->prepare('UPDATE eixo SET status_eixo = (:statusEixo) WHERE id = (:id)');
            $stmt->bindValue(':statusEixo', $this->statusEixo, PDO::PARAM_INT);
            $stmt->bindValue(':id', $this->eixo_id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $retorno['status'] = 1;
                $retorno['dados'] = 'Status atualizado com sucesso';
            } else {
                $retorno['dados'] = 'Nenhuma linha foi atualizada';
            }
        } catch (PDOException $ex) {
            $retorno['dados'] = 'Erro: ' . $ex->getMessage();
        }
        return $retorno;
    }
    public function atualizarStatus()
    {
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $stmt = $this->db->prepare('UPDATE eixo SET status_eixo = :statusEixo WHERE id = :id');
            $stmt->bindValue(':statusEixo', $this->statusEixo);
            $stmt->bindValue(':id', $this->eixo_id);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $retorno['status'] = 1;
            } else {
                $retorno['status'] = 0;
            }
        } catch (PDOException $ex) {
            echo 'Erro ao atualizar status: ' . $ex->getMessage();
        }
        return $retorno;
    }
}

?>