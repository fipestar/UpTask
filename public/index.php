<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\DashboardController;
$router = new Router();

//Login
$router->get('/', [new LoginController(), 'login']);
$router->post('/', [new LoginController(), 'login']);
$router->get('/logout', [new LoginController(), 'logout']);

//Crear Cuenta
$router->get('/crear', [new LoginController(), 'crear']);
$router->post('/crear', [new LoginController(), 'crear']);

//Formulario de olvide mi password
$router->get('/olvide', [new LoginController(), 'olvide']);
$router->post('/olvide', [new LoginController(), 'olvide']);

//Colocar el nuevo password
$router->get('/reestablecer', [new LoginController(), 'reestablecer']);
$router->post('/reestablecer', [new LoginController(), 'reestablecer']);

//Confirmacion de cuenta
$router->get('/mensaje', [new LoginController(), 'mensaje']);
$router->get('/confirmar', [new LoginController(), 'confirmar']);

//Zona de proyectos
$router->get('/dashboard', [new DashboardController(), 'index']);
// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();