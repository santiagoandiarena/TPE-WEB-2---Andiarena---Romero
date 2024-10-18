<?php
require_once 'libs/response.php';
require_once 'app/middlewares/autentificador.sesion.middleware.php';
require_once 'app/controllers/ropa.controller.php';
require_once 'app/controllers/categorias.controller.php';
require_once 'app/controllers/auth.controller.php';


define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$res = new Response();

$action = 'home'; // accion por defecto si no se envia ninguna
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        $controller = new RopaController();
        $controller->mostrarHome();
        break;
    case 'producto':
        $controller = new RopaController();
        $controller->mostrarProducto($params[1]);
        break;
    case 'about':
        $controller = new RopaController();
        $controller->mostrarNosotros();
        break;
    case 'categorias':
        $controller = new CategoriasController();
        $controller->mostrarcategorias();
        break;
    case 'productosxcategorias':
        $controller = new CategoriasController();
        $controller->productosxcategorias($params[1]);
        break;
    case 'agregarArticulo':
        authSessionMiddleware($res);
        $controller = new RopaController();
        $controller->agregararticulo();
        break;
    case 'administrarArticulos':
        authSessionMiddleware($res);
        $controller = new RopaController();
        $controller->administrarArticulos();
        break;
    case 'eliminarArticulo':
        authSessionMiddleware($res);
        $controller = new RopaController();
        $controller->eliminarArticulo($params[1]);
        break;
    case 'mostrarFormEdicion':
        authSessionMiddleware($res);
        $controller = new RopaController();
        $controller->mostrarFormEdicion($params[1]);
        break;
    case 'editarArticulo':
        authSessionMiddleware($res);
        $controller = new RopaController();
        $controller->editarArticulo($params[1]);
        break;
    case 'agregarCategorias':
        authSessionMiddleware($res);
        $controller = new CategoriasController();
        $controller->agregarcategorias();
        break;
    case 'agregarcategorias':
        authSessionMiddleware($res);
        $controller = new CategoriasController();
        $controller->vercategoriasagregadas();
        break;
    case 'editarcategorias':
        authSessionMiddleware($res);
        $controller = new CategoriasController();
        $controller->editarcategorias($params[1]);
        break;
    case 'borrarcategoria':
        authSessionMiddleware($res);
        $controller = new CategoriasController();
        $controller->borrarcategoria($params[1]);
        break;
    case 'mostrarLogin':
        $controller = new AuthController();
        $controller->mostrarLogin();
        break;
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    default:
        $controller = new RopaController();
        $controller->mostrarError('404 Page Not Found');
        break;
}
