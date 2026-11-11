<?php

namespace App\Controllers;

use App\Models\ModelCourses;
use App\Controllers\BaseController;
use App\Models\ModelClasses;
use CodeIgniter\HTTP\ResponseInterface;

class Courses extends BaseController
{

    protected $model_courses;
    protected $model_classes;

    public function __construct()
    {
        $this->model_courses   = new ModelCourses();
        $this->model_classes   = new ModelClasses();
    }

    public function view()
    {

        $all_courses = $this->model_courses->findAll();
        


        return view('/Site/Courses', [
            'all_courses' => $all_courses
        ]);
    }

    public function adminview()
    {

        $all_courses = $this->model_courses->findAll();



        return view('/Site/Admin/Courses', [
            'all_courses' => $all_courses
        ]);
    }

    public function createcourse()
    {
        $title = $this->request->getPost('title');
        $desc = $this->request->getPost('desc');
        $img   = $this->request->getFile('img');

        if ($img->isValid() && !$img->hasMoved()) {
            // Verifica se a extensão é permitida
            $extension = strtolower($img->getExtension());
            $extensionsAllowed = ['jpeg', 'jpg', 'png'];

            if (in_array($extension, $extensionsAllowed)) {

                // Enviar para DB

                $img_db = "curso." . $extension;

                $data = date('Y-m-d H:i:s');

                $database = [
                    'curso_nome' => $title,
                    'curso_descricao' => $desc,
                    'curso_img' => $img_db,
                    'data_criacao' => $data
                ];
                $id_course = $this->model_courses->insert($database, true);

                $add_folder_name = [
                    'curso_pasta' => "curso-" . $id_course
                ];

                $this->model_courses->update($id_course, $add_folder_name);


                // Cria a pasta "public/uploads/curso-<id>"
                $folder = 'uploads/curso-' . $id_course;
                $fullpath = ROOTPATH . 'public/' . $folder;

                if (!is_dir($fullpath)) {
                    mkdir($fullpath, 0755, true);
                }

                // Define nome do arquivo e move para dentro da pasta
                $nameImg = 'curso.' . $extension;
                $img->move($fullpath, $nameImg);

                return redirect()->to('Admin/Cursos')->with('success', 'Curso criado com sucesso!');
            } else {
                return redirect()->to('Admin/Cursos')->with('error', 'Extensão de imagem não permitida!');
            }
        }

        return redirect()->to('Admin/Cursos')->with('error', 'Erro no upload da imagem!');
    }

    public function editcourse($id_course)
    {
        $title = $this->request->getPost('title');
        $desc = $this->request->getPost('desc');
        $data = $this->request->getPost('data');
        $img = $this->request->getFile('img');

        $extension = null;

        // Verifica se a imagem foi enviada e é válida
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $extension = strtolower($img->getExtension());
            $extensionsAllowed = ['jpeg', 'jpg', 'png'];

            if (!in_array($extension, $extensionsAllowed)) {
                return redirect()->to('/Admin/Editar/Curso/' . $id_course)
                    ->with('error', 'Formato de imagem inválido. Use jpeg, jpg ou png.');
            }
        }

        $extensionSave = null;

        // Se houver imagem válida, salva no disco
        if ($extension) {
            $folder = 'uploads/curso-' . $id_course;
            $fullpath = ROOTPATH . 'public/' . $folder;

            if (!is_dir($fullpath)) {
                mkdir($fullpath, 0755, true);
            }

            // Apaga a imagem antiga se existir
            foreach (['jpeg', 'jpg', 'png'] as $ext) {
                $oldfile = $fullpath . '/curso.' . $ext;
                if (file_exists($oldfile)) {
                    unlink($oldfile);
                }
            }

            // Move a nova imagem
            $nameImg = 'curso.' . $extension;
            $img->move($fullpath, $nameImg);
            $extensionSave = $extension;
        }

        // Atualiza os dados no banco (com ou sem nova imagem)
        $dados = [
            'curso_nome' => $title,
            'curso_descricao' => $desc,
            'data_criacao' => $data,
        ];

        if (!empty($extensionSave)) {
            $dados['curso_img'] = 'curso.' . $extension;
        }

        // Aqui atualiza o banco
        $this->model_courses->update($id_course, $dados);

        return redirect()->to('/Admin/Editar/Curso/' . $id_course)
            ->with('success', 'Curso atualizado com sucesso!');
    }

    public function deletecourse($id_course)
    {

        $classes = $this->model_classes->where('id_curso', $id_course)->findAll();

        if (!empty($classes)) {
            foreach ($classes as $class) {
                $id_class = $class['id_aula'];


                ///
                $this->model_classes->delete($id_class);
                ///
            }
        }

        $folder = 'uploads/curso-' . $id_course;
        $fullpath = ROOTPATH . 'public/' . $folder;

        $course = $this->model_courses->where('id_curso', $id_course)->First();

        $name_course = $course['curso_img'];

        $Path_img = $fullpath . "/" . $name_course;

        if (is_file($Path_img)) {
            unlink($Path_img);
        }

        if (is_dir($fullpath)) {
            @rmdir($fullpath);
        }

        $this->model_courses->where('id_curso', $id_course)->delete();


        return redirect()->to('/Admin/Cursos')->with('success', 'Curso e arquivos deletados com sucesso!');
    }
}
