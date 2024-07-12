<?php

class ModelTurma{
    public $db = null;
    public $curso = null;
    public $id_curso = null;
    public $eixo = null;
    public $id_eixo = null;
    public $turma = null;
    public $id_turma = null;
    public $status = null;
    public function __construct($conexaoBanco)
    {
        $this->db = $conexaoBanco;
    }
    public function carregarEixos(){
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $stmt = $this->db->query('SELECT * FROM eixo where status_eixo = 1');
            $dados = $stmt->fetchAll();
            $retorno['status'] = 1;
            $retorno['dados'] = $dados;
        } catch (PDOException $e) {
            echo 'Erro ao carregar os eixos do banco de dados' . $e->getMessage();
        }
        return $retorno;
    }
    public function carregarCursos(){
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $stmt = $this->db->prepare('SELECT * FROM curso WHERE id_eixo = :id_eixo');
            $stmt->bindValue(':id_eixo', $this->id_eixo);
            $stmt->execute();
            $dados = $stmt->fetchAll();
            $retorno['status'] = 1;
            $retorno['dados'] = $dados;
        } catch (PDOException $e) {
            echo 'Erro ao listar listar os cursos' . $e->getMessage();
        }
        return $retorno;
    }
    public function cadastrarTurma(){
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $stmt = $this->db->prepare('INSERT INTO turma (nomenclatura, id_curso) VALUES (:nomenclatura, :id_curso)');
            $stmt->bindValue(':nomenclatura', $this->turma);
            $stmt->bindValue(':id_curso', $this->id_curso);
            $stmt->execute();
            $dados = ['id' => $this->db->lastInsertId()];
            $retorno['status'] = 1;
            $retorno['dados'] = $dados;

        } catch (PDOException $e) {
            echo 'Erro ao cadastrar turma' . $e->getMessage();
        }
        return $retorno;
    }
    public function carregarTurmas(){
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $query = $this->db->prepare('SELECT*FROM turma where id_curso = :id_curso');
            $query->bindValue(':id_curso', $this->id_curso);
            $query->execute();
            $dados = $query->fetchAll();
            $retorno['status'] = 1;
            $retorno['dados'] = $dados;
        } catch (PDOException $e) {
            echo 'Erro ao listar todos os cursos' . $e->getMessage();
        }
        return $retorno;
    }
    public function editarTurma(){
    $retorno = ['status' => 1, 'dados' => null];
    try {
        $stmt = $this->db->prepare('UPDATE turma SET nomenclatura = :nometurma WHERE id = :id_turma');
        $stmt->bindValue(':id_turma', $this->id_turma);
        $stmt->bindValue(':nometurma', $this->turma);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            // Consulta novamente para obter os dados atualizados da turma
            $stmt = $this->db->prepare('SELECT * FROM turma WHERE id = :id_turma');
            $stmt->bindValue(':id_turma', $this->id_turma);
            $stmt->execute();
            $dados = $stmt->fetch();

            $retorno['status'] = 1;
            $retorno['dados'] = $dados;
        } else {
            // Caso a edição não tenha sido bem-sucedida
            $retorno['status'] = 0;
        }
    } catch (PDOException $ex) {
        echo 'Erro ao editar: ' . $ex->getMessage();
    }
    return $retorno;
}

public function statusTurma() {
    $retorno = ['status' => 0, 'dados' => null];
    try {
        $stmt = $this->db->prepare('UPDATE turma SET status_turma = (:statusTurma) WHERE id = (:id_turma)');
        $stmt->bindValue(':statusTurma', $this->status);
        $stmt->bindValue(':id_turma', $this->id_turma);
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