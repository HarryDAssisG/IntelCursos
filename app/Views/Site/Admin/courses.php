<?= $this->extend('templates/masterpage') ?>
<?= $this->section('content') ?>

<!-- Page-Title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">Administrar Cursos</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">/</a></li>
                    <li class="breadcrumb-item active">Cursos</li>
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
                        <div class="row">
                            <ul class="col list-inline gallery-categories-filter text-center" id="filter">
                                <li class=""><button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modalCriarCurso">Adicionar Curso</button></li>
                            </ul>
                        </div>

                        <!-- Gallary -->
                        <div class="container">
                            <div class="row g-4">
                                <?php foreach ($all_courses as $course): ?>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <div class="card border-0 shadow-sm rounded-4 h-100">
                                            <a href="<?= base_url('Admin/Editar/Curso/' . $course['id_curso']) ?>" class="text-decoration-none text-dark">
                                                <div class="image-wrapper">
                                                    <img
                                                        src="<?= base_url('uploads/curso-' . $course['id_curso'] . '/' . esc($course['curso_img']) . '?' . time()) ?>"
                                                        class="card-img-top"
                                                        alt="<?= esc($course['curso_nome']) ?>">
                                                </div>
                                                <div class="card-body text-center">
                                                    <h5 class="card-title mb-1"><?= esc($course['curso_nome']) ?></h5>
                                                    <p class="text-muted small mb-0 text-center">
                                                        <?= date('d/m/Y', strtotime($course['data_criacao'])) ?>
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- 
                             <div class="col-xl-3 col-md-4 col-sm-6 ">
                                    <div class="border-0 rounded-4 hover-shadow mt-4 card">
                                        <a href="<?= base_url('Admin/Editar/Curso/' . $course['id_curso']) ?>" title="">
                                            <div class="border-0 shadow-sm rounded-4 transition overflow-hidden" style="height: 300px;">
                                                <img class="img-fluid" style="max-height: 200px;" src="<?= base_url('uploads/curso-' . $course['id_curso'] . '/' . esc($course['curso_img']) . '?' . time()) ?>" alt="1">
                                                <h5><?= esc($course['curso_nome']) ?></h5>
                                                <p class="mb-0"><?= date('d/m/Y', strtotime($course['data_criacao'])) ?></p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            -->
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

<!-- Modal Criar Curso -->
<div class="modal fade" id="modalCriarCurso" tabindex="-1" aria-labelledby="modalCriarCursoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="modalCriarCursoLabel">Criar Novo Curso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label for="curso_nome" class="form-label">Nome do Curso</label>
                        <input type="text" name="title" id="curso_nome" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="curso_descricao" class="form-label">Descrição</label>
                        <textarea name="desc" id="curso_descricao" rows="4" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="curso_img" class="form-label">Capa do Curso (Imagem)</label>
                        <input type="file" name="img" id="curso_img" class="form-control" accept="image/*" required>
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