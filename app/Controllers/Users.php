<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUsers;
use CodeIgniter\HTTP\ResponseInterface;

class Users extends BaseController
{
    protected $model_users;

    public function __construct()
    {
        $this->model_users = new ModelUsers();
    }

    public function usersview()
    {

        $this->response->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate');
        $this->response->setHeader('Pragma', 'no-cache');
        $this->response->setHeader('Expires', '0');

        $users = $this->model_users->findAll(); // ou um getUsers() customizado



        return view('/Site/Admin/users', ['users' => $users]);
    }

    public function createuser()
    {
        // Captura os dados
        $name     = $this->request->getPost('name');
        $user     = $this->request->getPost('user_name');
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $levelsec   = $this->request->getPost('level');

        // Verifica se o nome de usuário já existe
        $existingUser = $this->model_users
            ->where('usuario', $user)
            ->first();

        if ($existingUser) {
            // Retorna com erro se já existir
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'O nome de usuário já está em uso. Escolha outro.');
        }

        $existingEmail = $this->model_users->where('usuario_email', $email)->first();

        if ($existingEmail) {
            return redirect()->back()->withInput()->with('error', 'O email já está em uso. Escolha outro.');
        }

        // Criptografa a senha
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);



        if ($levelsec == "block") {  // <-- aqui tem "block" (com k)
            $level = 0;
        } elseif ($levelsec == "free") {
            $level = 1;
        } elseif ($levelsec == "admin") {
            $level = 2;
        } else {
            $level = 0; // valor padrão
        }

        // Monta os dados
        $data = [
            'usuario_nome'   => $name,
            'usuario'        => $user,
            'usuario_email'  => $email,
            'senha'          => $hashedPassword,
            'level'          => $level
        ];

        // Insere no banco de dados
        $this->model_users->insert($data);

        $this->model_users->resetQuery(); // limpa cache interno do builder (caso use)

        return redirect()->to('/Admin/Usuarios');
    }

    public function deleteuser($id_user)
    {
        // Verifica se o usuário existe
        $user = $this->model_users->where('id_usuario', $id_user)->first();

        if ($user) {
            // Deleta o usuário
            $this->model_users->where('id_usuario', $id_user)->delete();

            return redirect()
                ->to('/Admin/Usuarios')
                ->with('success', 'Usuário deletado com sucesso!');
        } else {
            // Usuário não encontrado
            return redirect()
                ->to('/Admin/Usuarios')
                ->with('error', 'Usuário não encontrado!');
        }
    }

    public function edit($id_user)
    {
        $user = $this->model_users->where('id_usuario', $id_user)->first();
        return view('/Site/Admin/editUser', ['user' => $user]);
    }

    public function setedit($id_user)
    {
        $name  = $this->request->getPost('name');
        $user  = $this->request->getPost('user');
        $email = $this->request->getPost('email');
        $level = $this->request->getPost('level');


        if (empty($name) || empty($user) || empty($email) || $level === null || $level === '') {
            session()->setFlashdata('alert', [
                'type' => 'error',
                'message' => 'Campo vazio!'
            ]);
            return redirect()->to('/Admin/Usuario/Editar/' . $id_user);
        }

        // Verifica se o nome de usuário já existe
        $existingUser = $this->model_users
            ->where('usuario', $user)
            ->first();

        if ($existingUser && $existingUser['id_usuario'] != $id_user) {
            session()->setFlashdata('alert', [
                'type' => 'error',
                'message' => 'Esse usuario já está em uso!'
            ]);
            return redirect()->to('/Admin/Usuario/Editar/' . $id_user);
        }

        // Verifica se o e-mail já existe
        $existingEmail = $this->model_users
            ->where('usuario_email', $email)
            ->first();

        if ($existingEmail && $existingEmail['id_usuario'] != $id_user) {
            session()->setFlashdata('alert', [
                'type' => 'error',
                'message' => 'Esse email já está em uso!'
            ]);
            return redirect()->to('/Admin/Usuario/Editar/' . $id_user);
        }

        // Atualiza o usuário no banco de dados
        $this->model_users->update($id_user, [
            'usuario_nome'   => $name,
            'usuario'        => $user,
            'usuario_email'  => $email,
            'level'          => $level
        ]);

        // Redireciona com mensagem de sucesso
        session()->setFlashdata('alert', [
            'type' => 'success',
            'message' => 'Usuario editado com sucesso!'
        ]);
        return redirect()->to('/Admin/Usuarios');
    }

    public function newpassword($id_user)
    {
        $password = $this->request->getPost('newpassword');

        if (empty($password)) {
            return redirect()->to('/Admin/Usuarios');
        }

        $userExists = $this->model_users->find($id_user);

        if (!$userExists) {
            return redirect()->to('/Admin/Usuarios');
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $data = ['senha' => $hashedPassword];

        $this->model_users->update($id_user, $data);

        // Redireciona com mensagem de sucesso
        session()->setFlashdata('alert', [
            'type' => 'success',
            'message' => 'Nova senha criada!'
        ]);

        return redirect()->to('/Admin/Usuarios');
    }

    public function chargepassword($id_user)
    {
        $oldpassword = $this->request->getPost('oldpassword');
        $newpassword = $this->request->getPost('newpassword'); // Corrigido aqui
        $confirmnewpassword = $this->request->getPost('confirmnewpassword');

        if ($newpassword != $confirmnewpassword) {
            // Senhas novas não batem
            session()->setFlashdata('alert', [
                'type' => 'error',
                'message' => 'Senhas são diferentes.'
            ]);
            return redirect()->to('/Principal');
        }

        $user = $this->model_users->where('id_usuario', $id_user)->first();

        if (!$user) {
            // Usuário não encontrado
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'User not found.'
            ]);
            return redirect()->to('/Principal');
        }

        $hashedOldPassword = $user['senha'];

        if (password_verify($oldpassword, $hashedOldPassword)) {
            $hashedNewPassword = password_hash($newpassword, PASSWORD_DEFAULT);
            $data = ['senha' => $hashedNewPassword];

            $this->model_users->update($id_user, $data);

            // Define mensagem de sucesso na sessão
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Senha alterada com sucesso!'
            ]);

            return redirect()->to('/Principal');
        } else {
            // Senha antiga incorreta
            session()->setFlashdata('alert', [
                'type' => 'error',
                'message' => 'Senha incorreta.'
            ]);
            return redirect()->back();
        }
    }
}
