<?= $this->extend('templates/masterpage') ?>

<?= $this->section('content') ?>


<!-- Page-Title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">Aulas Disponiveis</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">/</a></li>
                    <li class="breadcrumb-item active">Conteudo</li>
                </ol>
            </div>
        </div>

    </div>
</div>
<!-- end page title end breadcrumb -->


<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Título -->
                        <div class="mb-3 text-center">
                            <h1 class="fw-bold display-5"><?= $title ?></h1>
                        </div>

                        <div class="border p-3">
                            <form method="post" enctype="multipart/form-data" action="<?= base_url('Admin/Editar/Curso/' . $id_course . '/Aula/' . $id_class . '/EditarAula') ?>">
                                <div>
                                    <div class="d-flex justify-content-center">
                                        <h3>Editar Aula</h3>
                                    </div>
                                    <div class="mt-3 p-2">
                                        <div class="mb-3">
                                            <label for="editarDescricao" class="form-label">Titulo da Aula</label>
                                            <input type="text" class="form-control" name="desc_class" value="<?= esc($description) ?>">
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label for="img" class="form-label fw-semibold">Imagem de Capa</label>
                                            <div class="input-group">
                                                <input type="file" name="img" id="capa_curso" accept=".jpg,.jpeg,.png" class="form-control">
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalVisualizarCapa">Visualizar</button>
                                            </div>
                                        </div>

                                        <div class="mt-3">
                                            <label for="editarDescricao" class="form-label">Nomes dos videos no banco de dados </label>
                                            <div>
                                                <span>Video 1</span>
                                                <input type="text" class="form-control" name="video1" value="<?= $nome_video1 ?>" required>
                                            </div>
                                            <div class="mt-2">
                                                <span>Video 2 (Se existir)</span>
                                                <input type="text" class="form-control" name="video2"  value="<?= $nome_video2 ?>" required>
                                            </div>
                                        </div>

                                    </div>
                                    <div class=" p-2 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Botões de vídeo -->
                        <div class="text-center mb-4 mt-5">
                            <div class="btn-group" role="group" aria-label="Vídeos">
                                <?php foreach ($videos as $index => $video): ?>
                                    <button type="button"
                                        class="btn btn-outline-dark 
                                                    <?= $index === 0 ? 'active rounded-start' : '' ?> 
                                                    <?= $index === count($videos) - 1 ? 'rounded-end' : '' ?> 
                                                    px-4"
                                        onclick="trocarVideo('<?= base_url('uploads/curso-' . $id_course . '/aula-' . $id_class . '/' . $video['video']) ?>', this)">
                                        🎥 Vídeo <?= $index + 1 ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Vídeo local -->
                        <div class="mb-5 rounded-4 overflow-hidden  d-flex justify-content-center">
                            <video id="videoAula" controls style="width: 800px; height: 450px; border-radius: 1rem;">
                                <source src="<?= base_url('uploads/curso-' . $id_course . '/aula-' . $id_class . '/' . $videos[0]['video']) ?>" type="video/mp4">
                                Seu navegador não suporta vídeo HTML5.
                            </video>
                        </div>

                        <!-- Materiais -->
                        <div>
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h2 class="text-black">
                                        <i class="bi bi-journal-text me-2"></i>Materiais utilizados:
                                    </h2>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAdicionarMaterial">
                                        + Adicionar Material
                                    </button>
                                </div>
                                <ul class="list-group list-group-flush fs-5">
                                    <?php if (!empty($materials)): ?>
                                        <?php foreach ($materials as $material): ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <a href="<?= base_url('uploads/curso-' . $material['id_curso'] . '/aula-' . $material['id_aula'] . '/' . $material['material']) ?>" download class="text-decoration-none text-dark">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                        class="bi bi-download me-2" viewBox="0 0 16 16">
                                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                                                    </svg>
                                                    <?= $material['descricao_material'] ?>
                                                </a>

                                                <form action="<?= base_url('Admin/Editar/Curso/' . $material['id_curso'] . '/Aula/' . $material['id_aula'] . '/DeletarMaterial/' . $material['id_material']) ?>" method="post" onsubmit="return confirm('Tem certeza que deseja deletar este material?')">
                                                    <button type="submit" class="btn btn-sm btn-danger">Deletar</button>
                                                </form>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <li class="list-group-item text-muted text-center">
                                            Nenhum material disponível para esta aula.
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end page-content-wrapper -->
</div>


<!-- Modal para visualizar a capa -->
<div class="modal fade" id="modalVisualizarCapa" tabindex="-1" aria-labelledby="modalVisualizarCapaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVisualizarCapaLabel">Visualizar Imagem da Capa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body text-center">
                <img src="<?= base_url('uploads/curso-' . $id_course . '/aula-' . $id_class . '/' . esc($img) . '?' . time()) ?>" alt="Capa atual" class="img-fluid rounded shadow mt-2" style="max-height: 150px;">
            </div>
        </div>
    </div>
</div>


<!-- Modal Adicionar Material -->
<div class="modal fade" id="modalAdicionarMaterial" tabindex="-1" aria-labelledby="modalAdicionarMaterialLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" enctype="multipart/form-data" action="<?= base_url('/Admin/Editar/Curso/' . $id_course . '/Aula/' . $id_class . '/AdicionarMaterial') ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAdicionarMaterialLabel">Adicionar Material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="descricao_material" class="form-label">Material</label>
                        <input type="text" class="form-control" name="material" id="descricao_material" required>
                    </div>

                    <div class="mb-3">
                        <label for="descricao_material" class="form-label">Descrição</label>
                        <input type="text" class="form-control" name="desc" id="descricao_material" required>
                    </div>

                    <div class="mb-3">
                        <label for="materiais" class="form-label">Materiais</label>
                        <input type="file" name="doc" id="materiais" class="form-control">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar Material</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function trocarVideo(url, btn) {
        const video = document.getElementById('videoAula');
        video.querySelector('source').src = url;
        video.load(); // Atualiza o player com novo vídeo

        // Alterna botão ativo
        document.querySelectorAll('.btn-group .btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    }
</script>











<?= $this->endSection() ?>