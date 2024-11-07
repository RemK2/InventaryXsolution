<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Añadir Nuevo Usuario</h1>
    
    <form action="../bd/procesar_add_user.php" method="POST">
        <div class="form-group">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de usuario" required>
        </div>

        <div class="form-group">
            <label for="first_name">Nombre:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombre" required>
        </div>

        <div class="form-group">
            <label for="last_name">Apellido:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Apellido" required>
        </div>

        <div class="form-group">
            <label for="gender">Género:</label>
            <select class="form-control" id="gender" name="gender">
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
            </select>
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
        </div>

        <div class="form-group">
            <label for="status">Estado:</label>
            <select class="form-control" id="status" name="status">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Añadir Usuario</button>
    </form>
</div>
<!--FIN del cont principal-->

<?php require_once "vistas/parte_inferior.php"?>
