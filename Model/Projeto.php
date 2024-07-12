<?php
class ModelProjeto {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function obterProjetos($filtros) {
        $query = "SELECT p.*, e.nome AS eixo, c.nome AS curso, t.nomenclatura AS turma 
                  FROM projeto p
                  LEFT JOIN eixo e ON p.id_eixo = e.id
                  LEFT JOIN curso c ON p.id_curso = c.id
                  LEFT JOIN turma t ON p.id_turma = t.id
                  WHERE 1=1";

        if (!empty($filtros['eixo'])) {
            $query .= " AND p.id_eixo = " . intval($filtros['eixo']);
        }
        if (!empty($filtros['curso'])) {
            $query .= " AND p.id_curso = " . intval($filtros['curso']);
        }
        if (!empty($filtros['turma'])) {
            $query .= " AND p.id_turma = " . intval($filtros['turma']);
        }
        if (!is_null($filtros['status'])) {
            $query .= " AND p.status_projeto = " . intval($filtros['status']);
        }

        $result = $this->conn->query($query);
        $projetos = [];
        while ($row = $result->fetch_assoc()) {
            $projetos[] = $row;
        }
        return $projetos;
    }

    public function alterarStatusProjeto($id, $status) {
        $query = "UPDATE projeto SET status_projeto = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ii', $status, $id);
        return $stmt->execute();
    }
}
