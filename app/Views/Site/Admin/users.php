<?= $this->extend('templates/masterpage') ?>

<?= $this->section('content') ?>

<div class="page-title-box">
  <div class="container-fluid">
    <div class="row align-items-center">
      <div class="col-md-8">
        <h4 class="page-title mb-1">Tabela Usuarios</h4>
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
          <li class="breadcrumb-item active">Tabela Usuarios</li>
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
      <div class="col-12">
        <div class="card">
          <!-- Conteudo começa aqui -->
          <div class="card-body">
            <button type="button" class="btn btn-success waves-effect waves-light mb-3" data-bs-toggle="modal" data-bs-target="#modalCriarUsuario">Criar novo Usuario</button>
            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Usuario</th>
                  <th>E-mail</th>
                  <th>Ações</th>
                </tr>
              </thead>

              <tbody>
                <?php foreach ($users as $user): ?>
                  <tr>
                    <td><?= $user['usuario_nome'] ?></td>
                    <td><?= $user['usuario'] ?></td>
                    <td><?= $user['usuario_email'] ?></td>
                    <td>
                      <div class="d-flex">
                        <form action="<?= base_url('Admin/Usuario/Editar/' . $user['id_usuario']) ?>" method="get" class="me-1">
                          <button class="btn btn-sm btn-warning">Editar</button>
                        </form>
                        <button
                          type="button"
                          class="btn btn-sm btn-danger"
                          data-bs-toggle="modal"
                          data-bs-target="#deleteModal<?= $user['id_usuario'] ?>">
                          Deletar
                        </button>

                        <button
                          class="btn btn-sm btn-info btn-gerar-senha ml-1"
                          data-bs-toggle="modal"
                          data-bs-target="#newPasswordModal"
                          data-userid="<?= $user['id_usuario'] ?>">
                          Gerar Nova Senha
                        </button>

                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div> <!-- end col -->
    </div> <!-- end row -->
  </div>
  <!-- end container-fluid -->
</div>
<!-- end page-content-wrapper -->

<!-- Modal Criar Usuário -->
<div class="modal fade" id="modalCriarUsuario" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formCriarUsuario" method="post" action="<?= base_url('Admin/Usuarios/Criar') ?>">
        <div class="modal-header">
          <h5 class="modal-title">Criar Novo Usuário</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input class="form-control mb-2" placeholder="Nome Completo" required id="nomeCompleto" name="name">
          <input class="form-control mb-2" placeholder="Nome de Usuário" required id="nomeUsuario" name="user_name">
          <input class="form-control mb-2" placeholder="Email" type="email" required id="email" name="email">
          <div>
            <p class="mb-0">Nivel de Acesso:</p>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="level" id="radioLevel0" value="block" checked>
              <label class="form-check-label" for="radioLevel0">level 0 - Bloqueado</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="level" id="radioLevel1" value="free">
              <label class="form-check-label" for="radioLevel1">Level 1 - Livre</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="level" id="radioLevel2" value="admin">
              <label class="form-check-label" for="radioLevel2">Level 2 - Administrador</label>
            </div>
          </div>
          <input class="form-control form-control-sm mt-3" type="text" placeholder="Senha de primeiro acesso" aria-label=".form-control-sm example" name="password" required>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Criar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal único para nova senha -->
<div class="modal fade" id="newPasswordModal" tabindex="-1" aria-labelledby="novaSenhaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formNovaSenha" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="novaSenhaModalLabel">Nova senha</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <p>Senha gerada automaticamente, clicar para alterar</p>
          <input type="text" class="form-control" id="genPassword" name="newpassword" autocomplete="off">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </div>
    </form>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="deleteModal<?= $user['id_usuario'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $user['id_usuario'] ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel<?= $user['id_usuario'] ?>">Confirmar Exclusão</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja excluir este usuário? Essa ação não pode ser desfeita.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form action="<?= base_url('Admin/Usuario/Deletar/' . $user['id_usuario']) ?>" method="post" class="d-inline">
          <button type="submit" class="btn btn-danger">Sim, excluir</button>
        </form>
      </div>
    </div>
  </div>
</div>



<script>
  function genPassword(size = 8) {
    const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    let password = "";
    for (let i = 0; i < size; i++) {
      password += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return password;
  }

  var newPasswordModal = document.getElementById('newPasswordModal');
  var passwordInput = document.getElementById('genPassword');
  var formNovaSenha = document.getElementById('formNovaSenha');

  newPasswordModal.addEventListener('show.bs.modal', function(event) {
    // Botão que abriu o modal
    var button = event.relatedTarget;
    var userId = button.getAttribute('data-userid');

    // Atualiza a action do formulário usando base_url do PHP
    formNovaSenha.action = '<?= base_url("Admin/Usuario/NovaSenha/") ?>' + userId;

    // Gera uma nova senha e coloca no input
    passwordInput.value = genPassword(8);
  });
</script>




<?= $this->endSection() ?>