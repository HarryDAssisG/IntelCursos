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
                        <div class="mb-5 text-center">
                            <h1 class="fw-bold display-5"><?= $title ?></h1>
                            <p class="text-muted fs-5 mt-3">
                                <i class="bi bi-shield-lock"></i>
                                <?= $description ?>
                            </p>
                        </div>




                        <!-- Botões de vídeo -->
                        <div class="text-center mb-4">
                            <div class="btn-group" role="group" aria-label="Vídeos">
                                <?php foreach ($videos as $index => $video): ?>
                                    <button type="button"
                                        class="btn btn-outline-dark <?= $index === 0 ? 'active' : '' ?> <?= $index === 0 ? 'rounded-start' : '' ?> <?= $index === count($videos) - 1 ? 'rounded-end' : '' ?> px-4"
                                        onclick="trocarVideo('<?= base_url('uploads/curso-' . $id_course . '/aula-' . $id_classe . '/' . $video['video']) ?>', this)">
                                        🎥 Vídeo <?= $index + 1 ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Vídeo local -->
                        <div class="mb-5 rounded-4 overflow-hidden  d-flex justify-content-center">
                            <video id="videoAula" controls style="width: 800px; height: 450px; border-radius: 1rem;">
                                <source src="<?= base_url('uploads/curso-' . $id_course . '/aula-' . $id_classe . '/' . $videos[0]['video']) ?>" type="video/mp4">
                                Seu navegador não suporta vídeo HTML5.
                            </video>
                        </div>

                        <!-- Materiais -->
                        <div>
                            <h2 class="mb-4 text-black">
                                <i class="bi bi-journal-text me-2"></i>Materiais utilizados:
                            </h2>
                            <ul class="list-group list-group-flush fs-5">
                                <?php if (!empty($materials)): ?>
                                    <?php foreach ($materials as $materia): ?>
                                        <li class="list-group-item">
                                            <a href="<?= base_url('uploads/curso-' . $materia['id_curso'] . '/aula-' . $materia['id_aula'] . '/' . $materia['material']) ?>" download class="text-decoration-none text-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                    class="bi bi-download me-2" viewBox="0 0 16 16">
                                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                                                </svg>
                                                <i class="bi bi-file-earmark-text me-2 text-primary"></i><?= esc($materia['descricao_material']) ?>
                                            </a>
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