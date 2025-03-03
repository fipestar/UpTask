<div class="contenedor reestablecer">
 <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Coloca tu nuevo password</p>

        <form method="POST" action="/reestablecer" class="formulario">

        <div class="campo">
                <label for="password">Password</label>
                <input 
                   type="password"
                   id="password"
                   placeholder="Tu Password"
                   name="password"
                   />               
            </div>

            <input type="submit" class="boton" value="Guardar Password" >
        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes cuenta? Iniciar Sesion</a>
            <a href="/crear">¿Aun no tienes cuenta? Crea una</a>
        </div>
    </div> <!--.Contenedor-sm-->
</div>