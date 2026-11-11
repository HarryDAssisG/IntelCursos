    <!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesdesign" name="author">
        <link rel="icon" href="<?= base_url('uploads/pictures/intel_educa_white.png') ?>" type="image/x-icon">


        <!-- Bootstrap Css -->
        <link href="<?= base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="<?= base_url('assets/css/icons.min.css');?>" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="<?= base_url('assets/css/app.min.css');?>" rel="stylesheet" type="text/css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        
        <link href="<?= base_url('assets/css/alertify.min.css')?>" rel="stylesheet" type="text/css">

    </head>

    <body class="bg-black bg-pattern">
        
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <a class="logo"><img src="<?= base_url('uploads/pictures/intel_educa_white.png');?>" height="200" alt="logo"></a>
                            <h5 class="font-size-16 text-white-50"></h5>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center mt-0">
                    <div class="col-xl-5 col-sm-8">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="p-2">
                                    <h5 class="mb-5 text-center">Entre para acessar nossos cursos</h5>
                                    <form class="form-horizontal" action="Entrar" method="post">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-custom mb-4">
                                                    <input type="text" class="form-control" id="username" required="" name="username">
                                                    <label for="username">Usuario</label>
                                                </div>

                                                <div class="form-group form-group-custom mb-4">
                                                    <input type="password" class="form-control" id="userpassword" required="" name="userpassword">
                                                    <label for="userpassword">Senha</label>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customControlInline">
                                                            <label class="custom-control-label" for="customControlInline">Lembrar senha</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="text-md-right mt-3 mt-md-0">
                                                            <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock"></i> Esqueceu sua senha?</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <button class="btn btn-success btn-block waves-effect waves-light" type="submit">Entrar</button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end Account pages -->


        <?php if ($alert = session()->getFlashdata('alert')): ?>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    alertify.<?= $alert['type'] ?>(<?= json_encode($alert['message']) ?>);
                });
            </script>
        <?php endif; ?>


        <!-- JAVASCRIPT -->
             <!-- alertifyjs js -->
        <script src="<?= base_url('assets/js/alertify.min.js')?>"></script>
        <script src="<?= base_url('assets/js/alertifyjs.init.js')?>"></script>
        <script src="<?= base_url('assets/js/jquery.min.js')?>"></script>
        <script src="<?= base_url('assets/js/bootstrap.bundle.min.js')?>"></script>
        <script src="<?= base_url('assets/js/metisMenu.min.js')?>"></script>
        <script src="<?= base_url('assets/js/simplebar.min.js')?>"></script>
        <script src="<?= base_url('assets/js/waves.min.js')?>"></script>
        <script src="<?= base_url('assets/js/bundle.js')?>"></script>
        <script src="<?= base_url('assets/js/app.js')?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>
    </body>
</html>
