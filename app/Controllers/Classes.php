<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelClasses;
use App\Models\ModelCourses;
use App\Models\ModelVideos;
use App\Models\ModelMaterials;

class Classes extends BaseController
{
    protected $model_courses;
    protected $model_classes;
    protected $model_materials;
    protected $model_videos;

    public function __construct()
    {
        $this->model_courses   = new ModelCourses();
        $this->model_classes   = new ModelClasses();
        $this->model_materials = new ModelMaterials();
        $this->model_videos    = new ModelVideos();
    }

    public function viewAllClasses($id_course)
    {
        $all_classes = $this->model_classes->where('id_curso', $id_course)->findAll();
        $course      = $this->model_courses->where('id_curso', $id_course)->first();
        $desc_course = $course['curso_descricao'] ?? '';
        $title_course = $course['curso_nome'];

        return view('/Site/classes', [
            'allClasses'  => $all_classes,
            'desc_course' => $desc_course,
            'title' => $title_course
        ]);
    }

    public function adminViewAllClasses($id_course)
    {
        $classes = $this->model_classes->where('id_curso', $id_course)->findAll();
        $course  = $this->model_courses->where('id_curso', $id_course)->first();

        return view('/Site/Admin/classes', [
            'allClasses' => $classes,
            'course'  => $course
        ]);
    }

    public function viewContent($id_course, $id_classe)
    {
        $course = $this->model_courses->where('id_curso', $id_course)->first();
        $title  = $course['curso_nome'] ?? '';

        $videos = $this->model_videos->where([
            'id_curso' => $id_course,
            'id_aula'  => $id_classe
        ])->findAll();

        $classe = $this->model_classes->where([
            'id_curso' => $id_course,
            'id_aula'  => $id_classe
        ])->first();

        $description = $classe['aula_descricao'] ?? '';

        $materials = $this->model_materials->where([
            'id_curso' => $id_course,
            'id_aula'  => $id_classe
        ])->findAll();

        return view('/Site/content', [
            'title'       => $title,
            'description' => $description,
            'videos'      => $videos,
            'materials'   => $materials,
            'id_course'   => $id_course,
            'id_classe'   => $id_classe
        ]);
    }

    public function adminContent($id_course, $id_class)
    {
        $course = $this->model_courses->where('id_curso', $id_course)->first();

        $class = $this->model_classes->where([
            'id_curso' => $id_course,
            'id_aula'  => $id_class
        ])->first();

        if (!$class) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Aula não encontrada.");
        }

        $title = $course['curso_nome'];
        $description = $class['aula_descricao'];
        $img = $class['aula_img'];

        $videos = $this->model_videos->where([
            'id_curso' => $id_course,
            'id_aula'  => $id_class
        ])->findAll();

        // Verifica se existem vídeos antes de acessar
        $nome_video1 = isset($videos[0]) ? pathinfo($videos[0]['video'], PATHINFO_FILENAME) : null;
        $nome_video2 = isset($videos[1]) ? pathinfo($videos[1]['video'], PATHINFO_FILENAME) : null;


        $materials = $this->model_materials->where([
                'id_curso' => $id_course,
                'id_aula'  => $id_class
            ])->findAll();



        return view('/Site/Admin/content', [
            'title'       => $title,
            'description' => $description,
            'videos'      => $videos,
            'materials'   => $materials,
            'id_course'   => $id_course,
            'id_class'    => $id_class,
            'img'         => $img,
            'nome_video1' => $nome_video1,
            'nome_video2' => $nome_video2
        ]);
    }

    // FUNCTIONS
    public function createclass($id_course)
    {
        $desc = $this->request->getPost('desc');

        // Verifica se foi enviado um arquivo
        $img = $this->request->getFile('img');

        if (!$img->isValid()) {
            return redirect()->to('/Admin/Curso/' . $id_course)->with('error', 'Imagem inválida ou não enviada.');
        }

        $extension = strtolower($img->getExtension());
        $extensionsAllowed = ['jpg', 'jpeg', 'png'];

        if (!in_array($extension, $extensionsAllowed)) {
            return redirect()->to('/Admin/Curso/' . $id_course)->with('error', 'Formato de imagem inválido.');
        }

        $name_img = 'aula.' . $extension;

        // Cria aula no banco de dados
        $base = [
            'id_curso' => $id_course,
            'aula_descricao' => $desc,
            'aula_img' => $name_img,
        ];

        $id_class = $this->model_classes->insert($base, true);

        // Atualiza com o nome da pasta
        $base_update = [
            'aula_pasta' => "aula-" . $id_class,
        ];
        $this->model_classes->update($id_class, $base_update);

        // Diretório da aula
        $folder = 'uploads/curso-' . $id_course . '/aula-' . $id_class;
        $fullpath = ROOTPATH . 'public/' . $folder;

        // Cria diretório se não existir
        if (!is_dir($fullpath)) {
            mkdir($fullpath, 0755, true);
        }

        // Move imagem para o diretório
        $img->move($fullpath, $name_img);


        // VIDEO 1
        $video1_title = str_replace(' ', '', $this->request->getPost('video1')) . ".mp4"; 
        $base_v1 = [
            'video' => $video1_title,
            'id_aula' => $id_class,
            'id_curso' => $id_course,
            'numero_video' => "1"
        ];
        $this->model_videos->insert($base_v1);

        // VIDEO 2
        $video2_title = str_replace(' ', '', $this->request->getPost('video2')) . ".mp4"; 
        $base_v2 = [
            'video' => $video2_title,
            'id_aula' => $id_class,
            'id_curso' => $id_course,
            'numero_video' => "2"
        ];
        $this->model_videos->insert($base_v2);

        session()->setFlashdata('alert', [
            'type' => 'success',
            'message' => 'Aula criada com sucesso!'
        ]);

        return redirect()->to('/Admin/Editar/Curso/' . $id_course);
    }

    public function editclass($id_course, $id_class)
    {
        // 1. ATUALIZA DESCRIÇÃO
        $desc_class = $this->request->getPost('desc_class');

        if (!empty($desc_class)) {
            $this->model_classes
                ->where(['id_curso' => $id_course, 'id_aula' => $id_class])
                ->set(['aula_descricao' => $desc_class])
                ->update();
        }



        $video1Nome = str_replace(' ', '', $this->request->getPost('video1')) . ".mp4"; 
        $video2Nome = str_replace(' ', '', $this->request->getPost('video2')) . ".mp4";

                // Atualiza vídeo 1
                $this->model_videos
                    ->where('id_curso', $id_course)
                    ->where('id_aula', $id_class)
                    ->where('numero_video', 1)
                    ->set(['video' => $video1Nome])
                    ->update();

                // Atualiza vídeo 2
                $this->model_videos
                    ->where('id_curso', $id_course)
                    ->where('id_aula', $id_class)
                    ->where('numero_video', 2)
                    ->set(['video' => $video2Nome])
                    ->update();

        // Define mensagem de sucesso na sessão
        session()->setFlashdata('alert', [
            'type' => 'success',
            'message' => 'Aula editada com sucesso!'
        ]);

        // 2. ATUALIZA IMAGEM
        $img = $this->request->getFile('img');

        if ($img && $img->isValid() && !$img->hasMoved()) {
            $extension = strtolower($img->getExtension());
            $extensionsAllowed = ['jpeg', 'jpg', 'png'];

            if (in_array($extension, $extensionsAllowed)) {
                $nameImg = "aula." . $extension;

                // Busca a aula para obter nome da imagem antiga
                $class = $this->model_classes
                    ->where('id_curso', $id_course)
                    ->where('id_aula', $id_class)
                    ->first();

                $folder = 'uploads/curso-' . $id_course . '/aula-' . $id_class;
                $fullpath = ROOTPATH . 'public/' . $folder;

                if (!is_dir($fullpath)) {
                    mkdir($fullpath, 0777, true);
                }

                // remove antiga
                if (!empty($class['aula_img'])) {
                    $oldPathImg = $fullpath . '/' . $class['aula_img'];
                    if (file_exists($oldPathImg)) {
                        unlink($oldPathImg);
                    }
                }

                // atualiza no banco
                $this->model_classes
                    ->where(['id_curso' => $id_course, 'id_aula' => $id_class])
                    ->set(['aula_img' => $nameImg])
                    ->update();

                $img->move($fullpath, $nameImg);


                return redirect()->to('/Admin/Editar/Curso/' . $id_course . "/Aula/" . $id_class);
            } else {

                return redirect()->back();
            }
        }

        // Se não enviou imagem mas atualizou descrição
        return redirect()->to('/Admin/Editar/Curso/' . $id_course . "/Aula/" . $id_class)
            ->with('success', 'Aula atualizada com sucesso.');
    }

    public function addMaterials($id_course, $id_class)
    {
        $materialBaseName = $this->request->getPost('material');
        $materialBaseName = str_replace(' ', '', $materialBaseName); // remove espaços
        $desc = $this->request->getPost('desc');
        $doc = $this->request->getFile('doc');

        // Verificações de validade
        if (!$doc || !$doc->isValid()) {
            return redirect()
                ->to('/Admin/Editar/Curso/' . $id_course . "/Aula/" . $id_class)
                ->with('error', 'Arquivo inválido ou não recebido!');
        }

        $extension = strtolower($doc->getExtension());
        $allowed = ['pdf', 'doc', 'docx', 'txt', 'zip'];

        if (!in_array($extension, $allowed)) {
            return redirect()
                ->to('/Admin/Editar/Curso/' . $id_course . "/Aula/" . $id_class)
                ->with('error', 'Extensão de arquivo não permitida!');
        }

        // Gera nome final do arquivo com extensão
        $filename = $materialBaseName . '.' . $extension;

        // Caminho para salvar
        $folder = 'uploads/curso-' . $id_course . '/aula-' . $id_class;
        $fullpath = ROOTPATH . 'public/' . $folder;

        // Cria a pasta se não existir
        if (!is_dir($fullpath)) {
            mkdir($fullpath, 0777, true);
        }

        // Move o arquivo
        if (!$doc->hasMoved()) {
            if (!$doc->move($fullpath, $filename)) {
                return redirect()
                    ->to('/Admin/Editar/Curso/' . $id_course . "/Aula/" . $id_class)
                    ->with('error', 'Erro ao salvar o arquivo.');
            }
        }

        // Só insere no banco depois do sucesso no move
        $this->model_materials->insert([
            'material'            => $filename,
            'descricao_material'  => $desc,
            'id_aula'             => $id_class,
            'id_curso'            => $id_course
        ]);
        // Define mensagem de sucesso na sessão
        session()->setFlashdata('alert', [
            'type' => 'success',
            'message' => 'Material criado com sucesso!'
        ]);



        return redirect()
            ->to('/Admin/Editar/Curso/' . $id_course . "/Aula/" . $id_class);
    }

    public function deleteMaterials($id_course, $id_class, $id_material)
    {
        // Busca o material correto
        $material = $this->model_materials->where([
            'id_curso'     => $id_course,
            'id_aula'      => $id_class,
            'id_material'  => $id_material
        ])->first();

        if (!$material) {
            return redirect()->back()->with('error', 'Material não encontrado.');
        }

        // Caminho completo do arquivo
        $fullpath = FCPATH . 'uploads/curso-' . $id_course . '/aula-' . $id_class . '/' . $material['material'];

        // Tenta excluir o arquivo, se existir
        if (file_exists($fullpath)) {
            if (!unlink($fullpath)) {
                return redirect()->back()->with('error', 'Erro ao excluir o arquivo.');
            }
        }

        // Remove do banco
        $this->model_materials->delete($id_material);

        session()->setFlashdata('alert', [
            'type' => 'success',
            'message' => 'Material deletado com sucesso!'
        ]);

        return redirect()->back()->with('success', 'Material deletado com sucesso!');
    }

    public function deleteClass($id_course, $id_class)
    {

        $folder = 'uploads/curso-' . $id_course . '/aula-' . $id_class;
        $fullpath = ROOTPATH . 'public/' . $folder;

        // Videos
        $videos = $this->model_videos->where('id_curso', $id_course)->where('id_aula', $id_class)->findAll();
        foreach ($videos as $video) {
            $name_video = $video['video'];
            $fullpathVideo = $fullpath . '/' . $name_video;

            if (is_file($fullpathVideo)) {
                unlink($fullpathVideo);
            }

            $this->model_videos->where('id_curso', $id_course)
                ->where('id_aula', $id_class)
                ->where('video', $name_video)
                ->delete();
        }

        // Materiais
        $materials = $this->model_materials->where('id_curso', $id_course)->where('id_aula', $id_class)->findAll();
        foreach ($materials as $material) {
            $name_material = $material['material'];
            $fullpathMaterials = $fullpath . '/' . $name_material;

            if (is_file($fullpathMaterials)) {
                unlink($fullpathMaterials);
            }

            $this->model_materials->where('id_curso', $id_course)
                ->where('id_aula', $id_class)
                ->where('material', $name_material)
                ->delete();
        }

        // Aula
        $class = $this->model_classes->where('id_curso', $id_course)->where('id_aula', $id_class)->first();
        if (!empty($class)) {

            $img_class = $class['aula_img'];

            $fullpathImg = $fullpath . '/' . $img_class;

            if (is_file($fullpathImg)) {
                unlink($fullpathImg);
            }

            $this->model_classes->where('id_curso', $id_course)->where('id_aula', $id_class)->delete();
        }

        // Apagar a pasta da aula se estiver vazia
        if (is_dir($fullpath)) {
            @rmdir($fullpath); // Usa @ para evitar warning se não estiver vazia
        }
        // Define mensagem de sucesso na sessão
        session()->setFlashdata('alert', [
            'type' => 'success',
            'message' => 'Aula deletada com sucesso!'
        ]);

        return redirect()->back();
    }
}
