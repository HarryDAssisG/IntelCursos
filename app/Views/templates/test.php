       <?php
            $alert = session()->getFlashdata('alert');
            if ($alert):
        ?>
        <script>
            alertify.<?= $alert['type'] ?>("<?= addslashes($alert['message']) ?>");
        </script>
        <?php endif; ?>


       $("#notify").click(function() {
         alertify.success("Olá, bem-vindo ao sistema!");
        );


        <div class="gallery-box mt-4">
            <a class="gallery-popup" href="/Curso/<?= $course['id_curso'] ?>" title="">
                <img class="gallery-demo-img img-fluid mx-auto" src="/uploads/curso-<?= $course['id_curso'] ?>/<?= esc($course['curso_img']) . '?' . time() ?> ?>" alt="1">
                <div class="gallery-overlay">
                    <div class="overlay-content">
                        <h5 class="overlay-title"><?= esc($course['curso_nome']) ?></h5>
                        <p class="text-uppercase mb-0"><?= date('d/m/Y', strtotime($course['data_criacao'])) ?></p>
                    </div>
                </div>
            </a>
        </div>