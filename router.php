<?php
global $routes;
$routes = array();
$routes['/'] = '/';

// Admin/Funcionario
$routes['/funcionario/cadastrar'] = '/admin/viewCadastrar';
$routes['/login'] = '/admin/viewLogin';
$routes['/api/funcionario/cadastrar'] = '/admin/apiCadastrar';
$routes['/api/funcionario/listar'] = '/admin/apiListar';
$routes['/api/funcionario/buscar'] = '/admin/apiBuscar';
$routes['/api/funcionario/login'] = '/admin/apiLogin';
$routes['/perfil'] = '/admin/viewAlterarAdmin';
$routes['/api/admin/alterar'] = '/admin/apiAlterar';


// Serviços/Categorias
$routes['/servicos/cadastrar'] = '/servicos/viewCadastrar';
$routes['/api/servicos/buscar-por-categoria'] = '/servicos/apiBuscarPorCategoria';
$routes['/api/categorias/buscar'] = '/categoria/apiBuscar';
$routes['/categorias/cadastrar'] = '/categoria/viewCadastrar';
$routes['/api/categorias/cadastrar'] = '/categoria/apiCadastrar';

// servicoadmin
$routes['/api/admin-servicos/cadastrar'] = '/adminServico/apiCadastrar';
$routes['/api/admin-servicos/excluir'] = '/adminServico/apiExcluir';
