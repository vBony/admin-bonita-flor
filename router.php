<?php
global $routes;
$routes = array();
$routes['/'] = '/';

// Admin/Funcionadio
$routes['/funcionario/cadastrar'] = '/admin/viewCadastrar';
$routes['/login'] = '/admin/viewLogin';
$routes['/api/funcionario/cadastrar'] = '/admin/apiCadastrar';
$routes['/api/funcionario/listar'] = '/admin/apiListar';
$routes['/api/funcionario/buscar'] = '/admin/apiBuscar';
$routes['/api/funcionario/login'] = '/admin/apiLogin';
$routes['/perfil'] = '/admin/viewAlterarAdmin';

// Serviços/Categorias
$routes['/servicos/cadastrar'] = '/servicos/viewCadastrar';
$routes['/api/servicos/buscar-por-categoria'] = '/servicos/apiBuscarPorCategoria';

// servicoadmin
$routes['/api/admin-servicos/cadastrar'] = '/adminServico/apiCadastrar';
$routes['/api/admin-servicos/excluir'] = '/adminServico/apiExcluir';
