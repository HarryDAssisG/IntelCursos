<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/Principal', 'Home::index', ['filter' => 'authentication:1']);
$routes->get('/', 'Home::index', ['filter' => 'authentication:1']);
$routes->get('/Entrar', 'AcessSystem::login');
$routes->post('/Entrar', 'AcessSystem::setlogin');
$routes->get('/Sair', 'AcessSystem::logout');
$routes->get('/Cursos-Disponiveis', 'Courses::view', ['filter' => 'authentication:1']);
$routes->get('/Curso/(:num)', 'Classes::viewAllClasses/$1', ['filter' => 'authentication:1']);
$routes->get('/Curso/(:num)/Aula/(:num)', 'Classes::viewContent/$1/$2', ['filter' => 'authentication:1']);
$routes->post('/AlterarSenha/(:num)', 'Users::chargepassword/$1', ['filter' => 'authentication:1']);

///ADMIN
$routes->get('/Admin/Cursos', 'Courses::adminview', ['filter' => 'authentication:2']);
$routes->get('/Admin/Editar/Curso/(:num)', 'Classes::adminViewAllClasses/$1', ['filter' => 'authentication:2']);
$routes->get('/Admin/Editar/Curso/(:num)/Aula/(:num)', 'Classes::admincontent/$1/$2', ['filter' => 'authentication:2']);
$routes->get('/Admin/Usuarios', 'Users::usersview', ['filter' => 'authentication:2']);
$routes->get('/Admin/Usuario/Editar/(:num)', 'Users::edit/$1', ['filter' => 'authentication:2']);
//FUNCTIONS
$routes->post('/Admin/Cursos', 'Courses::createcourse', ['filter' => 'authentication:2']);
$routes->post('/Admin/EditarCurso/(:num)', 'Courses::editcourse/$1', ['filter' => 'authentication:2']);
$routes->post('/Admin/DeletarCurso/(:num)', 'Courses::deletecourse/$1', ['filter' => 'authentication:2']);
$routes->post('/Admin/Curso/(:num)/CriarAula', 'Classes::createclass/$1', ['filter' => 'authentication:2']);
$routes->post('/Admin/Editar/Curso/(:num)/Aula/(:num)/EditarAula', 'Classes::editclass/$1/$2', ['filter' => 'authentication:2']);
$routes->post('/Admin/Editar/Curso/(:num)/Aula/(:num)/DeletarAula', 'Classes::deleteClass/$1/$2', ['filter' => 'authentication:2']);
$routes->post('/Admin/Editar/Curso/(:num)/Aula/(:num)/AdicionarMaterial', 'Classes::addMaterials/$1/$2', ['filter' => 'authentication:2']);
$routes->post('/Admin/Editar/Curso/(:num)/Aula/(:num)/DeletarMaterial/(:num)', 'Classes::deleteMaterials/$1/$2/$3', ['filter' => 'authentication:2']);
$routes->post('/Admin/Usuarios/Criar', 'Users::createuser', ['filter' => 'authentication:2']);
$routes->post('/Admin/Usuario/Deletar/(:num)', 'Users::deleteuser/$1', ['filter' => 'authentication:2']);
$routes->post('/Admin/Usuario/Editar/(:num)', 'Users::setedit/$1', ['filter' => 'authentication:2']);
$routes->post('/Admin/Usuario/NovaSenha/(:num)', 'Users::newpassword/$1', ['filter' => 'authentication:2']);











