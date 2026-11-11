<?= $this->extend('templates/masterpage') ?>

<?= $this->section('content') ?>


<!-- Page-Title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">Aulas Disponiveis</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Principal</a></li>
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
                        <div class="row">
                            <div class="mb-3 text-center">
                                <h1 class=""><?= $title ?></h1>
                                <p class="text-muted fs-5 mt-3">
                                    <i class="bi bi-shield-lock"></i>
                                    <?= $desc_course ?>
                                </p>
                            </div>

                            <ul class="col list-inline gallery-categories-filter text-center" id="filter">
                                <li class="list-inline-item"><a class="categories active" data-filter="*">Todas as aulas</a></li>
                            </ul>
                        </div>

                        <!-- Gallary -->
                        <div class="container">
    <div class="row g-4">

        <?php foreach ($allClasses as $classes): ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                
                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <a href="<?= base_url('Curso/' . $classes['id_curso'] . '/Aula/' . $classes['id_aula']) ?>" 
                       class="text-decoration-none text-dark">

                        <div class="image-wrapper">
                            <img 
                                src="<?= base_url('uploads/curso-' . $classes['id_curso'] . '/aula-' . $classes['id_aula'] . '/' . $classes['aula_img']) ?>" 
                                class="card-img-top"
                                alt="<?= esc($classes['aula_descricao']) ?>">
                        </div>

                        <div class="card-body text-center">
                            <h5 class="card-title mb-0">
                                <?= esc($classes['aula_descricao']) ?>
                            </h5>
                        </div>

                    </a>

                </div>

            </div>
        <?php endforeach; ?>

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