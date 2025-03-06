<?php
namespace Controllers;

use Classes\Email;
use MVC\Router;
use Model\Usuario;

class LoginController {
    public static function login(Router $router) {

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }

        //Render a la vista
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesion'
        ]);
    }

    public static function logout() {
        echo "Desde login";     
    }

    public static function crear(Router $router) {
        $alertas = [];

        $usuario = new Usuario;
 

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $usuario->sincronizar($_POST);

            $alertas = $usuario->validarNuevaCuenta();

            if(empty($alertas)){
                $existeUsuario = Usuario::where('email', $usuario->email);

                if($existeUsuario) {
                    Usuario::setAlerta('error', 'El usuario ya esta registrado');
                    $alertas = Usuario::getAlertas();
                }else{
                    //Hashea el password
                    $usuario->hashPassword();

                    //eliminar password 2
                    unset($usuario->password2);

                    //Generar el token
                    $usuario->crearToken();
                    //Crear un nuevo usuario
                    $resultado = $usuario->guardar();

                    //Enviar Email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    if($resultado){
                        header('Location: /mensaje');
                    }
                }
            }

        }

        $router->render('auth/crear', [
            'titulo' => 'Iniciar Sesion',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);

    }

    public static function olvide(Router $router) {
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if(empty($alertas)){
                $usuario = Usuario::where('email', $usuario->email);

                if($usuario && $usuario->confirmado){
                    //Generar un nuevo token
                    $usuario->crearToken();
                    unset($usuario->password2);

                    //Actualizar el usuario
                    $usuario->guardar();
                    //Enviar el Email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    //Imprimir la alerta
                    Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu Email');
                }else{
                    Usuario::setAlerta('error', 'El usuario no existe o no esta confirmado');
                    
                }
            }
        }

        $alertas = Usuario::getAlertas();

        //Muestra la vista
        $router->render('auth/olvide', [
            'titulo' => 'Olvide mi Password',
            'alertas' => $alertas
        ]);
    }

    public static function reestablecer(Router $router) {
        $token = s($_GET['token']);
        $mostrar = true;

        if(!$token) header('Location: /');

        //Identificar al usuario con este token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token no valido');
            $mostrar = false;
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }

        $alertas = Usuario::getAlertas();

        //Muestra la vista
        $router->render('auth/reestablecer', [
            'titulo' => 'Reestablecer Password',
            'alertas' => $alertas,
            'mostrar' => $mostrar
        ]);
    }

    public static function mensaje(Router $router) {
        $router->render('auth/mensaje',[
            'titulo' => 'Cuenta Creada Exitosamente'
        ]);
    }

    public static function confirmar(Router $router) {

        $token = s($_GET['token']);

        if(!$token) header('Location: /');

        //Encontrar al usuario con ese token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            //No se encontro un usuario con ese token
            Usuario::setAlerta('error', 'Token no valido');
        } else {
            //Confirmar la cuenta
            $usuario->confirmado = 1;
            $usuario->token = null;
            unset($usuario->password2);

            //Guardar en la BD
            $usuario->guardar();

            $usuario::setAlerta('exito', 'Cuenta Comprobada Correctamente');
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmar', [
            'titulo' => 'Confirma tu cuenta UpTask',
            'alertas' => $alertas
        ]);
    }
}