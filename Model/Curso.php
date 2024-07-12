<?php

class ModelCurso
{
    public $db = null;
    public $curso = null;
    public $id_curso = null;
    public $eixo = null;
    public $id_eixo = null;
    public $status = null;
    public function __construct($conexaoBanco)
    {
        $this->db = $conexaoBanco;
    }

    public function carregarEixos()
    {
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $query = $this->db->query('SELECT * FROM eixo  where status_eixo = 1');
            $dados = $query->fetchAll();
            $retorno['status'] = 1;
            $retorno['dados'] = $dados;

        } catch (PDOException $e) {
            echo 'Erro ao carregar os eixos do banco de dados' . $e->getMessage();
        }
        return $retorno;
    }
    public function cadastrarCurso()
{
    $retorno = ['status' => 0, 'mensagem' => '', 'dados' => null];
    try {
        // Verifica se id_eixo foi passado corretamente
        if (empty($this->id_eixo) || $this->id_eixo == 'select') {
            $retorno['mensagem'] = 'Por favor, selecione um eixo.';
            return $retorno;
        }

        $stmt = $this->db->prepare('INSERT INTO curso (nome, id_eixo) VALUES (:nome, :id_eixo)');
        $stmt->bindValue(':nome', $this->curso);
        $stmt->bindValue(':id_eixo', $this->id_eixo);
        $stmt->execute();
        $dados = ['id' => $this->db->lastInsertId()];
        $retorno['status'] = 1;
        $retorno['dados'] = $dados;

    } catch (PDOException $e) {
        $retorno['mensagem'] = 'Erro ao cadastrar Curso: ' . $e->getMessage();
    }
    return $retorno;
}



    public function carregarCursos()
    {
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $query = $this->db->prepare('SELECT*FROM curso where id_eixo = :id_eixo');
            $query->bindValue(':id_eixo', $this->id_eixo);
            $query->execute();
            $dados = $query->fetchAll();
            $retorno['status'] = 1;
            $retorno['dados'] = $dados;
        } catch (PDOException $e) {
            echo 'Erro ao listar todos os cursos' . $e->getMessage();
        }
        return $retorno;
    }
    public function editarCurso()
    {
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $stmt = $this->db->prepare('UPDATE curso SET nome = (:nomecurso) WHERE id = (:id_curso)');
            $stmt->bindValue(':id_curso', $this->id_curso);
            $stmt->bindValue(':nomecurso', $this->curso);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                // Consulta novamente para obter os dados atualizados do curso
                $stmt = $this->db->prepare('SELECT * FROM curso WHERE id = (:id_curso)');
                $stmt->bindValue(':id_curso', $this->id_curso);
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
    public function statusCurso()
    {
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $stmt = $this->db->prepare('UPDATE curso SET status_curso = (:statusCurso) WHERE id = (:id)');
            $stmt->bindValue(':statusCurso', $this->status);
            $stmt->bindValue(':id', $this->id_curso);
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
}