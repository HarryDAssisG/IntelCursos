<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelUsers;


class AcessSystem extends BaseController
{
    public function logout()
    {
        // Inicia a sessão (se ainda não estiver iniciada)
        $session = session();

        // Remove todos os dados da sessão
        $session->destroy();

        // Redireciona o usuário para a página de login (ou qualquer outra)
        return redirect()->to('/Entrar');
    }

    public function Login()
    {   

        return view('/Site/login');
    }

    public function setLogin()
    {   
        $model_users = new ModelUsers;

        $session = session();
        $username = $this->request->getPost('username');
        $userpassword = $this->request->getPost('userpassword');

        $user = $model_users->where('usuario', $username)->first();

        if ($user) {
            $password_db = $user['senha'];
            $level = $user['level'];


            if ($level >= 1) {
                if (password_verify($userpassword, $password_db)) {
                    $session->set('user', [
                        'id'    => $user['id_usuario'],
                        'nome'  => $user['usuario_nome'],
                        'usuario' => $user['usuario'],
                        'email' => $user['usuario_email'],
                        'logado' => true,
                        'level' => $user['level']
                    ]);

                    session()->setFlashdata('alert', [
                        'type' => 'success',
                        'message' => 'Logado!'
                    ]);

                    return redirect()->to(base_url('Principal'));
                } else {

                    session()->setFlashdata('alert', [
                        'type' => 'error',
                        'message' => 'Usuario ou senha incorretos!'
                    ]);

                    return redirect()->to(base_url('Entrar'));
                }
            } else {
                session()->setFlashdata('alert', [
                    'type' => 'error',
                    'message' => 'Usuario bloqueado! Entre em contato com o administrador'
                ]);

                return redirect()->to(base_url('Entrar'));
            }
        } else {

            session()->setFlashdata('alert', [
                'type' => 'error',
                'message' => 'Usuario não encontrado!'
            ]);

            return redirect()->to(base_url('Entrar'));
        }
    }
}
