<?= $this->extend('templates/masterpage') ?>
<?= $this->section('content') ?>



<!-- Page-Title -->
                    <div class="page-title-box">
                        <div class="container-fluid">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h4 class="page-title mb-1">Editar Usuario</h4>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                    <li class="breadcrumb-item active">Editar</li>
                                    </ol>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end page title end breadcrumb -->

                    <div class="page-content-wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="" method="post">
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Nome</label>
                                                <div class="col-md-10">
                                                    <input class="form-control w-75" type="text" value="<?= $user['usuario_nome']?>" id="example-text-input" name="name" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="example-text-input " class="col-md-2 col-form-label">Usuario</label>
                                                <div class="col-md-10">
                                                    <input class="form-control w-75" type="text" value="<?= $user['usuario']?>" id="example-text-input" name="user" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="example-email-input" class="col-md-2 col-form-label">Email</label>
                                                <div class="col-md-10">
                                                    <input class="form-control w-75" type="email" value="<?= $user['usuario_email'] ?>" id="example-email-input" name="email" required>
                                                </div>
                                            </div>

                                            <div class="col-xl-4">
                                                <div class="mt-4 mt-sm-0">
                                                    <h5 class="card-header bg-transparent border-bottom mt-0">Nivel do Usuario</h5>
                                                    <div class="custom-control custom-radio mb-2 mt-2">
                                                        <input type="radio" id="customRadio1" name="level" class="custom-control-input" value="0" <?= $user['level'] == 0 ? 'checked' : '' ?>>
                                                        <label class="custom-control-label" for="customRadio1" >Nivel 0 - Bloqueado</label>
                                                    </div>
                                                    <div class="custom-control custom-radio mb-2">
                                                        <input type="radio" id="customRadio2" name="level" class="custom-control-input" value="1" <?= $user['level'] == 1 ? 'checked' : '' ?>>
                                                        <label class="custom-control-label" for="customRadio2">Nivel 1 - Livre</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="customRadio3" name="level" class="custom-control-input" value="2" <?= $user['level'] == 2 ? 'checked' : '' ?>>
                                                        <label class="custom-control-label" for="customRadio3">Nivel 2 - Admin</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-3 d-flex justify-content-center">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">Salvar</button>
                                            </form>
                                                <a href="<?= base_url('Admin/Usuarios') ?>" class="btn btn-danger waves-effect waves-light ml-3">
                                                    Cancelar
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
    <?= $this->endSection() ?>