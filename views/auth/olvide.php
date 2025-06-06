<div class="contenedor olvide">
 <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Ingresa tu correo para recuperar tu password</p>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <form method="POST" action="/olvide" class="formulario" novalidate>

            <div class="campo">
                <label for="email">Email</label>
                <input 
                   type="email"
                   id="email"
                   placeholder="Tu Email"
                   name="email"
                   />               
            </div>

            <input type="submit" class="boton" value="Enviar Instrucciones" >
        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes cuenta? Iniciar Sesion</a>
            <a href="/crear">¿Aun no tienes cuenta? Crea una</a>
        </div>
    </div> <!--.Contenedor-sm-->
</div>