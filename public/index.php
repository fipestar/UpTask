<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\DashboardController;
use Controllers\TareaController;

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
$router->get('/crear-proyecto', [new DashboardController(), 'crear_proyecto']);
$router->post('/crear-proyecto', [new DashboardController(), 'crear_proyecto']);
$router->get('/perfil', [new DashboardController(), 'perfil']);
$router->post('/perfil', [new DashboardController(), 'perfil']);
$router->get('/cambiar-password', [new DashboardController(), 'cambiar_password']);
$router->post('/cambiar-password', [new DashboardController(), 'cambiar_password']);
$router->get('/proyecto', [new DashboardController(), 'proyecto']);

//Api para las tareas
$router->get('/api/tareas', [new TareaController(), 'index']);
$router->post('/api/tarea', [new TareaController(), 'crear']);
$router->post('/api/tarea/actualizar', [new TareaController(), 'actualizar']);
$router->post('/api/tarea/eliminar', [new TareaController(), 'eliminar']);
// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();