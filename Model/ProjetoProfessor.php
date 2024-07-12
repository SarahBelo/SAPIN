<?php
class ModelProjetoProfessor {
    public $db = null;
    public $curso = null;
    public $eixo = null;
    public $turma = null;
    public $titulo = null;
    public $participantes = null;
    public $publico = null;
    public $introducao = null;
    public $id = null;

    public function __construct($conexaoBanco) {
        $this->db = $conexaoBanco;
    }

    public function listarIdProjeto() {
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $stmt = $this->db->prepare('SELECT * FROM projeto WHERE id = :id;');
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
            $retorno['dados'] = 'Erro ao buscar os dados deste projeto: ' . $ex->getMessage();
        }
        return $retorno;
    }

    public function editarProjeto() {
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $stmt = $this->db->prepare('
                UPDATE projeto 
                SET titulo = :titulo, introducao = :introducao, participantes = :participantes, publico = :publico, id_eixo = :eixo, id_curso = :curso, id_turma = :turma 
                WHERE id = :id;
            ');
            $stmt->bindValue(':eixo', $this->eixo);
            $stmt->bindValue(':curso', $this->curso);
            $stmt->bindValue(':turma', $this->turma);
            $stmt->bindValue(':titulo', $this->titulo);
            $stmt->bindValue(':participantes', $this->participantes);
            $stmt->bindValue(':publico', $this->publico);
            $stmt->bindValue(':introducao', $this->introducao);
            $stmt->bindValue(':id', $this->id);
            $stmt->execute();
            $retorno['status'] = 1;
            $retorno['dados'] = 'Projeto atualizado com sucesso';
        } catch (PDOException $ex) {
            $retorno['status'] = 0;
            $retorno['dados'] = 'Erro ao atualizar o projeto: ' . $ex->getMessage();
        }
        return $retorno;
    }

    public function listarTodos(){
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $stmt = $this->db->query('SELECT p.*, e.nome AS eixo, c.nome AS curso, t.nomenclatura AS turma 
                  FROM projeto p
                  LEFT JOIN eixo e ON p.id_eixo = e.id
                  LEFT JOIN curso c ON p.id_curso = c.id
                  LEFT JOIN turma t ON p.id_turma = t.id
                  WHERE status_projeto = 1;');
            $stmt->execute();
            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($dados) {
                $retorno['status'] = 1;
                $retorno['dados'] = $dados;
            } else {
                $retorno['status'] = 0;
                $retorno['dados'] = 'No data found';
            }
        } catch (PDOException $ex) {
            $retorno['status'] = 0;
            $retorno['dados'] = 'Erro ao buscar os dados deste projeto: ' . $ex->getMessage();
        }
        return $retorno;
    }

    public function listarProjetos(){
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $stmt = $this->db->prepare('SELECT p.*, e.nome AS eixo, c.nome AS curso, t.nomenclatura AS turma 
                  FROM projeto p
                  LEFT JOIN eixo e ON p.id_eixo = e.id
                  LEFT JOIN curso c ON p.id_curso = c.id
                  LEFT JOIN turma t ON p.id_turma = t.id
                  WHERE p.id = :id;');
            $stmt->bindValue(':id', $this->id);
            $stmt->execute();
            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($dados) {
                $retorno['status'] = 1;
                $retorno['dados'] = $dados;
            } else {
                $retorno['status'] = 0;
                $retorno['dados'] = 'No data found';
            }
        } catch (PDOException $ex) {
            $retorno['status'] = 0;
            $retorno['dados'] = 'Erro ao buscar os dados deste projeto: ' . $ex->getMessage();
        }
        return $retorno;
    }   
    public function visualizarProjetos() {
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $stmt = $this->db->prepare('SELECT p.*, e.nome AS eixo, c.nome AS curso, t.nomenclatura AS turma 
                                        FROM projeto p
                                        LEFT JOIN eixo e ON p.id_eixo = e.id
                                        LEFT JOIN curso c ON p.id_curso = c.id
                                        LEFT JOIN turma t ON p.id_turma = t.id
                                        WHERE p.id = :id');
            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $stmt->execute();
            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($dados) {
                $retorno['status'] = 1;
                $retorno['dados'] = $dados;
            } else {
                $retorno['status'] = 0;
                $retorno['dados'] = 'No data found';
            }
        } catch (PDOException $ex) {
            $retorno['status'] = 0;
            $retorno['dados'] = 'Erro ao buscar os dados deste projeto: ' . $ex->getMessage();
        }
        return $retorno;
    }
    
    
    
}
?>
