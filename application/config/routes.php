<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['default_controller'] = 'home';
$route['dashboard'] = 'home/dashboard';

$route['requisicaoajax'] = 'home/requisicaoajax';

/*
 *USUARIOS
 */
$route['busca_usuario_perfil'] = 'home/busca_usuario_perfil';
$route['lista_usuario'] = 'home/lista_usuario';
$route['consulta_usuario'] = 'home/consulta_usuario';
$route['cadastra_usuario'] = 'home/cadastra_usuario';
$route['profile'] = 'home/profile';


/*
 *CLIENTES
 */
$route['lista_cliente'] = 'cliente/lista_cliente';
$route['consulta_cliente'] = 'cliente/consulta_cliente';
$route['cadastra_cliente'] = 'cliente/cadastra_cliente';

/*
 *PRODUTOS
 */
$route['lista_produto'] = 'produto/lista_produto';
$route['consulta_produto'] = 'produto/consulta_produto';
$route['cadastra_produto'] = 'produto/cadastra_produto';

/*
 *PEDIDOS
 */
$route['novo_produto'] = 'pedido/novo_pedido';
$route['altera_produto'] = 'pedido/altera_produto';
$route['lista_produto'] = 'pedido/lista_produto';
$route['emissao_produto'] = 'pedido/emissao_produto';


/*
 *RELATORIOS
 */
$route['relatorio_clientes'] = 'relatorio/relatorio_clientes';
$route['relatorio_produtos'] = 'relatorio/relatorio_produtos';
$route['relatorio_pedidos'] = 'relatorio/relatorio_pedidos';

/*
 *AGENDA
 */
$route['agenda'] = 'agenda/agenda';

