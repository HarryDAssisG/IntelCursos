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
                    <li class="breadcrumb-item active">Aulas</li>
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
                        <div class="row justify-content-center mb-5">
                            <div class="col-lg-8 col-md-10">
                                <h1 class="fw-bold mb-4">Editar Curso</h1>
                                <form action="<?= base_url('Admin/EditarCurso/' . $course['id_curso']) ?>" method="post" enctype="multipart/form-data">
                                    <!-- Título -->
                                    <div class="mb-3">
                                        <label for="titulo_curso" class="form-label fw-semibold">Título do Curso</label>
                                        <input type="text" name="title" id="titulo_curso" class="form-control" value="<?= esc($course['curso_nome'] ?? '') ?>" required>
                                    </div>

                                    <!-- Descrição -->
                                    <div class="mb-3">
                                        <label for="descricao_curso" class="form-label fw-semibold">Descrição</label>
                                        <textarea name="desc" id="descricao_curso" class="form-control" rows="3" required><?= esc($course['curso_descricao'] ?? '') ?></textarea>
                                    </div>

                                    <!-- Data -->
                                    <div class="mb-3">
                                        <label for="data_curso" class="form-label fw-semibold">Data - (Mês, Dia, Ano)</label>
                                        <input type="date" name="data" id="data_curso" class="form-control" value="<?= $course['data_criacao'] ?>" required>
                                    </div>

                                    <!-- Imagem de Capa -->
                                    <div class="mb-3 position-relative">
                                        <label for="img" class="form-label fw-semibold">Imagem de Capa</label>
                                        <div class="input-group">
                                            <input type="file" name="img" id="capa_curso" accept=".jpg,.jpeg,.png" class="form-control">
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalVisualizarCapa">Visualizar</button>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <div>
                                            <button type="submit" class="btn btn-primary px-4 py-2">Salvar Alterações</button>
                                        </div>
                                </form>
                                <button type="button" class="btn btn-danger px-4 py-2" data-bs-toggle="modal" data-bs-target="#modalConfirmarExclusao">Deletar Curso</button>
                            </div>
                        </div>

                        <!-- Criar Aula -->
                        <div class="row mt-3">
                            <ul class="col list-inline gallery-categories-filter text-center" id="filter">
                                <li class="list-inline-item">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCriarAula">Criar Aula</button>
                                </li>
                            </ul>
                        </div>

                        <!-- Gallery de Aulas -->
                        <div class="container">
                            <div class="row g-4 mt-2">

                                <?php if (empty($allClasses)): ?>
                                    <div class="col-12 text-center py-4 rounded-3">
                                        <strong>Nenhuma Aula Cadastrada</strong>
                                    </div>
                                <?php endif; ?>

                                <?php foreach ($allClasses as $class): ?>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 position-relative">

                                        <div class="card border-0 shadow-sm rounded-4 h-100">

                                            <a href="<?= base_url('Admin/Editar/Curso/' . $class['id_curso'] . '/Aula/' . $class['id_aula']) ?>"
                                                class="text-decoration-none text-dark">

                                                <div class="image-wrapper">
                                                    <img
                                                        src="<?= base_url(
                                                                    'uploads/curso-' . $class['id_curso'] .
                                                                        '/aula-' . $class['id_aula'] . '/' .
                                                                        esc($class['aula_img']) . '?' . time()
                                                                ) ?>"
                                                        class="card-img-top"
                                                        alt="<?= esc($class['aula_descricao']) ?>">
                                                </div>

                                                <div class="card-body text-center py-3">
                                                    <h5 class="mb-0">
                                                        <?= esc($class['aula_descricao']) ?>
                                                    </h5>
                                                </div>

                                            </a>

                                        </div>

                                        <!-- Botão Deletar Aula -->
                                        <button
                                            type="button" class="btn btn-danger btn-sm rounded-circle shadow position-absolute text-center" title="Deletar Aula"
                                            style="top: 12px; right: 12px;" data-bs-toggle="modal" data-bs-target="#confirmarDeleteModal<?= $class['id_aula'] ?>">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                                class="bi bi-trash text-center" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5z" />
                                                <path d="M8 5.5a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5z" />
                                                <path d="M10.5 5.5a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5z" />
                                                <path fill-rule="evenodd"
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2h3.1a1 1 0 0 1 .9-.6h2a1 1 0 0 1 .9.6h3.1a1 1 0 0 1 1 1z" />
                                            </svg>
                                        </button>

                                        <!-- Modal Deletar Aula -->
                                        <div class="modal fade" id="confirmarDeleteModal<?= $class['id_aula'] ?>" tabindex="-1"
                                            aria-labelledby="modalLabel<?= $class['id_aula'] ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content rounded-4">
                                                    <div class="modal-header bg-danger text-white rounded-top-4">
                                                        <h5 class="modal-title" id="modalLabel<?= $class['id_aula'] ?>">
                                                            Confirmar Exclusão
                                                        </h5>
                                                        <button type="button" class="btn-close btn-close-white"
                                                            data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        Tem certeza que deseja excluir a aula
                                                        <strong><?= esc($class['aula_descricao']) ?></strong>?
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <form action="<?= base_url(
                                                                            'Admin/Editar/Curso/' . $class['id_curso'] .
                                                                                '/Aula/' . $class['id_aula'] . '/DeletarAula'
                                                                        ) ?>" method="post">
                                                            <button type="submit" class="btn btn-danger">
                                                                Sim, excluir
                                                            </button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                Cancelar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>

                    </div>
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

<!-- Modal de confirmação -->
<div class="modal fade" id="modalConfirmarExclusao" tabindex="-1" aria-labelledby="modalConfirmarExclusaoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalConfirmarExclusaoLabel">Confirmar Exclusão</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja deletar este curso? Esta ação não pode ser desfeita.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                <form action="<?= base_url('Admin/DeletarCurso/' . $course['id_curso']) ?>" method="post">
                    <button type="submit" class="btn btn-danger">Sim, deletar</button>
                </form>
            </div>
        </div>
    </div>
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
                <img src="<?= base_url('uploads/curso-' . $course['id_curso'] . '/' . $course['curso_img']) . '?' . time() ?>" alt="Capa do Curso" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>

<!-- Modal Criar Aula -->
<div class="modal fade" id="modalCriarAula" tabindex="-1" aria-labelledby="modalCriarAulaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="modalCriarAulaLabel">Criar Nova Aula</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <form action="<?= base_url('Admin/Curso/' . $course['id_curso'] . '/CriarAula') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body px-4">
                    <!-- Descrição -->
                    <div class="mb-3">
                        <label for="descricao_aula" class="form-label">Descrição da Aula</label>
                        <textarea name="desc" id="descricao_aula" rows="4" class="form-control" required></textarea>
                    </div>

                    <!-- Capa -->
                    <div class="mb-3">
                        <label for="video1" class="form-label">Imagem de Capa da Aula</label>
                        <input type="file" name="img" id="capa_aula" class="form-control" accept=".jpg, .jpeg, .png" required>
                    </div>

                    <div class="mb-3">
                        <label for="video1" class="form-label">Nome Video 1</label>
                        <input type="text" name="video1" id="video1" class="form-control" placeholder="Não colocar extensão" required>
                    </div>

                    <div class="mb-3">
                        <label for="video2" class="form-label">Nome Video 2</label>
                        <input type="text" name="video2" id="video2" class="form-control" placeholder="Não colocar extensão" required>
                    </div>
                </div>

                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="submit" class="btn btn-success px-4">Salvar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .image-wrapper {
    width: 100%;
    height: 200px;
    overflow: hidden;
}

.image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
<?= $this->endSection() ?>