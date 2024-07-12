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
        
        <?php foreach ($projetos as $projeto): ?>
            <div class="card">
            <div class="titulo"><?php echo $projeto['titulo']; ?></div>
            <div class="participantes"><?php echo $projeto['participantes']; ?></div>
            <div class="palavrasChaves">
            <span class="corA">Eixo:</span><span class="palavrachave"><?php echo $projeto['eixo']; ?></span>
            <br>
            <span class="corA">Curso:</span><span class="palavrachave"><?php echo $projeto['curso']; ?></span>
            <br>
            <span class="corA">Turma:</span><span class="palavrachave"><?php echo $projeto['turma']; ?></span>
            </div>
            <div class="link">
                <a href=""><button>Arquivo</button></a>
                <a href=""><button>Saiba Mais</button></a>
            </div>
            </div>
            </div>
        <?php endforeach; ?>
        
<?php else: ?>
<p>Nenhum projeto encontrado.</p>
<?php endif; ?>
