

<!doctype html>
<html lang="pt-BR">

<head>
    <title>INTEL EDUCA - Sistema de cursos gratuitos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Intel Educa" name="description">
    <meta content="CSI - CYBER LAB" name="author">
    <link rel="icon" href="<?= base_url('uploads/pictures/intel_educa_white.png') ?>" type="image/x-icon">

    <link href="<?= base_url('/assets/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/buttons.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/app.min.test.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/magnific-popup.css') ?>" rel="stylesheet" type="text/css">
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/Chart.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/ckeditor.js') ?>"></script>

    <!-- Sweet Alert-->
    <link href="<?= base_url('assets/css/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/cropper.min.css') ?>" rel="stylesheet" type="text/css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="<?= base_url('assets/css/alertify.min.css') ?>" rel="stylesheet" type="text/css">
    
    <!--<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>-->

    <script src="<?= base_url('assets/js/functions/mascaras.js')?>"></script>

</head>



<body data-topbar="colored">
    <!-- INICIO PAGE -->
    <div id="layout-wrapper">
        <!-- INICIO HEADER -->
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="<?= base_url('uploads/pictures/intel_educa_black.png') ?>" alt="" height="30">
                            </span>
                            <span class="logo-lg">
                                <img src="<?= base_url('uploads/pictures/intel_educa_black.png') ?>" alt="" height="100">
                            </span>
                        </a>

                        <a href="" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="<?= base_url('uploads/pictures/intel_educa_black.png') ?>" alt="" height="30">
                            </span>
                            <span class="logo-lg">
                                <img src="<?= base_url('assets/picture/intel_educa_black.png') ?>" alt="" height="45">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                        <i class="mdi mdi-backburger"></i>
                    </button>
                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ml-2">
                        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-search-dropdown">
                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-account-circle font-size-24 align-middle"></i>
                            <span class="d-none d-sm-inline-block ml-1"><?= session()->get('user.usuario') ?></span>
                            <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#changePasswordModal" class="dropdown-item" ><i class="mdi mdi-shield-sun font-size-16 align-middle mr-1"  ></i> Alterar Senha</a>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect text-danger" onclick="window.location.href='<?= base_url('Sair') ?>'">
                                <i class="mdi mdi-logout font-size-16 align-middle mr-1"></i>
                                Deslogar
                            </button>
                    </div>

                </div>
            </div>
        </header>
        <!-- FIM HEADER -->

        <!-- INICIO MENU -->
        <div class="vertical-menu">
            <div data-simplebar="" class="h-100">
                <div id="sidebar-menu">
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>
                        
                        <li class='nav-i    tem'>
                            <a href='/IntelCursos/public/Principal'' class='nav-link' target='_self'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                                    <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"/>
                                </svg>
                                <span> Pagina Inicial</span>
                            </a>
                            
                        </li>    
                            <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-mortarboard-fill" viewBox="0 0 16 16">
                                <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917z"/>
                                <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466z"/>
                            </svg>
                                    <span>Cursos</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <a href="<?= base_url('Cursos-Disponiveis') ?>" class="nav-link" target="_self">
                                            <span>Acessar todos os cursos</span>
                                        </a>
                                    </li>

                                    <li>
                                        <?php if (session()->get('user.level') === '2') : ?>
                                        <a href="<?= base_url('Admin/Cursos') ?>" class="nav-link" target="_self">
                                        
                                        <span>Admin Cursos</span>
                                        </a>
                                       <?php endif; ?>
                                    </li>
                            </ul>
                            </li>    

                            <?php if (session()->get('user.level') === '2') : ?>
                            <li>                   
                                <a href="<?= base_url('Admin/Usuarios') ?>" class="nav-link" target="_self">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-robot" viewBox="0 0 16 16">
                                    <path d="M6 12.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5M3 8.062C3 6.76 4.235 5.765 5.53 5.886a26.6 26.6 0 0 0 4.94 0C11.765 5.765 13 6.76 13 8.062v1.157a.93.93 0 0 1-.765.935c-.845.147-2.34.346-4.235.346s-3.39-.2-4.235-.346A.93.93 0 0 1 3 9.219zm4.542-.827a.25.25 0 0 0-.217.068l-.92.9a25 25 0 0 1-1.871-.183.25.25 0 0 0-.068.495c.55.076 1.232.149 2.02.193a.25.25 0 0 0 .189-.071l.754-.736.847 1.71a.25.25 0 0 0 .404.062l.932-.97a25 25 0 0 0 1.922-.188.25.25 0 0 0-.068-.495c-.538.074-1.207.145-1.98.189a.25.25 0 0 0-.166.076l-.754.785-.842-1.7a.25.25 0 0 0-.182-.135"/>
                                    <path d="M8.5 1.866a1 1 0 1 0-1 0V3h-2A4.5 4.5 0 0 0 1 7.5V8a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1v1a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-1a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1v-.5A4.5 4.5 0 0 0 10.5 3h-2zM14 7.5V13a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7.5A3.5 3.5 0 0 1 5.5 4h5A3.5 3.5 0 0 1 14 7.5"/>
                                </svg>
                                <span>Usuarios</span>
                            </a>
                            </li>
                            <?php endif; ?>
                        </li>
                    </ul>
                    <div class="col-md-12 text-center mt-5">
                        <img src="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
        <!-- FIM MENU -->

        <!-- INICIO MAIN -->
        <div class="main-content">                          
                                            
                    <!-- Start Page-content -->                            
                    <div class="page-content">
                            <!--INICIO RENDER CONTENT-->
                            <?= $this->renderSection('content') ?>
                            <!--FIM RENDER CONTENT-->
                    </div>
                    <!-- End Page-content -->

                    <!-- INICIO FOOTER -->
                            <footer class="footer">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <img src="<?= base_url('uploads/pictures/logo-csi.png') ?>" class="avatar-xs"> CSI - Centro de Segurança e Inteligência ©
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-sm-right d-none d-sm-block">
                                                INTEL EDUCA - Sistema de cursos gratuitos
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </footer>
                    <!-- FIM FOOTER -->
        </div>
            <!-- end main content-->

    

    <div class="rightbar-overlay"></div>

    <?php if ($alert = session()->getFlashdata('alert')): ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                alertify.<?= $alert['type'] ?>(<?= json_encode($alert['message']) ?>);
            });
        </script>
    <?php endif; ?>


    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="AlterarSenha/<?= session()->get('user.id') ?>" method="post" id="changePasswordForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changePasswordLabel">Alterar Senha</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="currentPassword" class="form-label">Senha Atual</label>
            <input type="password" class="form-control" id="currentPassword" name="oldpassword" required>
          </div>
          <div class="mb-3">
            <label for="newPassword" class="form-label">Nova senha</label>
            <input type="password" class="form-control" id="newPassword" name="newpassword" required>
          </div>
          <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirmar nova senha</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmnewpassword" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Alterar Senha</button>
        </div>
      </div>
    </form>
  </div>
</div>
    





    <!-- INICIO JAVASCRIPT -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js')?>"></script>
    <script src="<?= base_url('assets/js/metisMenu.min.js')?>"></script>
    <script src="<?= base_url('assets/js/simplebar.min.js')?>"></script>
    <script src="<?= base_url('assets/js/waves.min.js')?>"></script>
    <script src="<?= base_url('assets/js/bundle.js')?>"></script>

    <!-- Required datatable js -->
    <script src="<?= base_url('assets/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?= base_url('assets/js/dataTables.bootstrap4.min.js')?>"></script>
    <!-- Buttons examples -->
    <script src="<?= base_url('assets/js/dataTables.buttons.min.js')?>"></script>
    <script src="<?= base_url('assets/js/buttons.bootstrap4.min.js')?>"></script>
    <script src="<?= base_url('assets/js/jquery.magnific-popup.min.js')?>"></script>
    <script src="<?= base_url('assets/js/lightbox.init.js')?>"></script>
    <script src="<?= base_url('assets/js/sweetalert2.11.js')?>"></script>
    <script src="<?= base_url('assets/js/jquery.mask.min.js')?>"></script>
    <script src="<?= base_url('assets/js/functions.js')?>"></script>
    <script src="<?= base_url('assets/js/app.js')?>"></script>

    <script src="<?= base_url('assets/js/jszip.min.js')?>"></script>
    <!-- BOTAO PDF DATATABLE 
    <script src="https://themesdesign.in/xoric/layouts/blue/vertical/assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="https://themesdesign.in/xoric/layouts/blue/vertical/assets/libs/pdfmake/build/vfs_fonts.js"></script> -->
    <script src="<?= base_url('assets/js/buttons.html5.min.js')?>"></script>
    <script src="<?= base_url('assets/js/buttons.print.min.js')?>"></script>
    <script src="<?= base_url('assets/js/buttons.colVis.min.js')?>"></script>

    <!-- Responsive examples -->
    <script src="<?= base_url('assets/js/dataTables.responsive.min.js')?>"></script>
    <script src="<?= base_url('assets/js/responsive.bootstrap4.min.js')?>"></script>
    <!-- Datatable init js -->
    <script src="<?= base_url('assets/js/datatables.init.js')?>"></script>
    <!-- Sweet Alerts js -->
    <script src="<?= base_url('assets/js/sweetalert2.min.js')?>"></script>

    <!-- Sweet alert init js-->
    <script src="<?= base_url('assets/js/sweet-alerts.init.js')?>"></script>

    <!-- form mask -->
    <script src="<?= base_url('assets/js/jquery.inputmask.bundle.min.js')?>"></script>

    <!-- form mask init -->
    <script src="<?= base_url('assets/js/form-mask.init.js')?>"></script>

    <script src="<?= base_url('assets/js/cropper.js') ?>"></script>
    
    <!-- alertifyjs js -->
    <script src="<?= base_url('assets/js/alertify.min.js')?>"></script>

    <script src="<?= base_url('assets/js/alertifyjs.init.js')?>"></script>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>




</body>

</html>

</body>
