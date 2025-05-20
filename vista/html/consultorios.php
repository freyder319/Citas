<!DOCTYPE html>
<html>
<head>
<title>Sistema de Gestión Odontológica</title>
 <link rel="stylesheet" type="text/css" href="Vista/css/estilos.css">
  <link href="Vista/jquery/jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
 <script src="Vista/jquery/jquery-3.7.1.min.js" type="text/javascript"></script>
 <script src="Vista/jquery/jquery-ui-1.12.1.custom/jquery-ui.js" type="text/javascript"></script>

 <script src="Vista/js/script.js" type="text/javascript"></script>
 <script>
 </script>
 </head> 
 <body>
 <div id="contenedor">
 <div id="encabezado">
 <h1>Sistema de Gestión Odontológica</h1>
 </div>
 <ul id="menu">
 <li><a href="index.php">inicio</a> </li>
 <li><a href="index.php?accion=asignar">Asignar</a> </li>
 <li><a href="index.php?accion=consultar">Consultar Cita</a> </li>
 <li><a href="index.php?accion=cancelar">Cancelar Cita</a> </li>
 <li><a class="activa" href="index.php?accion=consultorio">Consultorios</a> </li>
 </ul>
 <div id="contenido">
    <h2>Consultorios</h2>
    <input type="button" name="ingConsultorio" id="ingConsultorio" value="Ingresar Consultorio" onclick="mostrarFormulario2();">
    <br><br>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>

            <th>Acciones</th>
        </tr>
        <?php while ($fila = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $fila["ConNumero"]; ?></td>
            <td><?php echo $fila["ConNombre"]; ?></td>
            <td>
            <a href="index.php?accion=modificarConsultorio&id=<?php echo $fila['ConNumero']; ?>">Modificar</a>
            <a href="index.php?accion=eliminarConsultorio&id=<?php echo $fila['ConNumero']; ?>" onclick="return confirm('¿Seguro que deseas eliminar este consultorio?');">Eliminar</a>
            </td>

        </tr>
        <?php } ?>
    </table>
</div>
 </div> 
    <div id="frmConsultorio" title="Agregar Nuevo Paciente">
    <form id="agregarConsultorio" method="PO">
    <table>
        <tr>
            <td>ID Consultorio</td>
            <td><input type="number" name="ConNumero" id="ConNumero"></td>
        </tr>
        <tr>
            <td>Nombre del Consultorio</td>
            <td><input type="text" name="ConNombre" id="ConNombre"></td>
        </tr>
    </table>
    </form>
    </div>
 </body>
</html>
</body>
</html>