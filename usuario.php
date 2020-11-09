<?php

include "./db/connection.php";

$users = $dao->select("email")->from("user")->toList();

include "./partials/header.php";

?>

    <div class="container py-5">
        <h1>Detalle de Usuario</h1>
        <div class="title-bar rounded"></div>

        <form>
            <div class="form-group">
                <label for="inputEmail">Correo electronico</label>
                <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="ej. user@mail.com" list="userlist" onkeyup="onUserSearch(this)" />
                <small id="emailHelp" class="form-text text-muted">Ingrese un usuario para ver en que provincia utilizo la aplicacion por ultima vez</small>
                <datalist id="userlist"></datalist>
            </div>
        </form>

        <div id="no-login-info">
            <h2>El usuario elegido no ha iniciado sesion por el momento</h2>
        </div>
        <div id="login-info" class="row">
            <div class="col-12 col-md-4">
                <h2>Usuario</h2>
                <p id="loginEmail"></p>
                <h3>Ultimo inicio de sesion</h3>
                <p id="loginCreated"></p>
                <h3>Ubicacion</h3>
                <p id="loginProvincia"></p>
                <div id="loginMap"></div>
            </div>
        </div>
    </div>


<?php include "./partials/footer.php"; ?>
<script type="application/javascript" src="./assets/js/usuario.js"></script>
