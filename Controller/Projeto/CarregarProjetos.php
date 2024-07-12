<?php
include '../../Configuracao/ConexaoProjeto.php';
include '../../Model/Projeto.php';

$modelo = new ModelProjeto($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acao'])) {
    if ($_POST['acao'] == 'alterarStatus') {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $resultado = $modelo->alterarStatusProjeto($id, $status);
        echo $resultado ? 'sucesso' : 'erro';
    }
    exit;
}

$filtros = [
    'eixo' => isset($_GET['eixo']) && $_GET['eixo'] !== '' ? $_GET['eixo'] : null,
    'curso' => isset($_GET['curso']) && $_GET['curso'] !== '' ? $_GET['curso'] : null,
    'turma' => isset($_GET['turma']) && $_GET['turma'] !== '' ? $_GET['turma'] : null,
    'status' => isset($_GET['status']) && $_GET['status'] !== '' && $_GET['status'] !== 'todos' ? intval($_GET['status']) : null
];

$projetos = $modelo->obterProjetos($filtros);

if (!empty($projetos)): ?>
<table class="consulta" style="border-radius: 15px;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Participantes</th>
            <th>Introdução</th>
            <th>Público</th>
            <th>Eixo</th>
            <th>Curso</th>
            <th>Turma</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($projetos as $projeto): ?>
            <tr>
                <td><?php echo $projeto['id']; ?></td>
                <td><?php echo $projeto['titulo']; ?></td>
                <td><?php echo $projeto['participantes']; ?></td>
                <td><?php echo $projeto['introducao']; ?></td>
                <td><?php echo $projeto['publico']; ?></td>
                <td><?php echo $projeto['eixo']; ?></td>
                <td><?php echo $projeto['curso']; ?></td>
                <td><?php echo $projeto['turma']; ?></td>
                <td><?php echo $projeto['status_projeto'] ? 'Ativado' : 'Desativado'; ?></td>
                <td>
                    <button class="btn btn-sm btn-toggle-status" data-id="<?php echo $projeto['id']; ?>" data-status="<?php echo $projeto['status_projeto']; ?>">
                        <?php echo $projeto['status_projeto'] ? 'Desativar' : 'Ativar'; ?>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p>Nenhum projeto encontrado.</p>
<?php endif; ?>
