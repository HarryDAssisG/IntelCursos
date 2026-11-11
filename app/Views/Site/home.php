<?= $this->extend('templates/masterpage') ?>

<?= $this->section('content') ?>
<!-- Page-Title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">Seja bem vindo</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Principal</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">/</a></li>
                    <li class="breadcrumb-item active">Pagina Inicial</li>
                </ol>
            </div>
            <div class="col-md-4">
                <div class="float-right d-none d-md-block">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card h-100 d-inline-block shadow">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="<?= base_url('uploads/pictures/imagem.png') ?>" alt="" class="img-fluid">
                                <p class="text-muted lead mb-4 mt-4">Essa é a sua área principal. Explore os cursos, aulas e recursos disponíveis.</p>

                                <a href="<?= base_url('Cursos-Disponiveis') ?>" class="btn btn-outline-dark active btn-lg">
                                    <i class="mdi mdi-book-open-variant mr-2"></i> Ver Cursos
                                </a>
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
<?= $this->endSection() ?>